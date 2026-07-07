<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PendingCompany extends Model
{
    protected $table = 'pending_companies';

    protected $fillable = [
        'tenant_id',
        'company_name',
        'email',
        'vat_number',
        'address',
        'subdomain',
        'admin_name',
        'admin_password_hash',
        'stripe_session_id',
        'plan',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pending) {
            if (empty($pending->tenant_id)) {
                $baseSlug = Str::slug($pending->company_name);
                $slug = $baseSlug;
                $counter = 1;

                while (
                    static::where('subdomain', $slug)->exists() ||
                    \App\Models\Tenant::where('id', $slug)->exists()
                ) {
                    $slug = $baseSlug . '-' . $counter++;
                }

                $pending->tenant_id = $slug;
                $pending->subdomain = $slug;
            }

            if (empty($pending->expires_at)) {
                $pending->expires_at = now()->addDay();
            }
        });
    }
}
