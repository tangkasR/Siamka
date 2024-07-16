@extends('layouts.dashboard')
@section('table-name')
    Tambah Nilai <span class="capitalize">{{ $tipe_ujian }}</span> di Rombel {{ $rombel->nama_rombel }}
@endsection
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('guru.nilai.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => Crypt::encrypt($rombel->id)]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-6 bg-white shadow-md">
        <div class="">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 ">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 ">
                    <div class="md:flex md:justify-between md:items-center">
                        <div class="md:mb-0 mb-6">
                            <h1 class="text-[18px] font-medium capitalize leading-7">Tahun Ajaran
                                {{ str_replace('-', '/', $tahun) }},
                                Semester
                                {{ $semester }}</h1>
                        </div>
                        <a id="btn_excel"
                            class="flex gap-2 justify-center items-center cursor-pointer text-center md:w-[200px]  border border-slate-700 hover:bg-slate-800 hover:text-white text-black font-medium py-2 px-4 rounded-md transition-all duration-300">
                            <span>Download Template</span><i class='bx bxs-cloud-upload text-[20px]'></i></a>

                    </div>
                    <div class=" grid md:grid-cols-12 gap-4">
                        <div class="md:col-span-6 border border-slate-300 rounded-xl p-6 pt-3 mt-5">
                            <h1 class="mb-1 font-medium text-[18px]">Import Data Nilai</h1>
                            <form action="{{ route('guru.nilai.store') }}" method="POST" enctype="multipart/form-data"
                                class="md:mb-0 mb-6">
                                @csrf
                                <input type="text" value="{{ $tahun }}" name="tahun" hidden id="tahun">
                                <input type="text" value="{{ $semester }}" name="semester" hidden id="semester">
                                <input type="text" value="{{ $rombel->id }}" name="rombel_id" hidden>
                                <div class="hidden">
                                    <label for="semester"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Semester
                                    </label>
                                    <select id="semester" name="semester_nilai"
                                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                        required>
                                        @if (explode(' ', $rombel->nama_rombel)[0] == 'X')
                                            @if ($semester == 'ganjil')
                                                <option value="1">Semester Ganjil</option>
                                            @endif
                                            @if ($semester == 'genap')
                                                <option value="2">Semester Genap</option>
                                            @endif
                                        @endif
                                        @if (explode(' ', $rombel->nama_rombel)[0] == 'XI')
                                            @if ($semester == 'ganjil')
                                                <option value="3">Semester Ganjil</option>
                                            @endif
                                            @if ($semester == 'genap')
                                                <option value="4">Semester Genap</option>
                                            @endif
                                        @endif
                                        @if (explode(' ', $rombel->nama_rombel)[0] == 'XII')
                                            @if ($semester == 'ganjil')
                                                <option value="5">Semester Ganjil</option>
                                            @endif
                                            @if ($semester == 'genap')
                                                <option value="6">Semester Genap</option>
                                            @endif
                                        @endif
                                    </select>
                                </div>
                                <div class="">
                                    <div class="mb-3">
                                        <label for="mapel_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                            Semester
                                        </label>
                                        <input type="text" name="" id=""
                                            class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                            placeholder="Masukan Nama Sesi" value="{{ $semester }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mapel_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                            Tipe Ujian
                                        </label>
                                        <input type="text" id="tipe_ujian"
                                            class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                            placeholder="Masukan Nama Sesi" value="{{ $tipe_ujian }}" name="tipe_ujian"
                                            readonly>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-3">
                                        <label for="mapel_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                            Mata Pelajaran
                                        </label>
                                        <select id="mapel_id" name="mapel_id"
                                            class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                            required>
                                            @foreach ($mapel as $data_mapel)
                                                <option value="{{ $data_mapel->id }}"
                                                    {{ $guru->mata_pelajaran_id == $data_mapel->id ? 'selected' : '' }}>
                                                    {{ $data_mapel->nama_mata_pelajaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mapel_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                            File Excel
                                        </label>
                                        <input name="file"
                                            class="block w-full  text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none "
                                            id="file" type="file" required>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="mt-3 w-full text-white hover:bg-blue-700 bg-blue-600 border-transparent btn">
                                    Import
                                </button>
                            </form>
                        </div>
                        <div class="relative overflow-x-auto mt-6 md:col-span-6">
                            <table class="table  w-full pt-4 text-center text-gray-700 dark:text-zinc-100"
                                id="daftar_siswa">
                                <thead>
                                    <tr class="bg-blue-100 ">
                                        <th class="p-4 border-blue-100 border">
                                            nama</th>
                                        <th class="p-4 border-blue-100 border">
                                            nomor_id</th>
                                        <th class="p-4 border-blue-100 border">
                                            nilai</th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-container">
                                    @foreach ($siswas as $siswa)
                                        <tr>
                                            <td class="p-4 border-blue-100 border">
                                                {{ $siswa->nama }}
                                            </td>
                                            <td class="p-4 border-blue-100 border">
                                                {{ $siswa->nomor_id }}
                                            </td>
                                            <td class="p-4 border-blue-100 border">
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


    <input type="text" id="rombel_name" value="{{ $rombel->nama_rombel }}" hidden>
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
                var nomor_id = data[i][1];
                var nilai = data[i][2];


                var cells = [nama, nomor_id, nilai];

                cells.forEach(function(cellData) {
                    var cell = document.createElement('td');
                    cell.className = 'p-4 border-blue-100 border';
                    cell.textContent = cellData;
                    row.appendChild(cell);
                });

                tableContainer.appendChild(row);
            }
        }

        const tahun = document.getElementById('tahun').value
        const semester = document.getElementById('semester').value
        const tipe_ujian = document.getElementById('tipe_ujian').value

        document.getElementById('btn_excel').addEventListener('click', () => {
            const workbook = XLSX.utils.book_new();
            const tableTemplate = document.getElementById('daftar_siswa');
            const worksheetTemplate = XLSX.utils.table_to_sheet(tableTemplate);
            const rombel = document.getElementById('rombel_name').value;

            XLSX.utils.book_append_sheet(workbook, worksheetTemplate, 'Template input nilai');

            XLSX.writeFile(workbook, `template-input-nilai-${rombel}-${tahun}-${semester}-${tipe_ujian}.xlsx`);
        })
    </script>

    @if (session('error'))
        <script>
            toast('error', '{{ Session::get('error') }}')
        </script>
    @endif
@endsection
