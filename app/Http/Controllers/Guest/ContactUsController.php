<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.contactUs');
    }

    public function store(Request $request)
    {
        // validazione
        $request->validate([
            'name' => 'required|string|min:4|max:100',
            'surname' => 'required|string|min:4|max:100',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required',
            'privacy_check' => 'nullable'
        ]);

        dd($request->all());
    }
}