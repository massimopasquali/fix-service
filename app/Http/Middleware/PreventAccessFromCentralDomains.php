<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventAccessFromCentralDomains
{
    public function handle(Request $request, Closure $next)
    {
        // Implementa la tua logica qui
        // Per ora, permetti tutto
        return $next($request);
    }
}
