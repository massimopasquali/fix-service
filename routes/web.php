<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepairStatusController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LegalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [SubscriptionController::class, 'checkout'])->name('checkout');
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
});

// aggiunti da me 16-06-2026


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/stato-riparazione', [RepairStatusController::class, 'show'])
    ->name('repair.status');

Route::get('/chi-siamo', [AboutController::class, 'index'])
    ->name('about');

Route::get('/condizioni-di-utilizzo', [LegalController::class, 'terms'])
    ->name('legal.terms');

Route::get('/privacy-policy', [LegalController::class, 'privacy'])
    ->name('legal.privacy');

// Rotte protette per aziende abbonate
Route::middleware(['auth'])->group(function () {
    Route::get('/rinnova-abbonamento', [SubscriptionController::class, 'show'])
        ->name('subscription.show');
    Route::post('/rinnova-abbonamento', [SubscriptionController::class, 'renew'])
        ->name('subscription.renew');
    Route::post('/webhook/stripe', [SubscriptionController::class, 'webhook'])
        ->name('cashier.webhook');
});

require __DIR__.'/auth.php';
