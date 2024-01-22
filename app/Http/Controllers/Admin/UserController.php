<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use App\Nation;
use App\Province;
use App\Region;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
        if(!Gate::allows('users_view')) {
            abort(401);
        }

        // recupero utenti
        $users = User::sortable(['name' => 'asc'])->paginate(config('app.default_paginate'));

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // controllo il permesso utente
        if(!Gate::allows('users_create')) {
            abort(401);
        }

        // recupero tutti i ruoli
        $roles = Role::where('name', '!=', 'Administrator')->orderBy('name', 'asc')->get();

        return view('admin.users.create', compact('roles'));
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
        if(!Gate::allows('users_create')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => 'required|string|min:4|max:100',
            'surname' => [
                'required',
                'string',
                'min:4',
                'max:100',
                function ($attribute, $value, $fail) use ($request) {
                    // controllo se il nome e cognome della request è 'Administrator' 'System'
                    if (ucfirst($request->name) == 'Administrator' || ucfirst($value) == 'System') {
                        $fail("Non puoi creare un utente con nome e cognome: 'Administrator System");
                    }
                }
            ],
            'email' => 'required|email|unique:users,email',
            'roles' => [
                'required',
                'array',
                'exists:roles,id',
                'min:1',
                function ($attribute, $value, $fail) {
                    // recupero il ruolo User
                    $roleUser = Role::where('name', 'User')->first();

                    // verifica se il ruolo 'User' è presente tra i ruoli selezionati e se sono più di 1
                    if (in_array($roleUser->id, array_map('intval', $value)) && count($value) > 1) {
                        $fail("{$attribute} Se selezioni il ruolo: '{$roleUser->name}', non puoi selezionare altri Ruoli.");
                    }
                }
            ]
        ]);

        // creo il nuovo utente
        $newUser = new User();
        $newUser->name = ucfirst($request->name);
        $newUser->surname = ucfirst($request->surname);
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->save();

        // assegno ruoli
        foreach ($request->roles as $role) {
            $newUser->assignRole($role);
        }

        return redirect()->route('admin.users.show', $newUser->id)->with(
            'success', 
            "L'Utente: {$newUser->name} {$newUser->surname}, con email: {$newUser->email}, è stato creato con successo."
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
        if(!Gate::allows('users_view')) {
            abort(401);
        }

        // recupero l'utente
        $user = User::findOrFail($id);

        // territori
        $nation = Nation::where('name', 'Italia')->first();
        $regions = Region::orderBy('name', 'asc')->get();
        $provinces = Province::orderBy('name', 'asc')->get();
        $cities = City::orderBy('name', 'asc')->get();

        return view('admin.users.show', compact('user', 'nation', 'regions', 'provinces', 'cities'));
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
        if(!Gate::allows('users_edit')) {
            abort(401);
        }

        // recupero l'utente
        $user = User::findOrFail($id);

        // recupero tutti i ruoli
        $roles = Role::where('name', '!=', 'Administrator')->orderBy('name', 'asc')->get();

        return view('admin.users.edit', compact('user', 'roles'));
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
        if(!Gate::allows('users_edit')) {
            abort(401);
        }

        // recupero l'utente
        $user = User::findOrFail($id);

        // validazione request
        $request->validate([
            'name' => 'required|string|min:4|max:100',
            'surname' => 'required|string|min:4|max:100',
            'email' => "required|email|unique:users,email,{$id}",
            'roles' => [
                'array',
                'exists:roles,id',
                'min:1',
                Rule::requiredIf(function () use ($user) {
                    // se l'utente è admin, il campo non è required
                    return $user->hasRole('Administrator') ? false : true;
                }),
                function ($attribute, $value, $fail) {
                    // recupero il ruolo User
                    $roleUser = Role::where('name', 'User')->first();

                    // verifica se il ruolo 'User' è presente tra i ruoli selezionati e se sono più di 1
                    if (in_array($roleUser->id, array_map('intval', $value)) && count($value) > 1) {
                        $fail("{$attribute} Se selezioni il ruolo: '{$roleUser->name}', non puoi selezionare altri Ruoli.");
                    }
                }
            ]
        ]);

        // controllo se l'uente è admin
        if (!$user->hasRole('Administrator')) {
            $user->name = ucfirst($request->name);
            $user->surname = ucfirst($request->surname);
            $user->syncRoles($request->roles);
        }

        // aggiorno l'utente
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.users.show', $user->id)->with(
            'success', 
            "L'Utente: {$user->name} {$user->surname}, con email: {$user->email}, è stato modificato con successo."
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
        if(!Gate::allows('users_delete')) {
            abort(401);
        }

        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'utente è administrator
        if ($user->hasRole('Administrator')) {
            return redirect()->back()->with(
                'error', 
                "L'Utente Admin: {$user->name} {$user->surname}, non può essere eliminato."
            );
        }
        
        // elimino l'utente
        $user->delete();

        return redirect()->route('admin.users.index')->with(
            'success', 
            "L'Utente: {$user->name} {$user->surname}, con email: {$user->email}, è stato eliminato con successo."
        );
    }
}