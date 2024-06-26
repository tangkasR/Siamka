@extends('layouts.dashboard')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('tahun_ajaran.index', 'guru') }}" class="flex justify-center items-center"><i
                class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('table-name')
    Daftar Guru
@endsection
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card  dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="flex justify-between items-start">
                        <h1 class="text-[18px] font-medium capitalize">Tahun Ajaran
                            {{ str_replace('-', '/', $tahun_ajaran->tahun_ajaran) }},
                            Semester
                            {{ $tahun_ajaran->semester }}</h1>
                        <div class="flex items-center gap-4">
                            <div class="relative dropdown ">
                                <button type="button"
                                    class="dropdown-toggle flex gap-2 justify-center items-center cursor-pointer text-center w-[180px] border border-blue-500 bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"><span>Tambah Data</span> <i
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
                                        {{-- <a class="cursor-pointer block text-blue-700 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                            data-tw-toggle="modal" data-tw-target="#modal-id_form_add">
                                            Import Guru</a> --}}
                                        <a class="cursor-pointer block text-blue-700 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                            href="{{ route('admin.guru.tambah_data', ['tahun' => $tahun, 'semester' => $semester]) }}">
                                            Import Guru</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="relative dropdown ">
                                <button type="button"
                                    class="dropdown-toggle flex gap-2 justify-center items-center cursor-pointer text-center w-[180px] border border-blue-500 hover:bg-blue-500 hover:text-white text-blue-500 font-medium py-2 px-4 rounded-md transition-all duration-300"
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
                                            data-tw-toggle="modal" data-tw-target="#modal-id_deaktivation_all">
                                            Deaktivasi Akun</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <table id="template-input" hidden>
                            <thead>
                                <tr>
                                    <th>nama</th>
                                    <th>mapel1</th>
                                    <th>mapel2</th>
                                    <th>jabatan</th>
                                    <th>niy</th>
                                    <th>password</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>List Mapel</th>
                                    <th>Pilih Mapel dari list disebelah</th>
                                    <th>Copas dan jangan dirubah!</th>
                                    <th></th>
                                    <th></th>
                                    <th>Password: tanggal lahir</th>
                                    <th>Format password</th>
                                    <th>tanggal bulan tahun</th>
                                    <th>02022002</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapels as $item_mapel)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ strtolower(str_replace(' ', '_', $item_mapel->nama_mata_pelajaran)) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- end template excel --}}


                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100 capitalize">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="p-4">
                                    No</th>
                                <th class="p-4">
                                    Nama</th>
                                <th class="p-4">
                                    Mata Pelajaran</th>
                                <th class="p-4">
                                    Jabatan</th>
                                <th class="p-4">
                                    Nomor Induk Yayasan</th>
                                <th class="p-4">
                                    Username</th>
                                <th class="p-4">
                                    Status Akun</th>
                                <th class="p-4">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4">
                                        {{ $data->nama }}</td>
                                    <td class="p-4">
                                        @foreach ($data->mapels as $mapel)
                                            {{ $loop->iteration }}. {{ $mapel->nama_mata_pelajaran }} <br>
                                        @endforeach
                                    </td>
                                    <td class="p-4">
                                        {{ $data->jabatan }}</td>
                                    <td class="p-4">
                                        {{ $data->nomor_induk_yayasan }}</td>
                                    <td class="p-4">
                                        {{ $data->username }}</td>
                                    {{-- <td class="p-4">
                                        @if ($data->status_akun == 'aktif')
                                            <a data-tw-toggle="modal"
                                                data-tw-target="#modal-id_single_deaktivation_{{ $loop->iteration }}"
                                                class="mx-auto cursor-pointer hover:border-red-500 hover:bg-red-500 hover:text-white py-2 px-6 border  bg-green-50 rounded-xl  text-green-900 capitalize">
                                                {{ $data->status_akun }}
                                            </a>
                                        @else
                                            <form action="{{ route('admin.guru.aktivasi', ['id' => $data->id]) }}"
                                                method="POST" class="mx-auto">
                                                @csrf
                                                <button type="submit"
                                                    class="cursor-pointer hover:border-green-500 hover:bg-green-500 hover:text-white py-2 px-6 border  bg-red-50 rounded-xl text-red-900 capitalize">
                                                    {{ $data->status_akun }}
                                                </button>
                                            </form>
                                        @endif
                                    </td> --}}
                                    <td class="p-4 min-w-[150px] w-[150px]">
                                        @if ($data->status_akun == 'aktif')
                                            <a data-tw-toggle="modal"
                                                data-tw-target="#modal-id_single_deaktivation_{{ $loop->iteration }}"
                                                class="w-[130px] mx-auto cursor-pointer hover:border-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 border  bg-green-500 rounded-full capitalize btn">
                                                {{ $data->status_akun }}
                                            </a>
                                        @else
                                            <form action="{{ route('admin.guru.aktivasi', ['id' => $data->id]) }}"
                                                method="POST" class="mx-auto">
                                                @csrf
                                                <button type="submit"
                                                    class="w-[130px] cursor-pointer hover:border-green-500 hover:bg-green-600 text-white py-2 px-6 border  bg-red-500 rounded-full  capitalize font-medium btn">
                                                    {{ $data->status_akun }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <div class="relative dropdown w-full">
                                            <button type="button" class="py-2 font-medium leading-tight  dropdown-toggle"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"><i
                                                    class='bx bx-menu text-[20px]'></i></button>
                                            <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                                aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        href="{{ route('admin.guru.detail_guru', ['tahun' => $tahun, 'semester' => $semester, 'guru' => $data]) }}"><i
                                                            class="text-lg align-middle bx bx-show ltr:mr-2 rtl:ml-2"></i>Detail
                                                        Guru</a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        href="{{ route('admin.guru.show_rombel', ['tahun' => $tahun, 'semester' => $semester, 'guru' => $data]) }}">
                                                        <i class='bx bx-group'></i>
                                                        Daftar Rombel</a>
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
                                                        data-tw-target="#modal-id_form_destroy_{{ $loop->iteration }}"><i
                                                            class="text-lg align-middle bx bx-trash ltr:mr-2 rtl:ml-2"></i>Hapus</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
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
                                                            action="{{ route('admin.guru.deaktivasi', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="w-full">
                                                                <div
                                                                    class="mx-auto p-3 bg-red-50 rounded-full text-red-500 font-medium w-fit mb-3">
                                                                    <i class='bx bxs-user-account text-[40px]'></i>
                                                                </div>
                                                            </div>
                                                            <h3
                                                                class="mb-3 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                                Apakah anda ingin
                                                                mendeaktivasi Guru <span
                                                                    class="text-red-600">{{ $data->nama }}?</span>
                                                            </h3>
                                                            <button type="submit"
                                                                class="w-full text-white bg-red-600 border-transparent btn">
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
                                                            Data Guru</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.guru.update', ['guru' => $data]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="nama"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama
                                                                </label>
                                                                <input type="text" name="nama" id="nama"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Guru"
                                                                    value="{{ $data->nama }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jabatan"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Jabatan
                                                                </label>
                                                                <input type="text" name="jabatan" id="jabatan"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nomor Induk Yayasan"
                                                                    value="{{ $data->jabatan }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="nomor_induk_yayasan"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nomor Induk Yayasan
                                                                </label>
                                                                <input type="text" name="nomor_induk_yayasan"
                                                                    id="nomor_induk_yayasan"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nomor Induk Yayasan"
                                                                    value="{{ $data->nomor_induk_yayasan }}" required>
                                                            </div>
                                                            <div class="grid grid-cols-2 gap-4">
                                                                @foreach ($data->mapels as $mapel)
                                                                    <div class="mb-3">
                                                                        <label for="mapel_id_{{ $loop->iteration }}"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                            Mata Pelajaran {{ $loop->iteration }}
                                                                        </label>
                                                                        <select id="mapel_id_{{ $loop->iteration }}"
                                                                            name="mapel_id_{{ $loop->iteration }}"
                                                                            class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                            <option value="">- Tidak berubah -
                                                                            </option>
                                                                            @foreach ($mapels as $item_mapel)
                                                                                <option value="{{ $item_mapel->id }}"
                                                                                    {{ $item_mapel->id == $mapel->id ? 'selected' : '' }}>
                                                                                    {{ $item_mapel->nama_mata_pelajaran }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endforeach
                                                                @if (count($data->mapels) == 1)
                                                                    <div class="mb-3">
                                                                        <label for="mapel_id_2"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                            Mata Pelajaran 2 (opsional)
                                                                        </label>
                                                                        <select id="mapel_id_2" name="mapel_id_2"
                                                                            class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                            <option value="">- Optional -
                                                                            </option>
                                                                            @foreach ($mapels as $mapel)
                                                                                <option value="{{ $mapel->id }}">
                                                                                    {{ $mapel->nama_mata_pelajaran }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="grid grid-cols-2 gap-4">
                                                                <div class="mb-3">
                                                                    <label for="username"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Username
                                                                    </label>
                                                                    <input type="text" name="username" id="username"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Email Siswa"
                                                                        value="{{ $data->username }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Password
                                                                    </label>
                                                                    <input type="text" name="password" id="password"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Password Siswa" required>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="w-full text-white mt-3 bg-violet-600 border-transparent btn">
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
                                                            menghapus data {{ $data->nama }}</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.guru.destroy', ['guru' => $data]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full text-white bg-red-600 border-transparent btn">
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
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

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
                            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-100">
                                Aktivasi Semua Akun Guru!</h3>
                            <form action="{{ route('admin.guru.aktivasi_all', ['id' => $tahun_ajaran_id]) }}"
                                method="POST" enctype="multipart/form-data">
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

    {{-- Modal Deaktivation All --}}
    <div class="relative z-50 hidden modal" id="modal-id_deaktivation_all" aria-labelledby="modal-title" role="dialog"
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
                            <div class="mx-auto p-3 bg-red-50 rounded-full text-red-500 font-medium w-fit mb-3">
                                <i class='bx bxs-user-account text-[40px]'></i>
                            </div>
                            <h3 class=" text-xl font-medium text-gray-700 dark:text-gray-100">
                                Deaktivasi Semua Akun Guru!</h3>
                            <form action="{{ route('admin.guru.deaktivasi_all', ['id' => $tahun_ajaran_id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <button type="submit"
                                    class="mt-3 w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300">
                                    Deaktivasi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Deaktivation All --}}



    <script>
        document.getElementById('btn-download').addEventListener('click', () => {
            const workbook = XLSX.utils.book_new();
            const tableInputGuru = document.getElementById('template-input');
            const worksheetGuru = XLSX.utils.table_to_sheet(tableInputGuru);
            XLSX.utils.book_append_sheet(workbook, worksheetGuru, 'Template Input Guru');
            XLSX.writeFile(workbook, `template-input-guru.xlsx`);
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
@endsection
