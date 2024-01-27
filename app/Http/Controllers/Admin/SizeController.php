<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SizeController extends Controller
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
        if(!Gate::allows('sizes_view')) {
            abort(401);
        }

        // recupero le taglie
        $sizes = Size::sortable(['name' => 'asc'])->paginate(config('app.default_paginate'));

        return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // controllo il permesso utente
        if(!Gate::allows('sizes_create')) {
            abort(401);
        }

        return view('admin.sizes.create');
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
        if(!Gate::allows('sizes_create')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:1',
                'max:200',
                function ($attribute, $value, $fail) {
                    // Formatta la stringa di input
                    $formattedValue = strtoupper($value);
                    // Array categorie
                    $existingSizes = Size::all()->pluck('name')->toArray();
                    if (in_array($formattedValue, $existingSizes)) {
                        $fail('Il Nome specificato è già esistente.');
                    }
                }
            ]
        ]);

        // creo la nuova taglia
        $newSize = new Size();
        $newSize->name = strtoupper($request->name);
        $newSize->save();

        return redirect()->route('admin.sizes.index')->with(
            'success',
            "La Taglia con nome: '{$newSize->name}', è stata creata con successo."
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
        if(!Gate::allows('sizes_edit')) {
            abort(401);
        }

        // recupero la taglia
        $size = Size::findOrFail($id);

        return view('admin.sizes.edit', compact('size'));
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
        if(!Gate::allows('sizes_edit')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:1',
                'max:200',
                function ($attribute, $value, $fail) use ($id) {
                    // Formatta la stringa di input
                    $formattedValue = strtoupper($value);
                    // Array categorie
                    $existingSizes = Size::where('id', '!=', $id)->pluck('name')->toArray();
                    if (in_array($formattedValue, $existingSizes)) {
                        $fail('Il Nome specificato è già esistente.');
                    }
                }
            ]
        ]);

        // recupero la taglia
        $size = Size::findOrFail($id);

        // aggiorno la taglia
        $size->name = strtoupper($request->name);
        $size->update();

        return redirect()->route('admin.sizes.index')->with(
            'success',
            "La Taglia con nome: '{$size->name}', è stata modificata con successo."
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
        if(!Gate::allows('sizes_delete')) {
            abort(401);
        }

        // recupero la taglia
        $size = Size::findOrFail($id);

        // elimino la taglia
        $size->delete();

        return redirect()->route('admin.sizes.index')->with(
            'success',
            "La Taglia con nome: '{$size->name}', è stata eliminata con successo."
        );
    }
}