@extends('layouts.dashboard')
@section('table-name')
    Data Nilai Rombel {{ $rombel->nama_rombel }}
@endsection
@section('table-role', 'Guru')
@section('content')
    <div class="grid grid-cols-1 gap-5 bg-white shadow-md">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                <div class="grid md:grid-cols-12 gap-4">
                    <div class="md:col-span-3 flex flex-col justify-end">
                        <h6 class="mb-3 text-gray-700 text-15 dark:text-gray-100 font-semibold">Tambah Data Nilai</h6>
                        <input type="text" id="rombel_id" value="{{ $rombel->id }}" hidden>
                        <a href="{{ route('guru.nilai.show_input', ['id' => $rombel->id]) }}"
                            class=" text-white text-center hover:bg-violet-600 bg-violet-400 py-2 font-normal px-[40px] text-[16px] rounded-md transition-all">
                            Tambah Data
                        </a>
                    </div>
                    <div class="md:col-span-3 flex flex-col justify-end">
                        <h6 class="mb-3 text-gray-600 text-[16px] dark:text-gray-100 font-medium">Jika salah memasukan
                            data, silahkan hapus sesuai tipe ujian dan semester!
                        </h6>
                        <input type="text" id="rombel_id" value="{{ $rombel->id }}" hidden>
                        <a data-tw-toggle="modal" data-tw-target="#modal-id_form_destroy"
                            class="text-center text-white hover:bg-red-700 bg-red-500 py-2 font-normal px-[40px] text-[16px] rounded-md transition-all">
                            Hapus Data
                        </a>
                    </div>
                    <div class="md:col-span-6 grid grid-cols-3 gap-3 mt-6 md:mt-0">
                        <div class="">
                            <label for=""
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Semester
                            </label>
                            <select id="semester" name="semester"
                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                required>
                                @if (explode(' ', $rombel->nama_rombel)[0] == 'X')
                                    <option value="1" selected>Semester 1</option>
                                    <option value="2">Semester 2</option>
                                @endif
                                @if (explode(' ', $rombel->nama_rombel)[0] == 'XI')
                                    <option value="3" selected>Semester 3</option>
                                    <option value="4">Semester 4</option>
                                @endif
                                @if (explode(' ', $rombel->nama_rombel)[0] == 'XII')
                                    <option value="5" selected>Semester 5</option>
                                    <option value="6">Semester 6</option>
                                @endif
                            </select>
                        </div>
                        <div class="">
                            <label for=""
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Tipe Ujian
                            </label>
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
                        <div class="">
                            <label for="mapel_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Mata Pelajaran
                            </label>
                            <select id="mapel_id"
                                class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                @foreach ($mapel as $data_mapel)
                                    <option value="{{ $data_mapel->id }}"
                                        {{ $guru->mata_pelajaran_id == $data_mapel->id ? 'selected' : '' }}>
                                        {{ $data_mapel->nama_mata_pelajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative overflow-x-auto card-body">
                <table id="" class="table uppercase w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                    <thead>
                        <tr class="bg-blue-200">
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                No</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                Nama Siswa</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                Mata Pelajaran</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                Semester</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                Tipe Ujian</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                Nilai</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                Aksi</th>
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
                                            <option value="1" selected>Semester 1</option>
                                            <option value="2">Semester 2</option>
                                        @endif
                                        @if (explode(' ', $rombel->nama_rombel)[0] == 'XI')
                                            <option value="3" selected>Semester 3</option>
                                            <option value="4">Semester 4</option>
                                        @endif
                                        @if (explode(' ', $rombel->nama_rombel)[0] == 'XII')
                                            <option value="5" selected>Semester 5</option>
                                            <option value="6">Semester 6</option>
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
    {{-- End Modal Destroy --}}

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

                let datas = {
                    'tipe_ujian': tipe_ujian,
                    'semester': semester,
                    'rombel_id': rombel_id,
                    'mapel_id': mapel_id,
                }
                return datas
            }

            function createTable(datas) {
                let row = ''
                let index = datas.from
                let rombel_id = $('#rombel_id').val()

                const baseUrl =
                    "{{ route('guru.nilai.show_update', ['id' => ':id', 'rombel_id' => ':rombel_id']) }}";
                for (let i = 0; i < datas.data.length; i++) {
                    let url_edit = baseUrl.replace(':id', datas.data[i].id).replace(':rombel_id', rombel_id);
                    row = `
                    <tr class="${(i + 1) % 2 == 0 ? 'bg-blue-50' : 'bg-white'}">
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                            ${index}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                            ${datas.data[i].nama}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                            ${datas.data[i].nama_mata_pelajaran}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                            ${datas.data[i].semester}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                            ${datas.data[i].tipe_ujian}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                            ${datas.data[i].nilai}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600 min-w-[150px] w-[150px]">
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
