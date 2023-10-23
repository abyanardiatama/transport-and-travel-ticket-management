<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratPermintaanTiketDinas;
use App\Models\SuratPermintaanTransport;
use App\Models\SuratPerintahKerja;

class DashboardController extends Controller
{
    public function index() {
        $suratPermintaanTransport = SuratPermintaanTransport::all();
        $suratPermintaanTransport = $suratPermintaanTransport->sortByDesc('created_at')->take(3);

        $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::all();
        $suratPermintaanTiketDinas = $suratPermintaanTiketDinas->sortByDesc('created_at')->take(3);

        
        //auth
        if(!Auth::user()){
            return redirect('/login');
        }
        else{
            return view('dashboard.index', [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'suratPermintaanTransport' => $suratPermintaanTransport,
                'suratPermintaanTiketDinas' => $suratPermintaanTiketDinas,
            ]);
        }
        
    }
}
