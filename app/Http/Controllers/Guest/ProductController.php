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
        $products = $query->filterProducts($request)->paginate(20);

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
        $products = $query->filterProducts($request)->paginate(20);

        // filtri
        $genres = Genre::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();

        return view('guest.shop', compact('controllerMethodName', 'titlePage', 'products', 'genres', 'categories', 'sizes', 'colors'));
    }
}