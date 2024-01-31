<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ColorController extends Controller
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
        if(!Gate::allows('colors_view')) {
            abort(401);
        }

        // recupero i colori
        $colors = Color::sortable(['name' => 'asc'])->paginate(config('app.default_paginate'));

        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // controllo il permesso utente
        if(!Gate::allows('colors_create')) {
            abort(401);
        }

        return view('admin.colors.create');
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
        if(!Gate::allows('colors_create')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => 'required|string|unique:colors,name|min:2|max:200'
        ]);

        // creo il nuovo colore
        $newColor = new Color();
        $newColor->name = ucfirst($request->name);
        $newColor->save();

        return redirect()->route('admin.colors.index')->with(
            'success',
            "Il Colore con nome: '{$newColor->name}', è stato creato con successo."
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
        if(!Gate::allows('colors_edit')) {
            abort(401);
        }

        // recupero il colore
        $color = Color::findOrFail($id);

        return view('admin.colors.edit', compact('color'));
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
        if(!Gate::allows('colors_edit')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => "required|string|unique:colors,name,{$id}|min:2|max:200"
        ]);

        // recupero il colore
        $color = Color::findOrFail($id);

        // aggiorno il colore
        $color->name = ucfirst($request->name);
        $color->update();

        return redirect()->route('admin.colors.index')->with(
            'success',
            "Il Colore con nome: '{$color->name}', è stato modificato con successo."
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
        if(!Gate::allows('colors_delete')) {
            abort(401);
        }

        // recupero il colore
        $color = Color::findOrFail($id);

        // elimino il colore
        $color->delete();

        return redirect()->route('admin.colors.index')->with(
            'success',
            "Il Colore con nome: '{$color->name}', è stato eliminato con successo."
        );
    }
}