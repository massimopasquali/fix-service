<?php

namespace App\Http\Controllers;

use App\Models\PendingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class RegistrationController extends Controller
{
    /**
     * Mostra il form di registrazione.
     */
    public function create()
    {
        return view('auth.register-company');
    }

    /**
     * Crea la PendingCompany e avvia il checkout Stripe.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name'   => 'required|string|max:255',
            'vat_number'     => 'required|string|max:50',
            'email'          => 'required|email|max:255',
            'address'        => 'required|string',
            'admin_name'     => 'required|string|max:255',
            'admin_password' => 'required|string|min:8|confirmed',
            'plan'           => 'required|in:monthly,yearly',
        ]);

        // 1. Crea SOLO PendingCompany (tenant e company nascono dal webhook)
        $pending = PendingCompany::create([
            'company_name'        => $validated['company_name'],
            'email'               => $validated['email'],
            'vat_number'          => $validated['vat_number'],
            'address'             => $validated['address'],
            'admin_name'          => $validated['admin_name'],
            'admin_password_hash' => Hash::make($validated['admin_password']),
            'plan'                => $validated['plan'],
            'status'              => 'pending',
        ]);

        // 2. Crea sessione Stripe Checkout
        Stripe::setApiKey(config('services.stripe.secret'));

        $priceId = $validated['plan'] === 'monthly'
            ? config('services.stripe.price_monthly')
            : config('services.stripe.price_yearly');

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price'    => $priceId,
                'quantity' => 1,
            ]],
            'mode'        => 'subscription',
            'success_url' => route('registration.success', ['pending_id' => $pending->id]),
            'cancel_url'  => route('registration.create'),
            'client_reference_id' => (string) $pending->id,
            'customer_email'      => $validated['email'],
            'metadata' => [
                'pending_company_id' => (string) $pending->id,
            ],
        ]);

        // 3. Salva Stripe Session ID
        $pending->update(['stripe_session_id' => $session->id]);

        // 4. Redirect a Stripe
        return redirect($session->url);
    }

    /**
     * Pagina di successo post-pagamento.
     */
    public function success(Request $request)
    {
        $pending = PendingCompany::findOrFail($request->pending_id);

        return view('auth.success', compact('pending'));
    }
}
