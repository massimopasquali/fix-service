<?php
// app/Models/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'tenant_id',
        // stripe_id, pm_type, pm_last_four, trial_ends_at
        // sono gestiti da Cashier automaticamente
    ];

    protected function casts(): array
    {
        return [
            'trial_ends_at'     => 'datetime',
            'email_verified_at' => 'datetime',
        ];
    }

    // ─── Relazioni ────────────────────────────────────────

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);  // ← App\Models\Tenant
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
