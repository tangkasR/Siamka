@extends('layouts.dashboard')
@section('table-name')
    Daftar Siswa {{ $rombel->nama_rombel }}
@endsection
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.rombel.show', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'rombel' => $rombel]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="md:flex md:justify-between md:items-center ">
                        <div>
                            <h1 class="text-[18px] font-medium capitalize leading-7">Tahun Ajaran
                                {{ str_replace('-', '/', $tahun_ajaran->tahun_ajaran) }},
                                Semester
                                {{ $tahun_ajaran->semester }}</h1>
                            <div class="mt-3">
                                <div class="relative dropdown ">
                                    <button type="button"
                                        class="hover:bg-gray-700 hover:text-white btn flex gap-2 items-center justify-center py-2 px-5 w-fit border border-gray-700 text-gray-700 rounded-md font-medium leading-tight  dropdown-toggle"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"><span>Cetak</span><i
                                            class='bx bx-printer text-[20px]'></i></button>
                                    <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                        aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                        <li>
                                            <a class="block w-full px-4 py-1 text-sm font-medium text-green-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                id="btn_excel">
                                                Excel
                                            </a>
                                        </li>
                                        <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                        <li>
                                            <a class="block text-red-500 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                id="btn_pdf">
                                                PDF</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="md:mt-0 mt-5">
                            <div class=" md:flex md:items-center grid grid-cols-2 gap-4 mb-3">
                                <div class="relative dropdown w-full">
                                    <button type="button"
                                        class="dropdown-toggle flex gap-2 justify-center items-center cursor-pointer text-center md:w-[180px] w-[150px] border border-blue-500 bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"><span>Kelola Data</span> <i
                                            class='bx bxs-plus-circle text-[20px]'></i></button>

                                    <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                        aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                        <li>
                                            <a class="cursor-pointer block w-full px-4 py-1 text-sm font-medium text-black bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                                id="btn-download">
                                                Download Template
                                            </a>
                                        </li>
                                        <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                        <li>
                                            <a class="cursor-pointer block text-blue-700 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                                href="{{ route('admin.siswa.tambah_data', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'rombel' => $rombel]) }}">
                                                Import Siswa</a>
                                        </li>
                                        @if ($tahun_ajaran->semester == 'genap')
                                            @if (count($siswa) == 0)
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a data-tw-toggle="modal" data-tw-target="#modal-id_migration"
                                                        class="cursor-pointer block text-green-500 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 ">
                                                        Transfer Data</a>
                                                </li>
                                            @else
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a href="{{ route('admin.siswa.show_next_grade', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'rombel' => $rombel]) }}"
                                                        class="cursor-pointer block text-red-500 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 ">
                                                        Naik Kelas</a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                                <div class="relative dropdown w-full">
                                    <button type="button"
                                        class="dropdown-toggle flex gap-2 justify-center items-center cursor-pointer text-center md:w-[180px] w-[148px] border border-blue-500 hover:bg-blue-500 hover:text-white text-blue-500 font-medium py-2 px-4 rounded-md transition-all duration-300"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"><span>Kelola Akun</span><i
                                            class='bx bxs-user-account text-[20px]'></i></button>

                                    <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                        aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                        <li>
                                            <a class="cursor-pointer block w-full px-4 py-1 text-sm font-medium text-green-700 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                                data-tw-toggle="modal" data-tw-target="#modal-id_aktivation_all">
                                                Aktivasi Akun
                                            </a>
                                        </li>
                                        <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                        <li>
                                            <a class="cursor-pointer block text-red-700 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                                data-tw-toggle="modal" data-tw-target="#modal-id_form_deaktivasi">
                                                Deaktivasi Akun</a>
                                        </li>
                                    </ul>
                                </div>
                                @if (explode(' ', $rombel->nama_rombel)[0] == 'XII' && $tahun_ajaran->semester == 'genap')
                                    <div>
                                        <a href="{{ route('admin.siswa.show_lulus', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'rombel' => $rombel]) }}"
                                            class=" md:w-[180px] w-[148px] hover:text-white text-red-600 border border-red-600 hover:bg-red-700 font-medium btn cursor-pointer">
                                            Luluskan Siswa
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="flex gap-4 items-center">



                            </div>
                        </div>
                        <div class="" hidden>
                            {{-- template excel --}}
                            <input type="text" id="nama_rombel_input" value="{{ $rombel->nama_rombel }}">
                            <table id="template-input">
                                <thead>
                                    <tr>
                                        <th>
                                            nama</th>
                                        <th>
                                            nis</th>
                                        <th>
                                            nisn</th>
                                        <th>
                                            nomor_id</th>
                                        <th>
                                            jenis_kelamin</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Rombel</th>
                                        <th></th>
                                        <th>Pilih Jenis Kelamin</th>
                                        <th></th>
                                        <th>Format Username</th>
                                        <th></th>
                                        <th>Format Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ explode(' ', $rombel->nama_rombel)[1] }}</td>
                                        <td></td>
                                        <td>L / P</td>
                                        <td></td>
                                        <td>NISN</td>
                                        <td></td>
                                        <td>Nomor_id</td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- end template excel --}}
                        </div>

                    </div>
                </div>
                <div class="relative overflow-x-auto card-body" id="template_pdf">
                    <div class="ms-12 hidden" id="print_nama_rombel">
                        <h1 class="text-[20px] font-medium">Daftar Siswa Rombel: {{ $rombel->nama_rombel }}</h1>
                    </div>
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100 capitalize">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="p-4">
                                    No</th>
                                <th class="p-4">
                                    Nama</th>
                                <th class="p-4">
                                    NIS</th>
                                <th class="p-4">
                                    NISN</th>
                                <th class="p-4">
                                    Nomor Id</th>
                                <th class="p-4">
                                    Jenis Kelamin</th>
                                <th class="p-4 hidden_item">
                                    Username</th>
                                <th class="p-4 hidden_item">
                                    Status Siswa</th>
                                <th class="p-4 hidden_item">
                                    Status Akun</th>
                                <th class="p-4 hidden_item">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4">
                                        {{ $data->nama }}</td>

                                    <td class="p-4">
                                        {{ $data->nis }}</td>
                                    <td class="p-4">
                                        {{ $data->nisn }}</td>
                                    <td class="p-4">
                                        {{ $data->nomor_id }}</td>
                                    <td class="p-4">
                                        {{ $data->jenis_kelamin }}</td>
                                    <td class="p-4 hidden_item">
                                        {{ $data->username }}</td>
                                    @if ($data->status_siswa == 'belum lulus')
                                        <td class="hidden_item p-4 min-w-[150px] w-[150px] text-green-400 font-medium">
                                            {{ $data->status_siswa }}</td>
                                    @endif
                                    @if ($data->status_siswa == 'keluar')
                                        <td class="hidden_item p-4 min-w-[150px] w-[150px] text-red-400 font-medium">
                                            {{ $data->status_siswa }}</td>
                                    @endif
                                    @if ($data->status_siswa == 'lulus')
                                        <td class="hidden_item p-4 min-w-[150px] w-[150px] text-red-400 font-medium">
                                            {{ $data->status_siswa }}</td>
                                    @endif
                                    <td class="hidden_item p-4 min-w-[150px] w-[150px]">
                                        @if ($data->aktivasi_akun == 'aktif')
                                            <a data-tw-toggle="modal"
                                                data-tw-target="#modal-id_single_deaktivation_{{ $loop->iteration }}"
                                                class="w-[130px] mx-auto cursor-pointer hover:border-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 border  bg-green-500 rounded-full capitalize btn">
                                                {{ $data->aktivasi_akun }}
                                            </a>
                                        @else
                                            <form action="{{ route('admin.siswa.aktivasi') }}" method="POST"
                                                class=" mx-auto">
                                                @csrf
                                                <input type="text" value="{{ $data->id }}" name="siswa_id"
                                                    hidden>
                                                <input type="text" value="{{ $rombel->id }}" name="rombel_id"
                                                    hidden>
                                                <button type="submit"
                                                    class="w-[130px] cursor-pointer hover:border-green-500 hover:bg-green-600 text-white py-2 px-6 border  bg-red-500 rounded-full  capitalize font-medium btn">
                                                    {{ $data->aktivasi_akun }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="hidden_item p-4">
                                        <div class="relative dropdown">
                                            <button type="button" class="py-2 font-medium leading-tight  dropdown-toggle"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"><i
                                                    class='bx bx-menu text-[20px]'></i></button>

                                            <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                                aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        href="{{ route('admin.siswa.detail_siswa', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'rombel' => $rombel, 'id' => Crypt::encrypt($data->id)]) }}"><i
                                                            class="text-lg align-middle bx bx-show ltr:mr-2 rtl:ml-2"></i>Detail
                                                        Siswa</a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_form_edit_{{ $loop->iteration }}"><i
                                                            class="text-lg align-middle bx bxs-edit ltr:mr-2 rtl:ml-2"></i>
                                                        Ubah</a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_move_class_{{ $loop->iteration }}"><i
                                                            class="text-lg align-middle bx bxs-right-arrow-circle ltr:mr-2 rtl:ml-2"></i>Pidah
                                                        Rombel</a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_form_keluar_{{ $loop->iteration }}">
                                                        <i
                                                            class="text-lg align-middle bx bx-log-out ltr:mr-2 rtl:ml-2"></i>Keluar</a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_form_destroy_{{ $loop->iteration }}"><i
                                                            class="text-lg align-middle bx bx-trash ltr:mr-2 rtl:ml-2"></i>Hapus</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <div class="relative z-50 hidden modal" id="modal-id_form_edit_{{ $loop->iteration }}"
                                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="fixed inset-0 z-50 overflow-y-auto">
                                        <div
                                            class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
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
                                                        <h3
                                                            class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                            Ubah
                                                            Data Siswa {{ $data->nama }}</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.siswa.update', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3 grid grid-cols-2 gap-3">
                                                                <div>
                                                                    <label for="nama"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Nama
                                                                    </label>
                                                                    <input type="text" name="nama" id="nama"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Nama Siswa"
                                                                        value="{{ $data->nama }}" required>
                                                                </div>
                                                                <div>
                                                                    <label for="nis"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        NIS
                                                                    </label>
                                                                    <input type="text" name="nis" id="nis"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Nis Siswa"
                                                                        value="{{ $data->nis }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 grid grid-cols-2 gap-3">
                                                                <div>
                                                                    <label for="nisn"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        NISN
                                                                    </label>
                                                                    <input type="text" name="nisn" id="nisn"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan NISN Siswa"
                                                                        value="{{ $data->nisn }}" required>
                                                                </div>
                                                                <div>
                                                                    <label for="nomor_id"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Nomor Id
                                                                    </label>
                                                                    <input type="text" name="nomor_id" id="nomor_id"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Nomor Id Siswa"
                                                                        value="{{ $data->nomor_id }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 grid grid-cols-2 gap-3">

                                                                <div>
                                                                    <label for="jenis_kelamin"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Jenis Kelamin
                                                                    </label>
                                                                    <select id="jenis_kelamin" name="jenis_kelamin"
                                                                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                        <option value="L"
                                                                            {{ $data->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                                            Laki-Laki</option>
                                                                        <option value="P"
                                                                            {{ $data->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                                            Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div>
                                                                    <label for="username"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Username
                                                                    </label>
                                                                    <input type="username" name="username" id="username"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Email Siswa"
                                                                        value="{{ $data->username }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 grid grid-cols-2 gap-3">
                                                                <div>
                                                                    <label for="password"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Password
                                                                    </label>
                                                                    <input type="text" name="password" id="password"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        value="{{ $data->nis }}"
                                                                        placeholder="Masukan Password Siswa" required>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="w-full text-white mt-3 hover:bg-blue-700 bg-blue-500 border-transparent btn">
                                                                Simpan
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal Edit --}}

                                {{-- Modal Pindah Kelas --}}
                                <div class="relative z-50 hidden modal" id="modal-id_move_class_{{ $loop->iteration }}"
                                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="fixed inset-0 z-50 overflow-y-auto">
                                        <div
                                            class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
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
                                                        <h3
                                                            class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                            Pindahkan Siswa <span
                                                                class="text-red-500">{{ $data->nama }}</span></h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.siswa.move_class', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="nama"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama
                                                                </label>
                                                                <input type="text" name="nama" id="nama"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Siswa"
                                                                    value="{{ $data->nama }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="rombel_id"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama Rombel
                                                                </label>
                                                                <select name="rombel_id"
                                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                    @foreach ($rombels as $item)
                                                                        @if (explode(' ', $rombel->nama_rombel)[0] == explode(' ', $item->nama_rombel)[0])
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $rombel->nama_rombel == $item->nama_rombel ? 'selected' : '' }}>
                                                                                {{ $item->nama_rombel }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 flex gap-3 items-center">
                                                                <input type="checkbox" value=""
                                                                    class="cursor-pointer align-middle rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                                    id="ketentuan" required>
                                                                <label for="ketentuan"
                                                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Pastikan semua data yang diisi sudah benar!
                                                                </label>
                                                            </div>
                                                            <button type="submit"
                                                                class="w-full text-white mt-3 hover:bg-red-700 bg-red-500 border-transparent btn">
                                                                Pindahkan
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal Pindah Kelas --}}

                                {{-- Modal Keluar --}}
                                <div class="relative z-50 hidden modal" id="modal-id_form_keluar_{{ $loop->iteration }}"
                                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="fixed inset-0 z-50 overflow-y-auto">
                                        <div
                                            class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
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
                                                        <h3
                                                            class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                            Apakah siswa <span
                                                                class="text-red-500">{{ $data->nama }}</span> keluar
                                                            dari sekolah?</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.siswa.keluar', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="w-full text-white hover:bg-red-700 bg-red-600 border-transparent btn">
                                                                Keluarkan
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal Keluar --}}

                                {{-- Modal Destroy --}}
                                <div class="relative z-50 hidden modal" id="modal-id_form_destroy_{{ $loop->iteration }}"
                                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="fixed inset-0 z-50 overflow-y-auto">
                                        <div
                                            class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
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
                                                        <h3
                                                            class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                            Apakah anda ingin
                                                            menghapus data <span
                                                                class="text-red-500">{{ $data->nama }}?</span></h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.siswa.destroy', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full text-white hover:bg-red-700 bg-red-600 border-transparent btn">
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

                                {{-- Modal Single Deaktivasi --}}
                                <div class="relative z-50 hidden modal"
                                    id="modal-id_single_deaktivation_{{ $loop->iteration }}"
                                    aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="fixed inset-0 z-50 overflow-y-auto">
                                        <div
                                            class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
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
                                                    <div class="py-5 px-10 mb-4">
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.siswa.deaktivasi', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div
                                                                class="mx-auto p-3 bg-red-50 rounded-full text-red-500 font-medium w-fit mb-3">
                                                                <i class='bx bxs-user-account text-[40px]'></i>
                                                            </div>
                                                            <h3
                                                                class="mb-3 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                                Apakah anda ingin
                                                                mendeaktivasi siswa <span
                                                                    class="text-red-600">{{ $data->nama }}?</span>
                                                            </h3>
                                                            @csrf
                                                            <button type="submit"
                                                                class="w-full text-white hover:bg-red-700 bg-red-600 border-transparent btn">
                                                                Deaktivasi
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal Single Deaktivasi --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Deaktivasi --}}
    <div class="relative z-50 hidden modal" id="modal-id_form_deaktivasi" aria-labelledby="modal-title" role="dialog"
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
                            <form class="space-y-4"
                                action="{{ route('admin.siswa.deaktivasiAll', ['rombel' => $rombel]) }}" method="POST">
                                @csrf
                                <div class="mx-auto p-3 bg-red-50 rounded-full text-red-500 font-medium w-fit mb-3">
                                    <i class='bx bxs-user-account text-[40px]'></i>
                                </div>
                                <h3 class=" text-xl font-medium text-gray-700 dark:text-gray-100">
                                    Deaktivasi Semua Akun Siswa!</h3>
                                @csrf
                                <button type="submit" class="w-full text-white bg-red-600 border-transparent btn">
                                    Deaktivasi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Deaktivasi --}}

    {{-- Modal Migrasi --}}
    <div class="relative z-50 hidden modal" id="modal-id_migration" aria-labelledby="modal-title" role="dialog"
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
                            <div class="mx-auto p-3 bg-green-50 rounded-full text-green-500 font-medium w-fit mb-3">
                                <i class='bx bxs-user-account text-[40px]'></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-100">
                                Transfer data siswa dari semester sebelumnya!</h3>
                            <form action="{{ route('admin.siswa.migrasi') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="tahun" value="{{ $tahun_ajaran->tahun_ajaran }}"
                                    id="" hidden>
                                <input type="text" name="semester" value="{{ $tahun_ajaran->semester }}"
                                    id="" hidden>
                                <input type="text" name="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}"
                                    id="" hidden>
                                <input type="text" name="nama_rombel" value="{{ $rombel->nama_rombel }}"
                                    id="" hidden>
                                <input type="text" name="rombel_id" value="{{ $rombel->id }}" id=""
                                    hidden>
                                <button type="submit"
                                    class="mt-3 w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300">
                                    Transfer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Migrasi --}}


    {{-- Modal Aktivation All --}}
    <div class="relative z-50 hidden modal" id="modal-id_aktivation_all" aria-labelledby="modal-title" role="dialog"
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
                            <div class="mx-auto p-3 bg-green-50 rounded-full text-green-500 font-medium w-fit mb-3">
                                <i class='bx bxs-user-account text-[40px]'></i>
                            </div>
                            <h3 class=" text-xl font-medium text-gray-700 dark:text-gray-100">
                                Aktivasi Semua Akun Siswa!</h3>
                            <form action="{{ route('admin.siswa.aktivasiAll', ['rombel' => $rombel]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <button type="submit"
                                    class="mt-3 w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300">
                                    Aktivasi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Aktivation All --}}

    <script>
        document.getElementById('btn-download').addEventListener('click', () => {
            let nama_rombel = document.getElementById('nama_rombel_input').value
            nama_rombel = nama_rombel.split(' '); // Membagi string berdasarkan spasi
            nama_rombel = nama_rombel[1]; // Mengambil bagian kedua dari hasil split (index 1)

            const workbook = XLSX.utils.book_new();
            const tableInputSiswa = document.getElementById('template-input');
            const worksheetSiswa = XLSX.utils.table_to_sheet(tableInputSiswa);
            XLSX.utils.book_append_sheet(workbook, worksheetSiswa,
                `Template Input Siswa`);
            XLSX.writeFile(workbook, `template-siswa-${nama_rombel}-angkatan-.xlsx`);
        })
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

    <input type="text" name="nama_rombel" value="{{ $rombel->nama_rombel }}" id="nama_rombel_" hidden>
    <script>
        document.getElementById('btn_excel').addEventListener('click', () => {
            const workbook = XLSX.utils.book_new();
            const tableSiswa = document.getElementById('datatable');

            // Ambil indeks kolom yang ingin kamu sertakan dalam array
            const selectedColumns = [0, 1, 2, 3, 4, 5]; // Ganti dengan indeks kolom yang kamu inginkan

            // Buat array untuk menampung data yang sudah diseleksi
            const selectedData = [];
            const headers = [];

            // Ambil header kolom
            const headerRow = tableSiswa.rows[0];
            for (let i = 0; i < selectedColumns.length; i++) {
                headers.push(headerRow.cells[selectedColumns[i]].innerText);
            }

            // Ambil data untuk setiap baris
            for (let i = 1; i < tableSiswa.rows.length; i++) {
                const rowData = [];
                for (let j = 0; j < selectedColumns.length; j++) {
                    rowData.push(tableSiswa.rows[i].cells[selectedColumns[j]].innerText);
                }
                selectedData.push(rowData);
            }

            // Buat worksheet dari data yang sudah diseleksi
            const worksheetSiswa = XLSX.utils.aoa_to_sheet([headers, ...selectedData]);
            const rombel = document.getElementById('nama_rombel_').value;

            // Tambahkan worksheet ke workbook
            XLSX.utils.book_append_sheet(workbook, worksheetSiswa, 'Daftar Siswa');

            // Simpan file Excel dengan nama yang sesuai
            XLSX.writeFile(workbook, `daftar-siswa-rombel-${rombel}.xlsx`);
        });

        document.getElementById('btn_pdf').addEventListener('click', () => {
            var btnExcel = document.getElementById('btn_excel')
            var btnPdf = document.getElementById('btn_pdf')
            const show = document.getElementById('datatable_length');
            const search = document.getElementById('datatable_filter');
            const paginate = document.getElementById('datatable_paginate');
            const nama_rombel = document.getElementById('print_nama_rombel');
            show.classList.add('hidden')
            search.classList.add('hidden')
            paginate.classList.add('hidden')
            nama_rombel.classList.remove('hidden')

            let hiddenItem = document.querySelectorAll('.hidden_item');
            hiddenItem.forEach(element => {
                console.log(element);
                element.classList.add('hidden')
            });

            var printContents = document.getElementById('template_pdf').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = `<div style="margin-bottom:30px"></div>`
            document.body.innerHTML += printContents;
            window.print();
            window.location.reload()
        })
    </script>
@endsection
