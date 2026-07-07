<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Cashier\Subscription;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_subscribe_to_a_plan_after_registration(): void
    {
        // Crea utente con tenant
        $user = User::factory()->create();
        $tenant = Tenant::factory()->create(['user_id' => $user->id]);

        // Usa Stripe test mode
        $user->createAsStripeCustomer();

        // Simula abbonamento con carta di test Stripe
        $paymentMethod = $user->addPaymentMethod('pm_card_visa');

        $subscription = $user->newSubscription('default', 'price_monthly')
            ->create($paymentMethod->id);

        // Verifica abbonamento attivo
        $this->assertTrue($user->subscribed('default'));
        $this->assertTrue($user->subscription('default')->active());

        // Aggiorna il tenant
        $tenant->update([
            'plan' => 'premium',
            'stripe_customer_id' => $user->stripe_id,
        ]);

        $this->assertDatabaseHas('tenants', [
            'id' => $tenant->id,
            'plan' => 'premium',
        ]);
    }
}
