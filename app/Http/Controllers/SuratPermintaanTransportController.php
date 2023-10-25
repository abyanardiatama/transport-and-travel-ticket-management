<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuratPermintaanTransportRequest;
use App\Http\Requests\UpdateSuratPermintaanTransportRequest;
use App\Models\SuratPermintaanTransport;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class SuratPermintaanTransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.SuratPermintaanTransport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratPermintaanTransportRequest $request)
    {
        //get all request
        $data = $request->all();
        $validatedData = $request->validate([
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
        //delete 00 from time
        $waktu_berangkat = str_replace('00', '', $waktu_berangkat);
        $waktu_kembali = str_replace('00', '', $waktu_kembali);

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
        if(!$is_atasan1){
            //send error to name email_atasan
            Session::flash('error', 'Email atasan tidak ditemukan');
        }
        //tanggal berangkat must be less than tanggal kembali
        elseif($validatedData['tanggal_berangkat'] > $validatedData['tanggal_kembali']){
            //send error message
            Session::flash('error', 'Waktu berangkat tidak valid');
        }else{
            //create new SuratPermintaanTransport
            SuratPermintaanTransport::create($validatedData);
            //send success message to dashboard
            Session::flash('success', 'Surat Permintaan Transport berhasil dibuat');
            //add data to seeder

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
        return view('dashboard.SuratPermintaanTransport.edit',[
            'suratTransport' => $suratTransport,
            'waktu_berangkat' => $waktu_berangkat,
            'waktu_kembali' => $waktu_kembali,
        ]);
    }

    public function lengkapiData($id)
    {
        //get data based id
        $suratTransport = SuratPermintaanTransport::find($id);
        //merge tanggal_berangkat and jam_berangkat
        $waktu_berangkat = $suratTransport->tanggal_berangkat . ' ' . $suratTransport->jam_berangkat;
        $waktu_kembali = $suratTransport->tanggal_kembali . ' ' . $suratTransport->jam_kembali;
        return view('dashboard.SuratPermintaanTransport.edit',[
            'suratTransport' => $suratTransport,
            'waktu_berangkat' => $waktu_berangkat,
            'waktu_kembali' => $waktu_kembali,
        ]);
    }

    public function updateLengkapiData(UpdateSuratPermintaanTransportRequest $request, $id)
    {
        //find data based id
        $suratPermintaanTransport = SuratPermintaanTransport::find($id);
        $validatedData = $request->validate([
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
            'kendaraan_lain' => '',
            'nomor_polisi' => '',
            'nama_driver' => '',
        ]);
        //delete column waktu_berangkat
        unset($validatedData['waktu_berangkat']);
        unset($validatedData['waktu_kembali']);

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
        
        //cek if email_atasan on the database
        $email_atasan = $validatedData['email_atasan'];
        //cek all user email with is_atasan1  or is_atasan2 = true
        $is_atasan1 = User::where('email', $email_atasan)->where('is_atasan1', true)->first();
        //send error message if email_atasan not found
        if(!$is_atasan1){
            //send error to name email_atasan
            Session::flash('error', 'Email atasan tidak ditemukan');
            //redirect back to /dashboard/permintaantransport/{{ $suratTransport->id }}/lengkapidata
            return redirect('/dashboard/permintaantransport/' . $suratPermintaanTransport->id . '/lengkapidata');
        }elseif($validatedData['tanggal_berangkat'] > $validatedData['tanggal_kembali']){
            //send error message
            Session::flash('error', 'Waktu berangkat tidak valid');
            return redirect('/dashboard/permintaantransport/' . $suratPermintaanTransport->id . '/lengkapidata');
        }else{
            //create new SuratPermintaanTransport
            SuratPermintaanTransport::where('id', $suratPermintaanTransport->id)->update($validatedData);
            //send success message to dashboard
            Session::flash('success', 'Surat Permintaan Transport berhasil dilengkapi');

            //redirect to dashboard
            return redirect('/dashboard');
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratPermintaanTransportRequest $request, SuratPermintaanTransport $suratPermintaanTransport)
    {
        dd($request);
        $validatedData = $request->validate([
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
        //delete column waktu_berangkat
        unset($validatedData['waktu_berangkat']);
        unset($validatedData['waktu_kembali']);

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
        dd($validatedData);
        if(!$is_atasan1){
            //send error to name email_atasan
            Session::flash('error', 'Email atasan tidak ditemukan');
        }
        //tanggal berangkat must be less than tanggal kembali
        elseif($validatedData['tanggal_berangkat'] > $validatedData['tanggal_kembali']){
            //send error message
            Session::flash('error', 'Waktu berangkat tidak valid');
        }else{
            
            //update SuratPermintaanTransport
            SuratPermintaanTransport::where('id', $suratPermintaanTransport->id)->update($validatedData);
            //send success message to dashboard
            Session::flash('success', 'Surat Permintaan Transport berhasil diedit');
            //add data to seeder

            //redirect to dashboard
            return redirect('/dashboard');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratPermintaanTransport $suratPermintaanTransport)
    {
        //
    }
}
