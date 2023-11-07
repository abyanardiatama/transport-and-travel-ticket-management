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

        $approvedSuratTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', true)->get()->sortByDesc('created_at');
        $countApprovedSuratTransport = $approvedSuratTransport->count();
        $checkUser = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->first();
        //get kendaraan where approvedSuratTransport->nomor_polisi == kendaraan->nomor_polisi

        if(Auth::user()->is_pegawai == 1){
            //display surat permintaan transport that id_pemohon == id user and sort by updated at
            //show latest data
            $suratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->take(3)->get()->sortByDesc('updated_at');
            // $suratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->take(3)->get()->sortByDesc('created_at');
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', true)->count();

            //sort by updated at or created at
            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('id_pemohon', Auth::user()->id)->take(3)->get()->sortBy('updated_at');
            // $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('id_pemohon', Auth::user()->id)->take(3)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('id_pemohon', Auth::user()->id)->where('isApprove_pegawai', true)->where('isApprove_atasan', true)->count();
            //logging activity and get his user name
            
            activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'pegawai', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_pegawai_login');


        }
        elseif(Auth::user()->is_admin == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 1, and is_approve_admin = 0
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->take(3)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->count();

            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->take(3)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->count();

            //surat perintah kerja based id surat permintaan transport
            $IdsuratTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)
                ->where('isApprove_atasan', true)
                ->where('isApprove_admin', true)
                ->first();

            if ($IdsuratTransport) {
                $id = $IdsuratTransport->id;
                // $suratPerintahKerja = SuratPerintahKerja::where('id_surat_permintaan_transport', $id)->get();
                // $countSuratPerintahKerja = SuratPerintahKerja::where('id_surat_permintaan_transport', $id)->count();
                
                $suratPerintahKerja = SuratPerintahKerja::all()->take(3)->sortByDesc('created_at');
                $countSuratPerintahKerja = SuratPerintahKerja::all()->count();
                //get nomor polisi from surat permintaan transport
                $suratTransport = SuratPermintaanTransport::where('id', $id)->first();
                $countSuratTransport = SuratPermintaanTransport::where('id', $id)->count();
                $nomor_polisi = $suratTransport->nomor_polisi;
            } else {
                $suratPerintahKerja = null;
            }
            activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'admin', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_admin_login');

            return view('dashboard.index', [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'suratPermintaanTransport' => $suratPermintaanTransport,
                'suratPermintaanTiketDinas' => $suratPermintaanTiketDinas,
                'countSuratPermintaanTransport' => $countSuratPermintaanTransport,
                'countSuratTiketDinas' => $countSuratTiketDinas,
                'suratPerintahKerja' => $suratPerintahKerja,
                'countSuratPerintahKerja' => $countSuratPerintahKerja,
                'nomor_polisi' => $nomor_polisi,
                'countSuratTransport' => $countSuratTransport,
                'approvedSuratTransport' => $approvedSuratTransport,
                'countApprovedSuratTransport' => $countApprovedSuratTransport,
                'checkUser' => $checkUser,
            ]);
        }
        elseif(Auth::user()->is_driver ==1 ){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 1, and is_approve_admin = 0 
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)
            ->where('isApprove_atasan', true)
            ->where('isApprove_admin', null)->take(3)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->count();

            //surat perintah kerja based id surat permintaan transport
            $IdsuratTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)
                ->where('isApprove_atasan', true)
                ->where('isApprove_admin', true)
                ->first();

            if ($IdsuratTransport) {
                $id = $IdsuratTransport->id;
                //surat kerja where user name == nama driver
                $suratPerintahKerja = SuratPerintahKerja::where('nama_driver', Auth::user()->name)->get();
                $countSuratPerintahKerja = SuratPerintahKerja::where('nama_driver', Auth::user()->name)->count();
                //get nomor polisi from surat permintaan transport

                $suratTransport = SuratPermintaanTransport::where('id', $id)->first();
                $countSuratTransport = SuratPermintaanTransport::where('id', $id)->count();
                $nomor_polisi = $suratTransport->nomor_polisi;
            } else {
                $suratPerintahKerja = null;
            }
            activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'driver', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_driver_login');

            return view('dashboard.index', [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'suratPermintaanTransport' => $suratPermintaanTransport,
                'countSuratPermintaanTransport' => $countSuratPermintaanTransport,
                'countSuratTiketDinas' => $countSuratTiketDinas,
                'suratPerintahKerja' => $suratPerintahKerja,
                'countSuratPerintahKerja' => $countSuratPerintahKerja,
                'nomor_polisi' => $nomor_polisi,
                'countSuratTransport' => $countSuratTransport,
                'approvedSuratTransport' => $approvedSuratTransport,
                'countApprovedSuratTransport' => $countApprovedSuratTransport,
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
            activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'atasan', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_atasan_login');
        }
        elseif(Auth::user()->is_atasan2 == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 0, and is_approve_admin = 0, and email_atasan == email user
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->take(3)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->count();
            
            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('email_atasan', Auth::user()->email)->take(3)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('email_atasan', Auth::user()->email)->count();
            activity()
                ->withProperties([
                    'nama_user'=>Auth::user()->name, 
                    'email_user'=>Auth::user()->email, 
                    'role_user'=>'atasan', 
                    'login_at'=>now()->toDateTimeString()])
                ->log('user_atasan_login');
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
                'countApprovedSuratTransport' => $countApprovedSuratTransport,
                'checkUser' => $checkUser,
            ]);
        }
        
    }

    public function logActivity() {
        $logActivity = Activity::all()->sortByDesc('created_at');
        // $logActivity = DB::table('activity_log')->paginate(15);
        $countActivity = Activity::all()->count();
        return view('dashboard.log.index', [
            'title' => 'Log Activity',
            'active' => 'logActivity',
            'logActivity' => $logActivity ,
            'countActivity' => $countActivity,
        ]);
        // return response()->json($logActivity, 200, [], JSON_PRETTY_PRINT);
    }
}
