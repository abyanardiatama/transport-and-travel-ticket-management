<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtasanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_atasan1 == 1 || auth()->user()->is_atasan2 == 1) {
            return $next($request);
        }

        return redirect('/dashboard'); // Redirect to home or another route if not admin
    }
}
