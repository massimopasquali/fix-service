<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->company;

        // Recupera le fatture da Stripe (se l'azienda esiste e ha il trait Billable)
        $invoices = collect();
        if ($company && method_exists($company, 'invoices')) {
            $invoices = $company->invoices();
        }

        return view('billing', compact('company', 'invoices'));

    }

    public function portal(Request $request)
    {
        $company = $request->user()->company;

        if (!$company || !$company->subscribed('default')) {
            return redirect()->route('pricing')->with('error', 'Nessun abbonamento attivo.');
        }

        return $company->redirectToBillingPortal(route('subscription.show'));
    }

}
