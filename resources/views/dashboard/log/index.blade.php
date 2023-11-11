@extends('dashboard.layouts.main')
@section('container')
<div class="p-4">
    <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
    
        <div class="text-lg lg:text-lg font-medium pb-4 dark:text-gray-400 dark:bg-gray-900 whitespace-nowrap">Log Aktivitas</div>
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <form action="{{ route('logActivity.index') }}" method="GET">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" name="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Aktivitas">
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Clear the search input field
                    document.getElementById('default-search').value = '';
                });
            </script>
        </form>

        {{-- List All Log --}}
        <div class="h-fit  mt-5 mb-5 rounded bg-gray-50 dark:bg-gray-800">
            <div class="h-fit rounded bg-gray-50 dark:bg-gray-800">
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="default-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-10">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 w-1/8">
                                    Aktivitas
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Deskripsi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Detail
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Waktu
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Detail Waktu
                                </th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach ($logActivity as $activity)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{-- {{ $activity->id }} --}}
                                        {{ $logActivity->firstItem() + $loop->index }}
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $activity->log_name == 'default' ? 'user_activity_log' : $activity->log_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $activity->description }}
                                    </td>
                                    <td class="px-6 py-4 flex items-center whitespace-nowrap">
                                        {{-- Detail Button --}}
                                        <button data-tooltip-target="tooltip-default-{{ $activity->id }}" type="button" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="w-4 h-4 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h2v5m-2 0h4M9.408 5.5h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            Detail
                                        </button>
                                        <div id="tooltip-default-{{ $activity->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            <pre>{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre>
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $activity->created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
                {{-- No Data --}}
                @if($countActivity==0)
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
        <div class="mb-5">
            {{-- {{ $logActivity->links()  }} --}}
            {{ $logActivity->appends(request()->input())->links() }}
        </div>
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