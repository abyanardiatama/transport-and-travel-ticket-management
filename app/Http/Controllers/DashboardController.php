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
        $suratPermintaanTransport = $suratPermintaanTransport->sortByDesc('updated_at')->take(3);

        $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::all();
        $suratPermintaanTiketDinas = $suratPermintaanTiketDinas->sortByDesc('updated_at')->take(3);
        $countSuratPermintaanTransport = 0;

        //count suratTransport that has not been approve by atasan
        //count suratTiketDinas that has not been approve by atasan
        

        if(Auth::user()->is_pegawai == 1){
            //display surat permintaan transport that id_pemohon == id user
            $suratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->take(3)->get();
            $suratPermintaanTransports = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', true)->count();
        }
        elseif(Auth::user()->is_admin == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 1, and is_approve_admin = 0
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->take(3)->get();
            $suratPermintaanTransports = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->count();
        }

        //cek auth user is_atasan and email_atasan == email user
        elseif(Auth::user()->is_atasan1 == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 0, and is_approve_admin = 0, and email_atasan == email user
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->take(3)->get();
            $suratPermintaanTransports = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->count();
            // $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', 0)->where('isApprove_admin', 0)->get();
        }
        elseif(Auth::user()->is_atasan2 == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 0, and is_approve_admin = 0, and email_atasan == email user
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->take(3)->get();
            $suratPermintaanTransports = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->count();
            // $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', 0)->where('isApprove_admin', 0)->get();
        }
        
        
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
                'countSuratPermintaanTransport' => $countSuratPermintaanTransport,
                'suratPermintaanTransports' => $suratPermintaanTransports,
            ]);
        }
        
    }
}
