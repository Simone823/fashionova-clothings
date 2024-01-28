<?php

namespace App\Http\Controllers\Admin;

use App\Category;
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

        return view('admin.products.create', compact('genres', 'categories', 'sizes'));
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
                    // verifica se almeno una taglia ha delle quantità non vuote
                    foreach ($value as $sizeId => $quantity) {
                        if (!empty($quantity) && $quantity != 0 && $quantity != 0.00) {
                            return;
                        }
                    }
    
                    $fail('È necessario inserire una quantità almeno per una taglia.');
                }
            ]
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

        // aggiungi relazione taglie con relative quantità
        foreach ($request->sizes as $sizeId => $quantity) {
            if (!empty($quantity) && $quantity != 0 && $quantity != 0.00) {
                $newProduct->sizes()->attach($sizeId, ['quantity_available' => $quantity]);
            }
        }

        // calcola e setta quantità totale
        $newProduct->calculateAndSetTotalQuantity();

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
        $categories = Category::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();

        return view('admin.products.show', compact('product', 'genres', 'categories', 'sizes'));
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

        return view('admin.products.edit', compact('product', 'genres', 'categories', 'sizes'));
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
                    // verifica se almeno una taglia ha delle quantità non vuote
                    foreach ($value as $sizeId => $quantity) {
                        if (!empty($quantity) && $quantity != 0 && $quantity != 0.00) {
                            return;
                        }
                    }
    
                    $fail('È necessario inserire una quantità almeno per una taglia.');
                }
            ]
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

        // aggiorno le taglie e relative quantità
        $product->sizes()->detach();
        foreach ($request->sizes as $sizeId => $quantity) {
            if (!empty($quantity) && $quantity != 0 && $quantity != 0.00) {
                $product->sizes()->attach($sizeId, ['quantity_available' => $quantity]);
            }
        }

        // calcola e setta quantità totale
        $product->calculateAndSetTotalQuantity();

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

        return redirect()->route('admin.products.index')->with(
            'success',
            "Il Prodotto con codice: '{$product->code}' e nome: '{$product->name}', è stato eliminato con successo."
        );
    }
}