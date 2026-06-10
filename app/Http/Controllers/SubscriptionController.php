<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function checkout(Request $request)
    {
        $user = $request->user();

        // 'price_123...' è l'ID del prezzo creato in Stripe Dashboard
        return $user->newSubscription('default', 'price_123456789')
            ->checkout([
                'success_url' => route('dashboard'),
                'cancel_url'  => route('plans'),
            ]);
    }
}
