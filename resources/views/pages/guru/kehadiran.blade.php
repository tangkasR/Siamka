@extends('layouts.dashboard')
@section('table-name', 'Absensi')
@section('table-role', 'Guru')
@section('content')
    <div class="max-w-xl flex items-center h-auto lg:h-screen flex-wrap mx-auto  lg:my-0 md:py-10 bg-slate-50">
        <!--Main Col-->
        <div class="w-full rounded-lg lg:rounded-l-lg lg:rounded-r-none md:shadow-lg   lg:mx-0 bg-white">
            <div class="p-4 md:p-12 lg:text-left">
                <!-- Image for mobile view-->
                <div>
                    <div id="map" class="z-10"></div>
                </div>
                <form action="{{ route('guru.kehadiran_guru.store') }}" method="POST">
                    @csrf
                    <input type="text" name="latitude" id="latitude" hidden>
                    <input type="text" name="longitude" id="longitude" hidden>
                    <input type="text" id="latitude_sekolah" value="{{ $latlong['latitude'] }}" hidden>
                    <input type="text" id="longitude_sekolah" value="{{ $latlong['longitude'] }}" hidden>
                    <input type="text" name="guru_id" value="{{ $guru->id }}" id="guru_id" hidden>
                    <input type="text" name="" value="{{ $bulan }}" id="bulan" hidden>
                    <input type="text" name="" value="{{ $tahun }}" id="tahun" hidden>
                    <div class="my-6 ">
                        <p class="mb-4 text-gray-800 text-[18px] font-medium">Selamat datang <span
                                class="font-semibold text-violet-600 text-[20px] capitalize">{{ $guru->nama }}</span>
                            di fitur
                            Absensi</p>
                        <p class="mb-4 text-gray-500 text-[16px] font-medium">
                            Tanggal: {{ $tanggal }}</p>
                        <p class="mb-1 text-gray-500 text-[16px]">Pastikan bahwa Anda sudah di lingkungan sekolah
                            supaya dapat
                            melakukan
                            absensi!</p>
                        <p class=" text-gray-500 text-[16px]">Silahkan melakukan absensi dengan menekan tombol dibawah
                        </p>

                    </div>

                    <button type="submit"
                        class="w-full  text-md font-medium bg-violet-400
                        mt-3 px-4 py-2 rounded-lg
                        text-white text-center">
                        Absen
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body border-b border-gray-100 dark:border-zinc-600 bg-white shadow-md mt-6">
        <div class="md:grid md:grid-cols-12 md:px-[20px]">
            <div class="md:col-span-2">
                <label for="example-text-input"
                    class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Bulan</label>
                <input
                    class="w-full border-gray-100 rounded placeholder:text-13 text-13 py-1.5 focus:border focus:ring focus:ring-violet-500/20 focus:border-violet-100 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                    type="month" id="month">
            </div>
        </div>
        <div class="relative overflow-x-auto card-body md:px-[20px] flex flex-col justify-center items-center ">
            <table id="" class="table uppercase w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                <thead>
                    <tr class="bg-blue-200">
                        <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                            No</th>
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
        <div class="pb-20 mt-20">
            <div class=" md:px-[20px] grid md:grid-cols-12 gap-4">
                <div class="md:col-span-4 flex justify-end flex-col">
                    <p for="example-text-input" class=" block font-medium text-gray-700 dark:text-gray-100 text-[18px]">
                        Rekap
                        Kehadiran
                        Per Tahun</p>
                </div>
                <div class="md:col-span-3">
                </div>
                <div class="md:col-span-2">
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
            <div class="relative overflow-x-auto card-body md:px-[20px] flex justify-center" id="template_pdf">
                <table class="table uppercase w-full pt-4 text-center text-gray-700 dark:text-zinc-100"
                    id="table_rekap_kehadiran">
                    <thead>
                        <tr class="bg-blue-200">
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                Tahun</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                Bulan</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                Total Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody id="container_rekap">
                        @include('pages.guru.data_kehadiran')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        toast('error', 'Tolong melakukan absensi dihandphone!')
    </script>
    @if (session('message'))
        <script>
            toast('message', '{{ Session::get('message') }}')
        </script>
    @endif
    @if (session('error'))
        <script>
            toast('error', '{{ Session::get('error') }}')
        </script>
    @endif

    <script type="module">
        let latitude = document.getElementById('latitude');
        let longitude = document.getElementById('longitude');

        // leaflet
        let latitude_sekolah = document.getElementById('latitude_sekolah').value;
        let longitude_sekolah = document.getElementById('longitude_sekolah').value;
        let map = L.map('map').setView([latitude_sekolah, longitude_sekolah], 16);
        let userMarker = null; // Variabel untuk menyimpan marker pengguna
        let schoolMarker = null; // Variabel untuk menyimpan marker sekolah
        let schoolCircle = null; // Variabel untuk menyimpan circle sekolah

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        // Pastikan peta meresize dengan benar
        setTimeout(() => {
            map.invalidateSize();
        }, 1000);
        // icon leaflet
        let icon_sekolah = L.icon({
            iconUrl: `{{ asset('/assets/img/default-school.png') }}`, // Ganti dengan path ikon khusus Anda
            iconSize: [32, 32], // Ukuran ikon (width, height)
            iconAnchor: [16, 32], // Titik referensi ikon (center bottom)
            popupAnchor: [0, -32] // Titik referensi popup (center top)
        });
        let icon_user = L.icon({
            iconUrl: `{{ asset('/assets/img/mark-user.png') }}`, // Ganti dengan path ikon khusus Anda
            iconSize: [22, 28], // Ukuran ikon (width, height)
            iconAnchor: [16, 32], // Titik referensi ikon (center bottom)
            popupAnchor: [0, -32] // Titik referensi popup (center top)
        });

        // geolocation
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(successCallBack, errorCallBack, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            });
        }

        function successCallBack(position) {
            latitude.value = position.coords.latitude;
            longitude.value = position.coords.longitude;
            console.log(position.coords);

            // Hapus marker pengguna jika sudah ada
            if (userMarker) {
                map.removeLayer(userMarker);
            }

            // Tambahkan marker baru pengguna
            userMarker = L.marker([position.coords.latitude, position.coords.longitude], {
                icon: icon_user
            }).addTo(map);

            // Hapus marker sekolah dan circle jika sudah ada
            if (schoolMarker) {
                map.removeLayer(schoolMarker);
            }
            if (schoolCircle) {
                map.removeLayer(schoolCircle);
            }

            // Tambahkan marker dan circle baru untuk sekolah
            schoolMarker = L.marker([latitude_sekolah, longitude_sekolah], {
                icon: icon_sekolah
            }).addTo(map);

            schoolCircle = L.circle([latitude_sekolah, longitude_sekolah], {
                color: '#fc4e4e',
                fillOpacity: 0.1,
                radius: 100
            }).addTo(map);
        }

        function errorCallBack(error) {
            console.error(`Error(${error.code}): ${error.message}`);
        }
    </script>

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
                    'guru_id': $('#guru_id').val(),
                    'bulan': $('#bulan').val(),
                    'tahun': $('#tahun').val(),
                },
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
                let bulan = $('#month').val()
                tahun = bulan.split('-')[0]
                bulan = bulan.split('-')[1]
                bulan = bulan.slice(1)
                let guru_id = $('#guru_id').val()
                let datas = {
                    'guru_id': guru_id,
                    'bulan': bulan,
                    'tahun': tahun,
                }
                return datas
            }


            function createTable(datas) {
                let row = ''
                let index = datas.from
                for (let i = 0; i < datas.data.length; i++) {
                    let date = datas.data[i].tanggal
                    let tahun = date.split('-')[0]
                    let bulan = date.split('-')[1]
                    let tanggal = date.split('-')[2]

                    row = `
                        <tr class="${(i + 1) % 2 == 0 ? 'bg-blue-50' : 'bg-white'}">
                            <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                ${index}</td>
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
                    url = '{{ route('guru.kehadiran_guru') }}';
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
