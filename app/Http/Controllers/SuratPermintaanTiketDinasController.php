<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuratPermintaanTiketDinasRequest;
use App\Http\Requests\UpdateSuratPermintaanTiketDinasRequest;
use App\Models\SuratPermintaanTiketDinas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuratPermintaanTiketDinasCreated;
use App\Mail\SuratPermintaanTiketDinasApproved;
use App\Mail\SuratPermintaanTiketDinasDitolak;
use App\Mail\SuratPermintaanTiketDinasLengkap;

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
            //berangkat
            'jenis_transportasi_berangkat' => 'required',
            'jenis_kelas_berangkat' => 'required',
            'rute_asal_berangkat' => 'required',
            'rute_tujuan_berangkat' => 'required',
            'waktu_berangkat' => 'required',
            'perusahaan_angkutan_berangkat' => 'required',
            //pulang
            'jenis_transportasi_kembali' => 'required',
            'jenis_kelas_kembali' => 'required',
            'rute_asal_kembali' => 'required',
            'rute_tujuan_kembali' => 'required',
            'waktu_kembali' => 'required',
            'perusahaan_angkutan_kembali' => 'required',

        ]);
        $tanggal_berangkat = $request->waktu_berangkat;
        $tanggal_berangkat = date('Y-m-d', strtotime($tanggal_berangkat));
        $tanggal_berangkat = str_replace('00', '', $tanggal_berangkat);
        $jam_berangkat = $request->waktu_berangkat;
        $jam_berangkat = date('H:i', strtotime($jam_berangkat));

        $tanggal_kembali = $request->waktu_kembali;
        $tanggal_kembali = date('Y-m-d', strtotime($tanggal_kembali));
        $tanggal_kembali = str_replace('00', '', $tanggal_kembali);
        $jam_kembali = $request->waktu_kembali;
        $jam_kembali = date('H:i', strtotime($jam_kembali));

        unset($validatedData['waktu_kembali']);
        unset($validatedData['waktu_berangkat']);
        $validatedData['tanggal_berangkat'] = $tanggal_berangkat;
        $validatedData['jam_berangkat'] = $jam_berangkat;
        $validatedData['tanggal_kembali'] = $tanggal_kembali;
        $validatedData['jam_kembali'] = $jam_kembali;

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
        activity()
            ->withProperties([
                'id'=>$suratPermintaanTiketDinas->id,
                'nama_user'=>Auth::user()->name,
                'email_user'=>Auth::user()->email,
                'time'=>now()->toDateString(),
            ])
            ->log('approve_surat_permintaan_tiket_dinas');
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
        activity()
            ->withProperties([
                'id'=>$suratPermintaanTiketDinas->id,
                'nama_user'=>Auth::user()->name,
                'email_user'=>Auth::user()->email,
                'time'=>now()->toDateString(),
            ])
            ->log('tolak_surat_permintaan_tiket_dinas');
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
            //berangkat
            'jenis_transportasi_berangkat' => 'required',
            'jenis_kelas_berangkat' => 'required',
            'rute_asal_berangkat' => 'required',
            'rute_tujuan_berangkat' => 'required',
            'waktu_berangkat' => 'required',
            'perusahaan_angkutan_berangkat' => 'required',
            //pulang
            'jenis_transportasi_kembali' => 'required',
            'jenis_kelas_kembali' => 'required',
            'rute_asal_kembali' => 'required',
            'rute_tujuan_kembali' => 'required',
            'waktu_kembali' => 'required',
            'perusahaan_angkutan_kembali' => 'required',
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
        unset($validatedData['waktu_kembali']);
        $validatedData['tanggal_kembali'] = $tanggal_berangkat;
        $validatedData['jam_kembali'] = $jam_berangkat;
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

    public function lengkapiDataDinas($id)
    {
        $suratTiketDinas = SuratPermintaanTiketDinas::find($id);
        return view('dashboard.SuratTiketPerjalananDinas.edit', [
            'suratTiketDinas' => $suratTiketDinas,
        ]);
    }
    public function updateLengkapiDataDinas(UpdateSuratPermintaanTiketDinasRequest $request, $id)
    {
        $suratTiketDinas = SuratPermintaanTiketDinas::find($id);
        $validatedData = $request->validate([
            'beban_biaya' => 'required',
        ]);
        $validatedData['isApprove_admin'] = true;
        $suratTiketDinas->update($validatedData);
        $pemohon = User::find($suratTiketDinas->id_pemohon);
        Mail::to($pemohon->email)->send(new SuratPermintaanTiketDinasLengkap($suratTiketDinas));
        Session::flash('success', 'Surat Permintaan Tiket Dinas berhasil Dilengkapi');
        activity()
            ->withProperties([
                'id'=>$suratTiketDinas->id,
                'nama_user'=>Auth::user()->name,
                'email_user'=>Auth::user()->email,
                'time'=>now()->toDateString(),
            ])
            ->log('lengkapi_surat_permintaan_tiket_dinas');
        return redirect('/dashboard');
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
        
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('templates/surat_permintaan_pengurusan_tiket_perjalanan_dinas_revisi.docx');
        $phpWord->setValue('nama_pemohon', $suratPermintaanTiketDinas->nama_pemohon);
        $phpWord->setValue('unit', $suratPermintaanTiketDinas->unit);
        $phpWord->setValue('beban_biaya', $suratPermintaanTiketDinas->beban_biaya);
        $phpWord->setValue('nama_atasan', $nama_atasan->name);
        //berangkat
        $phpWord->setValue('jenis_transportasi_berangkat', $suratPermintaanTiketDinas->jenis_transportasi_berangkat);
        $phpWord->setValue('jenis_kelas_berangkat', $suratPermintaanTiketDinas->jenis_kelas_berangkat);
        $phpWord->setValue('rute_asal_berangkat', $suratPermintaanTiketDinas->rute_asal_berangkat);
        $phpWord->setValue('rute_tujuan_berangkat', $suratPermintaanTiketDinas->rute_tujuan_berangkat);
        $phpWord->setValue('tanggal_berangkat', $suratPermintaanTiketDinas->tanggal_berangkat);
        $phpWord->setValue('jam_berangkat', $suratPermintaanTiketDinas->jam_berangkat);
        $phpWord->setValue('perusahaan_angkutan_berangkat', $suratPermintaanTiketDinas->perusahaan_angkutan_berangkat);
        //pulang
        $phpWord->setValue('jenis_transportasi_kembali', $suratPermintaanTiketDinas->jenis_transportasi_kembali);
        $phpWord->setValue('jenis_kelas_kembali', $suratPermintaanTiketDinas->jenis_kelas_kembali);
        $phpWord->setValue('rute_asal_kembali', $suratPermintaanTiketDinas->rute_asal_kembali);
        $phpWord->setValue('rute_tujuan_kembali', $suratPermintaanTiketDinas->rute_tujuan_kembali);
        $phpWord->setValue('tanggal_kembali', $suratPermintaanTiketDinas->tanggal_kembali);
        $phpWord->setValue('jam_kembali', $suratPermintaanTiketDinas->jam_kembali);
        $phpWord->setValue('perusahaan_angkutan_kembali', $suratPermintaanTiketDinas->perusahaan_angkutan_kembali);

        $phpWord->setValue('created_at', $suratPermintaanTiketDinas->created_at->translatedFormat('d F Y'));
        $filename = 'Surat Permintaan Pengurusan Tiket Perjalanan Dinas - ' . $suratPermintaanTiketDinas->nama_pemohon . '.docx';
        $phpWord->saveAs($filename);
        activity()
            ->withProperties([
                'id'=>$suratPermintaanTiketDinas->id,
                'nama_user'=>Auth::user()->name,
                'email_user'=>Auth::user()->email,
                'time'=>now()->toDateString(),
            ])
            ->log('download_surat_permintaan_tiket_dinas');
        return response()->download($filename)->deleteFileAfterSend(true);

    }
    public function destroy($id)
    {
        //
    }
}
