<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;

class AdminToolController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'roleAdmin']);
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function cacheClearAll() {
        // controllo il permesso utente
        if(!Gate::allows('admin_tool')) {
            abort(401);
        }

        Artisan::call('optimize:clear');

        return redirect()->route('admin.dashboard')->with('success', Artisan::output());
    }
}