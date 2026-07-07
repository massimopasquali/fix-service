<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 1. Crea l'utente
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Crea il tenant associato
        $tenant = Tenant::create([
            'user_id' => $user->id,
            'name' => "Tenant di {$user->name}",
            'domain' => $this->generateTenantDomain($user),
            'stripe_customer_id' => null, // verrà popolato dopo il pagamento
            'plan' => 'trial',
        ]);

        // 3. Collega l'utente al tenant
        $user->update(['tenant_id' => $tenant->id]);

        // 4. Crea il cliente Stripe (opzionale, se vuoi farlo subito)
        // $stripeCustomer = $user->createAsStripeCustomer();
        // $tenant->update(['stripe_customer_id' => $stripeCustomer->id]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    private function generateTenantDomain(User $user): string
    {
        return strtolower(str_replace(' ', '-', $user->name)) . '.' . config('app.domain');
    }
}
