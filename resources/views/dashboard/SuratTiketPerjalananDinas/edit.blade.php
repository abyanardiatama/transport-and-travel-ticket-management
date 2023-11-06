@extends('dashboard.layouts.main')
@section('container')
<div class="max-w-full pt-20 px-6">
    {{-- Session error --}}
    @if (session('error'))
        <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium">
                {{ session('error') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    @if (Auth::user()->is_pegawai == true)
        <h1 class="text-md  font-medium dark:text-white">Edit Surat Permintaan Tiket Dinas</h1>
    @elseif (Auth::user()->is_admin == true)
        <h1 class="text-md  font-medium dark:text-white">Review Surat Permintaan Tiket Dinas</h1>
    @endif
    <hr class="bg-slate-200 mt-5 max-w-lg">

    @if (Auth::user()->is_pegawai == true)
        <form action="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}" method="post" class="max-w-3xl py-4 font-montserrat">
            @method('put')
    @endif
    @if (Auth::user()->is_admin == true)
        <form action="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}/lengkapidata" method="post" class="max-w-3xl py-4 font-montserrat">
            @method('post')
    @endif
        @csrf
        <div class="grid grid-cols-2 gap-4">
            {{-- field id_pemohon --}}
            <div hidden class="col-span-2 sm:col-span-1">
                <input type="text" name="id_pemohon" id="id_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ Auth::user()->id }}" value="{{ Auth::user()->id }}" placeholder="ID Pemohon" readonly>
            </div>
            {{-- field nama --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="nama_pemohon" id="nama_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Pemohon" value="{{ old('nama_pemohon', $suratTiketDinas->nama_pemohon) }}" required>
            </div>
            {{-- field unit --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="unit" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Unit" value="{{ old('unit', $suratTiketDinas->unit) }}" required> 
            </div>
            {{-- email atasan --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="email" name="email_atasan" id="email_atasan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('email_atasan', $suratTiketDinas->email_atasan) }}" placeholder="Email Atasan" required>
            </div>
            {{-- field beban biaya --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="beban_biaya" id="beban_biaya" value="{{ old('beban_biaya', $suratTiketDinas->beban_biaya) }}" placeholder="Beban Biaya" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- jenis transportasi --}}
            <div class="col-span-2 sm:col-span-1">
                <select name="jenis_transportasi" id="jenis_transportasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Jenis Transportasi</option>
                    <option value="Penerbangan" {{ $suratTiketDinas->jenis_transportasi == 'Penerbangan' ? 'selected' : '' }}>Penerbangan</option>
                    <option value="Kereta Api" {{ $suratTiketDinas->jenis_transportasi == 'Kereta Api' ? 'selected' : '' }}>Kereta Api</option>
                    <option value="Kapal Laut" {{ $suratTiketDinas->jenis_transportasi == 'Kapal Laut' ? 'selected' : '' }}>Kapal Laut</option>
                </select>
            </div>
            {{-- jenis kelas --}}
            <div class="col-span-2 sm:col-span-1">
                <select name="jenis_kelas" id="jenis_kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="{{ $suratTiketDinas->jenis_kelas }}">{{ $suratTiketDinas->jenis_kelas }}</option>
                </select>
                <script>
                    const jenisTransportasi = document.getElementById('jenis_transportasi');
                    const jenisKelas = document.getElementById('jenis_kelas');
                    jenisTransportasi.addEventListener("change", function() {
                        if(jenis_transportasi.value == 'Penerbangan'){
                                jenis_kelas.innerHTML = `
                                    <option value="">Jenis Kelas</option>  
                                    <option value="Ekonomi">Ekonomi</option>
                                    <option value="Ekonomi Premium">Ekonomi Premium</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Eksekutif">First Class</option>
                                `;
                            }else if(jenis_transportasi.value == 'Kereta Api'){
                                jenis_kelas.innerHTML = `
                                    <option value="">Jenis Kelas</option>  
                                    <option value="Ekonomi">Ekonomi</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Eksekutif">Eksekutif</option>
                                    <option value="Luxury">Luxury</option>
                                `;
                            }
                            else if(jenis_transportasi.value == 'Kapal Laut'){
                                jenis_kelas.innerHTML = `
                                    <option value="Disesuaikan">Disesuaikan</option>
                                `;
                            }
                    });

                </script>
            </div>
            {{-- rute asal --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="rute_asal" id="rute_asal" value="{{ old('rute_asal', $suratTiketDinas->rute_asal) }}" placeholder="Rute Asal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- rute tujuan --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="rute_tujuan" id="rute_tujuan" value="{{ old('rute_tujuan', $suratTiketDinas->rute_tujuan) }}" placeholder="Rute Tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- waktu berangkat --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="datetime-local" name="waktu_berangkat" id="waktu_berangkat" value="{{ $suratTiketDinas->tanggal_berangkat }} {{ $suratTiketDinas->jam_berangkat }}" placeholder="Waktu Berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- perusahaan angkutan --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="perusahaan_angkutan" id="perusahaan_angkutan" value="{{ old('perusahaan_angkutan', $suratTiketDinas->perusahaan_angkutan) }}" placeholder="Perusahaan Angkutan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>  
        </form>
        {{-- Note bahwa surat akan diteruskan ke atasan untuk persetujuan --}}
        <div class="col-span-2">
            {{-- <p class="text-gray-500">* Dengan menekan submit Anda telah menyetujui dibuatnya surat permintaan dan akan dikirimkan ke atasan</p> --}}
            <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">Pastikan Semua kolom telah diisi dengan benar</span>
                    <ul class="mt-1.5 list-disc list-inside">
                      <li>Dengan menekan submit Anda telah menyetujui dibuatnya surat permintaan</li>
                      <li>Surat akan dikirimkan ke atasan untuk disetujui</li>
                  </ul>
                </div>
              </div>
        </div>
        {{-- back button --}}
        <div class="col-span-2 sm:col-span-1 sm:flex justify-start">
            <button id="backButton" class="text-sm w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Kembali</a>
        </div>
        <script>
            const backButton = document.getElementById('backButton');
            backButton.addEventListener('click', function(){
                //back to /dashboard
                window.location.href = '/dashboard';
            });
        </script>
        {{-- button submit --}}
        <div class="col-span-2 sm:col-span-1 sm:flex justify-end">
            @if (Auth::user()->is_pegawai == true)
                <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Edit Surat Permintaan Transportasi</button>
            @endif
            @if (Auth::user()->is_admin == true)
                {{-- <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Lengkapi Surat Permintaan Transportasi</button> --}}
                <a href="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}/review" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Setuju Surat Permintaan Tiket Dinas</a>
            @endif
        </div>
</div>
@if (Auth::user()->is_admin == true)
    <script>
        //readonly all input
        const nama_pemohon = document.getElementById('nama_pemohon');
        const unit = document.getElementById('unit');
        const email_atasan = document.getElementById('email_atasan');
        const beban_biaya = document.getElementById('beban_biaya');
        const jenis_transportasi = document.getElementById('jenis_transportasi');
        const rute_asal = document.getElementById('rute_asal');
        const rute_tujuan = document.getElementById('rute_tujuan');
        const waktu_berangkat = document.getElementById('waktu_berangkat');
        const perusahaan_angkutan = document.getElementById('perusahaan_angkutan');

        nama_pemohon.readOnly = true;
        unit.readOnly = true;
        email_atasan.readOnly = true;
        beban_biaya.readOnly = true;
        jenis_transportasi.readOnly = true;
        rute_asal.readOnly = true;
        rute_tujuan.readOnly = true;
        waktu_berangkat.readOnly = true;
        perusahaan_angkutan.readOnly = true;



    </script>
@endif
@endsection