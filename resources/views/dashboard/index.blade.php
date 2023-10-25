@extends('dashboard.layouts.main')
@section('container')
<div class="p-4">
    <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
        {{-- Alert Session Success --}}
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

        {{-- Top Content --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="border-solid border-2 border-blue-500 border-opacity-75 pl-4 h-28 rounded-lg bg-gray-50 dark:bg-gray-800 gap-4">
                <div class="py-1 text-sm lg:text-lg font-medium dark:text-gray-400">Permintaan Transport</div>
                <div class="text-6xl font-bold dark:text-gray-400">0</div>
            </div>
            <div class="border-solid border-2 border-blue-500 border-opacity-75 pl-2 h-28 rounded-lg bg-gray-50 dark:bg-gray-800">
                <div class="py-1 text-sm lg:text-lg font-medium dark:text-gray-400">Permintaan Tiket Perjalanan Dinas</div>
                <div class="text-6xl font-bold dark:text-gray-400">0</div>
            </div> 
        </div>
        {{-- End Top Content --}}

        {{-- Button Tambah Surat Permintaan Transport dan Surat Permintaan Pengurusan Tiket Dinas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 mb-2">
            {{-- Button Tambah Surat Permintaan Transport --}}
            <a href="/dashboard/permintaantransport/create" class="text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Surat Permintaan Transport</a>
            {{-- End Button Tambah Surat Permintaan Transport --}}

            {{-- Button Tambah Surat Permintaan Pengurusan Tiket Dinas --}}
            <a href="/dashboard/permintaantiketdinas/create" class="text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Surat Permintaan Pengurusan Tiket Dinas</a>
            {{-- End Button Tambah Surat Permintaan Pengurusan Tiket Dinas --}}
        </div>

        {{-- 5 List Surat Permintaan Sarana Transport --}}
        <div class="h-48 mb-28 rounded bg-gray-50 dark:bg-gray-800">
            <div class="h-24 rounded bg-gray-50 dark:bg-gray-800">
                <div class="py-1 text-sm lg:text-lg font-medium pb-4 dark:text-gray-400 dark:bg-gray-900">Surat Permintaan Transport</div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-screen text-sm text-left text-gray-500 dark:text-gray-400">
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
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Edit
                                    </th>
                                @endif
                                @if (Auth::user()->is_admin==true)
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
                                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-7 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                                    </svg>
                                                </button>
                                            @elseif ($suratTransport->isApprove_atasan == true)
                                                {{-- Button Approve Admin --}}
                                                <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/lengkapidata" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    {{-- <svg class="flex-shrink w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                                    </svg> --}}
                                                    Lengkapi Data
                                                </a>
                                            @elseif ($suratTransport->isApprove_atasan == false)
                                                <span class="bg-yellow-100 text-yellow-800 text-xs text-center font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Menunggu Persetujuan</span>
                                            @endif
                                            {{-- Modal Are you sure --}}
                                            <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-6 text-center">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                            </svg>
                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin ingin menghapus data?</h3>
                                                            <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                Ya
                                                            </button>
                                                            <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Modal Are you sure --}}
                                        </td>
                                    @endif
                                    @if (Auth::user()->is_atasan1 == true)
                                        <td class="px-6 py-4 text-right flex items-center justify-center">
                                            {{-- Button Lihat Data --}}
                                            <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <svg class="flex-shrink w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 20 14">
                                                    <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                </svg>
                                            </button>
                                            {{-- Button Tolak --}}
                                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                <svg class="flex-shrink w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                            </button>
                                        </td>
                                    @endif
                                    {{-- if auth is pegawai --}}
                                    @if (Auth::user()->is_pegawai == true)
                                        <td class="px-6 py-4 text-right">
                                            {{-- if isApproveAtasan false status = Dalam Proses --}}
                                            @if ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan == false && $suratTransport->isApprove_admin == false) 
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Terkirim</span>
                                            @endif  
                                            {{-- if isApprove_atasan true status = Disetujui --}}
                                            @if ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan == true && $suratTransport->isApprove_admin == false) 
                                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Disetujui</span>
                                            @endif
                                            {{-- if isApprove_atasan false status = Ditolak --}}
                                            @if ($suratTransport->isApprove_pegawai == true && $suratTransport->isApprove_atasan == true && $suratTransport->isApprove_admin == true) 
                                                {{-- Download Button --}}
                                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-7 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                                    </svg>
                                                </button>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="/dashboard/permintaantransport/{{ $suratTransport->id }}/edit" class="focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-7 py-1.5  dark:focus:ring-yellow-900">
                                                Edit
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>           
            </div>
        </div>

        {{-- 5 List Surat Permintaan Tiket Perjalanan Dinas --}}
        <div class="h-48 mb-36 rounded bg-gray-50 dark:bg-gray-800">
            <div class="h-24 rounded bg-gray-50 dark:bg-gray-800">
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
                                    Asal - Tujuan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jenis Tiket
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
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
                                        {{ $suratTiketDinas->rute_asal }} - {{ $suratTiketDinas->rute_tujuan }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $suratTiketDinas->jenis_transportasi }} - {{ $suratTiketDinas->jenis_kelas }}
                                    </td>
                                    <td class="px-6 py-4 text-right flex items-center justify-center whitespace-nowrap">
                                        <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            <svg class="flex-shrink w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 20 14">
                                                <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <svg class="flex-shrink w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                            </svg>
                                        </button>
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            <svg class="flex-shrink w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                        {{-- Modal Are you sure --}}
                                        <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-6 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Yakin ingin menghapus data?</h3>
                                                        <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Ya
                                                        </button>
                                                        <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Modal Are you sure --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>           
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

