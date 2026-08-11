<?php
// app/Models/Tenant.php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Colonne custom della tabella `tenants`.
     * Solo dati di tenancy, NON duplicare quelli di Company.
     */
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'company_id',
            'plan',
            'onboarding_completed_at',
        ];
    }

    protected $casts = [
        'data'                  => 'array',
        'onboarding_completed_at' => 'datetime',
    ];

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
