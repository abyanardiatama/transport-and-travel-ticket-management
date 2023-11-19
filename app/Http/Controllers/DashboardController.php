<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratPermintaanTiketDinas;
use App\Models\SuratPermintaanTransport;
use App\Models\SuratPerintahKerja;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Kendaraan;

class DashboardController extends Controller
{
    public function index() {
        $suratPermintaanTransport = SuratPermintaanTransport::all();
        $suratPermintaanTransport = $suratPermintaanTransport->sortByDesc('updated_at');

        $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::all();
        $suratPermintaanTiketDinas = $suratPermintaanTiketDinas->sortByDesc('updated_at')->take(3);
        $countSuratPermintaanTransport = 0;
        $countSuratTiketDinas = 0;

        $approvedSuratTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', true)->where('kendaraan_lain',null)->get()->sortByDesc('created_at');
        $countApprovedSuratTransport = $approvedSuratTransport->count();
        $approvedSuratTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->get()->sortByDesc('created_at');
        $countApprovedSuratTiketDinas = $approvedSuratTiketDinas->count();
        $checkUser = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->first();
        //get kendaraan where approvedSuratTransport->nomor_polisi == kendaraan->nomor_polisi

        if(Auth::user()->is_pegawai == 1){
            //display surat permintaan transport that id_pemohon == id user and sort by updated at
            //show latest data
            $suratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->take(3)->get()->sortByDesc('updated_at');
            // $suratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->take(3)->get()->sortByDesc('created_at');
            // $countSuratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', true)->count();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->count();

            //sort by updated at or created at
            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('id_pemohon', Auth::user()->id)->take(3)->get()->sortByDesc('updated_at');
            // $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('id_pemohon', Auth::user()->id)->take(3)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('id_pemohon', Auth::user()->id)->count();
        }
        elseif(Auth::user()->is_admin == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 1, and is_approve_admin = 0
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->take(3)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->count();

            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->take(3)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->count();

            //surat perintah kerja based id surat permintaan transport
            $IdsuratTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)
                ->where('isApprove_atasan', true)
                ->where('isApprove_admin', true)
                ->first();
            $suratPerintahKerja = SuratPerintahKerja::all()->take(3)->sortByDesc('created_at');
            $countSuratPerintahKerja = SuratPerintahKerja::all()->count();
                
            if ($IdsuratTransport) {
                $id = $IdsuratTransport->id;
                $suratTransport = SuratPermintaanTransport::where('id', $id)->first();
                $countSuratTransport = SuratPermintaanTransport::where('id', $id)->count();
                // $nomor_polisi = $suratTransport->nomor_polisi;
            } else {
                $suratTransport = null;
                $countSuratTransport = 0;
            }
            return view('dashboard.index', [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'suratPermintaanTransport' => $suratPermintaanTransport,
                'suratPermintaanTiketDinas' => $suratPermintaanTiketDinas,
                'countSuratPermintaanTransport' => $countSuratPermintaanTransport,
                'countSuratTiketDinas' => $countSuratTiketDinas,
                'suratPerintahKerja' => $suratPerintahKerja,
                'countSuratPerintahKerja' => $countSuratPerintahKerja,
                'countSuratTransport' => $countSuratTransport,
                'approvedSuratTransport' => $approvedSuratTransport,
                'approvedSuratTiketDinas' => $approvedSuratTiketDinas,
                'countApprovedSuratTiketDinas' => $countApprovedSuratTiketDinas,
                'countApprovedSuratTransport' => $countApprovedSuratTransport,
                'checkUser' => $checkUser,
            ]);
        }
        elseif(Auth::user()->is_driver ==1 ){
            $suratPerintahKerja = SuratPerintahKerja::where('nama_driver', Auth::user()->name)->get()->sortByDesc('created_at');
            $countSuratPerintahKerja = SuratPerintahKerja::where('nama_driver', Auth::user()->name)->count();
            return view('dashboard.index', [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'suratPerintahKerja' => $suratPerintahKerja,
                'countSuratPerintahKerja' => $countSuratPerintahKerja,
                'checkUser' => $checkUser,
            ]);

        }
        //cek auth user is_atasan and email_atasan == email user
        elseif(Auth::user()->is_atasan1 == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 0, and is_approve_admin = 0, and email_atasan == email user
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->take(3)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->count();
            
            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('email_atasan', Auth::user()->email)->take(3)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('email_atasan', Auth::user()->email)->count();
        }
        elseif(Auth::user()->is_atasan2 == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 0, and is_approve_admin = 0, and email_atasan == email user
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->take(3)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->count();
            
            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('email_atasan', Auth::user()->email)->take(3)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('email_atasan', Auth::user()->email)->count();
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
                'countSuratTiketDinas' => $countSuratTiketDinas,
                'approvedSuratTransport' => $approvedSuratTransport,
                'approvedSuratTiketDinas' => $approvedSuratTiketDinas,
                'countApprovedSuratTiketDinas' => $countApprovedSuratTiketDinas,
                'countApprovedSuratTransport' => $countApprovedSuratTransport,
                'checkUser' => $checkUser,
            ]);
        }
        
    }

    public function logActivity(Request $request) {
        
        // $logActivity = Activity::latest()->orderBy('id', 'desc');
        $query = $request['default-search'];
        // dd($query);
        // dd($query);
        $logActivity = Activity::orderBy('id', 'desc');
        $countActivity = Activity::all()->count();

        // dd($query);
        if (!empty($query)) {
            $logActivity->where('log_name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        }
        $logActivity = $logActivity->paginate(10);

        return view('dashboard.log.index', [
            'title' => 'Log Activity',
            'active' => 'logActivity',
            'logActivity' => $logActivity ,
            'countActivity' => $countActivity,
            
        ]);
    }
}
