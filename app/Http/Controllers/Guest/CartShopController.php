<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartShopController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.cartShop');
    }

    public function checkout()
    {
        // Controlla se l'utente è autenticato
        if (!Auth::check()) {
            // Se l'utente non è autenticato, salva l'URL del checkout nella sessione
            session(['redirect_to' => route('guest.cartShop.checkout')]);

            return redirect()->route('login');
        }

        // recupero l'utente
        $user = Auth::user();

        return view('guest.checkout', compact('user'));
    }
}