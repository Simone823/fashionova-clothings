<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{    
    public function __construct()
    {
        $this->middleware(['auth', 'roleAdmin']);
    }

    /**
     * Visualizza Profilo Utente
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        return view('admin.profiles.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        return view('admin.profiles.edit', compact('user'));
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
        // validazione request
        $request->validate([
            'name' => 'required|string|min:4|max:100',
            'surname' => 'required|string|min:4|max:100',
            'email' => "required|email|unique:users,email,{$id}",
        ]);

        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        // aggiorno l'utente
        if (!$user->hasRole('Administrator')) {
            $user->name = ucfirst($request->name);
            $user->surname = ucfirst($request->surname);
        }

        $user->email = strtolower($request->email);
        $user->update();

        return redirect()->route('admin.profiles.show', $user->id)->with(
            'success', 
            "Il tuo Profilo è stato aggiornato con successo."
        );
    }

    /**
     * Cambia la password dell'utente
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request, $id)
    {
        // validazione request
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors(), 'profilesChangePassword');
        }

        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        // aggiorno la password
        $user->password = Hash::make($request->password);
        $user->update();

        return redirect()->back()->with('success', 'La tua password è stata aggiornata con successo.');
    }
}