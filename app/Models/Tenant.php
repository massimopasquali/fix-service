<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public $incrementing = false;
    protected $keyType = 'string';

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'company_name',
            'email',
            'vat_number',
            'plan',
            'stripe_customer_id',
            'stripe_subscription_id',
            'trial_ends_at',
            'onboarding_completed_at',
        ];
    }
}
