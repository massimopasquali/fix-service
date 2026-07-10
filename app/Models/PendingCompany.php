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
        'admin_name',
        'admin_password_hash',
        'plan',
        'status',               // pending_payment, completed, failed
        'stripe_session_id',
        'company_id',           // riferimento alla company creata
        'tenant_id',            // riferimento al tenant creato
    ];

    protected $hidden = [
        'admin_password_hash',
    ];
}
