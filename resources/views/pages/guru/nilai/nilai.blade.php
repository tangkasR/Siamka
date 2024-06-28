@extends('layouts.dashboard')
@section('table-name')
    Data Nilai Rombel {{ $rombel->nama_rombel }}
@endsection
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('guru.nilai', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => Crypt::encrypt($rombel->id)]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-5 bg-white shadow-md">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                <div class="flex justify-between items-center gap-4">
                    <div>
                        <h1 class="text-[18px] font-medium capitalize">Tahun Ajaran
                            {{ str_replace('-', '/', $tahun) }},
                            Semester
                            {{ $semester }}</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-[200px]">
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
                        <div class="w-[200px]">
                            <select id="mapel_id"
                                class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                @foreach ($mapel as $data_mapel)
                                    <option value="{{ $data_mapel->id }}"
                                        {{ $guru->mata_pelajaran_id == $data_mapel->id ? 'selected' : '' }}>
                                        {{ $data_mapel->nama_mata_pelajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative dropdown">
                            <button type="button"
                                class="dropdown-toggle flex gap-2 justify-center items-center cursor-pointer text-center w-[180px] border border-blue-500 bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown"><span>Kelola Data Nilai</span><i
                                    class='bx bxs-plus-circle text-[20px]'></i></button>

                            <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                <li>
                                    <a class="cursor-pointer block w-full px-4 py-1 text-sm font-medium text-blue-700 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                        href="{{ route('guru.nilai.show_input', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}">
                                        Tambah Nilai
                                    </a>
                                </li>
                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                <li>
                                    <a class="cursor-pointer block text-red-700 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                        data-tw-toggle="modal" data-tw-target="#modal-id_form_destroy">
                                        Hapus Nilai</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative overflow-x-auto card-body">
                <table id="" class="table capitalize w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                    <thead>
                        <tr class="bg-blue-200">
                            <th class="p-4 pr-8">
                                No</th>
                            <th class="p-4 pr-8">
                                Nama Siswa</th>
                            <th class="p-4 pr-8">
                                Mata Pelajaran</th>
                            <th class="p-4 pr-8">
                                Semester</th>
                            <th class="p-4 pr-8">
                                Tipe Ujian</th>
                            <th class="p-4 pr-8">
                                Nilai</th>
                            <th class="p-4 pr-8">
                            </th>
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
    </div>
    {{-- Modal Destroy --}}
    <div class="relative z-50 hidden modal" id="modal-id_form_destroy" aria-labelledby="modal-title" role="dialog"
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
                                Apakah anda ingin
                                menghapus data Nilai?</h3>
                            <form class="space-y-4" action="{{ route('guru.nilai.destroy') }}" method="GET">
                                @csrf
                                <div>
                                    <label for="rombel_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Nama Rombel
                                    </label>
                                    <select id="rombel_id" name="rombel_id"
                                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                        readonly>
                                        <option value="{{ $rombel->id }}" selected>{{ $rombel->nama_rombel }}</option>
                                    </select>
                                </div>
                                <div>
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
                                    <label for=""
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Semester
                                    </label>
                                    <select id="semester" name="semester"
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
                                <div>
                                    <label for="tipe_ujian"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Tipe Ujian
                                    </label>
                                    <select id="tipe_ujian" name="tipe_ujian"
                                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                        required>
                                        <option value="">Pilih Ujian</option>
                                        <option value="uts">UTS</option>
                                        <option value="uas">UAS</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="ketentuan"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Pastikan ketentuan yang dipilih sudah benar!
                                    </label>
                                    <input type="checkbox" value=""
                                        class="cursor-pointer align-middle rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                        id="ketentuan" required>
                                </div>
                                <button type="submit" class="w-full text-white bg-red-600 border-transparent btn">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (explode(' ', $rombel->nama_rombel)[0] == 'X')
        @if ($semester == 'ganjil')
            <input value="1" id="semester" hidden />
        @endif
        @if ($semester == 'genap')
            <input value="2" id="semester" hidden />
        @endif
    @endif
    @if (explode(' ', $rombel->nama_rombel)[0] == 'XI')
        @if ($semester == 'ganjil')
            <input value="3" id="semester" hidden />
        @endif
        @if ($semester == 'genap')
            <input value="4" id="semester"hidden />
        @endif
    @endif
    @if (explode(' ', $rombel->nama_rombel)[0] == 'XII')
        @if ($semester == 'ganjil')
            <input value="5" id="semester" hidden />
        @endif
        @if ($semester == 'genap')
            <input value="6" id="semester" hidden />
        @endif
    @endif
    <input type="text" id="tahun_ajaran_" value="{{ $tahun }}" hidden>
    <input type="text" id="semester_" value="{{ $semester }}" hidden>
    <input type="text" id="rombel_id" value="{{ $rombel->id }}" hidden>
    <input type="text" id="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}" hidden>
    <script type="module">
        $(document).ready(function() {
            let page = 1;
            let url = null;
            const btnPrev = document.getElementById('btn-previous')
            const btnNext = document.getElementById('btn-next')
            let container = document.getElementById('tabel-container')

            // filter
            filter('#tipe_ujian')
            filter('#semester')
            filter('#mapel_id')

            // get all data
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            url = '{{ route('guru.nilai.get-nilai') }}';
            $.ajax({
                type: "GET",
                url: url,
                data: getDatas(),
                success: function(response) {
                    console.log(response);
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
                    url = '{{ route('guru.nilai.filter') }}';
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
                let rombel_id = $('#rombel_id').val()
                let semester = $('#semester').val()
                let mapel_id = $('#mapel_id').val()
                let tahun_ajaran_id = $('#tahun_ajaran_id').val()

                let datas = {
                    'tipe_ujian': tipe_ujian,
                    'semester': semester,
                    'rombel_id': rombel_id,
                    'mapel_id': mapel_id,
                    'tahun_ajaran_id': tahun_ajaran_id,
                }
                return datas
            }

            function createTable(datas) {
                let row = ''
                let index = datas.from
                let rombel_id = $('#rombel_id').val()
                let tahun_ = $('#tahun_ajaran_').val()
                let semester_ = $('#semester_').val()

                const baseUrl =
                    "{{ route('guru.nilai.show_update', ['tahun' => ':tahun', 'semester' => ':semester', 'id' => ':id', 'rombel_id' => ':rombel_id']) }}";
                for (let i = 0; i < datas.data.length; i++) {
                    let semester = '';
                    let url_edit = baseUrl.replace(':tahun', tahun_).replace(':semester', semester_).replace(':id',
                        btoa(datas.data[i].id)).replace(':rombel_id', btoa(
                        rombel_id));
                    if (datas.data[i].semester % 2 == 0) {
                        semester = 'genap'
                    } else {
                        semester = 'ganjil'
                    }

                    row = `
                    <tr class="${(i + 1) % 2 == 0 ? 'bg-blue-50' : 'bg-white'}">
                        <td class="p-4 pr-8">
                            ${index}</td>
                        <td class="p-4 pr-8">
                            ${datas.data[i].nama}</td>
                        <td class="p-4 pr-8">
                            ${datas.data[i].nama_mata_pelajaran}</td>
                        <td class="p-4 pr-8">
                            ${semester}</td>
                        <td class="p-4 pr-8 capitalize">
                            ${datas.data[i].tipe_ujian}</td>
                        <td class="p-4 pr-8">
                            ${datas.data[i].nilai}</td>
                        <td class="p-4 pr-8  min-w-[150px] w-[150px]">
                            <a href="${url_edit}"
                                class="btn-edit"
                                data-tw-toggle="modal"><i class='bx bxs-edit'></i> Ubah</a>
                        </td>
                    </tr>
                    `;
                    container.innerHTML += row
                    index++;
                }
            }
        });
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
@endsection
