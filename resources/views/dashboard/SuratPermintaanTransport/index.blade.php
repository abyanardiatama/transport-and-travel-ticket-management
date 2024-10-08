@extends('dashboard.layouts.main')
@section('container')
<div class="p-4">
    <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
        @if (session('success'))
            <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
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
        <div class="text-lg lg:text-lg font-medium pb-4 dark:text-gray-400 dark:bg-gray-900 whitespace-nowrap">Surat Permintaan Transport</div>
        <form>   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Permintaan Transport">
            </div>
            {{-- List All Surat Permintaan Transport --}}
            <div class="h-fit mt-5 mb-5 rounded bg-gray-50 dark:bg-gray-800">
                <div class="h-fit rounded bg-gray-50 dark:bg-gray-800">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table id="default-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                                    @if (Auth::user()->is_pegawai == true)
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                        </th>
                                    @endif
                                    @if (Auth::user()->is_admin==true)
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center min-w-max">
                                            {{-- Action  --}}
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
                                            <td class="px-6 py-4">
                                                @if ($suratTransport->isApprove_atasan == true && $suratTransport->isApprove_admin == true)
                                                    {{-- Download Button --}}
                                                    <div class="flex">
                                                        <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/download" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                            <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                                            </svg>
                                                            Download     
                                                        </a>
                                                    </div> 
                                                    <td class="px-6 py-4 flex items-end justify-end whitespace-nowrap">
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
                                                                            Surat Permintaan Sarana Transport
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
                                                                                <input type="text" id="biaya_perjalanan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->biaya_perjalanan }}" disabled>
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
                                                                            @if ($suratTransport->nomor_polisi!=null && $suratTransport->nama_driver!=null)
                                                                                {{-- field nomor_polisi --}}
                                                                                <div class="col-span-2 sm:col-span-1">
                                                                                    <label for="nomor_polisi" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Polisi</label>
                                                                                    <input name="nomor_polisi" id="nomor_polisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->nomor_polisi }}" disabled></input>
                                                                                </div>
                                                                                {{-- field nama_driver --}}
                                                                                <div class="col-span-2 sm:col-span-1">
                                                                                    <label for="nama_driver" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Driver</label>
                                                                                    <input name="nama_driver" id="nama_driver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $suratTransport->nama_driver }}" disabled></input>
                                                                                </div>
                                                                            @else
                                                                                {{-- field kendaraan lain --}}
                                                                                <div class="col-span-2">
                                                                                    <label for="kendaraan_lain" class="text-left block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kendaraan Lain</label>
                                                                                    <input name="kendaraan_lain" id="kendaraan_lain" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Kendaraan Lain" value="{{ $suratTransport->kendaraan_lain }}" disabled></input>
                                                                                </div>
                                                                            @endif
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
                                                                                <span class="font-medium">Pastikan data telah terisi dengan benar</span>
                                                                                <ul class="mt-1.5 list-disc list-inside">
                                                                                    <li>Pengguna dapat mengunduh data yang telah disetujui</li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- Delete Button --}}
                                                        <button data-modal-target="modal-delete-{{ $suratTransport->id }}" data-modal-toggle="modal-delete-{{ $suratTransport->id }}" type="button" class="flex items-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                                            <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white"  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                        {{-- Modal Delete --}}
                                                        <div id="modal-delete-{{ $suratTransport->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative w-full max-w-md max-h-full">
                                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-delete-{{ $suratTransport->id }}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                    <div class="p-6 text-center">
                                                                        <svg class="mx-auto mb-4 text-red-400 w-12 h-12 dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                        </svg>
                                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin ingin menghapus data?</h3>
                                                                        <button data-modal-hide="modal-delete-{{ $suratTransport->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                            Tidak, Batal
                                                                        </button>
                                                                        <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/delete" data-modal-hide="modal-delete-{{ $suratTransport->id }}" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                                                            Ya, Hapus
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                @elseif ($suratTransport->isApprove_atasan == true)
                                                    <span class="bg-lime-100 text-lime-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-lime-900 dark:text-lime-300 whitespace-nowrap">Menunggu dilengkapi</span>
                                                    {{-- Button Approve Admin --}}
                                                    <td class="px-6 py-4 flex items-end justify-end whitespace-nowrap">
                                                        <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/lengkapidata" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                            <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5h1v12a2 2 0 0 1-2 2m0 0a2 2 0 0 1-2-2V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v15a2 2 0 0 0 2 2h14ZM10 4h2m-2 3h2m-8 3h8m-8 3h8m-8 3h8M4 4h3v3H4V4Z"/>
                                                            </svg>
                                                            Lengkapi Data
                                                        </a>
                                                    </td>
                                                @elseif ($suratTransport->isApprove_atasan === null)
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs text-center font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 whitespace-nowrap">Menunggu Persetujuan</span>
                                                    <td class="px-6 py-4 flex items-end justify-end whitespace-nowrap">
                                                        
                                                    </td>
                                                @elseif ($suratTransport->isApprove_atasan == false)
                                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Ditolak</span>
                                                    <td class="px-6 py-4 flex items-end justify-end whitespace-nowrap">
                                                        {{-- Button Lihat Data --}}
                                                        <button data-modal-target="modal-lihat-data2-{{ $suratTransport->id }}" data-modal-toggle="modal-lihat-data2-{{ $suratTransport->id }}" type="button" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 whitespace-nowrap">
                                                            <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 20 14">
                                                                <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                            </svg>
                                                            Lihat Data
                                                        </button>
                                                        {{-- Modal Lihat Data --}}
                                                        <div id="modal-lihat-data2-{{ $suratTransport->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative w-full max-w-2xl max-h-full">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-start justify-start p-4 border-b rounded-t dark:border-gray-600">
                                                                        <h3 class="text-left text-md sm:text-lg font-medium text-gray-900 dark:text-white">
                                                                            Surat Permintaan Sarana Transport
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-lihat-data2-{{ $suratTransport->id }}">
                                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                            </svg>
                                                                            <span class="sr-only">Close modal</span>
                                                                        </button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div class="grid grid-cols-2 gap-4 p-4">
                                                                        <form action="/dashboard/permintaantransport/{{ $suratTransport->id }}/approveatasan" class="max-w-3xl py-4 pb-8 px-3">
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
                                                                        </form>
                                                                    </div>
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
                                                                                    <li>Dengan menyetujui data ini, data akan diteruskan untuk dilengkapi</li>
                                                                                    <li>Data akan dikirimkan ke admin untuk disetujui</li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- Delete Button --}}
                                                        <button data-modal-target="modal-delete2-{{ $suratTransport->id }}" data-modal-toggle="modal-delete2-{{ $suratTransport->id }}" type="button" class="flex items-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                                            <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white"  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                        {{-- Modal Delete --}}
                                                        <div id="modal-delete2-{{ $suratTransport->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative w-full max-w-md max-h-full">
                                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-delete2-{{ $suratTransport->id }}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                    <div class="p-6 text-center">
                                                                        <svg class="mx-auto mb-4 text-red-400 w-12 h-12 dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                        </svg>
                                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin ingin menghapus data?</h3>
                                                                        <button data-modal-hide="modal-delete2-{{ $suratTransport->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                            Tidak, Batal
                                                                        </button>
                                                                        <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/delete" data-modal-hide="modal-delete2-{{ $suratTransport->id }}" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                                                            Ya, Hapus
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </td>
                                        @endif
                                        @if (Auth::user()->is_atasan1 == true || Auth::user()->is_atasan2 == true)
                                            <td class="px-6 py-4 text-right flex items-center justify-center">
                                                {{-- Button Lihat Data --}}
                                                <button data-modal-target="modal-lihat-data3-{{ $suratTransport->id }}" data-modal-toggle="modal-lihat-data3-{{ $suratTransport->id }}" type="button" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 whitespace-nowrap">
                                                    <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 20 14">
                                                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                    </svg>
                                                    Lihat Data
                                                </button>
                                                {{-- Modal Lihat Data --}}
                                                <div id="modal-lihat-data3-{{ $suratTransport->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-start justify-start p-4 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-left text-md sm:text-lg font-medium text-gray-900 dark:text-white">
                                                                    Surat Permintaan Sarana Transport
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-lihat-data3-{{ $suratTransport->id }}">
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
                                                            <div class="gridgrid-cols-1 items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                                                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                                    </svg>
                                                                    <span class="sr-only">Info</span>
                                                                    <div class="text-left whitespace-normal">
                                                                        <span class="font-medium">Periksa kembali data sebelum memberikan persetujuan</span>
                                                                        <ul class="mt-1.5 list-disc list-inside">
                                                                            <li>Dengan menyetujui data ini, data akan diteruskan untuk dilengkapi</li>
                                                                            <li>Data akan dikirimkan ke admin untuk disetujui</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Button Setuju --}}
                                                <a data-modal-target="modal-approve-{{ $suratTransport->id }}" data-modal-toggle="modal-approve-{{ $suratTransport->id }}" class="flex items-center focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 whitespace-nowrap">
                                                    <svg class="flex-shrink w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                                    </svg>
                                                    Setuju
                                                </a>
                                                {{-- Modal Approve --}}
                                                <div id="modal-approve-{{ $suratTransport->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-approve-{{ $suratTransport->id }}">
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
                                                                <button data-modal-hide="modal-approve-{{ $suratTransport->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                    Tidak, Batal
                                                                </button>
                                                                <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/approveatasan" data-modal-hide="modal-approve-{{ $suratTransport->id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 whitespace-nowrap">
                                                                    Ya, setuju
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Button Tolak --}}
                                                <button data-modal-target="modal-tolak-{{ $suratTransport->id }}" data-modal-toggle="modal-tolak-{{ $suratTransport->id }}" type="button" class="flex items-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 whitespace-nowrap">
                                                    <svg class="flex-shrink w-2.5 h-2.5 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    Tolak
                                                </button>
                                                {{-- Modal Reject --}}
                                                <div id="modal-tolak-{{ $suratTransport->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-tolak-{{ $suratTransport->id }}">
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
                                                                <button data-modal-hide="modal-tolak-{{ $suratTransport->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                    Tidak, Batal
                                                                </button>
                                                                <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/tolakatasan" data-modal-hide="modal-tolak-{{ $suratTransport->id }}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 whitespace-nowrap">
                                                                    Ya, setuju
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
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
                                                    <span class="bg-lime-100 text-lime-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-lime-900 dark:text-lime-300">Menuggu dilengkapi</span>
                                                @elseif ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan === null)
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs text-center font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 whitespace-nowrap">Menunggu persetujuan</span> 
                                                @elseif ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan == false)
                                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Ditolak</span>
                                                    <td class="px-6 py-4">
                                                        <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/edit" class="flex items-center justify-center focus:outline-none text-gray-900 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5  dark:focus:ring-yellow-900">
                                                            <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17v1a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2M6 1v4a1 1 0 0 1-1 1H1m13.14.772 2.745 2.746M18.1 5.612a2.086 2.086 0 0 1 0 2.953l-6.65 6.646-3.693.739.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    </td>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                @if ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan === null && $suratTransport->isApprove_admin === null)
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
                        <div class="flex items-center justify-center p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 text-center" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Belum ada data yang masuk.</span>
                            </div>
                        </div>
                    @endif
                    <div id="no-event-data" class="hidden flex items-center justify-center p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Data tidak ditemukan</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Search Bar
        const searchBar = document.getElementById('default-search');
        searchBar.addEventListener('input', searchTable);

        function searchTable() {
            const input = searchBar.value.toLowerCase();
            const table = document.getElementById('default-table');
            const rows = table.getElementsByTagName('tr');
            var noEventDataDiv = document.getElementById("no-event-data");

            const hasResult = false;

            for (var i = 0; i < rows.length; i++) {
                var rowData = rows[i].textContent.toLowerCase();

                if (rowData.includes(input)) {
                    rows[i].style.display = "";
                    hasResults = true;
                } else {
                    rows[i].style.display = "none";
                }
            }
            if (hasResults) {
                noEventDataDiv.classList.add("hidden");
            } else {
                noEventDataDiv.classList.remove("hidden");
            }
        }
    });

</script>
@endsection