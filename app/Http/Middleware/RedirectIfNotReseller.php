<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotReseller
{
    public function handle($request, Closure $next, $guard = "reseller")
    {
        if (!auth()->guard($guard)->check()) {
            return redirect(route('reseller.login'));
        }
        return $next($request);
    }
}
