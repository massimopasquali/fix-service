<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingCompany extends Model
{
    protected $fillable = [
        'company_name',
        'email',
        'vat_number',
        'address',
        'subdomain',
        'admin_name',
        'admin_password_hash',
        'plan',
        'status',            // pending | paid | failed | expired
        'stripe_session_id',
        'company_id',
        'tenant_id',
    ];

    protected $hidden = [
        'admin_password_hash',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }
}
