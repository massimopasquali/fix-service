<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PendingCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Models\Tenant;
use Stripe\Checkout\Session;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (\Exception $e) {
            \Log::error('Stripe Webhook Error: ' . $e->getMessage());
            return response('Webhook Error', 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutCompleted($event->data->object);
                break;

            case 'customer.subscription.updated':
            case 'customer.subscription.deleted':
                // Cashier gestisce automaticamente questi eventi
                break;
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Gestisce il completamento del checkout:
     * crea Tenant + Company + User
     */
    private function handleCheckoutCompleted(Session $session)
    {
        $pendingId = $session->metadata->pending_company_id ?? null;

        if (!$pendingId) {
            \Log::warning('Webhook: pending_company_id mancante', ['session' => $session->id]);
            return;
        }

        $pending = PendingCompany::find($pendingId);

        if (!$pending) {
            \Log::warning("Webhook: PendingCompany #{$pendingId} non trovata");
            return;
        }

        // Evita elaborazioni duplicate
        if ($pending->status === 'completed') {
            return;
        }

        try {
            // 1. Crea il Tenant (database separato)
            $tenantId = Str::slug($pending->company_name) . '-' . Str::lower(Str::random(6));
            $tenant = Tenant::create([
                'id' => $tenantId,
            ]);

            // 2. Crea la Company nel database CENTRALE, collegata al tenant
            $company = Company::create([
                'name'       => $pending->company_name,
                'email'      => $pending->email,
                'vat_number' => $pending->vat_number,
                'address'    => $pending->address,
                'tenant_id'  => $tenant->id,
                'stripe_id'  => $session->customer, // 👈 importante per Cashier
            ]);

            // 3. Collega la subscription di Cashier alla company
            // Cashier userà stripe_id per collegare subscription e invoices
            $company->createOrGetStripeCustomer();

            // 4. Crea l'utente admin nel database DEL TENANT
            $tenant->run(function () use ($pending, $company) {
                User::create([
                    'name'       => $pending->admin_name,
                    'email'      => $pending->email,
                    'password'   => $pending->admin_password_hash, // già hashato
                    'company_id' => $company->id,
                    'role'       => 'admin',
                ]);
            });

            // 5. Aggiorna lo stato del PendingCompany
            $pending->update([
                'status'     => 'completed',
                'company_id' => $company->id,
                'tenant_id'  => $tenant->id,
            ]);

            \Log::info("Webhook: provisioning completato per company #{$company->id}");

        } catch (\Exception $e) {
            \Log::error('Webhook: errore provisioning', [
                'pending_id' => $pending->id,
                'error' => $e->getMessage(),
            ]);

            $pending->update(['status' => 'failed']);
            throw $e;
        }
    }
}
