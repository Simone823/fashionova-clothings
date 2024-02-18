<?php

namespace App\Http\Controllers\Guest;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Show the form contact us
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.contactUs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validazione
        $request->validate([
            'name' => 'required|string|min:4|max:100',
            'surname' => 'required|string|min:4|max:100',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'subject' => 'required|string|min:4|max:200',
            'message' => 'required',
            'privacy_check' => 'required'
        ]);

        // creo un nuovo contatto
        $newContact = new Contact();
        $newContact->name = ucfirst($request->name);
        $newContact->surname = ucfirst($request->surname);
        $newContact->email = strtolower($request->email);
        $newContact->phone = $request->phone;
        $newContact->subject = ucfirst($request->subject);
        $newContact->message = ucfirst($request->message);
        $newContact->save();

        // invio email


        return redirect()->back()->with(
            'success', 
            'Il tuo messaggio è stato inviato con successo. Grazie per averci contattato. Risponderemo al più presto possibile.'
        );
    }
}