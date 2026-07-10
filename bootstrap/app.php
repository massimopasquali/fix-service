<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Escludi il webhook Stripe dalla verifica CSRF
        $middleware->validateCsrfTokens(except: [
            'stripe/*', // Esclude tutte le rotte che iniziano con stripe/
        ]);
        $middleware->alias([
            'tenant' => \App\Http\Middleware\InitializeTenantByUser::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'PreventAccessFromCentralDomains' => \App\Http\Middleware\PreventAccessFromCentralDomains::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
