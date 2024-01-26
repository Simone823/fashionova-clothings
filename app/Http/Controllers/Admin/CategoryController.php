<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
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
        if(!Gate::allows('categories_view')) {
            abort(401);
        }

        // recupero le categorie
        $categories = Category::sortable(['name' => 'asc'])->paginate(config('app.default_paginate'));

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // controllo il permesso utente
        if(!Gate::allows('categories_create')) {
            abort(401);
        }

        return view('admin.categories.create');
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
        if(!Gate::allows('categories_create')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:200',
                function ($attribute, $value, $fail) {
                    // Formatta la stringa di input
                    $formattedValue = ucwords($value);
                    // Array categorie
                    $existingCategories = Category::all()->pluck('name')->toArray();
                    if (in_array($formattedValue, $existingCategories)) {
                        $fail('Il Nome specificato è già esistente.');
                    }
                }
            ]
        ]);

        // creo la nuova categoria
        $newCategory = new Category();
        $newCategory->name = ucwords($request->name);
        $newCategory->save();

        return redirect()->route('admin.categories.index')->with(
            'success',
            "La Categoria con nome: '{$newCategory->name}', è stata creata con successo."
        );
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
        if(!Gate::allows('categories_edit')) {
            abort(401);
        }

        // recupero la categoria
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
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
        if(!Gate::allows('categories_edit')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:200',
                function ($attribute, $value, $fail) use ($id) {
                    // Formatta la stringa di input
                    $formattedValue = ucwords($value);
                    // Array categorie
                    $existingCategories = Category::where('id', '!=', $id)->pluck('name')->toArray();
                    if (in_array($formattedValue, $existingCategories)) {
                        $fail('Il Nome specificato è già esistente.');
                    }
                }
            ]
        ]);

        // recupero la categoria
        $category = Category::findOrFail($id);

        // aggiorno la categoria
        $category->name = ucwords($request->name);

        return redirect()->route('admin.categories.index')->with(
            'success',
            "La Categoria con nome: '{$category->name}', è stata modificata con successo."
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
        if(!Gate::allows('categories_delete')) {
            abort(401);
        }

        // recupero la categoria
        $category = Category::findOrFail($id);

        // elimino la categoria
        $category->delete();

        return redirect()->route('admin.categories.index')->with(
            'success',
            "La Categoria con nome: '{$category->name}', è stata eliminata con successo."
        );
    }
}