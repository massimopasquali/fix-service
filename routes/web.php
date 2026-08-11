<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepairStatusController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| WEBHOOK STRIPE - FUORI DA TUTTI I MIDDLEWARE
|--------------------------------------------------------------------------
*/
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle'])
    ->name('stripe.webhook')
    ->withoutMiddleware([VerifyCsrfToken::class]);

/*
|--------------------------------------------------------------------------
| ROTTE PUBBLICHE (senza autenticazione, senza tenant)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/stato-riparazione', [RepairStatusController::class, 'show'])
    ->name('repair-status');

Route::post('/stato-riparazione/check', [RepairStatusController::class, 'check'])
    ->name('repair-status.check');

Route::get('/chi-siamo', [AboutController::class, 'index'])->name('about');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/pricing', [AboutController::class, 'pricing'])->name('pricing');
Route::get('/condizioni-di-utilizzo', [LegalController::class, 'terms'])->name('legal.terms');
Route::get('/privacy-policy', [LegalController::class, 'privacy'])->name('legal.privacy');

/*
|--------------------------------------------------------------------------
| Registrazione Azienda (dominio centrale)
|--------------------------------------------------------------------------
*/
// Usiamo PreventAccessFromTenantDomains (se esiste nel tuo pacchetto)
// oppure lasciamo solo 'web' se la registrazione è pubblica.
Route::middleware(['web'])->group(function () {

    Route::prefix('azienda')->name('registration.')->group(function () {
        Route::get('/registra', [RegistrationController::class, 'create'])->name('create');
        Route::post('/registra', [RegistrationController::class, 'store'])->name('store');
        Route::get('/successo', [RegistrationController::class, 'success'])->name('success');
    });
});

/*
|--------------------------------------------------------------------------
| ROTTE AUTENTICATE (utente loggato + tenant inizializzato)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'tenant'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profilo utente
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestione abbonamento
    Route::get('/abbonamento', [SubscriptionController::class, 'show'])->name('subscription.show');
    Route::post('/abbonamento/checkout', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::post('/abbonamento/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::post('/abbonamento/resume', [SubscriptionController::class, 'resume'])->name('subscription.resume');

    // Fatturazione
    Route::get('/billing', [BillingController::class, 'index'])->name('billing');
    Route::post('/billing/portal', [BillingController::class, 'portal'])->name('billing.portal');
});

/*
|--------------------------------------------------------------------------
| ROTTE DI AUTENTICAZIONE Laravel Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
