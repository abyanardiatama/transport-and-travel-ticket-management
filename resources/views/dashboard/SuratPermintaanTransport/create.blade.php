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
        
        <h1 class="text-md  font-medium dark:text-white">Buat Surat Permintaan Transportasi</h1>
        <hr class="bg-slate-200 mt-5 max-w-lg">
        <form action="/dashboard/permintaantransport/" method="post" class="max-w-3xl py-4 font-montserrat">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                {{-- field id_pemohon --}}
                <div hidden class="col-span-2 sm:col-span-1">
                    <input type="text" name="id_pemohon" id="id_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ Auth::user()->id }}" placeholder="ID Pemohon" readonly>
                </div>
                {{-- field nama --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="nama_pemohon" id="nama_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Pemohon" value="{{ old('nama_pemohon') }}" required>
                </div>
                {{-- field unit --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="unit" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Portofolio-Sub Portofolio (Cth : SCI-AKL)" value="{{ old('unit') }}" required> 
                </div>
                {{-- email atasan --}}
                <div class="col-span-2">
                    <input type="email" name="email_atasan" id="email_atasan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('email_atasan') }}" placeholder="Email Atasan" required>
                    {{-- all email atasan --}}
                    <datalist id="email_atasan_data">
                        @foreach ($users as $item)
                            <option value="{{ $item->email }}">{{ $item->email }}</option>
                        @endforeach
                    </datalist>
                </div>
                <script>
                    //when type email atasan give recomendation based on email_atasan_data
                    const email_atasan = document.getElementById('email_atasan');
                    email_atasan.addEventListener('input', function(){
                        this.setAttribute('list', 'email_atasan_data');
                    });
                    //if there is no email_atasan_data, focus on email_atasan field with red border
                </script>
                {{-- field tujuan --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="tujuan" id="tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tujuan" value="{{ old('tujuan') }}" required>
                </div>
                {{-- rute pemakaian --}} {{-- dropdown --}}
                <div class="col-span-2 sm:col-span-1">
                    <select name="rute_pemakaian" id="rute_pemakaian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('rute_pemakaian') }}" required>
                        <option value="">Rute Pemakaian</option>
                        <option value="Dalam Kota">Dalam Kota</option>
                        <option value="Luar Kota">Luar Kota</option>
                    </select>
                </div>
                {{-- keperluan --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="text" name="keperluan" id="keperluan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('keperluan') }}" placeholder="Keperluan" required>
                </div>
                {{-- jumlah penumpang --}} {{-- incrementail from 0 --}}
                <div class="col-span-2 sm:col-span-1">
                    <input type="number" name="jumlah_penumpang" id="jumlah_penumpang" min="2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('jumlah_penumpang') }}" placeholder="Jumlah Penumpang (Termasuk Driver)" required>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <div class="relative">
                        <svg class="absolute top-1/2 ml-3 transform -translate-y-1/2 w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                        <input type="text" id="waktu_berangkat" name="waktu_berangkat" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('waktu_berangkat') }}" placeholder="Waktu Berangkat">
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
                        <svg class="absolute ml-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                        <input type="text" id="waktu_kembali" name="waktu_kembali" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('waktu_kembali') }}" placeholder="Waktu Kembali">
                        <script>
                            const waktu_kembali = document.getElementById('waktu_kembali');
                            //change type to datetime-local when focus
                            waktu_kembali.addEventListener('focus', function(){
                                this.type = 'datetime-local';
                            });
                        </script>
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
                      <span class="font-medium">Pastikan semua kolom telah diisi dengan benar</span>
                        <ul class="mt-1.5 list-disc list-inside">
                          <li>Pastikan untuk mengecek jadwal penggunaan kendaraan lebih dahulu</li>
                          <li>Dengan menekan submit Anda telah menyetujui dibuatnya surat permintaan</li>
                          <li>Surat akan dikirimkan ke atasan untuk disetujui sebelum akhirnya dilengkapi</li>
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
                    window.location.href = '{{ url()->previous() }}';
                });
            </script>
            {{-- button submit --}}
            <div class="col-span-2 sm:col-span-1 sm:flex justify-end">
                <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Buat Surat Permintaan Transportasi</button>
            </div>
    </div>
@endsection