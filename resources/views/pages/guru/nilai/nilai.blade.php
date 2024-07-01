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
                <div class="md:flex md:justify-between md:items-center md:gap-4">
                    <div class="md:mb-0 mb-6">
                        <h1 class="text-[18px] font-medium capitalize leading-7">Tahun Ajaran
                            {{ str_replace('-', '/', $tahun) }},
                            Semester
                            {{ $semester }}</h1>
                    </div>
                    <div class=" md:flex md:items-center gap-4">
                        <form
                            action="{{ route('guru.nilai.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => Crypt::encrypt($rombel->id)]) }}"
                            method="GET">
                            @if (explode(' ', $rombel->nama_rombel)[0] == 'X')
                                @if ($semester == 'ganjil')
                                    <input value="1" name="semester" hidden />
                                @endif
                                @if ($semester == 'genap')
                                    <input value="2" name="semester" hidden />
                                @endif
                            @endif
                            @if (explode(' ', $rombel->nama_rombel)[0] == 'XI')
                                @if ($semester == 'ganjil')
                                    <input value="3" name="semester" hidden />
                                @endif
                                @if ($semester == 'genap')
                                    <input value="4" name="semester"hidden />
                                @endif
                            @endif
                            @if (explode(' ', $rombel->nama_rombel)[0] == 'XII')
                                @if ($semester == 'ganjil')
                                    <input value="5" name="semester" hidden />
                                @endif
                                @if ($semester == 'genap')
                                    <input value="6" name="semester" hidden />
                                @endif
                            @endif
                            <div class="flex items-center gap-4">
                                <div class="md:w-[200px] w-[150px]">
                                    <select id="tipe_ujian" name="tipe_ujian"
                                        class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                        <option value="" hidden>
                                            Pilih Tipe Ujian
                                        </option>
                                        <option value="uts">
                                            UTS
                                        </option>
                                        <option value="uas">
                                            UAS
                                        </option>
                                    </select>
                                </div>
                                <div class="md:w-[200px] w-[150px]">
                                    <select id="mapel_id" onchange="this.form.submit()" name="mapel_id"
                                        class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                        <option value="" hidden>
                                            Pilih Mata Pelajaran
                                        </option>
                                        @foreach ($mapel as $data_mapel)
                                            <option value="{{ $data_mapel->id }}"
                                                {{ $guru->mata_pelajaran_id == $data_mapel->id ? 'selected' : '' }}>
                                                {{ $data_mapel->nama_mata_pelajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <noscript><input type="submit" value="Submit"></noscript>
                            </div>
                        </form>
                        <div class="relative dropdown md:mt-0 mt-4">
                            <button type="button"
                                class="dropdown-toggle flex gap-2 justify-center items-center cursor-pointer text-center md:w-[180px] w-full border border-blue-500 bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown"><span>Kelola Data Nilai</span><i
                                    class='bx bxs-plus-circle text-[20px]'></i></button>

                            <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                <li>
                                    <a data-tw-toggle="modal" data-tw-target="#modal-id_tipe_ujian"
                                        class="cursor-pointer block w-full px-4 py-1 text-sm font-medium text-blue-700 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 ">
                                        Import Nilai
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
                <table id="datatable" class="table capitalize w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                    <thead>
                        <tr class="bg-blue-200">
                            <th class="p-4 pr-8">
                                No</th>
                            <th class="p-4 pr-8">
                                Nama Siswa</th>
                            <th class="p-4 pr-8">
                                Mata Pelajaran</th>
                            <th class="p-4 pr-8">
                                Tipe Ujian</th>
                            <th class="p-4 pr-8">
                                Nilai</th>
                            <th class="p-4 pr-8">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilais as $data)
                            <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                <td class="p-4 pr-8">
                                    {{ $loop->iteration }}</td>
                                <td class="p-4 pr-8">
                                    {{ $data->nama }}</td>
                                <td class="p-4 pr-8">
                                    {{ $data->nama_mata_pelajaran }}</td>
                                <td class="p-4 pr-8">
                                    {{ $data->tipe_ujian }}</td>
                                <td class="p-4 pr-8">
                                    {{ $data->nilai }}</td>
                                <td class="p-4 pr-8">
                                    <div class="relative dropdown ">
                                        <button type="button" class="py-2 font-medium leading-tight  dropdown-toggle"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown"><i
                                                class='bx bx-menu text-[20px]'></i></button>

                                        <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                            aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                            <li>
                                                <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                    data-tw-toggle="modal"
                                                    data-tw-target="#modal-id_form_edit_{{ $loop->iteration }}">
                                                    <i class='bx bxs-edit'></i>
                                                    Ubah
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal Edit --}}
                            <div class="relative z-50 hidden modal" id="modal-id_form_edit_{{ $loop->iteration }}"
                                aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                                                    <i
                                                        class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                                                </button>
                                                <div class="p-5">
                                                    <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                        Ubah
                                                        Data Sesi</h3>
                                                    <form class="space-y-4 w-full"
                                                        action="{{ route('guru.nilai.update', ['nilai' => $data->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class=" ">
                                                            <input type="text" name="tahun_ajaran_"
                                                                value="{{ $tahun }}" hidden>
                                                            <input type="text" name="semester_"
                                                                value="{{ $semester }}" hidden>
                                                            <input type="text" name="rombel_id" id="rombel_id"
                                                                class="" placeholder=""
                                                                value="{{ $rombel->id }}" hidden>
                                                            <div class="grid grid-cols-2 gap-4">
                                                                <div class="mb-3 w-full">
                                                                    <label for="nama"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Nama Siswa
                                                                    </label>
                                                                    <input type="text" name="nama" id="nama"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Nama Siswa"
                                                                        value="{{ $data->nama }}" required readonly>
                                                                </div>
                                                                <div class="mb-3 w-full">
                                                                    <label for="mapel"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Mata Pelajaran
                                                                    </label>
                                                                    <input type="text" name="mapel" id="mapel"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder=""
                                                                        value="{{ $data->nama_mata_pelajaran }}" required
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-2 gap-4">
                                                                <div class="mb-3 w-full">
                                                                    <label for="semester"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Semester
                                                                    </label>
                                                                    <input type="text" name="semester" id="semester"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Semester"
                                                                        value="{{ $data->semester }}" required readonly>
                                                                </div>
                                                                <div class="mb-3 w-full">
                                                                    <label for="tipe_ujian"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Tipe Ujian
                                                                    </label>
                                                                    <input type="text" name="tipe_ujian"
                                                                        id="tipe_ujian"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Tipe Ujian"
                                                                        value="{{ $data->tipe_ujian }}" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-2 gap-4">
                                                                <div class="mb-3 w-full">
                                                                    <label for="nilai"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Nilai
                                                                    </label>
                                                                    <input type="text" name="nilai" id="nilai"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Nilai Siswa"
                                                                        value="{{ $data->nilai }}" required>
                                                                </div>
                                                                <div></div>
                                                            </div>
                                                            <!-- Modal footer -->
                                                        </div>

                                                        <div class="flex gap-4">
                                                            <button type="submit"
                                                                class=" w-full text-white hover:bg-blue-700 bg-blue-500 border-transparent btn">
                                                                Simpan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Edit --}}
                        @endforeach
                    </tbody>
                </table>
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
                                <input type="text" name="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}"
                                    id="" hidden>
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

    {{-- Modal Semester --}}
    <div class="absolute z-50 hidden modal" id="modal-id_tipe_ujian" aria-labelledby="modal-title" role="dialog"
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
                        <div class="py-5 px-10 mb-4">
                            <h3 class="my-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                Pilih Tipe Ujian
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                <a href="{{ route('guru.nilai.show_input', ['tahun' => $tahun, 'semester' => $semester, 'tipe_ujian' => 'uts', 'rombel' => $rombel]) }}"
                                    class="cursor-pointer w-full hover:text-white text-blue-600 font-medium  hover:bg-blue-600 border-2 border-blue-600 btn capitalize transition-all duration-300">
                                    UTS
                                </a>
                                <a href="{{ route('guru.nilai.show_input', ['tahun' => $tahun, 'semester' => $semester, 'tipe_ujian' => 'uas', 'rombel' => $rombel]) }}"
                                    class="cursor-pointer w-full hover:text-white text-blue-600 font-medium  hover:bg-blue-600 border-2 border-blue-600 btn capitalize transition-all duration-300">
                                    UAS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Semester --}}

    <input type="text" id="tahun_ajaran_" value="{{ $tahun }}" hidden>
    <input type="text" id="semester_" value="{{ $semester }}" hidden>
    <input type="text" id="rombel_id" value="{{ $rombel->id }}" hidden>
    <input type="text" id="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}" hidden>
    {{-- <script type="module">
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
    </script> --}}

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
