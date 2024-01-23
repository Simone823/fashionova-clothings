<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
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
        if(!Gate::allows('contacts_view')) {
            abort(401);
        }

        // recupero tutti i contatti
        $contacts = Contact::sortable(['created_at' => 'desc'])->paginate(config('app.default_paginate'));

        return view('admin.contacts.index', compact('contacts'));
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
        if(!Gate::allows('contacts_delete')) {
            abort(401);
        }

        // recupero il contatto
        $contact = Contact::findOrFail($id);

        return view('admin.contacts.show', compact('contact'));
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
        if(!Gate::allows('contacts_delete')) {
            abort(401);
        }

        // recupero il contatto
        $contact = Contact::findOrFail($id);

        // elimino il contatto
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with(
            'success',
            "Il Contatto con soggetto: '{$contact->subject}', è stato eliminato correttamente."
        );
    }
}