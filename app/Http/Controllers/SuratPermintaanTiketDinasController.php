<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuratPermintaanTiketDinasRequest;
use App\Http\Requests\UpdateSuratPermintaanTiketDinasRequest;
use App\Models\SuratPermintaanTiketDinas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuratPermintaanTiketDinasCreated;
use App\Mail\SuratPermintaanTiketDinasApproved;
use App\Mail\SuratPermintaanTiketDinasDitolak;

class SuratPermintaanTiketDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->is_pegawai == 1){
            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('id_pemohon', auth()->user()->id)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('id_pemohon', auth()->user()->id)->where('isApprove_pegawai', true)->where('isApprove_atasan', true)->count();
        }
        elseif (auth()->user()->is_admin == 1){
            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::all();
            $countSuratTiketDinas = $suratPermintaanTiketDinas->count();
        }
        elseif (auth()->user()->is_atasan1 == 1){
            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('email_atasan', auth()->user()->email)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('email_atasan', auth()->user()->email)->count();
        }
        elseif (auth()->user()->is_atasan2 == 1){
            $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('email_atasan', auth()->user()->email)->get();
            $countSuratTiketDinas = SuratPermintaanTiketDinas::where('isApprove_pegawai', true)->where('isApprove_atasan', null)->where('email_atasan', auth()->user()->email)->count();
        }
        return view('dashboard.SuratTiketPerjalananDinas.index',[
            'suratPermintaanTiketDinas' => $suratPermintaanTiketDinas,
            'countSuratTiketDinas' => $countSuratTiketDinas,
        ]);
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
        $validatedData = $request->validate([
            'id_pemohon' => 'required',
            'nama_pemohon' => 'required',
            'unit' => 'required',
            'email_atasan' => 'required|email:rfc,dns',
            'beban_biaya' => 'required',
            'jenis_transportasi' => 'required',
            'jenis_kelas' => 'required',
            'rute_asal' => 'required',
            'rute_tujuan' => 'required',
            'waktu_berangkat' => 'required',
            'perusahaan_angkutan' => 'required',
        ]);
        $tanggal_berangkat = $request->waktu_berangkat;
        $tanggal_berangkat = date('Y-m-d', strtotime($tanggal_berangkat));
        $tanggal_berangkat = str_replace('00', '', $tanggal_berangkat);
        $jam_berangkat = $request->waktu_berangkat;
        $jam_berangkat = date('H:i', strtotime($jam_berangkat));
        unset($validatedData['waktu_berangkat']);
        $validatedData['tanggal_berangkat'] = $tanggal_berangkat;
        $validatedData['jam_berangkat'] = $jam_berangkat;
        $email_atasan = $validatedData['email_atasan'];
        $is_atasan1 = User::where('email', $email_atasan)->where('is_atasan1', true)->first();
        //send error message if email_atasan not found
        $is_atasan2 = User::where('email', $email_atasan)->where('is_atasan2', true)->first();
        //validate email_atasan is it atassan1 or atasan2
        $validatedData['isApprove_pegawai'] = true;
        if(!$is_atasan1 && !$is_atasan2){
            //send error to name email_atasan
            Session::flash('error', 'Email atasan tidak ditemukan');
            return redirect('/dashboard/permintaantiketdinas/create');
        }
        else{
            Mail::to($validatedData['email_atasan'])->send(new SuratPermintaanTiketDinasCreated($validatedData));
            SuratPermintaanTiketDinas::create($validatedData);
            Session::flash('success', 'Surat Permintaan Tiket Dinas Berhasil Dibuat');
            return redirect('/dashboard');
        }
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

    public function atasanApprove($id)
    {
        $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::find($id);
        $pemohon = User::find($suratPermintaanTiketDinas->id_pemohon);
        Mail::to($pemohon->email)->send(new SuratPermintaanTiketDinasApproved($suratPermintaanTiketDinas));
        $suratPermintaanTiketDinas->isApprove_atasan = true;
        $suratPermintaanTiketDinas->save();
        Session::flash('success', 'Surat Permintaan Tiket Dinas Berhasil Disetujui');
        return redirect('/dashboard');
    }

    public function atasanTolak($id)
    {
        $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::find($id);
        $pemohon = User::find($suratPermintaanTiketDinas->id_pemohon);
        Mail::to($pemohon->email)->send(new SuratPermintaanTiketDinasDitolak($suratPermintaanTiketDinas));
        $suratPermintaanTiketDinas->isApprove_atasan = false;
        $suratPermintaanTiketDinas->save();
        Session::flash('success', 'Surat Permintaan Tiket Dinas Berhasil Ditolak');
        return redirect('/dashboard');
    }

    public function reviewData($id)
    {
        $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::find($id);
        return view('dashboard.SuratTiketPerjalananDinas.review', [
            'suratPermintaanTiketDinas' => $suratPermintaanTiketDinas,
        ]);
    }

    public function edit($id)
    {
        $suratTiketDinas = SuratPermintaanTiketDinas::find($id);
        //merge tanggal_berangkat and jam_berangkat
        $waktu_berangkat = $suratTiketDinas->tanggal_berangkat . ' ' . $suratTiketDinas->jam_berangkat;
        return view('dashboard.SuratTiketPerjalananDinas.edit', [
            'suratTiketDinas' => $suratTiketDinas,
            'waktu_berangkat' => $waktu_berangkat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratPermintaanTiketDinasRequest $request, $id)
    {
        $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::find($id);
        $validatedData = $request->validate([
            'id_pemohon' => 'required',
            'nama_pemohon' => 'required',
            'unit' => 'required',
            'email_atasan' => 'required|email:rfc,dns',
            'beban_biaya' => 'required',
            'jenis_transportasi' => 'required',
            'jenis_kelas' => 'required',
            'rute_asal' => 'required',
            'rute_tujuan' => 'required',
            'waktu_berangkat' => 'required',
            'perusahaan_angkutan' => 'required',
        ]);
        //get date from tanggal_berangkat
        $tanggal_berangkat = $request->waktu_berangkat;
        $tanggal_berangkat = date('Y-m-d', strtotime($tanggal_berangkat));
        $tanggal_berangkat = str_replace('00', '', $tanggal_berangkat);

        //get time from jam_berangkat
        $jam_berangkat = $request->waktu_berangkat;
        $jam_berangkat = date('H:i', strtotime($jam_berangkat));

        unset($validatedData['waktu_berangkat']);
        $validatedData['tanggal_berangkat'] = $tanggal_berangkat;
        $validatedData['jam_berangkat'] = $jam_berangkat;
        $suratPermintaanTiketDinas->update($validatedData);
        $email_atasan = $validatedData['email_atasan'];
        $is_atasan1 = User::where('email', $email_atasan)->where('is_atasan1', true)->first();
        //send error message if email_atasan not found
        $is_atasan2 = User::where('email', $email_atasan)->where('is_atasan2', true)->first();
        //validate email_atasan is it atasan1 or atasan2
        $validatedData['isApprove_pegawai'] = true;
        $validatedData['isApprove_atasan'] = null;

        if(!$is_atasan1 && !$is_atasan2){
            //send error to name email_atasan
            Session::flash('error', 'Email atasan tidak ditemukan');
            return redirect('/dashboard/permintaantiketdinas/{id}/edit');
        }
        else{
            //update surat dinas
            Mail::to($validatedData['email_atasan'])->send(new SuratPermintaanTiketDinasCreated($validatedData));
            $suratPermintaanTiketDinas->update($validatedData);
            Session::flash('success', 'Surat Permintaan Tiket Dinas Berhasil Diperbarui');
            return redirect('/dashboard/');
        }

    }

    public function deleteTiketDinas($id)
    {
        $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::find($id);
        $suratPermintaanTiketDinas->delete();
        Session::flash('success', 'Surat Permintaan Tiket Dinas Berhasil Dihapus');
        return redirect('/dashboard/permintaantiketdinas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function downloadTiketDinas($id)
    {
        $suratPermintaanTiketDinas = SuratPermintaanTiketDinas::find($id);
        $nama_atasan = User::where('email', $suratPermintaanTiketDinas->email_atasan)->first();
        
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('templates/surat_permintaan_pengurusan_tiket_perjalanan_dinas.docx');
        $phpWord->setValue('nama_pemohon', $suratPermintaanTiketDinas->nama_pemohon);
        $phpWord->setValue('nama_atasan', $nama_atasan->name);
        $phpWord->setValue('unit', $suratPermintaanTiketDinas->unit);
        $phpWord->setValue('email_atasan', $suratPermintaanTiketDinas->email_atasan);
        $phpWord->setValue('beban_biaya', $suratPermintaanTiketDinas->beban_biaya);
        $phpWord->setValue('jenis_transportasi', $suratPermintaanTiketDinas->jenis_transportasi);
        $phpWord->setValue('jenis_kelas', $suratPermintaanTiketDinas->jenis_kelas);
        $phpWord->setValue('rute_asal', $suratPermintaanTiketDinas->rute_asal);
        $phpWord->setValue('rute_tujuan', $suratPermintaanTiketDinas->rute_tujuan);
        $phpWord->setValue('tanggal_berangkat', Carbon::parse($suratPermintaanTiketDinas->tanggal_berangkat)->translatedFormat('d F Y'));
        $phpWord->setValue('jam_berangkat', Carbon::parse($suratPermintaanTiketDinas->jam_berangkat)->format('H:i'));
        $phpWord->setValue('perusahaan_angkutan', $suratPermintaanTiketDinas->perusahaan_angkutan);
        $phpWord->setValue('created_at', $suratPermintaanTiketDinas->created_at->translatedFormat('d F Y'));
        $filename = 'Surat Permintaan Pengurusan Tiket Perjalanan Dinas - ' . $suratPermintaanTiketDinas->nama_pemohon . '.docx';
        $phpWord->saveAs($filename);
        return response()->download($filename)->deleteFileAfterSend(true);

    }
    public function destroy($id)
    {
        //
    }
}
