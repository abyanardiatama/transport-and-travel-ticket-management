<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Check if the user has at least one of the specified roles
        if ($user && $this->hasAnyRole($user, $roles)) {
            return $next($request);
        }

        return redirect('/dashboard'); // Redirect to home if the user doesn't have any of the specified roles
    }
    private function hasAnyRole($user, $roles)
    {
        foreach ($roles as $role) {
            if ($user->{"is_$role"}) {
                return true;
            }
        }

        return false;
    }
}
