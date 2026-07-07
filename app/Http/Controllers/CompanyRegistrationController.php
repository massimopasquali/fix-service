<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PendingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CompanyRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-company');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'vat_number' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'admin_name' => 'required|string|max:255',
            'admin_password' => 'required|string|min:8|confirmed',
            'plan' => 'required|in:monthly,yearly',
        ]);

        // 1. Crea PendingCompany
        $pending = PendingCompany::create([
            'company_name' => $validated['company_name'],
            'email' => $validated['email'],
            'vat_number' => $validated['vat_number'],
            'address' => $validated['address'],
            'admin_name' => $validated['admin_name'],
            'admin_password_hash' => Hash::make($validated['admin_password']),
            'plan' => $validated['plan'],
            'status' => 'pending_payment',
        ]);

        // 2. Crea sessione Stripe Checkout
        Stripe::setApiKey(config('cashier.secret'));

        $priceId = $validated['plan'] === 'monthly'
            ? config('services.stripe.price_monthly')
            : config('services.stripe.price_yearly');

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('registration.success', ['pending_id' => $pending->id]),
            'cancel_url' => route('registration.cancel', ['pending_id' => $pending->id]),
            'client_reference_id' => $pending->id,
            'customer_email' => $validated['email'],
            'metadata' => [
                'pending_company_id' => $pending->id,
                'tenant_id' => $pending->tenant_id,
            ],
        ]);

        // 3. Salva Stripe Session ID
        $pending->update(['stripe_session_id' => $session->id]);

        // 4. Redireziona a Stripe
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $pending = PendingCompany::findOrFail($request->pending_id);

        return view('auth.registration-success', compact('pending'));
    }

    public function cancel(Request $request)
    {
        $pending = PendingCompany::findOrFail($request->pending_id);
        $pending->update(['status' => 'cancelled']);

        return redirect()->route('registration.create')
            ->with('error', 'Registrazione annullata.');
    }
}
