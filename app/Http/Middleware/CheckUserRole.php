<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
        public function handle($request, Closure $next,...$roles)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }
        abort(403, 'Unauthorized action.');

        // foreach ($roles as $role) {
        //     if ($user->hasRole($role)) {
        //         if ($role == 'chef') {
        //             return redirect('/dashboard');
        //         } else if ($role == 'agent') {
        //             return redirect('/demande');
        //         }
        //     }
        // }

        // abort(403);
    }
}
