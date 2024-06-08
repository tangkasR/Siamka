@extends('layouts.dashboard')
@section('table-name', 'Rekap Nilai Siswa')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 " id="template_pdf">
                    <div class="px-[20px]">
                        <input type="text" value="{{ $siswa->nama }}"
                            class="ring-0 border-none outline-none text-[20px] capitalize m-0 p-0 ms-1" id="nama_siswa"
                            hidden>
                        <div class=" grid-cols-12 gap-4 text-[20px] font-medium capitalize template_data hidden mt-2 mb-6 ">
                            <div class="col-span-6">
                                <p class="mb-3">Nama: {{ $siswa->nama }}</p>
                                <p class="mb-3">NIS/NISN: {{ $siswa->nis }}/{{ $siswa->nisn }}</p>
                                <p class="">Kompetensi Keahlian: {{ $siswa->kompetensi_keahlian }}</p>
                            </div>
                            <div class="col-span-6">
                                <p class="mb-3">Kelas: {{ $rombel->nama_rombel }}</p>
                                <p class="">Tahun Pembelajaran:
                                    {{ $tahun_pembelajaran->tahun_awal }}/{{ $tahun_pembelajaran->tahun_akhir }}</p>
                            </div>
                        </div>
                        <div class=" grid md:grid-cols-12 items-center">
                            <div class="md:col-span-9">
                                <h2 class=" text-violet-500 capitalize text-[20px] font-bold">
                                    Nilai Mata Pelajaran
                                </h2>
                            </div>
                            <div class="md:col-span-3 grid grid-cols-2 mt-3 md:mt-0 gap-4">
                                <div class="">
                                    <button
                                        class="w-full  py-1 border  border-green-900 bg-green-50  font-medium
                                        hover:bg-green-700 hover:text-white text-green-900
                                        rounded-md text-[14px]"
                                        id="template_nilai_btn_excel">
                                        Cetak Excel
                                    </button>
                                </div>
                                <div class="">
                                    <button id="template_nilai_btn_pdf"
                                        class="w-full py-1 border border-orange-900 bg-orange-50 hover:bg-red-700 hover:text-white text-orange-900 font-medium rounded-md text-[14px]">
                                        Cetak PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto card-body">
                        <table id="table_nilai_mata_pelajaran"
                            class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100 capitalize">
                            <thead>
                                <tr class="bg-blue-200">
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600 ">
                                        Mata Pelajaran</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Tipe Ujian</th>
                                    @foreach ($semesters as $semester)
                                        <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                            {{ $semester }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formattedData as $data)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                        <td
                                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                            {{ $data['Mata Pelajaran'] }}</td>
                                        <td
                                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                            {{ $data['tipe_ujian'] }}</td>
                                        @foreach ($semesters as $semester)
                                            <td
                                                class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                                {{ $data[$semester] ?? '-' }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-[20px] mt-6">
                        <h2 class=" text-[20px] font-bold text-violet-500 capitalize">
                            Nilai Ekskul
                        </h2>
                    </div>
                    <div class="relative overflow-x-auto card-body">
                        <table id="table_nilai_ekskul"
                            class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100 capitalize">
                            <thead>
                                <tr class="bg-blue-200">
                                    @foreach ($nilai_ekskuls[0] as $header)
                                        <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                            {{ $loop->iteration == 1 ? $header : 'Semester ' . $header }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (array_slice($nilai_ekskuls, 1) as $row)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                        @foreach ($row as $data)
                                            <td
                                                class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                                {{ $data == null ? '-' : $data }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const nama = document.getElementById('nama_siswa').value
        document.getElementById('template_nilai_btn_excel').addEventListener('click', () => {
            const workbook = XLSX.utils.book_new();

            const tableMataPelajaran = document.getElementById('table_nilai_mata_pelajaran');
            const tableEkskul = document.getElementById('table_nilai_ekskul');

            const worksheetMataPelajaran = XLSX.utils.table_to_sheet(tableMataPelajaran);
            const worksheetEkskul = XLSX.utils.table_to_sheet(tableEkskul);

            XLSX.utils.book_append_sheet(workbook, worksheetMataPelajaran, 'Nilai Mata Pelajaran');
            XLSX.utils.book_append_sheet(workbook, worksheetEkskul, 'Nilai Ekskul');

            XLSX.writeFile(workbook, `rekap-nilai-siswa.xlsx`);
        })

        document.getElementById('template_nilai_btn_pdf').addEventListener('click', () => {
            var btnExcel = document.getElementById('template_nilai_btn_excel')
            var btnPdf = document.getElementById('template_nilai_btn_pdf')
            var nameInput = document.getElementById('nama_siswa')

            const template_data = document.querySelector('.template_data')

            template_data.classList.remove('hidden')
            template_data.classList.add('grid')

            btnExcel.classList.add('hidden')
            btnPdf.classList.add('hidden')
            nameInput.classList.add('hidden')

            var printContents = document.getElementById('template_pdf').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = `<div style="margin-bottom:30px"></div>`
            document.body.innerHTML += printContents;
            window.print();
            window.location.reload()
        })
    </script>
@endsection
