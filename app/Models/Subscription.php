<?php

namespace App\Models;

use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    /**
     * I campi che possono essere assegnati in massa
     */
    protected $fillable = [
        'name',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'trial_ends_at',
        'ends_at',
    ];

    /**
     * I campi che devono essere castati
     */
    protected function casts(): array
    {
        return [
            'quantity'      => 'integer',
            'trial_ends_at' => 'datetime',
            'ends_at'       => 'datetime',
        ];
    }
}
