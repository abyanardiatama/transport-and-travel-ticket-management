@extends('dashboard.layouts.main')
@section('container')
<div class="p-4">
    <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
        {{-- Alert Session Success --}}
        @if (session('success'))
            <div id="alert-3" class="font-montserrat flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                {{ session('success') }}
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif
            
        @if (session('error'))
            <div id="alert-2" class="font-montserrat flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
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

        {{-- Top Content --}}
        @if (Auth::user()->is_admin==true)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div class="border-solid border-2 border-blue-500 border-opacity-75 pl-4 h-28 rounded-lg bg-gray-50 dark:bg-gray-800 gap-4">
                    <div class="py-1 text-sm lg:text-lg font-medium dark:text-gray-400">Permintaan Transport</div>
                    <div class="text-6xl font-bold dark:text-gray-400">{{ $countSuratPermintaanTransport }}</div>
                </div>
                <div class="border-solid border-2 border-blue-500 border-opacity-75 pl-2 h-28 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <div class="py-1 text-sm lg:text-lg font-medium dark:text-gray-400 whitespace-nowrap">Permintaan Tiket Perjalanan Dinas</div>
                    <div class="text-6xl font-bold dark:text-gray-400">{{ $countSuratTiketDinas }}</div>
                </div> 
                <div class="border-solid border-2 border-blue-500 border-opacity-75 pl-2 h-28 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <div class="py-1 text-sm lg:text-lg font-medium dark:text-gray-400 whitespace-nowrap">Surat Perintah Kerja</div>
                    <div class="text-6xl font-bold dark:text-gray-400">{{ $countSuratPerintahKerja }}</div>
                </div> 
            </div>
        @elseif(Auth::user()->is_pegawai==true   || Auth::user()->is_atasan1==true || Auth::user()->is_atasan2==true)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="border-solid border-2 border-blue-500 border-opacity-75 pl-4 h-28 rounded-lg bg-gray-50 dark:bg-gray-800 gap-4">
                    <div class="py-1 text-sm lg:text-lg font-medium dark:text-gray-400">Permintaan Transport</div>
                    <div class="text-6xl font-bold dark:text-gray-400">{{ $countSuratPermintaanTransport }}</div>
                </div>
                <div class="border-solid border-2 border-blue-500 border-opacity-75 pl-2 h-28 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <div class="py-1 text-sm lg:text-lg font-medium dark:text-gray-400 whitespace-nowrap">Permintaan Tiket Perjalanan Dinas</div>
                    <div class="text-6xl font-bold dark:text-gray-400">{{ $countSuratTiketDinas }}</div>
                </div> 
            </div>
        @elseif(Auth::user()->is_driver==true)
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                <div class="border-solid border-2 border-blue-500 border-opacity-75 pl-2 h-28 rounded-lg bg-gray-50 dark:bg-gray-800">
                    <div class="py-1 text-sm lg:text-lg font-medium dark:text-gray-400 whitespace-nowrap">Surat Perintah Kerja</div>
                    <div class="text-6xl font-bold dark:text-gray-400">{{ $countSuratPerintahKerja }}</div>
                </div> 
            </div>
        @endif
        {{-- End Top Content --}}
            
        {{-- Button Tambah Surat Perintah Kerja --}}
        @if (Auth::user()->is_admin == true)
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mb-2">
                {{-- Button Tambah Surat Permintaan Transport --}}
                {{-- <a href="/dashboard/permintaantransport/create" class="mb-2 md:mb-0 text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Permintaan Transport</a> --}}

                {{-- Button Tambah Surat Permintaan Pengurusan Tiket Dinas --}}
                {{-- <a href="/dashboard/permintaantiketdinas/create" class="mb-2 md:mb-0 text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Permintaan Pengurusan Tiket Dinas</a> --}}

                {{-- Button Add User --}}
                <button data-modal-target="defaultModal1" data-modal-toggle="defaultModal1" class="text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Tambah User</button>
                <div id="defaultModal1" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-start p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-left text-md sm:text-lg font-medium text-gray-900 dark:text-white">
                                    Tambah Pengguna
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal1">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form action="/dashboard/user" class="max-w-3xl py-4 pb-8 px-3" method="post">
                                @csrf
                                <div class="grid grid-cols-2 gap-4 p-4">
                                    {{-- nama pengguna --}}
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="name" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pengguna</label>
                                        <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan nama user" required>
                                    </div>
                                    {{-- email --}}
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="email" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan email" required>
                                    </div>
                                    {{-- password --}}
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="password" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan password" required>
                                    </div>
                                    {{-- role --}}
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="role" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                        <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                            <option value="">Pilih Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="pegawai">Pegawai</option>
                                            <option value="atasan1">Atasan</option>
                                            <option value="driver">Driver</option>
                                        </select>
                                    </div>
                                    {{-- Submit button --}}
                                    <div class="col-span-2">
                                        <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Tambah User</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Modal footer -->
                            <div class="grid grid-cols-1 p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div class="text-left whitespace-normal">
                                        <span class="font-medium">Periksa data dengan benar</span>
                                        <ul class="mt-1.5 list-disc list-inside">
                                            <li>Dengan menekan submit, maka pengguna baru akan dibuat</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Button Add Kendaraan --}}
                <button data-modal-target="defaultModal2" data-modal-toggle="defaultModal2" class="text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Tambah Kendaraan</button>
                <div id="defaultModal2" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-start p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-left text-md sm:text-lg font-medium text-gray-900 dark:text-white">
                                    Tambah Kendaraan
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal2">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form action="/dashboard/kendaraan" class="max-w-3xl py-4 pb-8 px-3" method="post">
                                @csrf
                                <div class="grid grid-cols-2 gap-4 p-4">
                                    {{-- nama kendaraan --}}
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="nama_kendaraan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kendaraan</label>
                                        <input type="text" id="nama_kendaraan" name="nama_kendaraan" placeholder="Masukkan nama kendaraaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                    {{-- nomor polisi --}}
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="plat_nomor" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Polisi</label>
                                        <input type="text" id="plat_nomor" name="plat_nomor" placeholder="Masukkan plat nomor kendaraan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>

                                    {{-- Submit button --}}
                                    <div class="col-span-2">
                                        <button type="submit" class="text-sm w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200">Tambah Kendaraan</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Modal footer -->
                            <div class="grid grid-cols-1 p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div class="text-left whitespace-normal">
                                        <span class="font-medium">Periksa data dengan benar</span>
                                        <ul class="mt-1.5 list-disc list-inside">
                                            <li>Dengan menekan submit, maka data kendaraan baru akan dibuat</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (Auth::user()->is_pegawai == true)
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mb-2">
                {{-- Button Tambah Surat Permintaan Transport --}}
                <a href="/dashboard/permintaantransport/create" class="text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Surat Permintaan Transport</a>
                {{-- End Button Tambah Surat Permintaan Transport --}}

                {{-- Button Tambah Surat Permintaan Pengurusan Tiket Dinas --}}
                <a href="/dashboard/permintaantiketdinas/create" class="text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Surat Permintaan Pengurusan Tiket Dinas</a>
                {{-- End Button Tambah Surat Permintaan Pengurusan Tiket Dinas --}}
            </div>
        @endif
        
        {{-- List Surat Transport yang sudah disetujui --}}
        @if (Auth::user()->is_driver == false)
            <div class="h-fit mb-5 rounded bg-gray-50 dark:bg-gray-800">
                <div class="h-fit rounded bg-gray-50 dark:bg-gray-800">
                    <div class="py-1 text-sm lg:text-lg font-medium pb-4 dark:text-gray-400 dark:bg-gray-900 whitespace-nowrap">Daftar Penggunaan Kendaraan</div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-10">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Nomor Polisi
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Pengemudi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Berangkat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kembali
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pengguna
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approvedSuratTransport as $suratTransport)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTransport->nomor_polisi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTransport->nama_driver }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTransport->tanggal_berangkat }} / {{ $suratTransport->jam_berangkat }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTransport->tanggal_kembali }} / {{ $suratTransport->jam_kembali }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTransport->nama_pemohon }}
                                        </td>
                                        <td class="px-6 py-4 text-right flex items-center justify-center">
                                            @if ($checkUser)
                                                {{-- Button Lihat Data --}}
                                                <button data-modal-target="modal-lihat-data-{{ $suratTransport->id }}" data-modal-toggle="modal-lihat-data-{{ $suratTransport->id }}" type="button" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 whitespace-nowrap">
                                                    <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 20 14">
                                                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                    </svg>
                                                    Lihat Data
                                                </button>
                                                {{-- Modal Lihat Data --}}
                                                <div id="modal-lihat-data-{{ $suratTransport->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-start justify-start p-4 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-left text-md sm:text-lg font-medium text-gray-900 dark:text-white">
                                                                    Data Penggunaan Kendaraan
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-lihat-data-{{ $suratTransport->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <form action="/dashboard/permintaantransport/{{ $suratTransport->id }}/approveatasan" class="max-w-3xl py-4 pb-8 px-3">
                                                                <div class="grid grid-cols-2 gap-4 p-4">
                                                                    {{-- nama pemohon --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="nama_pemohon" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pemohon</label>
                                                                        <input type="text" id="nama_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->nama_pemohon }}" disabled>
                                                                    </div>
                                                                    {{-- unit --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="unit" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                                                        <input type="text" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->unit }}" disabled>
                                                                    </div>
                                                                    {{-- biaya perjalanan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="biaya_perjalanan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya Perjalanan</label>
                                                                        <input type="number" id="biaya_perjalanan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->biaya_perjalanan }}" disabled>
                                                                    </div>
                                                                    {{-- keperluan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="keperluan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keperluan</label>
                                                                        <input name="keperluan" id="keperluan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->keperluan }}" disabled></input>
                                                                    </div>
                                                                    {{-- tujuan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="tujuan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tujuan</label>
                                                                        <input name="tujuan" id="tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->tujuan }}" disabled></input>
                                                                    </div>
                                                                    {{-- rute pemakaian --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_pemakaian" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Pemakaian</label>
                                                                        <input name="rute_pemakaian" id="rute_pemakaian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->rute_pemakaian }}" disabled></input>
                                                                    </div>
                                                                    {{-- waktu berangkat --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="waktu_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Berangkat</label>
                                                                        <input name="waktu_berangkat" id="waktu_berangkat" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->tanggal_berangkat }} {{ $suratTransport->jam_berangkat }}" readonly>
                                                                    </div>
                                                                    {{-- waktu kembali --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="waktu_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Kembali</label>
                                                                        <input name="waktu_kembali" id="waktu_kembali" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->tanggal_kembali }} {{ $suratTransport->jam_kembali }}" readonly>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- Modal footer -->
                                                            <div class="grid grid-cols-1 p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                                    </svg>
                                                                    <span class="sr-only">Info</span>
                                                                    <div class="text-left whitespace-normal">
                                                                        <span class="font-medium">Periksa kembali data dengan benar</span>
                                                                        <ul class="mt-1.5 list-disc list-inside">
                                                                            <li>Pemohon dapat mengunduh surat permintaan yang telah diajukan</li> 
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Download Button --}}
                                                <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/download" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                                    </svg>
                                                    Download
                                                </a>
                                            @endif
                                        </td>    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>           
                    @if($countApprovedSuratTransport==0)
                        <div class="flex items-center justify-center p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Belum ada data yang masuk.</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- 5 List Surat Permintaan Sarana Transport --}}
        @if (Auth::user()->is_driver == false)
            <div class="h-fit mb-5 rounded bg-gray-50 dark:bg-gray-800">
                <div class="h-fit rounded bg-gray-50 dark:bg-gray-800">
                    <div class="py-1 text-sm lg:text-lg font-medium pb-4 dark:text-gray-400 dark:bg-gray-900 whitespace-nowrap">Surat Permintaan Transport</div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-10">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Keperluan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tujuan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pemohon
                                    </th>
                                    @if (Auth::user()->is_driver == true)
                                        <th scope="col" class="px-6 py-3">        
                                        </th>
                                    @endif
                                    @if (Auth::user()->is_pegawai == true)
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                        </th>
                                    @endif
                                    @if (Auth::user()->is_admin==true)
                                        <th scope="col" class="px-6 py-3 text-center min-w-max">
                                            
                                        </th>
                                    @endif
                                    @if (Auth::user()->is_atasan1==true || Auth::user()->is_atasan2==true)
                                        <th scope="col" class="px-6 py-3 text-center min-w-max">
                                            
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratPermintaanTransport as $suratTransport)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTransport->keperluan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTransport->tujuan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTransport->nama_pemohon }}
                                        </td>
                                        @if (Auth::user()->is_admin == true)
                                            <td class="px-6 py-4 text-right flex items-end justify-end whitespace-nowrap">
                                                @if ($suratTransport->isApprove_atasan == true && $suratTransport->isApprove_admin == true)
                                                    {{-- Download Button --}} 
                                                    <a  href="/dashboard/permintaantransport/{{ $suratTransport->id }}/download" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                                            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                                        </svg>
                                                        Download     
                                                    </a>
                                                @elseif ($suratTransport->isApprove_atasan == true)
                                                    {{-- Button Lengkapi Data Admin --}}
                                                    <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/lengkapidata" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5h1v12a2 2 0 0 1-2 2m0 0a2 2 0 0 1-2-2V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v15a2 2 0 0 0 2 2h14ZM10 4h2m-2 3h2m-8 3h8m-8 3h8m-8 3h8M4 4h3v3H4V4Z"/>
                                                        </svg>
                                                        Lengkapi Data
                                                    </a>
                                                @elseif ($suratTransport->isApprove_atasan == false)
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs text-center font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Menunggu Persetujuan</span>
                                                @endif
                                                
                                            </td>
                                        @endif
                                        @if (Auth::user()->is_driver==true)
                                            <td class="px-6 py-4 text-right flex items-center justify-center">
                                                {{-- Button Lihat Data --}}
                                                <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 whitespace-nowrap">
                                                    {{-- <svg class="flex-shrink w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 20 14">
                                                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                    </svg> --}}
                                                    Lihat Data
                                                </button>
                                                {{-- Modal Lihat Data --}}
                                                <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-start justify-start p-4 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-left text-md sm:text-lg font-medium text-gray-900 dark:text-white">
                                                                    Surat Permintaan Sarana Transport
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <form action="/dashboard/permintaantransport/{{ $suratTransport->id }}/approveatasan" class="max-w-3xl py-4 pb-8 px-3">
                                                                <div class="grid grid-cols-2 gap-4 p-4">
                                                                    {{-- nama pemohon --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="nama_pemohon" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pemohon</label>
                                                                        <input type="text" id="nama_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->nama_pemohon }}" disabled>
                                                                    </div>
                                                                    {{-- unit --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="unit" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                                                        <input type="text" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->unit }}" disabled>
                                                                    </div>
                                                                    {{-- biaya perjalanan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="biaya_perjalanan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya Perjalanan</label>
                                                                        <input type="number" id="biaya_perjalanan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->biaya_perjalanan }}" disabled>
                                                                    </div>
                                                                    {{-- keperluan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="keperluan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keperluan</label>
                                                                        <input name="keperluan" id="keperluan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->keperluan }}" disabled></input>
                                                                    </div>
                                                                    {{-- tujuan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="tujuan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tujuan</label>
                                                                        <input name="tujuan" id="tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->tujuan }}" disabled></input>
                                                                    </div>
                                                                    {{-- rute pemakaian --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_pemakaian" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Pemakaian</label>
                                                                        <input name="rute_pemakaian" id="rute_pemakaian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->rute_pemakaian }}" disabled></input>
                                                                    </div>
                                                                    {{-- waktu berangkat --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="waktu_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Berangkat</label>
                                                                        <input name="waktu_berangkat" id="waktu_berangkat" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->tanggal_berangkat }} {{ $suratTransport->jam_berangkat }}" readonly>
                                                                    </div>
                                                                    {{-- waktu kembali --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="waktu_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Kembali</label>
                                                                        <input name="waktu_kembali" id="waktu_kembali" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->tanggal_kembali }} {{ $suratTransport->jam_kembali }}" readonly>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- Modal footer -->
                                                            <div class="grid grid-cols-1 p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                                    </svg>
                                                                    <span class="sr-only">Info</span>
                                                                    <div class="text-left whitespace-normal">
                                                                        <span class="font-medium">Periksa kembali data dengan benar</span>
                                                                        <ul class="mt-1.5 list-disc list-inside">
                                                                            <li>Pengguna dapat menghubungi admin untuk data lebih lanjut </li>
                                                                            <li>Pengguna dapat mengunduh surat perintah kerja</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                        @if (Auth::user()->is_atasan1 == true || Auth::user()->is_atasan2 == true)
                                            <td class="px-6 py-4 text-right flex items-center justify-center">
                                                {{-- Button Lihat Data Baru --}}
                                                <button data-modal-target="modal-{{ $suratTransport->id }}" data-modal-toggle="modal-{{ $suratTransport->id }}" type="button" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus-ring-blue-800 whitespace-nowrap">
                                                    <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 20 14">
                                                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                    </svg>
                                                    Lihat Data
                                                </button>
                                                {{-- Modal Lihat Data Baru --}}
                                                <div id="modal-{{ $suratTransport->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-start justify-start p-4 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-left text-md sm:text-lg font-medium text-gray-900 dark:text-white">
                                                                    Surat Permintaan Sarana Transport
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-{{ $suratTransport->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>                                                                
                                                            </div>
                                                            <!-- Modal body -->
                                                            <form action="/dashboard/permintaantransport/{{ $suratTransport->id }}/approveatasan" class="max-w-3xl py-4 pb-8 px-3">
                                                                <div class="grid grid-cols-2 gap-4 p-4">
                                                                    {{-- nama pemohon --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="nama_pemohon" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pemohon</label>
                                                                        <input type="text" id="nama_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->nama_pemohon }}" disabled>
                                                                    </div>
                                                                    {{-- unit --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="unit" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                                                        <input type="text" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->unit }}" disabled>
                                                                    </div>
                                                                    {{-- biaya perjalanan --}}
                                                                    {{-- <div class="col-span-2 sm:col-span-1">
                                                                        <label for="biaya_perjalanan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya Perjalanan</label>
                                                                        <input type="number" id="biaya_perjalanan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->biaya_perjalanan }}" disabled>
                                                                    </div> --}}
                                                                    {{-- keperluan --}}
                                                                    <div class="col-span-2">
                                                                        <label for="keperluan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keperluan</label>
                                                                        <input name="keperluan" id="keperluan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->keperluan }}" disabled></input>
                                                                    </div>
                                                                    {{-- tujuan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="tujuan" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tujuan</label>
                                                                        <input name="tujuan" id="tujuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->tujuan }}" disabled></input>
                                                                    </div>
                                                                    {{-- rute pemakaian --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_pemakaian" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Pemakaian</label>
                                                                        <input name="rute_pemakaian" id="rute_pemakaian" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->rute_pemakaian }}" disabled></input>
                                                                    </div>
                                                                    {{-- waktu berangkat --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="waktu_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Berangkat</label>
                                                                        <input name="waktu_berangkat" id="waktu_berangkat" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->tanggal_berangkat }} {{ $suratTransport->jam_berangkat }}" readonly>
                                                                    </div>
                                                                    {{-- waktu kembali --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="waktu_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Kembali</label>
                                                                        <input name="waktu_kembali" id="waktu_kembali" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->tanggal_kembali }} {{ $suratTransport->jam_kembali }}" readonly>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- Modal footer -->
                                                            <div class="grid grid-cols-1 p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                                    </svg>
                                                                    <span class="sr-only">Info</span>
                                                                    <div class="text-left whitespace-normal">
                                                                        <span class="font-medium">Periksa kembali data sebelum memberikan persetujuan</span>
                                                                        <ul class="mt-1.5 list-disc list-inside">
                                                                            <li>Dengan menyetujui data ini, data akan diteruskan untuk dilengkapi</li>
                                                                            <li>Data akan dikirimkan kepada pemohon apabila telah dilengkapi</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Button Setuju --}}
                                                <a data-modal-target="popup-modal-approve" data-modal-toggle="popup-modal-approve" class="flex items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 whitespace-nowrap">
                                                    <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                                    </svg>
                                                    Setuju
                                                </a>
                                                {{-- Modal Approve --}}
                                                <div id="popup-modal-approve" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-approve">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-6 text-center">
                                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                </svg>
                                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin menyetujui surat permintaan?</h3>
                                                                <button data-modal-hide="popup-modal-approve" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                    Tidak, Batal
                                                                </button>
                                                                <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/approveatasan" data-modal-hide="popup-modal-approve" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 whitespace-nowrap">
                                                                    Ya, setuju
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Button Tolak --}}
                                                <button data-modal-target="popup-modal-tolak" data-modal-toggle="popup-modal-tolak" type="button" class="flex items-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 whitespace-nowrap">
                                                    <svg class="flex-shrink w-2.5 h-2.5 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    Tolak
                                                </button>
                                                {{-- Modal Reject --}}
                                                <div id="popup-modal-tolak" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-tolak">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-6 text-center">
                                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                </svg>
                                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin menolak surat permintaan?</h3>
                                                                <button data-modal-hide="popup-modal-tolak" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                    Tidak, Batal
                                                                </button>
                                                                <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/tolakatasan" data-modal-hide="popup-modal-tolak" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 whitespace-nowrap">
                                                                    Ya, setuju
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        @endif
                                        {{-- if auth is pegawai --}}
                                        @if (Auth::user()->is_pegawai == true)
                                            <td class="px-6 py-4 flex">
                                                @if ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan == true && $suratTransport->isApprove_admin == true)
                                                    {{-- Download Button --}}
                                                    <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/download" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                                            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                                        </svg>
                                                        Download     
                                                    </a>
                                                @elseif ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan == true)
                                                    <span class="bg-lime-100 text-lime-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-lime-900 dark:text-lime-300 whitespace-nowrap">Menunggu dilengkapi</span>
                                                @elseif ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan === null)
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs text-center font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 whitespace-nowrap">Menunggu persetujuan</span> 
                                                @elseif ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan == false)
                                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Ditolak</span>
                                                @endif
                                            </td>
                                            
                                                
                                            {{-- Can't edit when isApprove pegawai, atasan and admin --}}
                                            <td class="px-6 py-4 text-right">
                                                @if (
                                                    $suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan === null && $suratTransport->isApprove_admin === null ||
                                                    $suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan == false && $suratTransport->isApprove_admin === null)
                                                    <div class="flex">
                                                        <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/edit" class="flex items-center focus:outline-none text-gray-900 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5  dark:focus:ring-yellow-900">
                                                            <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17v1a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2M6 1v4a1 1 0 0 1-1 1H1m13.14.772 2.745 2.746M18.1 5.612a2.086 2.086 0 0 1 0 2.953l-6.65 6.646-3.693.739.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>           
                    @if($countSuratPermintaanTransport==0)
                        <div class="flex items-center justify-center p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Belum ada data yang masuk.</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- 5 List Surat Permintaan Tiket Perjalanan Dinas --}}
        @if (Auth::user()->is_driver == false)
            <div class="h-fit mb-5 rounded bg-gray-50 dark:bg-gray-800">
                <div class="h-fit rounded bg-gray-50 dark:bg-gray-800">
                    <div class="py-1 text-sm lg:text-lg font-medium pb-4 dark:text-gray-400 dark:bg-gray-900">Surat Permintaan Pengurusan Tiket Dinas </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pemohon
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Unit
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Rute Tujuan
                                    </th>
                                    @if(Auth::user()->is_pegawai == true)
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                    @endif
                                    <th scope="col" class="px-6 py-3 text-right">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratPermintaanTiketDinas as $suratTiketDinas)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTiketDinas->nama_pemohon }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTiketDinas->unit }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $suratTiketDinas->rute_asal_berangkat }} - {{ $suratTiketDinas->rute_tujuan_berangkat }}
                                        </td>
                                        @if (Auth::user()->is_pegawai == true)
                                            <td class="px-6 py-4 flex">
                                                @if ($suratTiketDinas->isApprove_atasan == true && $suratTiketDinas->isApprove_admin == true)
                                                    {{-- Download Button --}}
                                                    <a href="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}/download" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                                            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                                        </svg>
                                                        Download     
                                                    </a>
                                                @elseif ($suratTiketDinas->isApprove_atasan == true && $suratTiketDinas->isApprove_admin === null)
                                                    <span class="bg-lime-100 text-lime-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-lime-900 dark:text-lime-300">Menuggu dilengkapi</span>
                                                @elseif ($suratTiketDinas->isApprove_atasan === null && $suratTiketDinas->isApprove_admin === null)
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs text-center font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 whitespace-nowrap">Menunggu Persetujuan</span>  
                                                @elseif ($suratTiketDinas->isApprove_pegawai == true && $suratTiketDinas->isApprove_atasan == false)
                                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Ditolak</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                {{-- not show button edit when it has only approve pegawai --}}
                                                @if (!$suratTiketDinas->isApprove_atasan == true )
                                                    <div class="flex">
                                                        <a href="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}/edit" class="flex items-center focus:outline-none text-gray-900 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5  dark:focus:ring-yellow-900">
                                                            <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17v1a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2M6 1v4a1 1 0 0 1-1 1H1m13.14.772 2.745 2.746M18.1 5.612a2.086 2.086 0 0 1 0 2.953l-6.65 6.646-3.693.739.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                        @if (Auth::user()->is_admin == true)
                                            <td class="px-6 py-4 whitespace-nowrap flex items-end justify-end">
                                                {{-- Button Lihat Data Baru --}}
                                                <button data-modal-target="modal1-{{ $suratTiketDinas->id }}" data-modal-toggle="modal1-{{ $suratTiketDinas->id }}" type="button" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 whitespace-nowrap">
                                                    <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 20 14">
                                                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                    </svg>
                                                    Lihat Data
                                                </button>
                                                {{-- Modal Lihat Data Baru --}}
                                                <div id="modal1-{{ $suratTiketDinas->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-start justify-start p-4 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-left text-md sm:text-lg font-medium text-gray-900 dark:text-white">
                                                                    Surat Pengurusan Tiket Dinas
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal1-{{ $suratTiketDinas->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <form action="/dashboard/permintaantransport/{{ $suratTiketDinas->id }}/approveatasan" class="max-w-3xl py-4 pb-8 px-3">
                                                                <div class="grid grid-cols-2 gap-4 p-4">
                                                                    {{-- nama pemohon --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="nama_pemohon" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pemohon</label>
                                                                        <input type="text" id="nama_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->nama_pemohon }}" disabled>
                                                                    </div>
                                                                    {{-- unit --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="unit" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                                                        <input type="text" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->unit }}" disabled>
                                                                    </div>
                                                                    @if ($suratTiketDinas->beban_biaya != null)
                                                                        {{-- beban biaya --}}
                                                                        <div class="col-span-2">
                                                                            <label for="beban_biaya" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beban Biaya</label>
                                                                            <input type="text" id="beban_biaya" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->beban_biaya }}" disabled>
                                                                        </div>
                                                                    @endif
                                                                    {{-- keberangkatan --}}
                                                                    <div class="col-span-2 uppercase">
                                                                        <label class="text-left block text-sm font-medium text-gray-900 dark:text-white">Keberangkatan</label>
                                                                    </div>
                                                                    {{-- jenis transportasi --}}
                                                                    <div class="col-span-2">
                                                                        <input type="text" id="jenis_transportasi_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->jenis_transportasi_berangkat }} - {{ $suratTiketDinas->jenis_kelas_berangkat }}" disabled>
                                                                    </div>
                                                                    {{-- rute asal --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_asal_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Asal</label>
                                                                        <input type="text" id="rute_asal_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->rute_asal_berangkat }}" disabled>
                                                                    </div>
                                                                    {{-- rute tujuan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_tujuan_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Tujuan</label>
                                                                        <input type="text" id="rute_tujuan_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->rute_tujuan_berangkat }}" disabled>
                                                                    </div>
                                                                    {{-- tanggal dan jam berangkat --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="tanggal_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal dan Jam Berangkat</label>
                                                                        <input type="text" id="tanggal_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->tanggal_berangkat }} {{ $suratTiketDinas->jam_berangkat }}" readonly>
                                                                    </div>
                                                                    {{-- perusahaan angkutan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="perusahaan_angkutan_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Perusahaan Angkutan</label>
                                                                        <input type="text" id="perusahaan_angkutan_berangkat" name="perusahaan_angkutan_berangkat" value="{{ $suratTiketDinas->perusahaan_angkutan_berangkat }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                                                                    </div>
                                                                    {{-- kedatangan --}}
                                                                    <div class="col-span-2 uppercase">
                                                                        <label class="text-left block text-sm font-medium text-gray-900 dark:text-white">Kedatangan</label>
                                                                    </div>
                                                                    {{-- jenis transportasi --}}
                                                                    <div class="col-span-2">
                                                                        <input type="text" id="jenis_transportasi_kembali" name="jenis_transportasi_kembali" value="{{ $suratTiketDinas->jenis_transportasi_kembali }} - {{ $suratTiketDinas->jenis_kelas_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                                                                    </div>
                                                                    {{-- rute asal --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_asal_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Asal</label>
                                                                        <input type="text" id="rute_asal_kembali" name="rute_asal_kembali" value="{{ $suratTiketDinas->rute_asal_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                                                                    </div>
                                                                    {{-- rute tujuan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_tujuan_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Tujuan</label>
                                                                        <input type="text" id="rute_tujuan_kembali" name="rute_tujuan_kembali" value="{{ $suratTiketDinas->rute_tujuan_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                                                                    </div>
                                                                    {{-- tanggal dan jam berangkat --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="tanggal_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal dan Jam Kedatangan</label>
                                                                        <input type="text" id="tanggal_kembali" name="tanggal_kembali" value="{{ $suratTiketDinas->tanggal_kembali }} {{ $suratTiketDinas->jam_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                                                                    </div>
                                                                    {{-- perusahaan angkutan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="perusahaan_angkutan_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Perusahaan Angkutan</label>
                                                                        <input type="text" id="perusahaan_angkutan_kembali" name="perusahaan_angkutan_kembali" value="{{ $suratTiketDinas->perusahaan_angkutan_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- Modal footer -->
                                                            <div class="grid grid-cols-1 p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                                    </svg>
                                                                    <span class="sr-only">Info</span>
                                                                    <div class="text-left whitespace-normal">
                                                                        
                                                                        
                                                                        <ul class="mt-1.5 list-disc list-inside">
                                                                            <li>Data yang telah disetujui akan dikirimkan kembali kepada pemohon</li>
                                                                            <li>Pemohon dapat mengunduh data yang telah disetujui</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($suratTiketDinas->isApprove_admin === null)
                                                    {{-- Button Lengkapi Data Admin --}}
                                                    <a href="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}/lengkapidata" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5h1v12a2 2 0 0 1-2 2m0 0a2 2 0 0 1-2-2V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v15a2 2 0 0 0 2 2h14ZM10 4h2m-2 3h2m-8 3h8m-8 3h8m-8 3h8M4 4h3v3H4V4Z"/>
                                                        </svg>
                                                        Lengkapi Data
                                                    </a>
                                                @endif
                                                @if ($suratTiketDinas->isApprove_pegawai == true && $suratTiketDinas->isApprove_atasan == true && $suratTiketDinas->isApprove_admin == true)
                                                    {{-- Download Button --}}
                                                    <div class="flex">
                                                        <a href="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}/download" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                            <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                                            </svg>
                                                            Download     
                                                        </a>
                                                    </div>
                                                    <td></td>
                                                @endif
                                            </td>
                                        @endif
                                        @if (Auth::user()->is_atasan1 == true || Auth::user()->is_atasan2 == true )
                                            <td class="px-6 py-4 text-right flex items-center justify-center">
                                                {{-- Button Lihat Data Baru --}}
                                                <button data-modal-target="modal1-{{ $suratTiketDinas->id }}" data-modal-toggle="modal1-{{ $suratTiketDinas->id }}" type="button" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 whitespace-nowrap">
                                                    <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 20 14">
                                                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                    </svg>
                                                    Lihat Data
                                                </button>
                                                {{-- Modal Lihat Data Baru --}}
                                                <div id="modal1-{{ $suratTiketDinas->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-start justify-start p-4 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-left text-md sm:text-lg font-medium text-gray-900 dark:text-white">
                                                                    Surat Pengurusan Tiket untuk Perjalanan Dinas
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal1-{{ $suratTiketDinas->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <form action="/dashboard/permintaantransport/{{ $suratTiketDinas->id }}/approveatasan" class="max-w-3xl py-4 pb-8 px-3">
                                                                <div class="grid grid-cols-2 gap-4 p-4">
                                                                    {{-- nama pemohon --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="nama_pemohon" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pemohon</label>
                                                                        <input type="text" id="nama_pemohon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->nama_pemohon }}" disabled>
                                                                    </div>
                                                                    {{-- unit --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="unit" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                                                        <input type="text" id="unit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->unit }}" disabled>
                                                                    </div>
                                                                    {{-- keberangkatan --}}
                                                                    <div class="col-span-2 uppercase">
                                                                        <label class="text-left block text-sm font-medium text-gray-900 dark:text-white">Keberangkatan</label>
                                                                    </div>
                                                                    {{-- jenis transportasi --}}
                                                                    <div class="col-span-2">
                                                                        <input type="text" id="jenis_transportasi_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->jenis_transportasi_berangkat }} - {{ $suratTiketDinas->jenis_kelas_berangkat }}" disabled>
                                                                    </div>
                                                                    {{-- rute asal --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_asal_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Asal</label>
                                                                        <input type="text" id="rute_asal_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->rute_asal_berangkat }}" disabled>
                                                                    </div>
                                                                    {{-- rute tujuan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_tujuan_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Tujuan</label>
                                                                        <input type="text" id="rute_tujuan_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->rute_tujuan_berangkat }}" disabled>
                                                                    </div>
                                                                    {{-- tanggal dan jam berangkat --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="tanggal_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal dan Jam Berangkat</label>
                                                                        <input type="text" id="tanggal_berangkat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTiketDinas->tanggal_berangkat }} {{ $suratTiketDinas->jam_berangkat }}" disabled>
                                                                    </div>
                                                                    {{-- perusahaan angkutan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="perusahaan_angkutan_berangkat" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Perusahaan Angkutan</label>
                                                                        <input type="text" id="perusahaan_angkutan_berangkat" name="perusahaan_angkutan_berangkat" value="{{ $suratTiketDinas->perusahaan_angkutan_berangkat }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                                                    </div>
                                                                    {{-- kedatangan --}}
                                                                    <div class="col-span-2 uppercase">
                                                                        <label class="text-left block text-sm font-medium text-gray-900 dark:text-white">Kedatangan</label>
                                                                    </div>
                                                                    {{-- jenis transportasi --}}
                                                                    <div class="col-span-2">
                                                                        <input type="text" id="jenis_transportasi_kembali" name="jenis_transportasi_kembali" value="{{ $suratTiketDinas->jenis_transportasi_kembali }} - {{ $suratTiketDinas->jenis_kelas_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                                                    </div>
                                                                    {{-- rute asal --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_asal_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Asal</label>
                                                                        <input type="text" id="rute_asal_kembali" name="rute_asal_kembali" value="{{ $suratTiketDinas->rute_asal_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                                                    </div>
                                                                    {{-- rute tujuan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="rute_tujuan_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rute Tujuan</label>
                                                                        <input type="text" id="rute_tujuan_kembali" name="rute_tujuan_kembali" value="{{ $suratTiketDinas->rute_tujuan_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                                                    </div>
                                                                    {{-- tanggal dan jam berangkat --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="tanggal_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal dan Jam Kedatangan</label>
                                                                        <input type="text" id="tanggal_kembali" name="tanggal_kembali" value="{{ $suratTiketDinas->tanggal_kembali }} {{ $suratTiketDinas->jam_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                                                                    </div>
                                                                    {{-- perusahaan angkutan --}}
                                                                    <div class="col-span-2 sm:col-span-1">
                                                                        <label for="perusahaan_angkutan_kembali" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Perusahaan Angkutan</label>
                                                                        <input type="text" id="perusahaan_angkutan_kembali" name="perusahaan_angkutan_kembali" value="{{ $suratTiketDinas->perusahaan_angkutan_kembali }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 datetimepicker block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- Modal footer -->
                                                            <div class="grid grid-cols-1 p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                                    </svg>
                                                                    <span class="sr-only">Info</span>
                                                                    <div class="text-left whitespace-normal">
                                                                        <span class="font-medium">Periksa kembali data sebelum memberikan persetujuan</span>
                                                                        <ul class="mt-1.5 list-disc list-inside">
                                                                            <li>Dengan menyetujui data ini, data akan dikirimkan kembali kepada pemohon</li>
                                                                            <li>Pemohon dapat mengunduh data yang telah disetujui</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Button Setuju --}}
                                                <a data-modal-target="popup-modal1-approve" data-modal-toggle="popup-modal1-approve" class="flex items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 whitespace-nowrap">
                                                    <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                                    </svg>
                                                    Setuju
                                                </a>
                                                {{-- Modal Approve --}}
                                                <div id="popup-modal1-approve" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal1-approve">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-6 text-center">
                                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                </svg>
                                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin menyetujui surat permintaan?</h3>
                                                                <button data-modal-hide="popup-modal-approve" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                    Tidak, Batal
                                                                </button>
                                                                <a href="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}/atasanapprove" data-modal-hide="popup-modal1-approve" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 whitespace-nowrap">
                                                                    Ya, setuju
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Button Tolak --}}
                                                <button data-modal-target="popup-modal1-tolak" data-modal-toggle="popup-modal1-tolak" type="button" class="flex items-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 whitespace-nowrap">
                                                    <svg class="flex-shrink w-2.5 h-2.5 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                      </svg>
                                                    Tolak
                                                </button>
                                                {{-- Modal Reject --}}
                                                <div id="popup-modal1-tolak" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal1-tolak">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-6 text-center">
                                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                </svg>
                                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin menolak surat permintaan?</h3>
                                                                <button data-modal-hide="popup-modal1-tolak" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                    Tidak, Batal
                                                                </button>
                                                                <a href="/dashboard/permintaantiketdinas/{{ $suratTiketDinas->id }}/atasantolak" data-modal-hide="popup-modal-tolak" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 whitespace-nowrap">
                                                                    Ya, setuju
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                    @if($countSuratTiketDinas==0)
                        <div class="flex items-center justify-center p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Belum ada data yang masuk.</span>
                            </div>
                        </div>
                    @endif         
                </div>
            </div>
        @endif  

        {{-- 5 List Surat Perintah Kerja --}}
        @if (Auth::user()->is_admin == true || Auth::user()->is_driver == true)
            <div class="h-fit mb-5 rounded bg-gray-50 dark:bg-gray-800">
                <div class="h-fit rounded bg-gray-50 dark:bg-gray-800">
                    <div class="py-1 text-sm lg:text-lg font-medium pb-4 dark:text-gray-400 dark:bg-gray-900">Surat Perintah Kerja </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Driver
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Nomor Polisi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tujuan
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Berangkat
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Kembali
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratPerintahKerja as $surat)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $surat->nama_driver }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{-- get nomor_polisi from surat permintaan ransport --}}

                                            {{ $surat->nomor_polisi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $surat->alamat }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $surat->tanggal_berangkat }} / {{ $surat->jam_berangkat }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $surat->tanggal_kembali }} / {{ $surat->jam_kembali }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap flex items-end justify-end">
                                            {{-- Download Button --}}
                                            <a href="/dashboard/perintahkerja/{{ $surat->id }}/download" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                                </svg>
                                                Download     
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                    @if($countSuratPerintahKerja==0)
                        <div class="flex items-center justify-center p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Belum ada data yang masuk.</span>
                            </div>
                        </div>
                    @endif         
                </div>
            </div>
            
        @endif
    </div>
</div>
@endsection

