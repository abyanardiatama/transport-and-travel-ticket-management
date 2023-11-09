@extends('dashboard.layouts.main')
@section('container')
    <div class="max-w-full pt-20 px-6">
        <h1 class="text-md  font-medium dark:text-white">Edit Surat Perintah Kerja</h1>
        <hr class="bg-slate-200 mt-5 max-w-lg">
        <form action="/dashboard/perintahkerja/{id}/" method="post" class="max-w-3xl py-4 font-montserrat">
            @method('put')
            @csrf
            <div class="grid grid-cols-2 gap-4">
                {{-- field id_admin --}}
                <div hidden class="col-span-2 sm:col-span-1">
                    <input type="text" name="id_admin" id="id_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ Auth::user()->id }}" placeholder="ID Pemohon">
                </div>
                {{-- teks surat perintah kerja --}}
                <div class="col-span-2">
                    <p class="text-sm dark:text-white">Diperintahkan pada Kopkar Sejahtera Mandiri Abadi untuk memberikan tugas kepada:</p>
                </div>
                {{-- field nama driver --}}
                <div class="col-span-2 sm:col-span-1">
                    <label for="nama_driver" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Driver</label>
                    {{-- <input type="text" name="nama_driver" id="nama_driver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('nama_driver',$suratPerintahKerja['nama_driver']) }}" placeholder="Nama Driver" required> --}}
                    <select name="nama_driver" id="nama_driver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Pilih Driver</option>
                        @foreach ($user as $user)
                            <option value="{{ $user->name }}" {{ $suratPerintahKerja->nama_driver == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- field keperluan --}}
                <div class="col-span-2 sm:col-span-1">
                    <label for="keperluan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keperluan</label>
                    <input name="keperluan" id="keperluan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('keperluan', $suratPerintahKerja['keperluan']) }}" placeholder="Keperluan" required>
                </div>
                {{-- field alamat --}}
                <div class="col-span-2 sm:col-span-1">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat / Tujuan</label>
                    <input name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('alamat', $suratPerintahKerja['alamat']) }}" placeholder="Alamat" required>
                </div>
                {{-- field lama_perjalanan --}}
                <div class="col-span-2 sm:col-span-1">
                    <label for="lama_perjalanan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lama Perjalanan</label>
                    <div class="flex">
                        <input type="number" name="lama_perjalanan" id="lama_perjalanan" class="rounded-r-0 rounded-l-lg  bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('lama_perjalanan', $suratPerintahKerja['lama_perjalanan']) }}" placeholder="Lama Perjalanan" required>
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            Hari
                        </span>
                    </div>
                </div>
                {{-- field tanggal berangkat --}}
                <div class="col-span-2 sm:col-span-1">
                    <label for="tanggal_berangkat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('tanggal_berangkat', $suratPerintahKerja['tanggal_berangkat']) }}" placeholder="Tanggal Berangkat" required>
                </div>
                {{-- field tanggal kembali --}}
                <div class="col-span-2 sm:col-span-1">
                    <label for="tanggal_kembali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('tanggal_kembali', $suratPerintahKerja['tanggal_kembali']) }}" placeholder="Tanggal Kembali" required>
                </div>
                {{-- field jam berangkat --}}
                <div class="col-span-2 sm:col-span-1">
                    <label for="jam_berangkat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Berangkat</label>
                    <input type="time" name="jam_berangkat" id="jam_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('jam_berangkat', $suratPerintahKerja['jam_berangkat']) }}" placeholder="Jam Berangkat" required>
                </div>
                {{-- field jam kembali --}}
                <div class="col-span-2 sm:col-span-1">
                    <label for="jam_kembali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Kembali</label>
                    <input type="time" name="jam_kembali" id="jam_kembali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('jam_kembali', $suratPerintahKerja['jam_kembali']) }}" placeholder="Jam Kembali" required>
                </div>
                {{-- Note bahwa surat akan diteruskan ke atasan untuk persetujuan --}}
                <div class="col-span-2">
                    <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                        <span class="font-medium">Periksa kembali data yang telah terisi</span>
                            <ul class="mt-1.5 list-disc list-inside">
                            <li>Dengan menekan submit maka surat perintah kerja akan dibuat</li>
                            <li>Apabila terdapat kesalahan, surat perintah kerja dapat disunting lebih dulu</li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                {{-- Back Button --}}
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
                {{-- Submit Button --}}
                <div class="col-span-2 sm:col-span-1 sm:flex justify-end">
                    <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Edit Surat Perintah Kerja</button>
                </div>

            </div>
        </form>
    </div>
@endsection