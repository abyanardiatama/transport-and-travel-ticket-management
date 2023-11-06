<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuratPermintaanTransportRequest;
use App\Http\Requests\UpdateSuratPermintaanTransportRequest;
use App\Models\SuratPerintahKerja;
use Illuminate\Http\Request;
use App\Models\SuratPermintaanTransport;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class SuratPermintaanTransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->is_pegawai == 1){
            //display surat permintaan transport that id_pemohon == id user
            $suratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('id_pemohon', Auth::user()->id)->where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', true)->count();
        }
        elseif(Auth::user()->is_admin == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 1, and is_approve_admin = 0
            $suratPermintaanTransport = SuratPermintaanTransport::all();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', true)->where('isApprove_admin', null)->count();
        }

        //cek auth user is_atasan and email_atasan == email user
        elseif(Auth::user()->is_atasan1 == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 0, and is_approve_admin = 0, and email_atasan == email user
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->count();
            // $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', 0)->where('isApprove_admin', 0)->get();
        }
        elseif(Auth::user()->is_atasan2 == 1){
            //display surat permintaan transport that is_approve_pegawai = 1 and is_approve_atasan = 0, and is_approve_admin = 0, and email_atasan == email user
            $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->get();
            $countSuratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', null)->where('isApprove_admin', null)->where('email_atasan', Auth::user()->email)->count();
            // $suratPermintaanTransport = SuratPermintaanTransport::where('isApprove_pegawai', 1)->where('isApprove_atasan', 0)->where('isApprove_admin', 0)->get();
        }
        return view('dashboard.SuratPermintaanTransport.index', [
            'suratPermintaanTransport' => $suratPermintaanTransport,
            'countSuratPermintaanTransport' => $countSuratPermintaanTransport,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        //get all user email
        $users = User::all();
        //get all user email with is_atasan1 = true or is_atasan2 = true
        $users = User::where('is_atasan1', true)->orWhere('is_atasan2', true)->get();
        return view('dashboard.SuratPermintaanTransport.create',[
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratPermintaanTransportRequest $request)
    {
        $validatedData = $request->validate([
            'nama_pemohon' => 'required',
            'unit' => 'required',
            'id_pemohon' => 'required',
            'email_atasan' => 'required|email:rfc,dns',
            'biaya_perjalanan' => 'required',
            'tujuan' => 'required',
            'rute_pemakaian' => 'required',
            'keperluan' => 'required',
            'jumlah_penumpang' => 'required',
            'waktu_berangkat' => 'required',
            'waktu_kembali' => 'required',
            'waktu_kembali' => 'required',
        ]);
        //get date from waktu_berangkat
        $tanggal_berangkat = $request->waktu_berangkat;
        $tanggal_kembali = $request->waktu_kembali;
        $tanggal_berangkat = date('Y-m-d', strtotime($tanggal_berangkat));
        $tanggal_kembali = date('Y-m-d', strtotime($tanggal_kembali));
        //delete 00 from date
        $tanggal_berangkat = str_replace('00', '', $tanggal_berangkat);
        $tanggal_kembali = str_replace('00', '', $tanggal_kembali);

        //get time from waktu_berangkat
        $waktu_berangkat = $request->waktu_berangkat;
        $waktu_kembali = $request->waktu_kembali;
        $waktu_berangkat = date('H:i', strtotime($waktu_berangkat));
        $waktu_kembali = date('H:i', strtotime($waktu_kembali));

        //add tanggal_berangkat, tanggal_kembali, waktu_berangkat, waktu_kembali to validatedData
        $validatedData['tanggal_berangkat'] = $tanggal_berangkat;
        $validatedData['tanggal_kembali'] = $tanggal_kembali;
        $validatedData['jam_berangkat'] = $waktu_berangkat;
        $validatedData['jam_kembali'] = $waktu_kembali;
        //add isApprove_pegawai
        $validatedData['isApprove_pegawai'] = true;
        
        //cek if email_atasan on the database
        $email_atasan = $validatedData['email_atasan'];
        //cek all user email with is_atasan1 = true
        $is_atasan1 = User::where('email', $email_atasan)->where('is_atasan1', true)->first();
        //send error message if email_atasan not found
        $is_atasan2 = User::where('email', $email_atasan)->where('is_atasan2', true)->first();
        //check if email atasan is is_atasan1 or is atasan2
        if(!$is_atasan1 && !$is_atasan2){
            //send error to name email_atasan
            Session::flash('error', 'Email atasan tidak ditemukan');
            return redirect('/dashboard/permintaantransport/create');
        }
        //tanggal berangkat must be less than tanggal kembali
        elseif($validatedData['tanggal_berangkat'] > $validatedData['tanggal_kembali']){
            //send error message
            Session::flash('error', 'Tanggal berangkat tidak valid');
            return redirect('/dashboard/permintaantransport/create');
        }
        //check if tanggal_berangkat and tanggal_kembali is same but jam_berangkat is more than jam_kembali
        elseif($validatedData['tanggal_berangkat'] == $validatedData['tanggal_kembali'] && $validatedData['jam_berangkat'] > $validatedData['jam_kembali']){
            //send error message
            Session::flash('error', 'Jam berangkat tidak valid');
            return redirect('/dashboard/permintaantransport/create');
        }
        //check if tanggal_berangkat and tanggal_kembali is same but jam_berangkat is same with jam_kembali
        elseif($validatedData['tanggal_berangkat'] == $validatedData['tanggal_kembali'] && $validatedData['jam_berangkat'] == $validatedData['jam_kembali']){
            //send error message
            Session::flash('error', 'Waktu berangkat tidak valid');
            return redirect('/dashboard/permintaantransport/create');
        }
        //check if any same data on database
        // elseif(SuratPermintaanTransport::where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
        // ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
        // ->where('jam_berangkat', $validatedData['jam_berangkat'])
        // ->where('jam_kembali', $validatedData['jam_kembali'])
        // ->exists()){
        //     Session::flash('error', 'Jadwal sudah sama dengan yang lain');
        //     return redirect('/dashboard/permintaantransport/create');
        // }
        
        //check if tanggal_berangkat and tanggal_kembali is same but jam_berangkat is overlap with other data in database
        // elseif(SuratPermintaanTransport::where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
        // ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
        // ->where('jam_berangkat', '<=', $validatedData['jam_berangkat'])
        // ->where('jam_kembali', '>=', $validatedData['jam_berangkat'])
        // ->exists()){
        //     Session::flash('error', 'Jadwal sudah terisi');
        //     return redirect('/dashboard/permintaantransport/create');
        // }
        // elseif(SuratPermintaanTransport::where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
        // ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
        // ->where('jam_berangkat', '>=', $validatedData['jam_berangkat'])
        // ->where('jam_berangkat', '<=', $validatedData['jam_kembali'])
        // ->exists()){
        //     Session::flash('error', 'Jadwal sudah terisi');
        //     return redirect('/dashboard/permintaantransport/create');
        // }
        // elseif(SuratPermintaanTransport::where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
        // ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
        // ->where('jam_berangkat', '>=', $validatedData['jam_berangkat'])
        // ->where('jam_kembali', '<=', $validatedData['jam_kembali'])
        // ->exists()){
        //     Session::flash('error', 'Mobil masih dipakai');
        //     return redirect('/dashboard/permintaantransport/create');
        // }
        // //check if tanggal_berangkat and tanggal_kembali is new but jam_berangkat is overlap with other data in database
        // elseif(SuratPermintaanTransport::where('tanggal_berangkat', '<=', $validatedData['tanggal_berangkat'])
        // ->where('tanggal_kembali', '>=', $validatedData['tanggal_berangkat'])
        // ->where('jam_berangkat', '<=', $validatedData['jam_berangkat'])
        // ->where('jam_kembali', '>=', $validatedData['jam_berangkat'])
        // ->exists()){
        //     Session::flash('error', 'Jadwal sudah dipakai');
        //     return redirect('/dashboard/permintaantransport/create');
        // }

        else{
            //create new SuratPermintaanTransport
            SuratPermintaanTransport::create($validatedData);
            //send success message to dashboard
            Session::flash('success', 'Surat Permintaan Transport berhasil dibuat');
            //redirect to dashboard
            return redirect('/dashboard');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPermintaanTransport $suratPermintaanTransport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //get data based id
        $suratTransport = SuratPermintaanTransport::find($id);
        //merge tanggal_berangkat and jam_berangkat
        $waktu_berangkat = $suratTransport->tanggal_berangkat . ' ' . $suratTransport->jam_berangkat;
        $waktu_kembali = $suratTransport->tanggal_kembali . ' ' . $suratTransport->jam_kembali;
        //get all user with is_driver ==true
        return view('dashboard.SuratPermintaanTransport.edit',[
            'suratTransport' => $suratTransport,
            'waktu_berangkat' => $waktu_berangkat,
            'waktu_kembali' => $waktu_kembali,
        ]);
    }

    public function approveAtasan($id) 
    {
        $data = SuratPermintaanTransport::find($id);
        //get isApprove_atasan from database
        $data = $data->isApprove_atasan;
        // change value to 1 in database
        $data = 1;
        //update data
        SuratPermintaanTransport::where('id', $id)->update(['isApprove_atasan' => $data]);
        //send session success to dashboard
        Session::flash('success', 'Surat Permintaan Transport berhasil diapprove');
        return redirect('/dashboard');
        // dd('data berhasil kembali ke dashboard');
    }

    public function tolakAtasan($id)
    {
        $data = SuratPermintaanTransport::find($id);
        //get isApprove_atasan from database
        $data = $data->isApprove_atasan;
        // change value to 1 in database
        $data = 0;
        //update data
        SuratPermintaanTransport::where('id', $id)->update(['isApprove_atasan' => $data]);
        //send session success to dashboard
        Session::flash('success', 'Surat Permintaan Transport berhasil ditolak');
        return redirect('/dashboard');
        // dd('data berhasil kembali ke dashboard');
    }
    public function lengkapiData($id)
    {
        //get data based id
        $suratTransport = SuratPermintaanTransport::find($id);
        //merge tanggal_berangkat and jam_berangkat
        // dd($suratTransport->id);
        $data = $suratTransport->tanggal_berangkat;
        //dd($suratTransport->tanggal_berangkat . ' ' . $suratTransport->jam_berangkat);
        $waktu_berangkat = $suratTransport->tanggal_berangkat . ' ' . $suratTransport->jam_berangkat;
        $waktu_kembali = $suratTransport->tanggal_kembali . ' ' . $suratTransport->jam_kembali;
        $users = User::where('is_driver', true)->get();
        //get data kendaraan that status = tersedia
        $kendaraan = Kendaraan::all();
        return view('dashboard.SuratPermintaanTransport.edit',[
            'suratTransport' => $suratTransport,
            'waktu_berangkat' => $waktu_berangkat,
            'waktu_kembali' => $waktu_kembali,
            'users' => $users,
            'kendaraan' => $kendaraan,
        ]);
    }

    public function updateLengkapiData(UpdateSuratPermintaanTransportRequest $request, $id)
    {
        $suratTransport = SuratPermintaanTransport::find($id);
        $validatedData = $request->validate([
            'nama_pemohon' => 'required',
            'id_pemohon' => 'required',
            'unit' => 'required',
            'email_atasan' => 'required|email:rfc,dns',
            'biaya_perjalanan' => 'required',
            'tujuan' => 'required',
            'rute_pemakaian' => 'required',
            'keperluan' => 'required',
            'jumlah_penumpang' => 'required',
            'waktu_berangkat' => 'required',
            'waktu_kembali' => 'required',
            'kendaraan_lain' => '',
            'nomor_polisi' => '',
            'nama_driver' => '',
        ]);
        //get date from waktu_berangkat
        $tanggal_berangkat = $request->waktu_berangkat;
        $tanggal_kembali = $request->waktu_kembali;
        $tanggal_berangkat = date('Y-m-d', strtotime($tanggal_berangkat));
        $tanggal_kembali = date('Y-m-d', strtotime($tanggal_kembali));
        //delete 00 from date
        $tanggal_berangkat = str_replace('00', '', $tanggal_berangkat);
        $tanggal_kembali = str_replace('00', '', $tanggal_kembali);

        //get time from waktu_berangkat
        $waktu_berangkat = $request->waktu_berangkat;
        $waktu_kembali = $request->waktu_kembali;
        $waktu_berangkat = date('H:i', strtotime($waktu_berangkat));
        $waktu_kembali = date('H:i', strtotime($waktu_kembali));

        //add tanggal_berangkat, tanggal_kembali, waktu_berangkat, waktu_kembali to validatedData
        $validatedData['tanggal_berangkat'] = $tanggal_berangkat;
        $validatedData['tanggal_kembali'] = $tanggal_kembali;
        $validatedData['jam_berangkat'] = $waktu_berangkat;
        $validatedData['jam_kembali'] = $waktu_kembali;
        
         //add isApprove_admin
        $validatedData['isApprove_admin'] = true;
        if($validatedData['nama_driver'] == null && $validatedData['nomor_polisi'] == null){
            Session::flash('success', 'Surat Permintaan Transport berhasil dilengkapi');
            SuratPermintaanTransport::where('id', $suratTransport->id)->update($validatedData);
            return redirect('/dashboard');
        }
        //check if nama driver and nomor polisi is not null
        elseif($validatedData['nama_driver'] != null && $validatedData['nomor_polisi'] != null){
            //Mengecek data yang sama
            if(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
            ->where('jam_berangkat', $validatedData['jam_berangkat'])
            ->where('jam_kembali', $validatedData['jam_berangkat'])
            ->exists()){
                unset($validatedData['waktu_berangkat']);
                unset($validatedData['waktu_kembali']);
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect()->route('permintaantransport.lengkapidata', compact('id'));
            }
            //Mengencek hari yang sama dimana jam berangkat berada diantara jam berangkat dan jam kembali di database 
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
            ->where('jam_berangkat', '<=', $validatedData['jam_berangkat'])
            ->where('jam_kembali', '>=', $validatedData['jam_berangkat'])
            ->exists()){
                unset($validatedData['waktu_berangkat']);
                unset($validatedData['waktu_kembali']);
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect()->route('permintaantransport.lengkapidata', compact('id'));
            }
            //Mengencek hari yang sama dimana jam berangkat berada sebelum jam berangkat di database dan jam kembali berada setelah jam berangkat di database
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
            ->where('jam_berangkat', '>=', $validatedData['jam_berangkat'])
            ->where('jam_berangkat', '<=', $validatedData['jam_kembali'])
            ->exists()){
                unset($validatedData['waktu_berangkat']);
                unset($validatedData['waktu_kembali']);
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect()->route('permintaantransport.lengkapidata', compact('id'));
            }
            //Mengencek dimana tanggal berangkat berada diantara tanggal berangkat dan tanggal kembali di database
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', '<=', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', '>=', $validatedData['tanggal_berangkat'])
            ->where('jam_kembali', '>=', $validatedData['jam_berangkat'])
            ->exists()){
                unset($validatedData['waktu_berangkat']);
                unset($validatedData['waktu_kembali']);
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect()->route('permintaantransport.lengkapidata', compact('id'));
            }
            //Mengencek dimana tanggal berangkat berada sebelum tanggal berangkat di database dan tanggal kembali berada setelah tanggal berangkat di database
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', '>=', $validatedData['tanggal_berangkat'])
            ->where('tanggal_berangkat', '>=', $validatedData['tanggal_kembali'])
            ->where('jam_berangkat', '<=', $validatedData['jam_kembali'])
            ->exists()){
                unset($validatedData['waktu_berangkat']);
                unset($validatedData['waktu_kembali']);
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect()->route('permintaantransport.lengkapidata', compact('id'));
            }
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', '>=', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', '<=', $validatedData['tanggal_kembali'])
            ->exists()){
                unset($validatedData['waktu_berangkat']);
                unset($validatedData['waktu_kembali']);
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect()->route('permintaantransport.lengkapidata', compact('id'));
            }
            else{
                Session::flash('success', 'Surat Permintaan Transport berhasil dilengkapi');
                //update
                //delete column waktu_berangkat
                unset($validatedData['waktu_berangkat']);
                unset($validatedData['waktu_kembali']);
                SuratPermintaanTransport::where('id', $suratTransport->id)->update($validatedData);
                //go to perintah kerja create
                //get data from surat permintaan transport
                $suratPermintaanTransport = SuratPermintaanTransport::find($id);
                //Count lama perjalanan based on tanggal berangkat and tanggal kembali
                $tanggal_berangkat = $validatedData['tanggal_berangkat'];
                $tanggal_kembali = $validatedData['tanggal_kembali'];
                $lama_perjalanan = (strtotime($tanggal_kembali) - strtotime($tanggal_berangkat)) / (60 * 60 * 24);
                $lama_perjalanan = $lama_perjalanan + 1;
                return view('dashboard.SuratPerintahKerja.create', [
                    'suratPermintaanTransport' => $suratPermintaanTransport,
                    'lama_perjalanan' => $lama_perjalanan,
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratPermintaanTransportRequest $request, $id)
    {
        $suratPermintaanTransport = SuratPermintaanTransport::find($id);
        $validatedData = $request->validate([
            'id_pemohon' => 'required',
            'nama_pemohon' => 'required',
            'unit' => 'required',
            'email_atasan' => 'required|email:rfc,dns',
            'biaya_perjalanan' => 'required',
            'tujuan' => 'required',
            'rute_pemakaian' => 'required',
            'keperluan' => 'required',
            'jumlah_penumpang' => 'required',
            'waktu_berangkat' => 'required',
            'waktu_kembali' => 'required',
        ]);
        //get date from waktu_berangkat
        $tanggal_berangkat = $request->waktu_berangkat;
        $tanggal_kembali = $request->waktu_kembali;
        $tanggal_berangkat = date('Y-m-d', strtotime($tanggal_berangkat));
        $tanggal_kembali = date('Y-m-d', strtotime($tanggal_kembali));
        //delete 00 from date
        $tanggal_berangkat = str_replace('00', '', $tanggal_berangkat);
        $tanggal_kembali = str_replace('00', '', $tanggal_kembali);
        //get time from waktu_berangkat
        $waktu_berangkat = $request->waktu_berangkat;
        $waktu_kembali = $request->waktu_kembali;
        $waktu_berangkat = date('H:i', strtotime($waktu_berangkat));
        $waktu_kembali = date('H:i', strtotime($waktu_kembali));
        //add tanggal_berangkat, tanggal_kembali, waktu_berangkat, waktu_kembali to validatedData
        $validatedData['tanggal_berangkat'] = $tanggal_berangkat;
        $validatedData['tanggal_kembali'] = $tanggal_kembali;
        $validatedData['jam_berangkat'] = $waktu_berangkat;
        $validatedData['jam_kembali'] = $waktu_kembali;
        //add isApprove_pegawai
        $validatedData['isApprove_pegawai'] = true;
        //cek if email_atasan on the database
        $email_atasan = $validatedData['email_atasan'];
        //cek all user email with is_atasan1 = true
        $is_atasan1 = User::where('email', $email_atasan)->where('is_atasan1', true)->first();
        $is_atasan2 = User::where('email', $email_atasan)->where('is_atasan2', true)->first();
        //delete column waktu_berangkat
        unset($validatedData['waktu_berangkat']);
        unset($validatedData['waktu_kembali']);
        $validatedData['isApprove_pegawai'] = true;
        $validatedData['isApprove_atasan'] = null;
        $validatedData['isApprove_admin'] = null;

        if(!$is_atasan1 && !$is_atasan2){
            //send error to name email_atasan
            Session::flash('error', 'Email atasan tidak ditemukan');
            return redirect('/dashboard/permintaantransport/create');
        }
        //tanggal berangkat must be less than tanggal kembali
        elseif($validatedData['tanggal_berangkat'] > $validatedData['tanggal_kembali']){
            //send error message
            Session::flash('error', 'Tanggal berangkat tidak valid');
            return redirect('/dashboard/permintaantransport/create');
        }
        //check if tanggal_berangkat and tanggal_kembali is same but jam_berangkat is more than jam_kembali
        elseif($validatedData['tanggal_berangkat'] == $validatedData['tanggal_kembali'] && $validatedData['jam_berangkat'] > $validatedData['jam_kembali']){
            //send error message
            Session::flash('error', 'Jam berangkat tidak valid');
            return redirect('/dashboard/permintaantransport/create');
        }
        //check if tanggal_berangkat and tanggal_kembali is same but jam_berangkat is same with jam_kembali
        elseif($validatedData['tanggal_berangkat'] == $validatedData['tanggal_kembali'] && $validatedData['jam_berangkat'] == $validatedData['jam_kembali']){
            //send error message
            Session::flash('error', 'Waktu berangkat tidak valid');
            return redirect('/dashboard/permintaantransport/create');
        }
        else{
            //update SuratPermintaanTransport
            SuratPermintaanTransport::where('id', $suratPermintaanTransport->id)->update($validatedData);
            //send success message to dashboard
            Session::flash('success', 'Surat Permintaan Transport berhasil diedit');
            //redirect to dashboard
            return redirect('/dashboard');
        }
        
    }

    public function deleteTransport($id)
    {
        $suratPermintaanTransport = SuratPermintaanTransport::find($id);
        $suratPermintaanTransport->delete();
        Session::flash('success', 'Data berhasil dihapus');
        return redirect('/dashboard/permintaantransport');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratPermintaanTransport $suratPermintaanTransport)
    {
        //
    }
}
