<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Whitelist dei Price ID (sostituisci con i tuoi ID reali di Stripe)
     */
    private const ALLOWED_PLANS = [
        'starter'          => 'price_starter_ID',
        'pro_monthly'      => 'price_pro_monthly_ID',
        'pro_yearly'       => 'price_pro_yearly_ID',
        'enterprise'       => 'price_enterprise_ID',
    ];

    /**
     * Mostra la pagina di gestione abbonamento
     */
    public function show()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('warning', 'Devi effettuare il login.');
        }

        if (!$user->company) {
            abort(403, 'Nessuna azienda associata al tuo account.');
        }

        $company = $user->company;

        // Recupera le fatture da Stripe
        $invoices = collect();
        if ($company->subscribed('default')) {
            $invoices = $company->invoices();
        }

        return view('subscription', [
            'company'       => $company,
            'subscription'  => $company->subscription('default'),
            'isSubscribed'  => $company->subscribed('default'),
            'onGracePeriod' => $company->subscription('default')?->onGracePeriod() ?? false,
            'currentPlan'   => $company->subscription('default')?->stripe_price,
            'invoices'      => $invoices,
        ]);
    }

    /**
     * Avvia il checkout Stripe
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'plan' => ['required', 'string', 'in:' . implode(',', array_keys(self::ALLOWED_PLANS))],
        ]);

        $company = auth()->user()->company;
        $priceId = self::ALLOWED_PLANS[$request->plan];

        // Se ha già un abbonamento → swap
        if ($company->subscribed('default')) {
            $company->subscription('default')->swap($priceId);

            return redirect()->route('subscription.show')
                ->with('success', 'Piano aggiornato con successo.');
        }

        // Crea o recupera il cliente Stripe
        $company->createOrGetStripeCustomer();

        // Nuovo abbonamento
        return $company->newSubscription('default', $priceId)
            ->checkout([
                'success_url' => route('subscription.show') . '?success=true',
                'cancel_url'  => route('pricing'),
                'billing_address_collection' => 'required',
                'tax_id_collection' => ['enabled' => true],
                'metadata' => [
                    'company_id' => $company->id,
                    'price_id'   => $priceId,
                ],
            ]);
    }

    /**
     * Cancella l'abbonamento (alla fine del periodo)
     */
    public function cancel(Request $request)
    {
        $company = auth()->user()->company;

        if ($company->subscribed('default')) {
            $company->subscription('default')->cancel();
        }

        return redirect()->route('subscription.show')
            ->with('success', 'Abbonamento cancellato. Avrai accesso fino alla fine del periodo.');
    }

    /**
     * Ripristina l'abbonamento (entro grace period)
     */
    public function resume(Request $request)
    {
        $company = auth()->user()->company;
        $subscription = $company->subscription('default');

        if ($subscription && $subscription->onGracePeriod()) {
            $subscription->resume();

            return redirect()->route('subscription.show')
                ->with('success', 'Abbonamento ripristinato.');
        }

        return redirect()->route('subscription.show')
            ->with('error', 'Impossibile ripristinare l\'abbonamento.');
    }
}
