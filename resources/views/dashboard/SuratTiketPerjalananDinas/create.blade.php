@extends('dashboard.layouts.main')
@section('container')
    <div class="max-w-full pt-20 px-6">
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

        <h1 class="text-md  font-medium dark:text-white">Buat Surat Permintaan Pengurusan Tiket Perjalanan Dinas</h1>
        <hr class="bg-slate-200 mt-5 max-w-lg">
        <form action="/dashboard/permintaantiketdinas" method="post" class="max-w-3xl py-4 font-montserrat">
            @csrf
            @method('post')
            <div class="grid grid-cols-2 gap-4">
                {{-- field id_pemohon --}}
                <div hidden class="col-span-2 sm:col-span-1">
                    <input type="text" name="id_pemohon" id="id_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ Auth::user()->id }}" value="{{ Auth::user()->id }}" placeholder="ID Pemohon" readonly>
                </div>
                {{-- field nama --}}
                <div class="col-span-2 sm:col-span-1">
                    {{-- validation --}}
                    <input type="text" name="nama_pemohon" id="nama_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Pemohon" required>
                </div>
                {{-- field unit --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="unit" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Unit" required>
                </div>
                {{-- email atasan --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="email" name="email_atasan" id="email_atasan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email Atasan" required>
                </div>
                {{-- beban biaya --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="beban_biaya" id="beban_biaya" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Beban Biaya" required>
                </div>
                {{-- jenis transportasi --}}
                <div class="col-span-2 sm:col-span-1">
                    <select name="jenis_transportasi" id="jenis_transportasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="">Jenis Transportasi</option>
                        <option value="Penerbangan">Penerbangan</option>
                        <option value="Kereta Api">Kereta Api</option>
                        <option value="Kapal Laut">Kapal Laut</option>
                    </select>
                </div>
                {{-- jenis kelas --}}
                <div class="col-span-2 sm:col-span-1">
                    <select name="jenis_kelas" id="jenis_kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="">Jenis Kelas</option>  
                    </select>
                    <script>
                        const jenis_transportasi = document.getElementById('jenis_transportasi');
                        const jenis_kelas = document.getElementById('jenis_kelas');
                        jenis_transportasi.addEventListener('change', function(){
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
                            if(jenis_transportasi.value == 'Kapal Laut'){
                                jenis_kelas.innerHTML = `
                                    <option value="Disesuaikan">Disesuaikan</option>
                                `;
                            }
                        });
                    </script>
                </div>
                {{-- rute asal --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="rute_asal" id="rute_asal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rute Asal" required>
                </div>
                {{-- rute tujuan --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="rute_tujuan" id="rute_tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rute Tujuan" required>
                </div>
                {{-- waktu dan jam berangkat --}}
                <div class="col-span-2 sm:col-span-1">
                    <div class="relative">
                        <svg class="absolute ml-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                        <input type="text" id="waktu_berangkat" name="waktu_berangkat" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Waktu Berangkat" required>
                        <script>
                            const waktu_berangkat = document.getElementById('waktu_berangkat');
                            //change type to datetime-local when focus
                            waktu_berangkat.addEventListener('focus', function(){
                                this.type = 'datetime-local';
                            });
                        </script>
                    </div>
                </div>
                {{-- perusahaan angkutan --}}
                <div class="col-span-2 sm:col-span-1">
                    <div class="col-span-2 sm:col-span-1">
                        <input type="text" name="perusahaan_angkutan" id="perusahaan_angkutan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Perusahaan Angkutan" required>
                    </div>
                </div>     
            </form>
            {{-- Note bahwa surat akan diteruskan ke atasan untuk persetujuan --}}
            <div class="col-span-2">
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
                <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Buat Surat Permintaan Pengurusan Tiket Dinas</button>
            </div>
    </div>
@endsection