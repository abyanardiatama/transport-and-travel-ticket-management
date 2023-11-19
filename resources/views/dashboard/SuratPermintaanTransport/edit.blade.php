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
            <h1 class="text-md  font-medium dark:text-white">Edit Surat Permintaan Transportasi</h1>
        @elseif (Auth::user()->is_admin == true)
            <h1 class="text-md  font-medium dark:text-white">Lengkapi Surat Permintaan Transportasi</h1>
        @endif
        <hr class="bg-slate-200 mt-5 max-w-lg">

        @if (Auth::user()->is_pegawai == true)
            <form action="/dashboard/permintaantransport/{{ $suratTransport->id }}" method="post" class="max-w-3xl py-4 font-montserrat">
                @method('put')
        @endif
        @if (Auth::user()->is_admin == true)
            <form action="/dashboard/permintaantransport/{{ $suratTransport->id }}/lengkapidata" method="post" class="max-w-3xl py-4 font-montserrat">
                @method('post')
        @endif
            @csrf
            <div class="grid grid-cols-2 gap-4">
                {{-- field id_pemohon --}}
                <div hidden class="col-span-2 sm:col-span-1">
                    <input type="text" name="id_pemohon" id="id_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->id_pemohon }}" placeholder="ID Pemohon" readonly>
                </div>
                {{-- field id_admin --}}
                @if (Auth::user()->is_admin==true)
                    <div hidden class="col-span-2 sm:col-span-1">
                        <input type="text" name="id_admin" id="id_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ Auth::user()->id }}" placeholder="ID Admin" readonly>
                    </div>
                @endif
                {{-- field nama --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="nama_pemohon" id="nama_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Pemohon" value="{{ old('nama_pemohon', $suratTransport->nama_pemohon) }}" required>
                </div>
                {{-- field unit --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="unit" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Unit" value="{{ old('unit', $suratTransport->unit) }}" required> 
                </div>
                {{-- email atasan --}}
                <div class="col-span-2">
                    <input type="email" name="email_atasan" id="email_atasan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('email_atasan', $suratTransport->email_atasan) }}" placeholder="Email Atasan" required>
                </div>
                {{-- biaya perjalanan --}}
                {{-- <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="biaya_perjalanan" id="biaya_perjalanan" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('biaya_perjalanan', $suratTransport->biaya_perjalanan) }}" placeholder="Biaya Perjalanan" required>
                </div> --}}
                {{-- field tujuan --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="tujuan" id="tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tujuan" value="{{ old('tujuan', $suratTransport->tujuan) }}" required>
                </div>
                {{-- rute pemakaian --}} {{-- dropdown --}}
                <div class="col-span-2 sm:col-span-1">
                    @if (Auth::user()->is_pegawai==true)
                        <select name="rute_pemakaian" id="rute_pemakaian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->rute_pemakaian }}" required>
                            <option value="">Rute Pemakaian</option>
                            <option value="Dalam Kota" {{ $suratTransport->rute_pemakaian == 'Dalam Kota' ? 'selected' : '' }}>Dalam Kota</option>
                            <option value="Luar Kota" {{ $suratTransport->rute_pemakaian == 'Luar Kota' ? 'selected' : '' }}>Luar Kota</option>
                        </select>
                    @elseif (Auth::user()->is_admin==true)
                        <input name="rute_pemakaian" id="rute_pemakaian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->rute_pemakaian }}" required></input>
                    @endif
                </div>
                {{-- keperluan --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="keperluan" id="keperluan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('keperluan', $suratTransport->keperluan) }}" placeholder="Keperluan" required>
                </div>
                {{-- jumlah penumpang --}} {{-- incrementail from 0 --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="number" name="jumlah_penumpang" id="jumlah_penumpang" min="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('jumlah_penumpang', $suratTransport->jumlah_penumpang) }}" placeholder="Jumlah Penumpang (Termasuk Driver)" required>
                </div>
                {{-- waktu  --}}
                <div class="col-span-2 sm:col-span-1">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                        <input type="text" id="waktu_berangkat" name="waktu_berangkat" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('waktu_berangkat', $waktu_berangkat) }}" placeholder="Waktu Berangkat">
                        <script>
                            const waktu_berangkat = document.getElementById('waktu_berangkat');
                            waktu_berangkat.addEventListener('focus', function(){
                                this.type = 'datetime-local';
                            });
                        </script>
                    </div>
                </div> 
                {{-- waktu dan jam kembali --}}
                <div class="col-span-2 sm:col-span-1">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                        <input type="text" id="waktu_kembali" name="waktu_kembali" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('waktu_kembali', $waktu_kembali) }}" placeholder="Waktu Kembali">
                        <script>
                            const waktu_kembali = document.getElementById('waktu_kembali');
                            //change type to datetime-local when focus
                            waktu_kembali.addEventListener('focus', function(){
                                this.type = 'datetime-local';
                            });
                        </script>
                    </div>
                </div>
                @if (Auth::user()->is_admin==true)
                    {{-- biaya perjalanan --}}
                    <div class="col-span-2">
                        <input type="text" name="biaya_perjalanan" id="biaya_perjalanan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="Biaya Perjalanan" autofocus required>
                    </div>
                    {{-- Checkbox ada kendaraan --}}
                    <div class="col-span-2 pt-5"> 
                        <div class="flex items-center mb-4">
                            <input id="checkbox" type="checkbox" name="isKendaraan_available" value="false" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            {{-- <label for="checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ada kendaraan tersedia? </label> --}}
                            <span for="checkbox" class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ada kendaraan tersedia?</span>
                        </div>
                    </div>
                    {{-- field nomor polisi --}}
                    <div id="div_nomor_polisi" class="col-span-2 sm:col-span-1" hidden>
                        <select hidden id="nomor_polisi" name="nomor_polisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Nomor Polisi</option>
                            {{-- option all kendaraan --}}
                            @foreach ($kendaraan as $kendaraan)
                                <option value="{{ $kendaraan->plat_nomor }}">{{ $kendaraan->nama_kendaraan }} -- {{ $kendaraan->plat_nomor }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- field driver --}}
                    <div id="div_nama_driver" class="col-span-2 sm:col-span-1" hidden>
                        <select hidden id="nama_driver" name="nama_driver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Driver</option>
                            {{-- option all user with is_driver == true --}}
                            @foreach ($users as $user)
                                <option value="{{ $user->name }}" {{ $suratTransport->driver == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- jenis kendaraan --}}
                    <div id="div_kendaraan_lain" class="col-span-2">
                        <input id="kendaraan_lain" type="text" name="kendaraan_lain" id="kendaraan_lain" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kendaraan Alternatif" value="" required>
                        @error('kendaraan_lain')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <script>
                        const checkbox = document.getElementById('checkbox');
                        const nomor_polisi = document.getElementById('nomor_polisi');
                        const nama_driver = document.getElementById('nama_driver');
                        const kendaraan_lain = document.getElementById('kendaraan_lain');
                        const div_nomor_polisi = document.getElementById('div_nomor_polisi');
                        const div_nama_driver = document.getElementById('div_nama_driver');
                        const div_kendaraan_lain = document.getElementById('div_kendaraan_lain');
                        checkbox.addEventListener('change', function(){
                            if (checkbox.checked) {
                                //show div
                                div_nomor_polisi.hidden = false;
                                div_nama_driver.hidden = false;
                                //hide input kendaraan lain
                                div_kendaraan_lain.hidden = true;
                                //set value kendaraan lain to null
                                kendaraan_lain.value = '';
                                //set required to nomor polisi and nama driver
                                nomor_polisi.required = true;
                                nama_driver.required = true;
                                //set required to kendaraan lain to false
                                kendaraan_lain.required = false;
                            } else {
                                //hide div
                                div_nomor_polisi.hidden = true;
                                div_nama_driver.hidden = true;
                                //show input kendaraan lain
                                div_kendaraan_lain.hidden = false;
                                //set value nomor polisi and nama driver to null
                                nomor_polisi.value = '';
                                nama_driver.value = '';
                                //set required to nomor polisi and nama driver to false
                                nomor_polisi.required = false;
                                nama_driver.required = false;

                            }
                        });  
                    </script>
                @endif
                {{-- Note bahwa surat akan diteruskan ke atasan untuk persetujuan --}}
                <div class="col-span-2">
                    <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        @if (Auth::user()->is_admin==true)
                            <div>
                                <span class="font-medium">Periksa kembali semua kolom pengisian</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    <li>Dengan menekan submit maka surat permintaan transport telah dilengkapi</li>
                                    <li>Apabila kendaraan tersedia, surat perintah kerja akan otomatis diproses</li>
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
            {{-- button back --}}
            <div class="text-center w-full flex col-span-2 sm:col-span-1 sm:flex justify-start">
                <a href="{{ url()->previous() }}" id="backButton" class="text-sm w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Kembali</a>
            </div>
            <script>
                const backButton = document.getElementById('backButton');
                backButton.addEventListener('click', function(){
                    //back to /dashboard
                    window.location.href = '{{ url()->previous() }}';
                });
            </script>
            {{-- button submit --}}
            <div class="col-span-2 sm:col-span-1 sm:flex justify-end">
                @if (Auth::user()->is_pegawai == true)
                    <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Edit Surat Permintaan Transportasi</button>
                @endif
                @if (Auth::user()->is_admin == true)
                    <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Lengkapi Surat Permintaan Transportasi</button>
                @endif
            </div>
        </div>
        @if (Auth::user()->is_admin == true)
        <script>
            //readonly all input
            const nama_pemohon = document.getElementById('nama_pemohon');
            const unit = document.getElementById('unit');
            const email_atasan = document.getElementById('email_atasan');
            const biaya_perjalanan = document.getElementById('biaya_perjalanan');
            const tujuan = document.getElementById('tujuan');
            const rute_pemakaian = document.getElementById('rute_pemakaian');
            const keperluan = document.getElementById('keperluan');
            const jumlah_penumpang = document.getElementById('jumlah_penumpang');

            nama_pemohon.readOnly = true;
            unit.readOnly = true;
            email_atasan.readOnly = true;
            // biaya_perjalanan.readOnly = true;
            tujuan.readOnly = true;
            rute_pemakaian.readOnly = true;
            // rute_pemakaian.disabled = true;
            keperluan.readOnly = true;
            jumlah_penumpang.readOnly = true;
            waktu_berangkat.readOnly = true;
            // waktu_berangkat.disabled = true;
            waktu_kembali.readOnly = true;
            // waktu_kembali.disabled = true;
        </script>
        
    @endif
@endsection