@extends('layouts.dashboard')
@section('table-name', 'Import Data Siswa')
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.siswa.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="md:flex md:justify-between md:items-center">
                        <div class="md:mb-0 mb-6">
                            <h1 class="text-[18px] font-medium capitalize leading-7">Tahun Ajaran
                                {{ str_replace('-', '/', $tahun) }},
                                Semester
                                {{ $semester }}</h1>
                        </div>
                        <div class="flex items-center gap-4">
                            <a data-tw-toggle="modal" data-tw-target="#modal-id_preview"
                                class="flex gap-2 justify-center items-center cursor-pointer text-center md:w-[180px] w-[150px] border border-slate-500 bg-slate-500 hover:bg-slate-800 text-white font-medium py-2 px-4 rounded-md transition-all duration-300">
                                <span>Preview</span><i class='bx bxs-show text-[20px]'></i></a>
                            <a data-tw-toggle="modal" data-tw-target="#modal-id_form_add"
                                class="flex gap-2 justify-center items-center cursor-pointer text-center md:w-[180px] w-[150px] border border-blue-500 bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300">
                                <span>Import</span><i class='bx bxs-cloud-upload text-[20px]'></i></a>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto mt-6">
                        <table class="table  w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                            <thead>
                                <tr class="bg-blue-100">
                                    <th class="p-4">
                                        nama</th>
                                    <th class="p-4">
                                        nis</th>
                                    <th class="p-4">
                                        nisn</th>
                                    <th class="p-4">
                                        nomor_id</th>
                                    <th class="p-4">
                                        jenis_kelamin</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-container">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Preview --}}
    <div class="absolute z-50 hidden modal" id="modal-id_preview" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
            </div>
            <div class="p-4 mx-auto animate-translate sm:max-w-lg">
                <div
                    class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                    <div class="bg-white dark:bg-zinc-700">
                        <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600"
                            data-tw-dismiss="modal">
                            <i class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                        </button>
                        <div class="p-5">
                            <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                Preview Import Siswa</h3>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file" type="file" name="file" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Preview --}}
    {{-- Modal Import --}}
    <div class="relative z-50 hidden modal" id="modal-id_form_add" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
            </div>
            <div class="p-4 mx-auto animate-translate sm:max-w-lg">
                <div
                    class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                    <div class="bg-white dark:bg-zinc-700">
                        <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600"
                            data-tw-dismiss="modal">
                            <i class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                        </button>
                        <div class="p-5">
                            <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                Import
                                Data Siswa</h3>
                            <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data"
                                class="md:mb-0 mb-6 md:col-span-4">
                                @csrf
                                <input type="text" value="{{ $tahun }}" name="tahun" hidden>
                                <input type="text" value="{{ $semester }}" name="semester" hidden>
                                <input type="text" value="{{ $rombel->id }}" name="rombel_id" hidden>
                                <input
                                    class="block w-full text-[16px] text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="file" type="file" name="file" required>
                                <button type="submit" class="mt-3 w-full text-white bg-blue-500 border-transparent btn">
                                    Import Data Siswa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Import --}}

    <script>
        document.getElementById('file').addEventListener('change', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var data = new Uint8Array(e.target.result);
                var workbook = XLSX.read(data, {
                    type: 'array'
                });

                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];

                var jsonData = XLSX.utils.sheet_to_json(worksheet, {
                    header: 1
                });
                populateTable(jsonData);
            };

            reader.readAsArrayBuffer(file);
        });

        function populateTable(data) {
            var tableContainer = document.getElementById('tabel-container');
            tableContainer.innerHTML = '';

            for (var i = 1; i < data.length; i++) {
                var row = document.createElement('tr');
                // Ambil kolom yang diinginkan berdasarkan indeksnya
                var nama = data[i][0];
                var nis = data[i][1];
                var nisn = data[i][2];
                var nomor_id = data[i][3];
                var jenis_kelamin = data[i][4];

                var cells = [nama, nis, nisn, nomor_id, jenis_kelamin];

                cells.forEach(function(cellData) {
                    var cell = document.createElement('td');
                    cell.className = 'p-4';
                    cell.textContent = cellData;
                    row.appendChild(cell);
                });

                tableContainer.appendChild(row);
            }
        }
    </script>
@endsection
