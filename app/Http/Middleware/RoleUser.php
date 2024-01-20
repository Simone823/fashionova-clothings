<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // utente loggato
        $userAuth = Auth::user();

        // controllo se l'utente ha il ruolo User
        if (!$userAuth->hasRole('User')) {
            return abort(401);
        }

        return $next($request);
    }
}