<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use App\UserAddress;
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
     * Crea indirizzo
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function createAddress(Request $request, $id)
    {
        // validazione
        $request->validate([
            'is_primary' => [
                "nullable",
                function ($attribute, $value, $fail) use ($id) {   
                    // indirizzo utente primario esistente
                    $userAddressPrimary = UserAddress::where(['is_primary' => 1, 'user_id' => $id])->first();

                    if ($userAddressPrimary) {
                        $fail('Esiste già un indirizzo primario.');
                    }
                }
            ],
            'nation_id' => 'required|integer|exists:nations,id',
            'region_id' => 'required|integer|exists:regions,id',
            'province_id' => 'required|integer|exists:provinces,id',
            'city_id' => 'required|integer|exists:cities,id',
            'cap' => 'required|numeric|digits:5',
            'address' => 'required|string|min:3|max:255',
            'house_number' => 'required|string|max:255'
        ]);

        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        // creo l'indirizzo
        $newUserAddress = new UserAddress();
        $newUserAddress->is_primary = $request->is_primary == 'on' ? 1 : 0;
        $newUserAddress->user_id = $user->id;
        $newUserAddress->nation_id = $request->nation_id;
        $newUserAddress->region_id = $request->region_id;
        $newUserAddress->province_id = $request->province_id;
        $newUserAddress->city_id = $request->city_id;
        $newUserAddress->cap = $request->cap;
        $newUserAddress->address = ucwords($request->address);
        $newUserAddress->house_number = $request->house_number;
        $newUserAddress->save();

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

    /**
     * Elimina indirizzo utente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAddress($id, $userId)
    {
        // recupero l'utente
        $user = User::findOrFail($userId);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        // recupero l'indirizzo utente
        $userAddress = UserAddress::where(['id' => $id, 'user_id' => $user->id])->first();

        // elimino l'indirizzo utente
        $userAddress->delete();

        return redirect()->back();
    }
}