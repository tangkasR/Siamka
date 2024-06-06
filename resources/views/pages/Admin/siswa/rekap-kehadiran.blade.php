@extends('layouts.dashboard')
@section('table-name', 'Rekap Nilai Siswa')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600" id="template_pdf">
                    <div class="px-[20px]">
                        <div class=" grid md:grid-cols-12 gap-4">
                            <div class="md:col-span-7 flex items-end">
                                <h2 class=" text-slate-700 text-[20px] font-bold">Rekap Kehadiran<span
                                        class=" text-violet-500 capitalize" id="tipe_ujian_title">
                                        <input type="text" value="{{ $siswa->nama }}"
                                            class="ring-0 border-none outline-none text-[20px] capitalize m-0 p-0 ms-1"
                                            id="nama_siswa"></span>
                                </h2>
                            </div>
                            <div class="md:col-span-2" id="selectYear">
                                <p for="example-text-input"
                                    class=" block font-medium text-gray-700 dark:text-gray-100 text-[16px] mb-2">
                                    Pilih Tahun</p>
                                <select id="tahun_rekap" name="tahun_rekap"
                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                    @foreach ($years as $item)
                                        <option value="{{ $item->year }}">
                                            {{ $item->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-3 grid grid-cols-2 mt-3 md:mt-0 gap-4 items-end">
                                <div class="">
                                    <button
                                        class="w-full  py-1 border  border-green-900 bg-green-50  font-medium
                                                    hover:bg-green-700 hover:text-white text-green-900
                                                    rounded-md text-[14px]"
                                        id="btn_excel">
                                        Cetak Excel
                                    </button>
                                </div>
                                <div class="">
                                    <button id="btn_pdf"
                                        class="w-full py-1 border border-orange-900 bg-orange-50 hover:bg-red-700 hover:text-white text-orange-900 font-medium rounded-md text-[14px]">
                                        Cetak PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class=" grid-cols-12 text-[16px] font-medium capitalize template_data hidden mt-2  ">
                            <div class="col-span-3">
                                <p class="mb-2">Nama: {{ $siswa->nama }}</p>
                                <p>NIS/NISN: {{ $siswa->nis }}/{{ $siswa->nisn }}</p>
                            </div>
                            <div class="col-span-3">
                                <p class="mb-2">Kelas: {{ $rombel->nama_rombel }}</p>
                                <p>Tahun Pembelajaran:
                                    {{ $tahun_pembelajaran->tahun_awal }}/{{ $tahun_pembelajaran->tahun_akhir }}</p>
                            </div>
                            <div class="col-span-5">
                                <p>Kompetensi Keahlian: {{ $siswa->kompetensi_keahlian }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto card-body">
                        <table id="table_rekap"
                            class="text-center uppercase table w-full pt-4 text-gray-700 dark:text-zinc-100">
                            <thead>
                                <tr class="bg-blue-200">
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Tahun</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Bulan</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Hadir</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Sakit</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Izin</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Alpa</th>
                                </tr>
                            </thead>
                            <tbody id="container_rekap">
                                @include('pages.Admin.siswa.data-kehadiran')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="text" name="siswa_id" id="siswa_id" value="{{ $siswa->id }}" hidden>
    </div>

    <script>
        $(document).ready(function() {
            // filter rekap
            filter_rekap('#tahun_rekap')

            function filter_rekap(id_select) {
                $(id_select).on('change', function() {
                    let tahun_rekap = $('#tahun_rekap').val()
                    let container_rekap = $('#container_rekap')
                    let siswa_id = $('#siswa_id').val()
                    let urlTemplate =
                        `{{ route('admin.siswa.rekap_kehadiran', ['id' => '__SISWA_ID__']) }}`;
                    url = urlTemplate.replace("__SISWA_ID__", siswa_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            'tahun': tahun_rekap
                        },
                        success: function(response) {
                            container_rekap.html('')
                            container_rekap.html(response)
                        }
                    });
                })
            }
        });
    </script>
    <script>
        const nama = document.getElementById('nama_siswa').value
        document.getElementById('btn_excel').addEventListener('click', () => {
            const workbook = XLSX.utils.book_new();

            const tableKehadiran = document.getElementById('table_rekap');
            const worksheetKehadiran = XLSX.utils.table_to_sheet(tableKehadiran);

            XLSX.utils.book_append_sheet(workbook, worksheetKehadiran, 'Rekap Kehadiran');

            XLSX.writeFile(workbook, `rekap-kehadiran-siswa-${nama}.xlsx`);
        });

        document.getElementById('btn_pdf').addEventListener('click', () => {
            var btnExcel = document.getElementById('btn_excel')
            var btnPdf = document.getElementById('btn_pdf')
            var nameInput = document.getElementById('nama_siswa')
            var selectYear = document.getElementById('selectYear')
            var template_data = document.querySelector('.template_data')

            template_data.classList.remove('hidden')
            template_data.classList.add('grid')

            btnExcel.classList.add('hidden')
            btnPdf.classList.add('hidden')
            nameInput.classList.add('hidden')
            selectYear.classList.add('hidden')

            var printContents = document.getElementById('template_pdf').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = `<div style="margin-bottom:30px"></div>`
            document.body.innerHTML += printContents;
            window.print();
            window.location.reload()
        })
    </script>
@endsection
