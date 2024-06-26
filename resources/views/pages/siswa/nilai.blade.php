@extends('layouts.dashboard')
@section('table-name', 'Nilai')
@section('table-role', 'Siswa')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 p-0 ">
                    <div class="px-[30px] pt-[30px] pb-[20px]">
                        <div class=" bg-white rounded shadow mb-20">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 py-10 ">
                    <div class="px-[20px] pb-0 mt-6">
                        <div class=" grid md:grid-cols-12 items-center">
                            <div class="md:col-span-8">
                                <h2 class=" text-slate-700 text-[20px] font-bold capitalize">Nilai Mata Pelajaran<span
                                        class=" text-violet-500 ms-1 " id="tipe_ujian_title">
                                        Semua</span>
                                </h2>
                            </div>
                            <div class="md:col-span-4 grid grid-cols-2 gap-3 mt-3 md:mt-0">
                                <div class="">
                                    <select id="semester" name="semester"
                                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                        required>
                                        <option value="1">Semester 1</option>
                                        <option value="2">Semester 2</option>
                                        <option value="3">Semester 3</option>
                                        <option value="4">Semester 4</option>
                                        <option value="5">Semester 5</option>
                                        <option value="6">Semester 6</option>

                                    </select>
                                </div>
                                <div class="">
                                    <select id="tipe_ujian"
                                        class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                        <option value="uts">
                                            UTS
                                        </option>
                                        <option value="uas">
                                            UAS
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 ">
                        <div class="relative overflow-x-scroll card-body  ">
                            <table id=""
                                class="text-center capitalize table w-full  text-gray-700 dark:text-zinc-100">
                                <thead>
                                    <tr class="bg-blue-200">
                                        <th class="p-4 ">
                                            Mata Pelajaran</th>
                                        <th class="p-4 ">
                                            Tipe Ujian</th>
                                        <th class="p-4 ">
                                            Semester</th>
                                        <th class="p-4 ">
                                            Nilai</th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-container">
                                </tbody>
                            </table>
                        </div>
                        <div class="my-4 px-6">
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
                </div>
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 py-20" id="template_pdf">
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
                                {{-- <p class="">Tahun Pembelajaran:
                                    {{ $tahun_pembelajaran->tahun_awal }}/{{ $tahun_pembelajaran->tahun_akhir }}</p> --}}
                            </div>
                        </div>
                        <div class=" grid md:grid-cols-12 items-center">
                            <div class="md:col-span-9">
                                <h2 class="capitalize text-[20px] font-bold">
                                    Nilai <span class="text-violet-500">Mata Pelajaran</span>
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
                    <div class="relative overflow-x-scroll card-body pt-4">
                        <table id="table_nilai_mata_pelajaran"
                            class="text-center table w-full text-gray-700 dark:text-zinc-100 ">
                            <thead>
                                <tr class="bg-blue-200">
                                    <th class="p-4">
                                        MATA
                                        PELAJARAN</th>
                                    @foreach ($semesters as $semester)
                                        <th class="p-4">Semester {{ $semester }} - UTS</th>
                                        <th class="p-4">Semester {{ $semester }} - UAS</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilais as $mataPelajaran => $ujianData)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                        <td class="p-4">{{ $mataPelajaran }}</td>
                                        @foreach ($semesters as $semester)
                                            <td class="p-4">{{ $ujianData['uts'][$semester] ?? '-' }}</td>
                                            <td class="p-4">{{ $ujianData['uas'][$semester] ?? '-' }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-[20px] mt-20">
                        <h2 class=" text-[20px] font-bold  capitalize">
                            Nilai <span class="text-violet-500">Ekskul</span>
                        </h2>
                    </div>
                    <div class="relative overflow-x-scroll card-body">
                        <table id="table_nilai_ekskul"
                            class="text-center uppercase table w-full pt-4 text-gray-700 dark:text-zinc-100">
                            <thead>
                                <tr class="bg-blue-200">
                                    @foreach ($nilai_ekskuls[0] as $header)
                                        <th class="p-4 ">
                                            {{ $loop->iteration == 1 ? $header : 'Semester ' . $header }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (array_slice($nilai_ekskuls, 1) as $row)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                        @foreach ($row as $data)
                                            <td class="p-4 ">
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
    <input type="text" value="{{ $siswa->nis }}" id="nis" hidden>
    <script type="module">
        $(document).ready(function() {
            let page = 1;
            let url = null;
            let tipe_ujian_title = $('#tipe_ujian_title')
            const btnPrev = document.getElementById('btn-previous')
            const btnNext = document.getElementById('btn-next')
            let container = document.getElementById('tabel-container')

            // filter
            filter('#tipe_ujian')
            filter('#semester')

            // get all data
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            url = '{{ route('siswa.nilai.get_nilai') }}';
            $.ajax({
                type: "GET",
                url: url,
                data: getDatas(),
                success: function(response) {
                    if (response.data.length != 0) {
                        createTable(response)
                    }
                    if (response.current_page == 1) {
                        btnPrev.classList.add('hidden')
                    }
                    if (response.current_page == response.last_page) {
                        btnNext.classList.add('hidden')
                    }
                }
            });
            // end get all data

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
                    url = '{{ route('siswa.nilai.filter') }}';
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
                let tipe_ujian = $('#tipe_ujian').val()
                let semester = $('#semester').val()
                let nis = $('#nis').val()

                let datas = {
                    'tipe_ujian': tipe_ujian,
                    'semester': semester,
                    'nis': nis
                }
                tipe_ujian_title.html(tipe_ujian)
                return datas
            }

            function createTable(datas) {
                let row;
                for (let i = 0; i < datas.data.length; i++) {
                    console.log(datas.data[i])
                    row = `
                        <tr class="${(i + 1) % 2 == 0 ? 'bg-blue-50' : 'bg-white'}">
                            <td
                                class="p-4 ">
                                ${datas.data[i].nama_mata_pelajaran}
                            </td>
                            <td
                                class="p-4 ">
                                ${datas.data[i].tipe_ujian}
                            </td>
                            <td
                                class="p-4 ">
                                ${datas.data[i].semester}
                            </td>
                            <td
                                class="p-4 ">
                                ${datas.data[i].nilai}
                            </td>
                        </tr>
                    `;
                    container.innerHTML += row
                }
            }
        });
    </script>

    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}


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

            XLSX.writeFile(workbook, `rekap-nilai-siswa-${nama}.xlsx`);
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
