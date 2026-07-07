<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepairStatusController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\Auth\CompanyRegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Webhook Stripe (DEVE essere FUORI da auth e CSRF)
|--------------------------------------------------------------------------
*/
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle'])
    ->name('stripe.webhook');

/*
|--------------------------------------------------------------------------
| Rotte pubbliche
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/stato-riparazione', [RepairStatusController::class, 'show'])
    ->name('repair-status');

Route::post('/stato-riparazione/check', [RepairStatusController::class, 'check'])
    ->name('repair-status.check');

Route::get('/chi-siamo', [AboutController::class, 'index'])
    ->name('about');

Route::get('/condizioni-di-utilizzo', [LegalController::class, 'terms'])
    ->name('legal.terms');

Route::get('/privacy-policy', [LegalController::class, 'privacy'])
    ->name('legal.privacy');

/*
|--------------------------------------------------------------------------
| Registrazione Azienda (con URL diverso da /register di Breeze)
|--------------------------------------------------------------------------
*/
// Rotte CENTRALI per la registrazione (accessibili solo dal dominio centrale)
Route::middleware(['central'])->group(function () {

    Route::prefix('azienda')->name('registration.')->group(function () {
        Route::get('/registra', [RegistrationController::class, 'create'])->name('create');
        Route::post('/registra', [RegistrationController::class, 'store'])->name('store');
        Route::get('/successo', [RegistrationController::class, 'success'])->name('success');
    });

    // Webhook Stripe (deve essere centrale)
    Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleCheckoutSessionCompleted'])
        ->name('stripe.webhook')
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});

// Rotte TENANT (accessibili dai subdomain)
Route::middleware(['tenant'])->group(function () {
    Route::get('/dashboard', function () {
        return view('tenant.dashboard');
    })->name('tenant.dashboard');

    // Altre rotte tenant...
});


/*
|--------------------------------------------------------------------------
| Rotte autenticate (utente loggato)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profilo
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout e abbonamento
    Route::get('/checkout', [SubscriptionController::class, 'checkout'])->name('checkout');
    Route::get('/rinnova-abbonamento', [SubscriptionController::class, 'show'])->name('subscription.show');
    Route::post('/rinnova-abbonamento', [SubscriptionController::class, 'renew'])->name('subscription.renew');
});

/*
|--------------------------------------------------------------------------
| Rotte pricing e Rotta per la pagina About classica
|--------------------------------------------------------------------------
*/
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Rotta per la pagina dei prezzi (Abbonamenti Stripe)
Route::get('/pricing', [AboutController::class, 'pricing'])->name('pricing');

/*
|--------------------------------------------------------------------------
| Rotte di autenticazione Laravel Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

