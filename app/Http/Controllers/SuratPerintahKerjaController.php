<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuratPerintahKerjaRequest;
use App\Http\Requests\UpdateSuratPerintahKerjaRequest;
use PhpOffice\PhpWord\PhpWord;
use App\Models\User;
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
    {   if(Auth::user()->is_admin==true){
            $suratPerintahKerja=SuratPerintahKerja::all();
            $countSuratPerintahKerja = SuratPerintahKerja::all()->count();
        }
        elseif(Auth::user()->is_driver==true){
            $suratPerintahKerja=SuratPerintahKerja::where('nama_driver', Auth::user()->name)->get();
            $countSuratPerintahKerja = SuratPerintahKerja::where('nama_driver', Auth::user()->name)->get()->count();
        }
        return view('dashboard.SuratPerintahKerja.index',[
            'suratPerintahKerja' => $suratPerintahKerja,
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
            'nomor_polisi' => 'required',
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
        //user driver
        $user = User::where('is_driver', true)->get();    
        return view('dashboard.SuratPerintahKerja.edit', compact('suratPerintahKerja'),[
            'suratPerintahKerja' => $suratPerintahKerja,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratPerintahKerjaRequest $request, $id)
    {
        $suratPerintahKerja = SuratPerintahKerja::find($id);
        $validatedData = $request->validate([
            'id_admin' => 'required',
            'nama_driver' => 'required',
            'nomor_polisi' => 'required',
            'jobdesc' => 'Driver',
            'keperluan' => 'required',
            'alamat' => 'required',
            'tanggal_berangkat' => 'required',
            'tanggal_kembali' => 'required',
            'jam_berangkat' => 'required',
            'jam_kembali' => 'required',
            'lama_perjalanan' => 'required',
        ]);
        //update surat permintaan transport only
        $suratPermintaanTransport = SuratPermintaanTransport::where('id', $suratPerintahKerja->id_surat_permintaan_transport)->first();
        //check ketersediaan kendaraan
        if($validatedData['nama_driver'] != $suratPermintaanTransport['nama_driver'] &&
         $validatedData['tanggal_berangkat'] != $suratPermintaanTransport['tanggal_berangkat'] &&
          $validatedData['tanggal_kembali'] != $suratPermintaanTransport['tanggal_kembali'] &&
           $validatedData['jam_berangkat'] != $suratPermintaanTransport['jam_berangkat'] &&
            $validatedData['jam_kembali'] != $suratPermintaanTransport['jam_kembali']){
            //Mengecek data yang sama
            if(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
            ->where('jam_berangkat', $validatedData['jam_berangkat'])
            ->where('jam_kembali', $validatedData['jam_berangkat'])
            ->exists()){
                dd('sama1');
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect('/dashboard/perintahkerja/'.$suratPerintahKerja->id.'/edit');
            }
            //Mengencek hari yang sama dimana jam berangkat berada diantara jam berangkat dan jam kembali di database 
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
            ->where('jam_berangkat', '<=', $validatedData['jam_berangkat'])
            ->where('jam_kembali', '>=', $validatedData['jam_berangkat'])
            ->exists()){
                dd('sama2');
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect('/dashboard/perintahkerja/'.$suratPerintahKerja->id.'/edit');
            }
            //Mengencek hari yang sama dimana jam berangkat berada sebelum jam berangkat di database dan jam kembali berada setelah jam berangkat di database
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', $validatedData['tanggal_kembali'])
            ->where('jam_berangkat', '>=', $validatedData['jam_berangkat'])
            ->where('jam_berangkat', '<=', $validatedData['jam_kembali'])
            ->exists()){
                dd('sama3');
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect('/dashboard/perintahkerja/'.$suratPerintahKerja->id.'/edit');
            }
            //Mengencek dimana tanggal berangkat berada diantara tanggal berangkat dan tanggal kembali di database
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', '<=', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', '>=', $validatedData['tanggal_berangkat'])
            ->where('jam_kembali', '>=', $validatedData['jam_berangkat'])
            ->exists()){
                dd('sama4');
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect('/dashboard/perintahkerja/'.$suratPerintahKerja->id.'/edit');
            }
            //Mengencek dimana tanggal berangkat berada sebelum tanggal berangkat di database dan tanggal kembali berada setelah tanggal berangkat di database
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', '>=', $validatedData['tanggal_berangkat'])
            ->where('tanggal_berangkat', '>=', $validatedData['tanggal_kembali'])
            ->where('jam_berangkat', '<=', $validatedData['jam_kembali'])
            ->exists()){
                dd('sama5');
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect('/dashboard/perintahkerja/'.$suratPerintahKerja->id.'/edit');
            }
            elseif(SuratPermintaanTransport::where('nama_driver', $validatedData['nama_driver'])
            ->where('nomor_polisi', $validatedData['nomor_polisi'])
            ->where('tanggal_berangkat', '>=', $validatedData['tanggal_berangkat'])
            ->where('tanggal_kembali', '<=', $validatedData['tanggal_kembali'])
            ->exists()){;
                dd('sama6');
                Session::flash('error', 'Jadwal sudah terisi, silahkan cek daftar penggunaan kendaraan');
                return redirect('/dashboard/perintahkerja/'.$suratPerintahKerja->id.'/edit');
            }
            else{
                Session::flash('success', 'Surat Permintaan Transport berhasil dilengkapi');
                //get data from surat permintaan transport
                $suratPermintaanTransport = SuratPermintaanTransport::find($id);
                //Count lama perjalanan based on tanggal berangkat and tanggal kembali
                $tanggal_berangkat = $validatedData['tanggal_berangkat'];
                $tanggal_kembali = $validatedData['tanggal_kembali'];
                $lama_perjalanan = (strtotime($tanggal_kembali) - strtotime($tanggal_berangkat)) / (60 * 60 * 24);
                $lama_perjalanan = $lama_perjalanan + 1;
                $suratPermintaanTransport->update([
                    'id_admin' => $request->id_admin,
                    'keperluan' => $request->keperluan,
                    'tujuan' => $request->alamat,
                    'tanggal_berangkat' => $request->tanggal_berangkat,
                    'tanggal_kembali' => $request->tanggal_kembali,
                    'jam_berangkat' => $request->jam_berangkat,
                    'jam_kembali' => $request->jam_kembali,
                    'isApprove_admin' => $request->isApprove_admin,
                    'isApprove_atasan' => $request->isApprove_atasan,
                    'nomor_polisi' => $request->nomor_polisi,
                    'nama_driver' => $request->nama_driver,
                    'lama_perjalanan' => $lama_perjalanan,
                ]);

                $suratPerintahKerja->update($validatedData);
                Session::flash('success', 'Surat Perintah Kerja berhasil diupdate');
                return redirect('/dashboard/perintahkerja');
            }
        }
        //update surat permintaan
        dd($request->isApprove_admin);
        $suratPermintaanTransport->update([
            'id_admin' => $request->id_admin,
            'keperluan' => $request->keperluan,
            'tujuan' => $request->alamat,
            'isApprove_admin' => 1,
            'isApprove_atasan' => 1,
        ]);
        //update surat perintah kerja
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
