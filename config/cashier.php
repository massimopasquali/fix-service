<?php

return [
    'currency' => 'eur',
    'currency_symbol' => '€',

    // Disabilita calcolo automatico IVA
    'tax_rates' => [],

    /*
        |--------------------------------------------------------------------------
        | Subscription Model
        |--------------------------------------------------------------------------
        */
    'models' => [
        'subscription' => \App\Models\Subscription::class,
    ],

    // Configura webhook
    'webhook' => [
        'secret' => env('STRIPE_WEBHOOK_SECRET'),
        'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
    ],
];
