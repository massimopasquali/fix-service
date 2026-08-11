<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Tenant;
use Stancl\Tenancy\Tenancy;

class InitializeTenantByUser
{
    protected $tenancy;

    public function __construct(Tenancy $tenancy)
    {
        $this->tenancy = $tenancy;
    }

    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Se l'utente è loggato e ha un'azienda
        if ($user && $user->company) {
            // L'azienda ha un tenant associato
            $tenant = $user->company->tenant;

            if ($tenant) {
                // Inizializza il contesto tenant
                $this->tenancy->initialize($tenant);
            }
        }

        return $next($request);
    }
}
