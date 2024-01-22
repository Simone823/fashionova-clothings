<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class RoleController extends Controller
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
        if(!Gate::allows('roles_view')) {
            abort(401);
        }

        // recupero ruoli
        $roles = Role::sortable(['name' => 'asc'])->paginate(config('app.default_paginate'));

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // controllo il permesso utente
        if(!Gate::allows('roles_create')) {
            abort(401);
        }

        // recupero tutti i permessi
        $permissions = Permission::where('name', '!=', 'admin_tool')->orderBy('name', 'asc')->get();

        return view('admin.roles.create', compact('permissions'));
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
        if(!Gate::allows('roles_create')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:155',
                function ($attribute, $value, $fail) {
                    // Formatta la stringa di input
                    $formattedValue = ucfirst($value);
                    // Array nomi ruoli sul db
                    $existingRole = Role::all()->pluck('name')->toArray();
                    if (in_array($formattedValue, $existingRole)) {
                        $fail('Il Nome specificato è già esistente.');
                    }
                }
            ],
            'permissions' => 'array|exists:permissions,id|min:1'
        ]);

        // creo nuovo ruolo
        $newRole = new Role();
        $newRole->name = ucfirst($request->name);
        $newRole->givePermissionTo($request->permissions);
        $newRole->save();

        return redirect()->route('admin.roles.index')->with(
            'success',
            "Il Ruolo: '{$newRole->name}', è stato creato con successo."
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
        if(!Gate::allows('roles_edit')) {
            abort(401);
        }

        // recupero il ruolo
        $role = Role::find($id);

        // recupero il permesso
        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('admin.roles.edit', compact('role', 'permissions'));
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
        if(!Gate::allows('roles_edit')) {
            abort(401);
        }

        // recupero il ruolo
        $role = Role::find($id);

        // controllo se il ruolo è User
        if ($role->name == 'User') {
            return redirect()->route('admin.roles.index')->with(
                'error',
                "Il Ruolo: '{$role->name}', non può essere moidificato."
            );
        }

        // validazione request
        $request->validate([
            'name' => [
                "required", 
                "string",
                "min:3", 
                "max:155",
                function ($attribute, $value, $fail) use ($id) {
                    // Formatta la stringa di input
                    $formattedValue = ucfirst($value);
                    // Array nomi ruoli sul db
                    $existingRole = Role::where('id', '!=', $id)->pluck('name')->toArray();
                    if (in_array($formattedValue, $existingRole)) {
                        $fail('Il Nome specificato è già esistente.');
                    }
                }
            ],
            'permissions' => 'array|exists:permissions,id|min:1'
        ]);

        // controllo se il ruolo è Administrator
        if (!$role->name == 'Administrator') {
            $role->name = ucfirst($request->name);
        }

        // aggiorno il ruolo
        $role->syncPermissions($request->permissions);
        $role->update();

        return redirect()->route('admin.roles.index')->with(
            'success',
            "Il Ruolo: '{$role->name}', è stato modificato con successo."
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
        if(!Gate::allows('roles_delete')) {
            abort(401);
        }

        // recupero il ruolo
        $role = Role::findOrFail($id);

        // controllo se il ruolo è admin o user
        if ($role->name == 'Administrator' || $role->name == 'User') {
            return redirect()->back()->with(
                'error',
                "Il Ruolo: '{$role->name}', non può essere eliminato."
            );
        }

        // controllo se il ruolo ha degli utenti
        if (count($role->users) > 0) {
            return redirect()->back()->with(
                'error',
                "Il Ruolo: '{$role->name}', non può essere eliminato, ci sono degli Utenti con questo Ruolo."
            );
        }

        // elimino il ruolo
        $role->delete();

        return redirect()->route('admin.roles.index')->with(
            'success',
            "Il Ruolo: '{$role->name}', è stato eliminato con successo."
        );
    }
}