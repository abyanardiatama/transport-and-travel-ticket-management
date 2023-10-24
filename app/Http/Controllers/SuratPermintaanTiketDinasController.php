<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuratPermintaanTiketDinasRequest;
use App\Http\Requests\UpdateSuratPermintaanTiketDinasRequest;
use App\Models\SuratPermintaanTiketDinas;
use Illuminate\Support\Facades\Session;

class SuratPermintaanTiketDinasController extends Controller
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
        return view('dashboard.SuratTiketPerjalananDinas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratPermintaanTiketDinasRequest $request)
    {
        $validatedData = $request->all();
        // $validatedData = $request->validate([
        //     'nama_pemohon' => 'required',
        //     'unit' => 'required',
        //     'email_atasan' => 'required|email:rfc,dns',
        //     'beban biaya' => 'required',
        //     'jenis_transportasi' => 'required',
        //     'jenis_kelas' => 'required',
        //     'rute_asal' => 'required',
        //     'rute_tujuan' => 'required',
        //     'waktu_berangkat' => 'required',
        //     'perusahaan_angkutan' => 'required',
        // ]);
        $tanggal_berangkat = $request->waktu_berangkat;
        $tanggal_berangkat = date('Y-m-d', strtotime($tanggal_berangkat));
        $tanggal_berangkat = str_replace('00', '', $tanggal_berangkat);
        

        $jam_berangkat = $request->waktu_berangkat;
        $jam_berangkat = date('H:i', strtotime($jam_berangkat));
        $jam_berangkat = str_replace('00', '', $jam_berangkat);

        $validatedData['tanggal_berangkat'] = $tanggal_berangkat;
        $validatedData['jam_berangkat'] = $jam_berangkat;
        SuratPermintaanTiketDinas::create($validatedData);
        //send message to dashboard
        Session::flash('success', 'Surat Permintaan Tiket Dinas Berhasil Dibuat');
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPermintaanTiketDinas $suratPermintaanTiketDinas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPermintaanTiketDinas $suratPermintaanTiketDinas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratPermintaanTiketDinasRequest $request, SuratPermintaanTiketDinas $suratPermintaanTiketDinas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratPermintaanTiketDinas $suratPermintaanTiketDinas)
    {
        //
    }
}
