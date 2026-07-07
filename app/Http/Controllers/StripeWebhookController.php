<?php

namespace App\Http\Controllers;

use App\Models\PendingCompany;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Database\Models\Domain;

class StripeWebhookController extends Controller
{
    public function handleCheckoutSessionCompleted(Request $request)
    {
        $payload = $request->all();
        $session = $payload['data']['object'];

        if ($session['mode'] !== 'subscription') {
            return response()->json(['status' => 'skipped']);
        }

        $pendingId = $session['metadata']['pending_company_id'] ?? null;

        if (!$pendingId) {
            return response()->json(['status' => 'no_pending_id'], 400);
        }

        $pending = PendingCompany::find($pendingId);

        if (!$pending || $pending->status === 'completed') {
            return response()->json(['status' => 'already_processed']);
        }

        DB::transaction(function () use ($pending, $session) {
            // 1. Crea il Tenant con lo slug come ID
            $tenant = Tenant::create([
                'id' => $pending->tenant_id, // Usa lo slug come ID
                'name' => $pending->company_name,
                'email' => $pending->email,
                'vat_number' => $pending->vat_number,
                'address' => $pending->address,
                'stripe_id' => $session['customer'],
                'stripe_status' => 'active',
            ]);

            // 2. Crea il dominio/subdomain
            $centralDomain = config('tenancy.central_domains.0');
            Domain::create([
                'domain' => $pending->subdomain . '.' . $centralDomain,
                'tenant_id' => $tenant->id,
            ]);

            // 3. Esegui operazioni nel database del tenant
            $tenant->run(function () use ($pending) {
                // Crea la Company
                $company = \App\Models\Company::create([
                    'name' => $pending->company_name,
                    'email' => $pending->email,
                    'vat_number' => $pending->vat_number,
                    'address' => $pending->address,
                ]);

                // Crea l'utente admin
                User::create([
                    'name' => $pending->admin_name,
                    'email' => $pending->email,
                    'password' => $pending->admin_password_hash,
                    'role' => 'admin',
                    'company_id' => $company->id,
                ]);
            });

            // 4. Aggiorna lo stato del PendingCompany
            $pending->update(['status' => 'completed']);
        });

        return response()->json(['status' => 'success']);
    }
}
