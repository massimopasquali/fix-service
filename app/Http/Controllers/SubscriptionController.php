<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function show()
    {
        $company = auth()->user()->company;
        return view('subscription', compact('company'));
    }

    public function renew(Request $request)
    {
        $company = auth()->user()->company;

        // Crea o aggiorna il cliente Stripe
        $company->createOrGetStripeCustomer();

        // Crea un checkout session per il piano scelto
        return $company->newSubscription('default', $request->plan)
            ->checkout([
                'success_url' => route('subscription.show') . '?success=true',
                'cancel_url'  => route('subscription.show') . '?cancel=true',
            ]);
    }

    public function webhook()
    {
        return app('Laravel\Cashier\Http\Controllers\WebhookController')->handleWebhook();
    }
}
