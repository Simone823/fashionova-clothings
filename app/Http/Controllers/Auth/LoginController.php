<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo(): string
    {
        // Controlla se c'è un URL di redirect
        if (session()->has('redirect_to') && Auth::user()->hasRole('User')) {
            // Ottieni l'URL di checkout dalla sessione
            $redirectTo = session('redirect_to');

            // Rimuovi l'URL di checkout dalla sessione
            session()->forget('redirect_to');

            // Reindirizza l'utente all'URL di checkout salvato
            return $redirectTo;
        }

        // Controlla il ruolo dell'utente dopo il login
        if (!Auth::user()->hasRole('User')) {
            return '/admin/dashboard';
        }

        return RouteServiceProvider::HOME;
    }
}