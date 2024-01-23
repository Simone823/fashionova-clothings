<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PermissionController extends Controller
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
        if(!Gate::allows('permissions_view')) {
            abort(401);
        }

        // recupero tutti i permessi
        $permissions = Permission::sortable(['name' => 'asc'])->paginate(config('app.default_paginate'));

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // controllo il permesso utente
        if(!Gate::allows('permissions_create')) {
            abort(401);
        }

        return view('admin.permissions.create');
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
        if(!Gate::allows('permissions_create')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:5',
                'max:155',
                function ($attribute, $value, $fail) {
                    // Formatta la stringa di input
                    $formattedValue = Str::slug($value, '_');
                    // Array nomi permessi sul db
                    $existingPermissions = Permission::all()->pluck('name')->toArray();
                    if (in_array($formattedValue, $existingPermissions)) {
                        $fail('Il Nome specificato è già esistente.');
                    }
                }
            ]
        ]);

        // creo un nuovo permesso
        $newPermission = new Permission();
        $newPermission->name = Str::slug($request->name, '_');
        $newPermission->save();

        return redirect()->route('admin.permissions.index')->with(
            'success',
            "Il Permesso: '{$newPermission->name}', è stato creato con successo."
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
        if(!Gate::allows('permissions_edit')) {
            abort(401);
        }

        // recupero il permesso
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
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
        if(!Gate::allows('permissions_edit')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:5',
                'max:155',
                function ($attribute, $value, $fail) use ($id) {
                    // Formatta la stringa di input
                    $formattedValue = Str::slug($value, '_');
                    // Array nomi permessi sul db
                    $existingPermissions = Permission::where('id', '!=', $id)->pluck('name')->toArray();
                    if (in_array($formattedValue, $existingPermissions)) {
                        $fail('Il Nome specificato è già esistente.');
                    }
                }
            ]
        ]);

        // recupero il permesso
        $permission = Permission::find($id);
        $permission->name = Str::slug($request->name, '_');
        $permission->update();

        return redirect()->route('admin.permissions.index')->with(
            'success',
            "Il Permesso: '{$permission->name}', è stato modificato con successo."
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
        if(!Gate::allows('permissions_delete')) {
            abort(401);
        }

        // recupero il ruolo
        $permission = Permission::find($id);
 
        // elimino il ruolo
        $permission->delete();

        return redirect()->route('admin.permissions.index')->with(
            'success',
            "Il Permesso: '{$permission->name}', è stato eliminato con successo."
        );
    }
}