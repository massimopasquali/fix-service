<?php

namespace Tests\Feature\Auth;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Cashier;
use Stripe\Customer;
use Stripe\StripeClient;
use Tests\TestCase;

class RegistrationWithTenantTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Imposta Stripe in modalità test
        Cashier::useStripeSk(config('services.stripe.secret'));
    }

    /** @test */
    public function registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /** @test */
    public function new_users_can_register_and_tenant_is_created(): void
    {
        $userData = [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Esegue la registrazione
        $response = $this->post('/register', $userData);

        // Verifica redirect dopo registrazione
        $response->assertRedirect('/dashboard');

        // Verifica che l'utente sia stato creato nel DB
        $this->assertDatabaseHas('users', [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
        ]);

        // Verifica che la password sia hashata correttamente
        $user = User::where('email', 'mario@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));

        // Verifica che l'utente sia autenticato
        $this->assertAuthenticatedAs($user);

        // Verifica che il tenant sia stato creato
        $this->assertDatabaseHas('tenants', [
            'user_id' => $user->id,
            'name' => 'Tenant di Mario Rossi', // o la logica che hai scelto
        ]);

        // Verifica la relazione user -> tenant
        $this->assertInstanceOf(Tenant::class, $user->tenant);
    }

    /** @test */
    public function registration_fails_with_invalid_data(): void
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'pw',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertDatabaseCount('users', 0);
        $this->assertDatabaseCount('tenants', 0);
    }

    /** @test */
    public function registration_fails_with_duplicate_email(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->post('/register', [
            'name' => 'Test',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('tenants', 0);
    }
}
