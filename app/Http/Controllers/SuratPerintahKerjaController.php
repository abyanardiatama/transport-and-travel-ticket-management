<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuratPerintahKerjaRequest;
use App\Http\Requests\UpdateSuratPerintahKerjaRequest;
use App\Models\SuratPerintahKerja;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratPermintaanTransport;
use Illuminate\Support\Facades\Session;

class SuratPerintahKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $IdsuratTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)
        ->where('isApprove_atasan', true)
        ->where('isApprove_admin', true)
        ->first();
        if ($IdsuratTransport) {
            $id = $IdsuratTransport->id;
            $suratPerintahKerja = SuratPerintahKerja::where('nama_driver', Auth::user()->name)->get();
            $countSuratPerintahKerja = SuratPerintahKerja::where('nama_driver', Auth::user()->name)->count();
            //get nomor polisi from surat permintaan transport
            $suratTransport = SuratPermintaanTransport::where('id', $id)->first();
            $countSuratTransport = SuratPermintaanTransport::where('id', $id)->count();
            $nomor_polisi = $suratTransport->nomor_polisi;
        } else {
            $suratPerintahKerja = null;
        }
        // $id = $IdsuratTransport->id;
        // $suratPerintahKerja = SuratPerintahKerja::where('id_surat_permintaan_transport', $id)->first();
        // $countSuratPerintahKerja = SuratPerintahKerja::where('id_surat_permintaan_transport', $id)->count();
        // //get nama_driver
        // //get surat transport that same id with surat perintah kerja
        // $suratTransport = SuratPermintaanTransport::where('id', $id)->first();
        // $nomor_polisi = $suratTransport->nomor_polisi;
        return view('dashboard.SuratPerintahKerja.index',[
            'suratPerintahKerja' => $suratPerintahKerja,
            'nomor_polisi' => $nomor_polisi,
            'countSuratPerintahKerja' => $countSuratPerintahKerja,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.SuratPerintahKerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratPerintahKerjaRequest $request)
    {
        $request['alamat'] = $request->tujuan;
        unset($request['tujuan']);
        // dd($request->all());
        $data = $request->validate([
            'id_surat_permintaan_transport' => 'required',
            'id_admin' => 'required',
            'nama_driver' => 'required',
            'jobdesc' => 'required',
            'keperluan' => 'required',
            'alamat' => 'required',
            'tanggal_berangkat' => 'required',
            'tanggal_kembali' => 'required',
            'lama_perjalanan' => 'required',
            'isApprove_admin' => 'required',
            'isApprove_atasan' => 'required',
        ]);
        
        Session::flash('success', 'Surat Perintah Kerja berhasil dibuat');
        SuratPerintahKerja::create($data);
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPerintahKerja $suratPerintahKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPerintahKerja $suratPerintahKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratPerintahKerjaRequest $request, SuratPerintahKerja $suratPerintahKerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratPerintahKerja $suratPerintahKerja)
    {
        //
    }
}
