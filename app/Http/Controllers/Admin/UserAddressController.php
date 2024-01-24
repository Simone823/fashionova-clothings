<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserAddressController extends Controller
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
        if(!Gate::allows('user_addresses_view')) {
            abort(401);
        }

        // recupero gli indirizzi utente
        $userAddresses = UserAddress::sortable(['created_at' => 'desc'])->paginate(config('app.default_paginate'));

        return view('admin.user_addresses.index', compact('userAddresses'));
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
        if(!Gate::allows('user_addresses_view')) {
            abort(401);
        }

        // recupero l'indirizzo
        $userAddress = UserAddress::findOrFail($id);

        return view('admin.user_addresses.show', compact('userAddress'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}