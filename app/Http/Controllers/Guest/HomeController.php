<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // prodotti in sconto
        $productsDiscounted = Product::where('discount_percent', '!=', null)->where('visible', 1)->get();

        return view('guest.home', compact('productsDiscounted'));
    }
}