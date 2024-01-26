<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use League\CommonMark\Environment;

class DetailCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'roleAdmin']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Visualizza Dettagli Azienda (i dettagli si trovano in config/app.php)
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // controllo il permesso utente
        if(!Gate::allows('details_company_view')) {
            abort(401);
        }

        // recupero i dettagli azienda da config
        $detailsCompany = Config::get('app.details_company');

        return view('admin.details_company.show', compact('detailsCompany'));
    }

    /**
     * Vista modifica dettagli azienda
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // controllo il permesso utente
        if(!Gate::allows('details_company_edit')) {
            abort(401);
        }

        // recupero i dettagli azienda da config
        $detailsCompany = Config::get('app.details_company');

        return view('admin.details_company.edit', compact('detailsCompany'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // controllo il permesso utente
        if(!Gate::allows('details_company_edit')) {
            abort(401);
        }

        // validazione request
        $request->validate([
            'name' => 'required|string|min:4|max:255',
            'address' => 'required|string|min:4|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[\d\s\(\)\+\-]+$/',
            'hours' => 'required|string|min:4|max:255'
        ]);

        // setto i dettagli in config
        // Config::write('app.details_company.name', $request->name);
        Config::write('app.details_company.address', $request->address);
        Config::write('app.details_company.email', $request->email);
        Config::write('app.details_company.phone', $request->phone);
        Config::write('app.details_company.hours', $request->hours);

        // Ricrea la cache della configurazione
        Artisan::call('optimize:clear');

        return redirect()->back();
    }
}