<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
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

        return view('user.profiles.show', compact('user'));
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

        return view('user.profiles.edit', compact('user'));
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
            'email' => "required|email|unique:users,email,{$id}"
        ]);

        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        // aggiorno l'utente
        $user->name = ucfirst($request->name);
        $user->surname = ucfirst($request->surname);
        $user->email = strtolower($request->email);
        $user->update();

        return redirect()->route('user.profiles.show', $user->id);
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
        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        // aggiorno la password
        $user->password = Hash::make($request->password);
        $user->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        // elimino l'utente
        $user->delete();

        return redirect()->route('guest.home');
    }
}