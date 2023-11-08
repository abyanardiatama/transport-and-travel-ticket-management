<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuratPerintahKerjaRequest;
use App\Http\Requests\UpdateSuratPerintahKerjaRequest;
use PhpOffice\PhpWord\PhpWord;
use App\Models\SuratPerintahKerja;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratPermintaanTransport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class SuratPerintahKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        
        $IdsuratTransport = SuratPermintaanTransport::where('isApprove_pegawai', true)
        ->where('isApprove_atasan', true)
        ->where('isApprove_admin', true)
        ->first();
        if ($IdsuratTransport) {
            $id = $IdsuratTransport->id;
            if(Auth::user()->is_driver == true){
                $suratPerintahKerja = SuratPerintahKerja::where('nama_driver', Auth::user()->name)->get();
                $countSuratPerintahKerja = SuratPerintahKerja::where('nama_driver', Auth::user()->name)->count();
            }
            elseif(Auth::user()->is_admin == true){
                $suratPerintahKerja = SuratPerintahKerja::all();
                $countSuratPerintahKerja = SuratPerintahKerja::all()->count();
            }
            //get nomor polisi from surat permintaan transport
            $suratTransport = SuratPermintaanTransport::where('id', $id)->first();
            $countSuratTransport = SuratPermintaanTransport::where('id', $id)->count();
            $nomor_polisi = $suratTransport->nomor_polisi;
        } else {
            $suratPerintahKerja = null;
        }
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
            'jam_berangkat' => 'required',
            'jam_kembali' => 'required',
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
    public function edit($id)
    {   
        $suratPerintahKerja = SuratPerintahKerja::find($id);    
        return view('dashboard.SuratPerintahKerja.edit', compact('suratPerintahKerja'),[
            'suratPerintahKerja' => $suratPerintahKerja,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratPerintahKerjaRequest $request, SuratPerintahKerja $suratPerintahKerja)
    {
        $validatedData = $request->validate([
            'id_admin' => 'required',
            'nama_driver' => 'required',
            'jobdesc' => 'Driver',
            'keperluan' => 'required',
            'alamat' => 'required',
            'tanggal_berangkat' => 'required',
            'tanggal_kembali' => 'required',
            'jam_berangkat' => 'required',
            'jam_kembali' => 'required',
            'lama_perjalanan' => 'required',
        ]);
        $suratPerintahKerja->update($validatedData);
        Session::flash('success', 'Surat Perintah Kerja berhasil diupdate');
        return redirect('/dashboard/perintahkerja');
    }

    public function deletePerintahKerja($id){
        $suratPerintahKerja = SuratPerintahKerja::find($id);
        // dd('berhasil');
        $suratPerintahKerja->delete();
        Session::flash('success', 'Surat Perintah Kerja berhasil dihapus');
        return redirect('/dashboard/perintahkerja');
    }
    
    public function downloadPerintahKerja($id){
        $suratPerintahKerja = SuratPerintahKerja::find($id);
        
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('templates/surat_perintah_kerja.docx');
        $phpWord->setValue('nama_driver', $suratPerintahKerja->nama_driver);
        $phpWord->setValue('jobdesc', $suratPerintahKerja->jobdesc);
        $phpWord->setValue('keperluan', $suratPerintahKerja->keperluan);
        $phpWord->setValue('alamat', $suratPerintahKerja->alamat);
        $phpWord->setValue('tanggal_berangkat', Carbon::parse($suratPerintahKerja->tanggal_berangkat)->translatedFormat('d F Y'));
        $phpWord->setValue('tanggal_kembali', Carbon::parse($suratPerintahKerja->tanggal_kembali)->translatedFormat('d F Y'));
        $phpWord->setValue('jam_berangkat', $suratPerintahKerja->jam_berangkat);
        $phpWord->setValue('jam_kembali', $suratPerintahKerja->jam_kembali);
        $phpWord->setValue('lama_perjalanan', $suratPerintahKerja->lama_perjalanan);

        $filename = 'Surat Perintah Kerja - '.$suratPerintahKerja->nama_driver.'.docx';
        $phpWord->saveAs($filename);
        return response()->download($filename)->deleteFileAfterSend(true);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratPerintahKerja $suratPerintahKerja)
    {
        //
    }
}
