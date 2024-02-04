<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Color;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Product;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'roleAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // controllo il permesso utente
        if (!Gate::allows('products_view')) {
            abort(401);
        }

        // recupero i prodotti
        $products = Product::sortable(['code' => 'asc'])->paginate(config('app.default_paginate'));

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // controllo il permesso utente
        if (!Gate::allows('products_create')) {
            abort(401);
        }

        // relazioni
        $genres = Genre::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();

        return view('admin.products.create', compact('genres', 'categories', 'sizes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // controllo il permesso utente
        if (!Gate::allows('products_create')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => 'required|unique:products,name',
            'genre_id' => 'required|exists:genres,id',
            'price' => 'required|numeric|between:0,9999999.99',
            'discount_percent' => 'nullable|numeric|between:0,999.99',
            'description' => 'nullable|string',
            'categories' => 'required|array|min:1|exists:categories,id',
            'sizes' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    // Verifica se almeno una taglia ha delle quantità non vuote
                    foreach ($value as $size) {
                        foreach ($size['colors'] as $color) {
                            if (!empty($color['quantity_available']) && is_numeric($color['quantity_available']) && $color['quantity_available'] > 0) {
                                return;
                            }
                        }
                    }

                    $fail('Inserire una quantità almeno per una taglia e un colore.');
                }
            ],
            'sizes.*.colors.*.quantity_available' => 'nullable|integer|min:1',
            'images_colors' => 'nullable|array',
            'images_colors.*' => 'nullable|array',
            'images_colors.*.*' => 'nullable|image|mimetypes:image/png,image/jpg,image/jpeg,image/webp|max:1024'
        ]);

        // creo un nuovo prodotto
        $newProduct = new Product();
        $newProduct->name = ucfirst($request->name);
        $newProduct->genre_id = $request->genre_id;
        $newProduct->price = $request->price;
        $newProduct->discount_percent = $request->discount_percent;
        $newProduct->description = $request->description;
        $newProduct->save();

        // cacola e setta codice prodotto
        $newProduct->calculateAndSetCodeProduct();

        // aggiungi relazione categorie
        foreach ($request->categories as $category) {
            $newProduct->categories()->attach($category);
        }

        // aggiungi relazione taglie e colori con relative quantità
        foreach ($request->sizes as $sizeId => $size) {
            // check se la taglia deve essere allegato o no
            $attachSize = false;

            foreach ($size['colors'] as $colorId => $color) {
                if (!empty($color['quantity_available']) && is_numeric($color['quantity_available']) && $color['quantity_available'] > 0) {
                    // se la quantità non è vuota allego anche la taglia
                    $attachSize = true;

                    $newProduct->colors()->attach($colorId, [
                        'size_id' => $sizeId,
                        'quantity_available' => $color['quantity_available']
                    ]);
                }
            }

            if ($attachSize) {
                $newProduct->sizes()->attach($sizeId);
            }
        }

        // calcola e setta quantità totale
        $newProduct->calculateAndSetTotalQuantity();

        // Salvo e setto le immagini
        $newProduct->uploadImagesColors($request->images_colors);

        return redirect()->route('admin.products.show', $newProduct->id)->with(
            'success',
            "Il Prodotto con codice: '{$newProduct->code}', Nome: '{$newProduct->name}', è stato creato con successo.",
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // controllo il permesso utente
        if (!Gate::allows('products_view')) {
            abort(401);
        }

        // recupero il prodotto
        $product = Product::findOrFail($id);

        $genres = Genre::orderBy('name', 'asc')->get();

        return view('admin.products.show', compact('product', 'genres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // controllo il permesso utente
        if (!Gate::allows('products_edit')) {
            abort(401);
        }

        // recupero il prodotto
        $product = Product::findOrFail($id);

        $genres = Genre::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();

        return view('admin.products.edit', compact('product', 'genres', 'categories', 'sizes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // controllo il permesso utente
        if (!Gate::allows('products_edit')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => "required|unique:products,name,{$id}",
            'genre_id' => 'required|exists:genres,id',
            'price' => 'required|numeric|between:0,9999999.99',
            'discount_percent' => 'nullable|numeric|between:0,999.99',
            'description' => 'nullable|string',
            'categories' => 'required|array|min:1|exists:categories,id',
            'sizes' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    // Verifica se almeno una taglia ha delle quantità non vuote
                    foreach ($value as $size) {
                        foreach ($size['colors'] as $color) {
                            if (!empty($color['quantity_available']) && is_numeric($color['quantity_available']) && $color['quantity_available'] > 0) {
                                return;
                            }
                        }
                    }

                    $fail('Inserire una quantità almeno per una taglia e un colore.');
                }
            ],
            'sizes.*.colors.*.quantity_available' => 'nullable|integer|min:1',
            'images_colors' => 'nullable|array',
            'images_colors.*' => 'nullable|array',
            'images_colors.*.*' => 'nullable|image|mimetypes:image/png,image/jpg,image/jpeg,image/webp|max:1024'
        ]);

        // recupero il prodotto
        $product = Product::findOrFail($id);

        // aggiorno il prodotto
        $product->name = ucfirst($request->name);
        $product->genre_id = $request->genre_id;
        $product->price = $request->price;
        $product->discount_percent = $request->discount_percent;
        $product->description = $request->description;
        $product->update();

        // aggiorno le categorie
        $product->categories()->sync($request->categories);

        // aggiorno relazione taglie e colori con relative quantità
        $product->sizes()->detach();
        $product->colors()->detach();
        foreach ($request->sizes as $sizeId => $size) {
            // check se la taglia deve essere allegato o no
            $attachSize = false;

            foreach ($size['colors'] as $colorId => $color) {
                if (!empty($color['quantity_available']) && is_numeric($color['quantity_available']) && $color['quantity_available'] > 0) {
                    // se la quantità non è vuota allego anche la taglia
                    $attachSize = true;

                    $product->colors()->attach($colorId, [
                        'size_id' => $sizeId,
                        'quantity_available' => $color['quantity_available']
                    ]);
                }
            }

            if ($attachSize) {
                $product->sizes()->attach($sizeId);
            }
        }

        // calcola e setta quantità totale
        $product->calculateAndSetTotalQuantity();

        // setto le immagini
        $product->uploadImagesColors($request->images_colors, $request->replace_images_colors);

        return redirect()->route('admin.products.show', $product->id)->with(
            'success',
            "Il Prodotto con codice: '{$product->code}', Nome: '{$product->name}', è stato modificato con successo.",
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // controllo il permesso utente
        if (!Gate::allows('products_delete')) {
            abort(401);
        }

        // recupero il prodotto
        $product = Product::findOrFail($id);

        // elimino il prodotto
        $product->delete();

        // elimino le immagini
        $product->deleteAllImages();

        return redirect()->route('admin.products.index')->with(
            'success',
            "Il Prodotto con codice: '{$product->code}' e nome: '{$product->name}', è stato eliminato con successo."
        );
    }
}