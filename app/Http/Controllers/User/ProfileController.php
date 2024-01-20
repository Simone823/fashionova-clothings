<?php

namespace App\Http\Controllers\User;

use App\City;
use App\Http\Controllers\Controller;
use App\Nation;
use App\Province;
use App\Region;
use App\User;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{    
    public function __construct()
    {
        $this->middleware(['auth', 'roleUser']);
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

        // territiori
        $nation = Nation::where('name', 'Italia')->first();
        $regions = Region::orderBy('name', 'asc')->get();
        $provinces = Province::orderBy('name', 'asc')->get();
        $cities = City::orderBy('name', 'asc')->get();

        return view('user.profiles.edit', compact('user', 'nation', 'regions', 'provinces', 'cities'));
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

        // valido i campi indirizzi, se nella richiesta esiste l'array user_addresses
        if ($request->has('user_addresses')) {
            $request->validate([
                'user_addresses.*.is_primary' => [
                    "nullable",
                    function ($attribute, $value, $fail) use ($id) {   
                        // Recupera l'indice dell'indirizzo corrente all'interno dell'array
                        $idUserAddress = explode('.', str_replace('user_addresses.', '', $attribute));

                        // indirizzo utente primario esistente
                        $userAddressPrimary = UserAddress::where([
                            'is_primary' => 1, 
                            'user_id' => $id
                        ])->where('id', '!=', $idUserAddress[0])->first();

                        if ($userAddressPrimary) {
                            $fail('Esiste già un indirizzo primario.');
                        }
                    }
                ],
                'user_addresses.*.nation_id' => 'required|integer|exists:nations,id',
                'user_addresses.*.region_id' => 'required|integer|exists:regions,id',
                'user_addresses.*.province_id' => 'required|integer|exists:provinces,id',
                'user_addresses.*.city_id' => 'required|integer|exists:cities,id',
                'user_addresses.*.cap' => 'required|numeric|digits:5',
                'user_addresses.*.address' => 'required|string|min:3|max:255',
                'user_addresses.*.house_number' => [
                    'required',
                    'string',
                    'max:255',
                    function ($attribute, $value, $fail) use ($id, $request) {
                        // recupero l'indice dell'indirizzo corrente all'interno dell'array
                        $idUserAddress = explode('.', str_replace('user_addresses.', '', $attribute));

                        // verifico l'esistenza di un indirizzo utente con gli stessi dettagli, escludendo l'indirizzo corrente
                        $existingAddress = UserAddress::where([
                            'nation_id' => $request->input("user_addresses.{$idUserAddress[0]}.nation_id"),
                            'region_id' => $request->input("user_addresses.{$idUserAddress[0]}.region_id"),
                            'province_id' => $request->input("user_addresses.{$idUserAddress[0]}.province_id"),
                            'city_id' => $request->input("user_addresses.{$idUserAddress[0]}.city_id"),
                            'cap' => $request->input("user_addresses.{$idUserAddress[0]}.cap"),
                            'address' => ucwords($request->input("user_addresses.{$idUserAddress[0]}.address")),
                            'house_number' => $value,
                        ])->where('id', '!=', $idUserAddress[0])->first();

                        if ($existingAddress) {
                            $fail('Esiste già un indirizzo con i dettagli forniti.');
                        }
                    }
                ],
            ]);
        }

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

        // aggiorno gli indirizzi se esistono
        if ($request->has('user_addresses')) {
            foreach ($request->user_addresses as $idAddress => $address) {
                // recupero e aggiorno l'indirizzo tramite id
                $userAddress = UserAddress::findOrFail($idAddress);
                $userAddress->is_primary = isset($address['is_primary']) && $address['is_primary'] == 'on' ? 1 : 0;
                $userAddress->nation_id = $address['nation_id'];
                $userAddress->region_id = $address['region_id'];
                $userAddress->province_id = $address['province_id'];
                $userAddress->city_id = $address['city_id'];
                $userAddress->cap = $address['cap'];
                $userAddress->address = ucwords($address['address']);
                $userAddress->house_number = $address['house_number'];
                $userAddress->update();
            }
        }

        return redirect()->route('user.profiles.show', $user->id)->with(
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
        $validator = Validator::make($request->all(), [
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
            'house_number' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($id, $request) {
                    // indirizzo utente esistente
                    $existingAddress = UserAddress::where([
                        'user_id' => $id,
                        'nation_id' => $request->nation_id,
                        'region_id' => $request->region_id,
                        'province_id' => $request->province_id,
                        'city_id' => $request->city_id,
                        'cap' => $request->cap,
                        'address' => ucwords($request->address),
                        'house_number' => $request->house_number,
                    ])->first();
    
                    if ($existingAddress) {
                        $fail('Esiste già un indirizzo con i dettagli forniti.');
                    }
                }
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors(), 'profilesCreateAddress');
        }

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

        return redirect()->back()->with(
            'success', 
            "L'Indirizzo è stato creato con successo. {$newUserAddress->address}, {$newUserAddress->house_number}, {$newUserAddress->cap}, {$newUserAddress->city->name}, {$newUserAddress->province->sigle}"
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
        // recupero l'utente
        $user = User::findOrFail($id);

        // controllo se l'id e diverso dall'utente loggato
        if ($user->id != Auth::id()) {
            return abort(401);
        }

        // elimino l'utente
        $user->delete();

        return redirect()->route('guest.home')->with(
            'success', 
            "Il tuo account con indirizzo mail: {$user->email}, è stato eliminato con successo."
        );
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

        return redirect()->back()->with(
            'success', 
            "L'indirizzo è stato eliminato con successo. {$userAddress->address}, {$userAddress->house_number}, {$userAddress->cap}, {$userAddress->city->name}, {$userAddress->province->sigle}"
        );
    }
}