<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PendingCompany;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stancl\Tenancy\Database\Models\Domain;

class StripeWebhookController extends Controller
{
    /**
     * Router principale webhook
     */
    public function handle(Request $request)
    {
        $payload = $request->all();
        $eventType = $payload['type'] ?? null;

        Log::info('Stripe Webhook ricevuto', [
            'type'    => $eventType,
            'event_id' => $payload['id'] ?? null,
        ]);

        return match ($eventType) {
            'checkout.session.completed'    => $this->handleCheckoutSessionCompleted($payload),
            'customer.subscription.updated' => $this->handleSubscriptionUpdated($payload),
            'customer.subscription.deleted' => $this->handleSubscriptionDeleted($payload),
            'invoice.payment_succeeded'     => $this->handleInvoicePaymentSucceeded($payload),
            'invoice.payment_failed'        => $this->handleInvoicePaymentFailed($payload),
            default => response()->json(['status' => 'ignored', 'type' => $eventType]),
        };
    }

    /**
     * 1. CHECKOUT COMPLETATO
     */
    private function handleCheckoutSessionCompleted(array $payload)
    {
        $session = $payload['data']['object'];

        if (($session['mode'] ?? '') !== 'subscription') {
            return response()->json(['status' => 'skipped']);
        }

        $metadata        = $session['metadata'] ?? [];
        $pendingId       = $metadata['pending_company_id'] ?? null;
        $companyId       = $metadata['company_id'] ?? null;
        $subscriptionId  = $session['subscription'] ?? null;
        $customerId      = $session['customer'] ?? null;
        $priceId         = $metadata['price_id']
            ?? ($session['line_items']['data'][0]['price']['id'] ?? null);

        Log::info('Checkout session completed', [
            'session_id'      => $session['id'],
            'pending_id'      => $pendingId,
            'company_id'      => $companyId,
            'subscription_id' => $subscriptionId,
            'customer_id'     => $customerId,
            'price_id'        => $priceId,
        ]);

        if ($pendingId) {
            return $this->processNewTenant($pendingId, $subscriptionId, $priceId, $customerId);
        }

        if ($companyId) {
            return $this->processExistingCompany($companyId, $subscriptionId, $priceId, $customerId);
        }

        Log::warning('Checkout senza identificatore', ['metadata' => $metadata]);

        return response()->json(['status' => 'no_identifier'], 400);
    }

    /**
     * Scenario 1: Nuova registrazione (da PendingCompany)
     */
    private function processNewTenant($pendingId, $subscriptionId, $priceId, $customerId)
    {
        $pending = PendingCompany::find($pendingId);

        if (!$pending || $pending->status === 'completed') {
            return response()->json(['status' => 'already_processed']);
        }

        DB::transaction(function () use ($pending, $subscriptionId, $priceId, $customerId) {
            // 1. Crea Tenant nel DB centrale
            $tenant = Tenant::create([
                'id'           => $pending->tenant_id,
                'name'         => $pending->company_name,
                'email'        => $pending->email,
                'vat_number'   => $pending->vat_number,
                'address'      => $pending->address,
                'stripe_id'    => $customerId,
                'stripe_status' => 'active',
            ]);

            // 2. Crea dominio
            $centralDomain = config('tenancy.central_domains.0');
            Domain::create([
                'domain'    => $pending->subdomain . '.' . $centralDomain,
                'tenant_id' => $tenant->id,
            ]);

            // 3. Operazioni nel DB tenant
            $tenant->run(function () use ($pending, $subscriptionId, $priceId, $customerId) {
                // Crea Company (con Billable)
                $company = Company::create([
                    'name'       => $pending->company_name,
                    'email'      => $pending->email,
                    'vat_number' => $pending->vat_number,
                    'address'    => $pending->address,
                    'stripe_id'  => $customerId,
                ]);

                // Crea utente admin
                User::create([
                    'name'     => $pending->admin_name,
                    'email'    => $pending->email,
                    'password' => $pending->admin_password_hash,
                    'role'     => 'admin',
                    'company_id' => $company->id,
                ]);

                // Crea subscription Cashier
                if ($subscriptionId && $priceId) {
                    $company->subscriptions()->create([
                        'name'           => 'default',
                        'stripe_id'      => $subscriptionId,
                        'stripe_status'  => 'active',
                        'stripe_price'   => $priceId,
                        'quantity'       => 1,
                        'trial_ends_at'  => null,
                        'ends_at'        => null,
                    ]);

                    Log::info('Subscription creata per nuovo tenant', [
                        'tenant_id'       => $pending->tenant_id,
                        'subscription_id' => $subscriptionId,
                    ]);
                }
            });

            // 4. Aggiorna pending
            $pending->update(['status' => 'completed']);
        });

        return response()->json(['status' => 'success']);
    }

    /**
     * Scenario 2: Azienda esistente che si abbona
     */
    private function processExistingCompany($companyId, $subscriptionId, $priceId, $customerId)
    {
        $company = Company::where('id', $companyId)->first();

        if (!$company) {
            Log::warning('Company non trovata', ['company_id' => $companyId]);
            return response()->json(['status' => 'company_not_found'], 404);
        }

        // Aggiorna stripe_id
        $company->update(['stripe_id' => $customerId]);

        // Crea subscription
        if ($subscriptionId && $priceId) {
            $company->subscriptions()
                ->where('name', 'default')
                ->delete();

            $company->subscriptions()->create([
                'name'           => 'default',
                'stripe_id'      => $subscriptionId,
                'stripe_status'  => 'active',
                'stripe_price'   => $priceId,
                'quantity'       => 1,
                'trial_ends_at'  => null,
                'ends_at'        => null,
            ]);

            Log::info('Subscription creata per company esistente', [
                'company_id'      => $companyId,
                'subscription_id' => $subscriptionId,
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * 2. SUBSCRIPTION UPDATED
     */
    private function handleSubscriptionUpdated(array $payload)
    {
        $subscription = $payload['data']['object'];
        $customerId   = $subscription['customer'];
        $status       = $subscription['status'];
        $priceId      = $subscription['items']['data'][0]['price']['id'] ?? null;
        $stripeSubId  = $subscription['id'];

        $company = Company::where('stripe_id', $customerId)->first();

        if (!$company) {
            return response()->json(['status' => 'company_not_found'], 404);
        }

        $companySubscription = $company->subscriptions()
            ->where('stripe_id', $stripeSubId)
            ->first();

        if ($companySubscription) {
            $companySubscription->update([
                'stripe_status' => $status,
                'stripe_price'  => $priceId,
                'ends_at'       => $status === 'active' ? null : now(),
            ]);

            Log::info('Subscription aggiornata', [
                'company_id' => $company->id,
                'status'     => $status,
            ]);
        }

        return response()->json(['status' => 'updated']);
    }

    /**
     * 3. SUBSCRIPTION DELETED
     */
    private function handleSubscriptionDeleted(array $payload)
    {
        $subscription = $payload['data']['object'];
        $customerId   = $subscription['customer'];
        $stripeSubId  = $subscription['id'];

        $company = Company::where('stripe_id', $customerId)->first();

        if (!$company) {
            return response()->json(['status' => 'company_not_found'], 404);
        }

        $companySubscription = $company->subscriptions()
            ->where('stripe_id', $stripeSubId)
            ->first();

        if ($companySubscription) {
            $companySubscription->update([
                'stripe_status' => 'canceled',
                'ends_at'       => now(),
            ]);

            Log::info('Subscription cancellata', ['company_id' => $company->id]);
        }

        return response()->json(['status' => 'canceled']);
    }

    /**
     * 4. INVOICE PAYMENT SUCCEEDED
     */
    private function handleInvoicePaymentSucceeded(array $payload)
    {
        $invoice = $payload['data']['object'];

        Log::info('Pagamento periodico riuscito', [
            'customer_id' => $invoice['customer'],
            'amount'      => $invoice['amount_paid'],
            'currency'    => $invoice['currency'],
            'invoice_id'  => $invoice['id'],
        ]);

        return response()->json(['status' => 'logged']);
    }

    /**
     * 5. INVOICE PAYMENT FAILED
     */
    private function handleInvoicePaymentFailed(array $payload)
    {
        $invoice    = $payload['data']['object'];
        $customerId = $invoice['customer'];

        $company = Company::where('stripe_id', $customerId)->first();

        if ($company) {
            Log::warning('Pagamento fallito', [
                'company_id'   => $company->id,
                'company_name' => $company->name,
                'amount'       => $invoice['amount_due'],
            ]);
        }

        return response()->json(['status' => 'payment_failed_logged']);
    }
}
