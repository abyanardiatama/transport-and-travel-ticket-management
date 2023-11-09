@extends('dashboard.layouts.main')
@section('container')
    <div class="max-w-full pt-20 px-6">
        <h1 class="text-md  font-medium dark:text-white">Buat Surat Perintah Kerja</h1>
        <hr class="bg-slate-200 mt-5 max-w-lg">
        <form action="{{ route('perintahkerja.store') }}" method="post" class="max-w-3xl py-4 font-montserrat">
        @csrf
        @method('post')
        <div class="grid grid-cols-2 gap-4">
            {{-- id_surat_transport --}}
            <div hidden class="col-span-2 sm:col-span-1">
                <input type="text" name="id_surat_permintaan_transport" id="id_surat_permintaan_transport" value="{{ $suratPermintaanTransport->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="id_surat_transport">
            </div>
            {{-- field nomor_polisi --}}
            <div hidden class="col-span-2 sm:col-span-1">
                <label for="nomor_polisi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Polisi</label>
                <input type="text" name="nomor_polisi" id="nomor_polisi" value="{{ old('nomor_polisi', $suratPermintaanTransport['nomor_polisi']) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nomor Polisi" required>
            </div>
            {{-- field id_admin --}}
            <div hidden class="col-span-2 sm:col-span-1">
                <input type="text" name="id_admin" id="id_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ Auth::user()->id }}" value="{{ Auth::user()->id }}" placeholder="ID Pemohon">
            </div>
            {{-- field jobdesc --}}
            <div hidden class="col-span-2 sm:col-span-1">
                <input type="text" name="jobdesc" id="jobdesc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="Driver" placeholder="Jobdesc">
            </div>
            {{-- teks surat perintah kerja --}}
            <div class="col-span-2">
                <p class="text-sm dark:text-white">Diperintahkan pada Kopkar Sejahtera Mandiri Abadi untuk memberikan tugas kepada:</p>
            </div>
            {{-- field isApprove_admin --}}
            <div hidden class="col-span-2 sm:col-span-1">
                <input type="text" name="isApprove_admin" id="isApprove_admin" value="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="isApprove_admin">
            </div>
            {{-- field isApprove_atasan --}}
            <div hidden class="col-span-2 sm:col-span-1">
                <input type="text" name="isApprove_atasan" id="isApprove_atasan" value="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="isApprove_atasan">
            </div>
            {{-- field nama driver --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="nama_driver" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Driver</label>
                <input type="text" name="nama_driver" id="nama_driver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('nama_driver',$suratPermintaanTransport['nama_driver']) }}" placeholder="Nama Driver" required>
            </div>
            {{-- field unit --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                <input type="text" name="unit" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('unit', $suratPermintaanTransport['unit']) }}" placeholder="Unit" required>
            </div>
            {{-- field keperluan --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="keperluan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keperluan</label>
                <input name="keperluan" id="keperluan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('keperluan', $suratPermintaanTransport['keperluan']) }}" placeholder="Keperluan" required>
            </div>
            {{-- field tujuan --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="tujuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tujuan / Alamat</label>
                <input name="tujuan" id="tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('tujuan', $suratPermintaanTransport['tujuan']) }}" placeholder="Tujuan / Alamat" required>
            </div>
            {{-- field tanggal berangkat --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="tanggal_berangkat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Berangkat</label>
                <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('tanggal_berangkat', $suratPermintaanTransport['tanggal_berangkat']) }}" placeholder="Tanggal Berangkat" required>
            </div>
            {{-- field tanggal kembali --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="tanggal_kembali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('tanggal_kembali', $suratPermintaanTransport['tanggal_kembali']) }}" placeholder="Tanggal Kembali" required>
            </div>
            {{-- field jam berangkat --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="jam_berangkat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Berangkat</label>
                <input type="time" name="jam_berangkat" id="jam_berangkat" class="rounded-r-0 rounded-l-lg  bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('jam_berangkat', $suratPermintaanTransport['jam_berangkat']) }}" placeholder="Jam Berangkat" required>
            </div>
            {{-- field jam kembali --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="jam_kembali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Kembali</label>
                <input type="time" name="jam_kembali" id="jam_kembali" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('jam_kembali', $suratPermintaanTransport['jam_kembali']) }}" placeholder="Jam Kembali" required>
            </div>
            {{-- field lama perjalanan --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="lama_perjalanan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lama Perjalanan</label>
                <div class="flex">
                    <input type="number" name="lama_perjalanan" id="lama_perjalanan" class="rounded-r-0 rounded-l-lg  bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('lama_perjalanan', $lama_perjalanan) }}" placeholder="Lama Perjalanan" required>
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Hari
                    </span>
                </div>
            </div>
            {{-- field biaya perjalanan --}}
            <div class="col-span-2 sm:col-span-1">
                <label for="biaya_perjalanan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya Perjalanan</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Rp
                    </span>
                    <input type="text" name="biaya_perjalanan" id="biaya_perjalanan" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('biaya_perjalanan', $suratPermintaanTransport['biaya_perjalanan']) }}" placeholder="Biaya Perjalanan" required>
                </div>
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
                          <li>Apabila terdapat kesalahan, surat perintah kerja dapat disunting oleh admin</li>
                      </ul>
                    </div>
                </div>
            </div>
            {{-- back button --}}
            <div class="col-span-2 sm:col-span-1 sm:flex justify-start">
                <button id="backButton" class="text-sm w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Kembali</button>
            </div>
            <script>
                const backButton = document.getElementById('backButton');
                backButton.addEventListener('click', function(){
                    //back to /dashboard
                    window.location.href = '{{ url()->previous() }}';
                });
            </script>
            {{-- button submit --}}
            <div class="col-span-2 sm:flex justify-end">
                <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200 py-2.5">Buat Surat Perintah Kerja</button>
            </div>
        </div>
        </form>
    </div>
@endsection