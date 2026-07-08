<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Billable;

class Company extends Model
{
    use Billable;

    protected $fillable = [
        'name',
        'vat_number',
        'email',
        'phone',
        'address',
        'stripe_id',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class);
    }

    /**
     * Override della relazione subscriptions di Cashier
     * per usare il nostro modello personalizzato
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
