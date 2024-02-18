<?php

namespace App\Http\Controllers\Guest;

use App\Category;
use App\Color;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Product;
use App\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Shop (tutti i prodotti)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function shop(Request $request)
    {
        // nome del metodo del controller
        $controllerMethodName = __FUNCTION__;

        // titolo vista blade
        $titlePage = "Shop";

        // recupera i prodotti filtrati se ci sono filtri in sessione, se no torna tutti i prodotti
        $query = Product::with(['categories', 'sizes'])->where('visible', 1);
        $products = $query->filterProducts($request)->paginate(config('default_paginate_guest'));

        // filtri
        $genres = Genre::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();

        return view('guest.shop', compact('controllerMethodName', 'titlePage', 'products', 'genres', 'categories', 'sizes', 'colors'));
    }

    /**
     * Lista prodotti in sconto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productsDiscounted(Request $request)
    {
        // nome del metodo del controller
        $controllerMethodName = __FUNCTION__;

        // titolo vista blade
        $titlePage = "Prodotti in sconto";

        // recupero i prodotti in sconto
        $query = Product::with(['categories', 'sizes'])->where('discount_percent', '!=', null)->where('visible', 1);
        $products = $query->filterProducts($request)->paginate(config('default_paginate_guest'));

        // filtri
        $genres = Genre::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();

        return view('guest.shop', compact('controllerMethodName', 'titlePage', 'products', 'genres', 'categories', 'sizes', 'colors'));
    }

    /**
     * Lista genere 'Donna'
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productsWoman(Request $request)
    {
        // nome del metodo del controller
        $controllerMethodName = __FUNCTION__;

        // titolo vista blade
        $titlePage = "Prodotti Donna";

        // recupero i prodotti con genere 'Donna'
        $genreIdWoman = Genre::where('name', 'Donna')->pluck('id')->first();
        $query = Product::with(['categories', 'sizes'])->where('genre_id', $genreIdWoman)->where('visible', 1);
        $products = $query->filterProducts($request)->paginate(config('default_paginate_guest'));

        // filtri
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();

        return view('guest.shop', compact('controllerMethodName', 'titlePage', 'products', 'categories', 'sizes', 'colors'));
    }

    /**
     * Lista genere 'Uomo'
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productsMan(Request $request)
    {
        // nome del metodo del controller
        $controllerMethodName = __FUNCTION__;

        // titolo vista blade
        $titlePage = "Prodotti Uomo";

        // recupero i prodotti con genere 'Uomo'
        $genreIdMan = Genre::where('name', 'Uomo')->pluck('id')->first();
        $query = Product::with(['categories', 'sizes'])->where('genre_id', $genreIdMan)->where('visible', 1);
        $products = $query->filterProducts($request)->paginate(config('default_paginate_guest'));

        // filtri
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();

        return view('guest.shop', compact('controllerMethodName', 'titlePage', 'products', 'categories', 'sizes', 'colors'));
    }
}