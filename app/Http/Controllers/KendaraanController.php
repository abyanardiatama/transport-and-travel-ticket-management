<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKendaraanRequest;
use App\Http\Requests\UpdateKendaraanRequest;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kendaraan.index', [
            'kendaraans' => Kendaraan::all(),
            'countKendaraan' => Kendaraan::all()->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKendaraanRequest $request)
    {

        $validatedData = $request->validate([
            'nama_kendaraan' => 'required',
            'plat_nomor' => 'required',
        ]);
        //if plat nomot not null
        if ($validatedData['plat_nomor'] != null) {
            $plat_nomor = strtoupper($validatedData['plat_nomor']);
            if (Kendaraan::where('plat_nomor', $plat_nomor)->exists()) {
                return redirect('/dashboard')->with('error', 'Plat nomor kendaraan sudah tersedia');
            }
            else{
                Kendaraan::create($validatedData);
                return redirect('/dashboard')->with('success', 'Kendaraan berhasil ditambahkan');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKendaraanRequest $request, $id)
    {
        $kendaraan = Kendaraan::find($id);
        $validatedData = $request->validate([
            'nama_kendaraan' => 'required',
            'plat_nomor' => 'required',
        ]);
        // dd($validatedData);
        $kendaraan->update($validatedData);
        // dd('anjay keupdate');
        return redirect('/dashboard/kendaraan')->with('success', 'Kendaraan berhasil diupdate');
    }

    public function deleteKendaraan($id)
    {
        $kendaraan = Kendaraan::find($id);
        $kendaraan->delete();
        return redirect('/dashboard/kendaraan')->with('success', 'Kendaraan berhasil dihapus');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kendaraan $kendaraan)
    {
        //
    }
}
