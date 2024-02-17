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
    public function index(Request $request)
    {
        // titolo vista blade
        $titlePage = "Shop";

        // Recupera i filtri salvati in sessione
        $filters = session()->get('filters', []);

        if ($request->all()) {
            // validazione request
            $request->validate([
                'genres' => 'array',
                'genres.*' => 'integer|exists:genres,id',
                'categories' => 'array',
                'categories.*' => 'integer|exists:categories,id',
                'sizes' => 'array',
                'sizes.*' => 'integer|exists:sizes,id',
                'colors' => 'array',
                'colors.*' => 'integer|exists:colors,id'
            ]);

            // salvo i filtri in sessione
            $filters = $request->all();
            session()->put('filters', $filters);
        }

        // Recupera i prodotti
        $query = Product::with(['categories', 'sizes'])->where('visible', 1);

        // Applica filtri se presenti
        if (!empty($filters)) {
            if (isset($filters['genres'])) {
                $query->whereIn('genre_id', $filters['genres']);
            }

            if (isset($filters['categories'])) {
                $query->whereHas('categories', function ($category) use ($filters) {
                    $category->whereIn('id', $filters['categories']);
                });
            }

            if (isset($filters['sizes'])) {
                $query->whereHas('sizes', function ($size) use ($filters) {
                    $size->whereIn('id', $filters['sizes']);
                });
            }

            if (isset($filters['colors'])) {
                $query->whereHas('colors', function ($color) use ($filters) {
                    $color->whereIn('id', $filters['colors']);
                });
            }
        }

        $products = $query->paginate(20);

        // filtri
        $genres = Genre::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();

        return view('guest.shop', compact('titlePage', 'products', 'genres', 'categories', 'sizes', 'colors'));
    }

    /**
     * Lista prodotti in sconto
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productsDiscounted()
    {
        // titolo vista blade
        $titlePage = "Prodotti in sconto";

        // recupero i prodotti in sconto
        $products = Product::with(['categories', 'sizes'])->where('discount_percent', '!=', null)->where('visible', 1)->get();

        // filtri
        $genres = Genre::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();

        return view('guest.shop', compact('titlePage', 'products', 'genres', 'categories', 'sizes', 'colors'));
    }
}