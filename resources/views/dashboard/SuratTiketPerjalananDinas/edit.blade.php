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
        <h1 class="text-md  font-medium dark:text-white">Lengkapi Surat Permintaan Tiket Dinas</h1>
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
            <div class="col-span-2">
                <input type="email" name="email_atasan" id="email_atasan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('email_atasan', $suratTiketDinas->email_atasan) }}" placeholder="Email Atasan" required>
            </div>
            @if (Auth::user()->is_admin==true)
                {{-- field beban biaya --}}
                <div class="col-span-2">
                    <input type="text" name="beban_biaya" id="beban_biaya" value="{{ old('beban_biaya', $suratTiketDinas->beban_biaya) }}" placeholder="Beban Biaya" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autofocus>
                </div>
            @endif
            <div class="col-span-2">
                <label class="text-left block text-sm font-medium text-gray-900 dark:text-white">Keberangkatan</label>
            </div>
            {{-- jenis transportasi --}}
            <div class="col-span-2 sm:col-span-1">
                <select name="jenis_transportasi_berangkat" id="jenis_transportasi_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Jenis Transportasi</option>
                    <option value="Penerbangan" {{ $suratTiketDinas->jenis_transportasi_berangkat == 'Penerbangan' ? 'selected' : '' }}>Penerbangan</option>
                    <option value="Kereta Api" {{ $suratTiketDinas->jenis_transportasi_berangkat == 'Kereta Api' ? 'selected' : '' }}>Kereta Api</option>
                    <option value="Kapal Laut" {{ $suratTiketDinas->jenis_transportasi_berangkat == 'Kapal Laut' ? 'selected' : '' }}>Kapal Laut</option>
                </select>
            </div>
            {{-- jenis kelas --}}
            <div class="col-span-2 sm:col-span-1">
                <select name="jenis_kelas_berangkat" id="jenis_kelas_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="{{ $suratTiketDinas->jenis_kelas_berangkat }}">{{ $suratTiketDinas->jenis_kelas_berangkat }}</option>
                </select>
                <script>
                    const jenisTransportasiBerangkat = document.getElementById('jenis_transportasi_berangkat');
                    const jenisKelasBerangkat = document.getElementById('jenis_kelas_berangkat');
                    jenisTransportasiBerangkat.addEventListener("change", function() {
                        if(jenisTransportasiBerangkat.value == 'Penerbangan'){
                                jenisKelasBerangkat.innerHTML = `
                                    <option value="">Jenis Kelas</option>  
                                    <option value="Ekonomi">Ekonomi</option>
                                    <option value="Ekonomi Premium">Ekonomi Premium</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Eksekutif">First Class</option>
                                `;
                            }else if(jenisTransportasiBerangkat.value == 'Kereta Api'){
                                jenisKelasBerangkat.innerHTML = `
                                    <option value="">Jenis Kelas</option>  
                                    <option value="Ekonomi">Ekonomi</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Eksekutif">Eksekutif</option>
                                    <option value="Luxury">Luxury</option>
                                `;
                            }
                            else if(jenisTransportasiBerangkat.value == 'Kapal Laut'){
                                jenisKelasBerangkat.innerHTML = `
                                    <option value="Disesuaikan">Disesuaikan</option>
                                `;
                            }
                    });

                </script>
            </div>
            {{-- rute asal --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="rute_asal_berangkat" id="rute_asal_berangkat" value="{{ old('rute_asal_berangkat', $suratTiketDinas->rute_asal_berangkat) }}" placeholder="Rute Asal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- rute tujuan --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="rute_tujuan_berangkat" id="rute_tujuan_berangkat" value="{{ old('rute_tujuan_berangkat', $suratTiketDinas->rute_tujuan_berangkat) }}" placeholder="Rute Tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- waktu berangkat --}}
            <div class="col-span-2">
                <input type="datetime-local" name="waktu_berangkat" id="waktu_berangkat" value="{{ $suratTiketDinas->tanggal_berangkat }} {{ $suratTiketDinas->jam_berangkat }}" placeholder="Waktu Berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- perusahaan angkutan --}}
            <div class="col-span-2 mt-2">
                <input type="text" name="perusahaan_angkutan_berangkat" id="perusahaan_angkutan_berangkat" value="{{ old('perusahaan_angkutan_berangkat', $suratTiketDinas->perusahaan_angkutan_berangkat) }}" placeholder="Perusahaan Angkutan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div> 
            <div class="col-span-2">
                <label class="text-left block text-sm font-medium text-gray-900 dark:text-white">Kedatangan</label>
            </div>
            {{-- jenis transportasi --}}
            <div class="col-span-2 sm:col-span-1">
                <select name="jenis_transportasi_kembali" id="jenis_transportasi_kembali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Jenis Transportasi</option>
                    <option value="Penerbangan" {{ $suratTiketDinas->jenis_transportasi_kembali == 'Penerbangan' ? 'selected' : '' }}>Penerbangan</option>
                    <option value="Kereta Api" {{ $suratTiketDinas->jenis_transportasi_kembali == 'Kereta Api' ? 'selected' : '' }}>Kereta Api</option>
                    <option value="Kapal Laut" {{ $suratTiketDinas->jenis_transportasi_kembali == 'Kapal Laut' ? 'selected' : '' }}>Kapal Laut</option>
                </select>
            </div>
            {{-- jenis kelas --}}
            <div class="col-span-2 sm:col-span-1">
                <select name="jenis_kelas_kembali" id="jenis_kelas_kembali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="{{ $suratTiketDinas->jenis_kelas_kembali }}">{{ $suratTiketDinas->jenis_kelas_kembali }}</option>
                </select>
                <script>
                    const jenisTransportasiKembali = document.getElementById('jenis_transportasi_kembali');
                    const jenisKelasKembali = document.getElementById('jenis_kelas_kembali');
                    jenisTransportasiKembali.addEventListener("change", function() {
                        if(jenisTransportasiKembali.value == 'Penerbangan'){
                                jenisKelasKembali.innerHTML = `
                                    <option value="">Jenis Kelas</option>  
                                    <option value="Ekonomi">Ekonomi</option>
                                    <option value="Ekonomi Premium">Ekonomi Premium</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Eksekutif">First Class</option>
                                `;
                            }else if(jenisTransportasiKembali.value == 'Kereta Api'){
                                jenisKelasKembali.innerHTML = `
                                    <option value="">Jenis Kelas</option>  
                                    <option value="Ekonomi">Ekonomi</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Eksekutif">Eksekutif</option>
                                    <option value="Luxury">Luxury</option>
                                `;
                            }
                            else if(jenisTransportasiKembali.value == 'Kapal Laut'){
                                jenisKelasBerangkat.innerHTML = `
                                    <option value="Disesuaikan">Disesuaikan</option>
                                `;
                            }
                    });

                </script>
            </div>
            {{-- rute asal --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="rute_asal_kembali" id="rute_asal_kembali" value="{{ old('rute_asal_kembali', $suratTiketDinas->rute_asal_kembali) }}" placeholder="Rute Asal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- rute tujuan --}}
            <div class="col-span-2 sm:col-span-1">
                <input type="text" name="rute_tujuan_kembali" id="rute_tujuan_kembali" value="{{ old('rute_tujuan_kembali', $suratTiketDinas->rute_tujuan_kembali) }}" placeholder="Rute Tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- waktu berangkat --}}
            <div class="col-span-2">
                <input type="datetime-local" name="waktu_kembali" id="waktu_kembali" value="{{ $suratTiketDinas->tanggal_kembali }} {{ $suratTiketDinas->jam_kembali }}" placeholder="Waktu Kembali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            {{-- perusahaan angkutan --}}
            <div class="col-span-2 mt-2">
                <input type="text" name="perusahaan_angkutan_kembali" id="perusahaan_angkutan_kembali" value="{{ old('perusahaan_angkutan_kembali', $suratTiketDinas->perusahaan_angkutan_kembali) }}" placeholder="Perusahaan Angkutan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div> 
             
            {{-- Note bahwa surat akan diteruskan ke atasan untuk persetujuan --}}
            <div class="col-span-2">
                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    @if (Auth::user()->is_admin==true)
                        <div>
                        <span class="font-medium">Pastikan Semua kolom telah diisi dengan benar</span>
                            <ul class="mt-1.5 list-disc list-inside">
                            <li>Dengan menekan submit maka surat permintaan telah dilengkapi</li>
                            <li>Surat akan dikirimkan kembali ke pemohon untuk diunduh</li>
                        </ul>
                        </div>
                    @else
                        <div>
                            <span class="font-medium">Pastikan Semua kolom telah diisi dengan benar</span>
                            <ul class="mt-1.5 list-disc list-inside">
                                <li>Dengan menekan submit maka surat permintaan akan diedit</li>
                                <li>Surat akan dikirimkan kembali atasan untuk disetujui</li>
                            </ul>
                        </div>
                    @endif
                  </div>
            </div>
        </form>
        <div class="text-center w-full flex col-span-2 sm:col-span-1 sm:flex justify-start">
            <a href="{{ url()->previous() }}" id="backButton" class="text-sm w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Kembali</a>
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
                <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Lengkapi Surat Permintaan Tiket Dinas</button>
                {{-- <a href="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}/review" class="text-center text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Lengkapi Surat Permintaan Tiket Dinas</a> --}}
            @endif
        </div>
</div>

@if (Auth::user()->is_admin == true)
    <script>
        //readonly all input
        const nama_pemohon = document.getElementById('nama_pemohon');
        const unit = document.getElementById('unit');
        const email_atasan = document.getElementById('email_atasan');
        const jenis_transportasi_berangkat = document.getElementById('jenis_transportasi_berangkat');
        const jenis_kelas_berangkat = document.getElementById('jenis_kelas_berangkat');
        const rute_asal_berangkat = document.getElementById('rute_asal_berangkat');
        const rute_tujuan_berangkat = document.getElementById('rute_tujuan_berangkat');
        const waktu_berangkat = document.getElementById('waktu_berangkat');
        const perusahaan_angkutan_berangkat = document.getElementById('perusahaan_angkutan_berangkat');
        const jenis_transportasi_kembali = document.getElementById('jenis_transportasi_kembali');
        const jenis_kelas_kembali = document.getElementById('jenis_kelas_kembali');
        const rute_asal_kembali = document.getElementById('rute_asal_kembali');
        const rute_tujuan_kembali = document.getElementById('rute_tujuan_kembali');
        const waktu_kembali = document.getElementById('waktu_kembali');
        const perusahaan_angkutan_kembali = document.getElementById('perusahaan_angkutan_kembali'); 

        nama_pemohon.readOnly = true;
        unit.readOnly = true;
        email_atasan.readOnly = true;
        jenis_transportasi_berangkat.readOnly = true;
        jenis_kelas_berangkat.readOnly = true;
        rute_asal_berangkat.readOnly = true;
        rute_tujuan_berangkat.readOnly = true;
        waktu_berangkat.readOnly = true;
        perusahaan_angkutan_berangkat.readOnly = true;
        jenis_transportasi_kembali.readOnly = true;
        jenis_kelas_kembali.readOnly = true;
        rute_asal_kembali.readOnly = true;  
        rute_tujuan_kembali.readOnly = true;
        waktu_kembali.readOnly = true;
        perusahaan_angkutan_kembali.readOnly = true;

    </script>
@endif
@endsection