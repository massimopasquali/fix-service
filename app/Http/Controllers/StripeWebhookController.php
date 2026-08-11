<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PendingCompany;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                config('services.stripe.webhook_secret')
            );
        } catch (\Exception $e) {
            \Log::error('Stripe Webhook Error: ' . $e->getMessage());
            return response('Webhook Error', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $this->handleCheckoutCompleted($event->data->object);
        }

        // Pagamento fallito o sessione scaduta → segna il pending come failed
        if (in_array($event->type, [
            'checkout.session.expired',
            'checkout.session.async_payment_failed',
        ])) {
            $this->handleCheckoutFailed($event->data->object);
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Gestisce il completamento del checkout:
     * crea Tenant + Company + User admin.
     */
    private function handleCheckoutCompleted(Session $session): void
    {
        $pendingId = $session->metadata->pending_company_id ?? null;

        if (!$pendingId) {
            \Log::warning('Webhook: pending_company_id mancante');
            return;
        }

        $pending = PendingCompany::find($pendingId);

        if (!$pending || $pending->status === 'paid') {
            return; // già elaborata o non trovata
        }

        try {
            // 1. Tenant (con TUTTE le colonne NOT NULL)
            $tenantId = Str::slug($pending->company_name) . '-' . Str::lower(Str::random(6));

            $tenant = Tenant::create([
                'id'                     => $tenantId,
                'company_name'           => $pending->company_name,
                'email'                  => $pending->email,
                'vat_number'             => $pending->vat_number,
                'plan'                   => $pending->plan,
                'stripe_customer_id'     => $session->customer,
                'stripe_subscription_id' => $session->subscription,
            ]);
            // ↑ Stancl crea il DB tenant_{id} + migra automaticamente

            // 2. Company centrale (entità Billable per Cashier)
            $company = Company::create([
                'name'       => $pending->company_name,
                'email'      => $pending->email,
                'vat_number' => $pending->vat_number,
                'address'    => $pending->address,
                'tenant_id'  => $tenant->id,
                'stripe_id'  => $session->customer,
            ]);

            // 3. Utente admin nel DB del tenant
            $tenant->run(function () use ($pending, $company) {
                User::create([
                    'name'       => $pending->admin_name,
                    'email'      => $pending->email,
                    'password'   => $pending->admin_password_hash,
                    'company_id' => $company->id,
                    'role'       => 'admin',
                ]);
            });

            // 4. Aggiorna pending
            $pending->update([
                'status'     => 'paid',
                'company_id' => $company->id,
                'tenant_id'  => $tenant->id,
                'subdomain'  => $tenantId,
            ]);

            \Log::info("✅ Provisioning completato per company #{$company->id} (tenant: {$tenantId})");

        } catch (\Exception $e) {
            \Log::error('Webhook: errore provisioning', [
                'pending_id' => $pending->id,
                'error'      => $e->getMessage(),
            ]);

            $pending->update(['status' => 'failed']);
            throw $e;
        }
    }

    /**
     * Gestisce fallimento / scadenza del checkout.
     */
    private function handleCheckoutFailed(Session $session): void
    {
        $pendingId = $session->metadata->pending_company_id ?? null;

        if (!$pendingId) {
            return;
        }

        PendingCompany::where('id', $pendingId)
            ->where('status', 'pending')
            ->first()
            ?->update(['status' => 'failed']);

        \Log::warning("⚠️ Checkout fallito/scaduto per pending #{$pendingId}");
    }
}
