@extends('layouts.dashboard')
@section('table-name', 'Detail Guru')
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.guru.detail_guru', ['tahun' => $tahun_ajaran, 'semester' => $semester, 'guru' => $guru]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="md:grid md:grid-cols-12 md:px-[20px]">
                        <div class="md:col-span-2">
                            <label for="example-text-input"
                                class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Bulan</label>
                            <input
                                class="w-full border-gray-100 rounded placeholder:text-13 text-13 py-1.5 focus:border focus:ring focus:ring-violet-500/20 focus:border-violet-100 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                type="month" id="month">
                        </div>
                    </div>
                    <div class="relative overflow-x-auto card-body md:px-[20px]">
                        <table id=""
                            class="table capitalize w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                            <thead>
                                <tr class="bg-blue-200">
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        No</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Kehadiran</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Jam Masuk</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Jam Keluar</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Total Jam Per Hari</th>
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
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 5H1m0 0 4 4M1 5l4-4" />
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
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Help text -->
                            </div>
                        </div>
                    </div>
                    <div class="pb-20 mt-10">
                        <div class=" md:px-[20px] grid md:grid-cols-12 gap-4">
                            <div class="md:col-span-4 flex justify-end flex-col">
                                <p for="example-text-input"
                                    class=" block font-medium text-gray-700 dark:text-gray-100 text-[18px]">
                                    Rekap
                                    Kehadiran
                                    Per Bulan</p>
                            </div>
                            <div class="col-span-3">
                            </div>
                            <div class="col-span-2">
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
                        <div class="relative overflow-x-auto card-body md:px-[20px]" id="template_pdf">
                            <table class="table capitalize w-full pt-4 text-center text-gray-700 dark:text-zinc-100"
                                id="table_rekap_kehadiran">
                                <thead>
                                    <tr class="bg-blue-200">
                                        <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                            Tahun</th>
                                        <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                            Bulan</th>
                                        <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                            Total Kehadiran</th>
                                        <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                            Total Jam Per Bulan</th>
                                    </tr>
                                </thead>
                                <tbody id="container_rekap">
                                    @include('pages.admin.guru.data-kehadiran')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="text" name="" value="{{ $guru->nomor_induk_yayasan }}" id="niy" hidden>
    <input type="text" name="" value="{{ $guru->id }}" id="guru_id" hidden>
    <input type="text" name="" value="{{ $bulan }}" id="bulan" hidden>
    <input type="text" name="" value="{{ $tahun }}" id="tahun" hidden>
    <input type="text" name="" value="{{ $tahun_ajaran }}" id="tahun_ajaran" hidden>
    <input type="text" name="" value="{{ $semester }}" id="semester" hidden>


    <script>
        $(document).ready(function() {
            let page = 1;
            let iteration = 0;
            let url = null;
            const btnPrev = document.getElementById('btn-previous')
            const btnNext = document.getElementById('btn-next')
            let container = document.getElementById('tabel-container')



            url = '{{ route('guru.kehadiran_guru.getData') }}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    'niy': $('#niy').val(),
                    'bulan': $('#bulan').val(),
                    'tahun': $('#tahun').val(),
                },
                success: function(response) {
                    console.log(response);
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
                    url = '{{ route('guru.kehadiran_guru.getData') }}';
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
                let niy = $('#niy').val()
                let bulan = $('#month').val()
                tahun = bulan.split('-')[0]
                bulan = bulan.split('-')[1]
                bulan = +bulan - 1 + 1
                console.log(bulan)
                let datas = {
                    'niy': niy,
                    'bulan': bulan,
                    'tahun': tahun,
                }
                return datas
            }


            function createTable(datas) {
                let row = ''
                let index = datas.from
                for (let i = 0; i < datas.data.length; i++) {
                    let dateStr = datas.data[i].tanggal;
                    let date = new Date(dateStr);
                    let options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    let formattedDate = date.toLocaleDateString('id-ID', options);

                    row = `
                        <tr class="${(i + 1) % 2 == 0 ? 'bg-blue-50' : 'bg-white'}">
                            <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                ${index}</td>
                            <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                ${datas.data[i].kehadiran}</td>
                            <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                ${datas.data[i].jam_masuk}</td>
                            <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                ${datas.data[i].jam_keluar}</td>
                            <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                ${datas.data[i].total_jam}</td>
                            <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                ${formattedDate}</td>
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
                    let niy = $('#niy').val()
                    let guru_id = $('#guru_id').val()
                    let tahun_ajaran = $('#tahun_ajaran').val()
                    let semester = $('#semester').val()

                    console.log('ini filter tahun')

                    let container_rekap = $('#container_rekap')
                    let urlTemplate =
                        `{{ route('admin.guru.filter_kehadiran', ['tahun' => '__tahun__', 'semester' => '__semester__']) }}`;
                    url = urlTemplate.replace("__tahun__", tahun_ajaran)
                        .replace(
                            "__semester__", semester);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            'tahun': tahun_rekap,
                            'niy': niy,
                            'guru_id': guru_id
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
        document.getElementById('template_nilai_btn_excel').addEventListener('click', () => {
            // Membuat workbook baru
            const workbook = XLSX.utils.book_new();

            // Mengambil tabel rekap kehadiran
            const tableRekapKehadiran = document.getElementById('table_rekap_kehadiran');
            if (!tableRekapKehadiran) {
                console.error('Table rekap kehadiran tidak ditemukan');
                return;
            }

            // Mengonversi tabel menjadi worksheet
            const worksheetKehadiran = XLSX.utils.table_to_sheet(tableRekapKehadiran);

            // Menambahkan worksheet ke dalam workbook
            XLSX.utils.book_append_sheet(workbook, worksheetKehadiran, 'Rekap Kehadiran Guru');

            // Menyimpan file Excel
            XLSX.writeFile(workbook, `rekap-kehadiran-guru.xlsx`);
        });
        document.getElementById('template_nilai_btn_pdf').addEventListener('click', () => {
            var btnExcel = document.getElementById('template_nilai_btn_excel')
            var btnPdf = document.getElementById('template_nilai_btn_pdf')

            btnExcel.classList.add('hidden')
            btnPdf.classList.add('hidden')

            var printContents = document.getElementById('template_pdf').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = `<div style="margin-bottom:30px; padding:30px">` + printContents + `</div>`;
            window.print();
            window.location.reload()
        })
    </script>
@endsection
