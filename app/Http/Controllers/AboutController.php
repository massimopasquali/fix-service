<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Cashier;

class AboutController extends Controller
{
    /**
     * Mostra la pagina "Chi Siamo" (About).
     */
    public function index()
    {
        return view('about.index');
    }

    /**
     * Mostra la pagina dei Prezzi / Piani di Abbonamento (Stripe).
     */
    public function pricing()
    {
        // Recupera i prezzi attivi da Stripe
        // Nota: Assicurati di aver configurato i prodotti e i prezzi nella dashboard di Stripe
        $stripePrices = Cashier::stripe()->prices->all([
            'active' => true,
            'expand' => ['data.product'],
        ]);

        // Filtra o raggruppa i prezzi se necessario (es. mensili vs annuali)
        $prices = collect($stripePrices->data)->sortBy('unit_amount');

        return view('pricing', [
            'prices' => $prices,
        ]);
    }
}
