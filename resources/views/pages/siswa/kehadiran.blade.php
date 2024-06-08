@extends('layouts.dashboard')
@section('table-name', 'Data Kehadiran')
@section('table-role', 'Siswa')
@section('content')
    <div class="grid grid-cols-1 gap-5 bg-white shadow-md">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                <div class="grid md:grid-cols-12 gap-3 items-center px-[20px]">
                    <div class="md:col-span-6">
                        <h2 class=" text-slate-700 text-[20px] font-bold">Daftar Kehadiran Bulan <span
                                class=" text-violet-500 ms-1 capitalize" id="month_title">
                                {{ $bulan }}</span>
                        </h2>
                    </div>
                    <div class="md:col-span-3">
                    </div>
                    <div class="md:col-span-3">
                        <div class="">
                            <label for="example-text-input"
                                class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Bulan</label>
                            <input
                                class="w-full border-gray-100 rounded placeholder:text-13 text-13 py-1.5 focus:border focus:ring focus:ring-violet-500/20 focus:border-violet-100 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                type="month" id="month">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                <div class="relative overflow-x-auto card-body px-[20px]">
                    <table id="" class="table uppercase w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    No</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nama Siswa</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Kehadiran</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-container">
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <div class="">
                            <div class="">
                                <div class=" mt-2 xs:mt-0  flex justify-between " id="container-pagination">
                                    <!-- Buttons -->
                                    <div class="">
                                        <button id="btn-previous"
                                            class="flex items-center  justify-center px-4 h-10 text-base font-medium border-black border-[0.05px] text-black rounded-md hover:bg-gray-50 dark:bg-violet-800 dark:border-violet-700 dark:text-violet-400 dark:hover:bg-violet-700 dark:hover:text-white">
                                            <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                                            </svg>
                                            Sebelumnya
                                        </button>
                                    </div>
                                    <div class="">
                                        <button id="btn-next"
                                            class="flex   items-center justify-center px-4 h-10 text-base font-medium text-black  border-black border-[0.05px] border-s  rounded-md hover:bg-gray-50 dark:bg-violet-800 dark:border-violet-700 dark:text-violet-400 dark:hover:bg-violet-700 dark:hover:text-white">
                                            Selanjutnya
                                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Help text -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-b border-gray-100 dark:border-zinc-600 py-20" id="template_pdf">
                <div class="px-[20px]">
                    {{-- <div class="md:col-span-9">

                    </div> --}}
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
                            @include('pages.siswa.data-kehadiran')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            let page = 1;
            let iteration = 0;
            let url = null;
            const btnPrev = document.getElementById('btn-previous')
            const btnNext = document.getElementById('btn-next')
            let container = document.getElementById('tabel-container')



            url = '{{ route('siswa.get-kehadiran') }}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: url,
                data: getDatas(),
                success: function(response) {
                    if (response.data.length != 0) {
                        container.innerHTML = ''
                        createTable(response)
                        btnNext.classList.remove('hidden')
                    }
                    if (response.current_page == 1) {
                        btnPrev.classList.add('hidden')
                    }
                    if (response.current_page == response.last_page) {
                        btnNext.classList.add('hidden')
                    }
                }
            });


            // filter
            filter('#month')


            // pagination
            $('#btn-previous').on('click', function() {
                if (page > 2) {
                    page--;
                } else {
                    page = 1
                }
                ajaxRequest(url, page)
            });

            $('#btn-next').on('click', function() {
                page++;
                btnPrev.classList.remove('hidden')
                ajaxRequest(url, page)
            });

            // ajax request
            function ajaxRequest(url, page) {
                btnPrev.classList.add('hidden')
                btnNext.classList.add('hidden')
                $.ajax({
                    url: url + '?page=' + page,
                    type: 'get',
                    data: getDatas(),
                }).done((response) => {
                    container.innerHTML = ''
                    if (response.data.length != 0) {
                        createTable(response)
                        btnPrev.classList.remove('hidden')
                        btnNext.classList.remove('hidden')
                    }
                    if (response.current_page == response.last_page) {
                        btnNext.classList.add('hidden')
                    }
                    if (response.current_page == 1) {
                        btnPrev.classList.add('hidden')
                    }
                    if (response.current_page != response.last_page) {
                        btnNext.classList.remove('hidden')
                    }
                }).fail((jqXHR, ajaxOptions, thrownError) => {
                    alert('server not responding...');
                });
            }

            function filter(id_select) {
                $(id_select).on('change', function() {
                    url = '{{ route('siswa.filter-kehadiran') }}';
                    page = 1;
                    btnPrev.classList.add('hidden')
                    btnNext.classList.add('hidden')
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: getDatas(),
                        success: function(response) {
                            container.innerHTML = ''
                            if (response.data.length != 0) {
                                createTable(response)
                                btnNext.classList.remove('hidden')
                            }
                            if (response.current_page == 1) {
                                btnPrev.classList.add('hidden')
                            }
                            if (response.current_page == response.last_page) {
                                btnNext.classList.add('hidden')
                            }
                        }
                    });
                })
            }

            function getDatas() {
                let month = ''
                let year = ''
                let value = $('#month').val()
                if (value != '') {
                    let month_ = value.split('-')[1]
                    month = month_.slice(1)
                    year = value.split('-')[0]
                    changeMonth(month)
                }
                let datas = {
                    'month': month,
                    'year': year,
                }
                return datas
            }

            function changeMonth(month) {
                const containerMonth = document.getElementById('month_title');
                const listBulan = {
                    '1': 'Januari',
                    '2': 'Februari',
                    '3': 'Maret',
                    '4': 'April',
                    '5': 'Mei',
                    '6': 'Juni',
                    '7': 'Juli',
                    '8': 'Agustus',
                    '9': 'September',
                    '10': 'Oktober',
                    '11': 'November',
                    '12': 'Desember',
                };

                containerMonth.innerHTML = '';
                Object.keys(listBulan).forEach(key => {
                    if (key == month) {
                        containerMonth.innerHTML = listBulan[key];
                    }
                });
            }

            function createTable(datas) {
                let row = ''
                let index = datas.from
                for (let i = 0; i < datas.data.length; i++) {
                    let keterangan = '-'

                    let date = datas.data[i].tanggal
                    let tahun = date.split('-')[0]
                    let bulan = date.split('-')[1]
                    let tanggal = date.split('-')[2]

                    if (datas.data[i].keterangan != null) {
                        keterangan = datas.data[i].keterangan
                    }
                    row = `
                <tr class="${(i + 1) % 2 == 0 ? 'bg-blue-50' : 'bg-white'}">
                    <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                        ${index}</td>
                    <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                        ${datas.data[i].nama}</td>
                    <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                        ${datas.data[i].kehadiran}</td>
                    <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                        ${tanggal}-${bulan}-${tahun}</td>
                </tr>
                `;
                    container.innerHTML += row
                    index++
                }
            }



            // filter rekap
            filter_rekap('#tahun_rekap')

            function filter_rekap(id_select) {
                $(id_select).on('change', function() {
                    let tahun_rekap = $('#tahun_rekap').val()
                    let container_rekap = $('#container_rekap')
                    url = '{{ route('siswa.show_kehadiran') }}';
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

            const template_data = document.querySelector('.template_data')

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
