<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Laravel\Cashier\Billable;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, Billable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'vat_number',
        'address',
        'stripe_id',
        'stripe_status',
    ];

    // Override per permettere ID personalizzati (slug)
    public $incrementing = false;
    protected $keyType = 'string';
}
