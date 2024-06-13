@extends('layouts.dashboard')
@section('table-name', 'Data Siswa')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <h5 class="text-slate-800 text-[20px] leading-10 font-medium m-0">Daftar Siswa Rombel <span
                            class="text-violet-800 font-bold">{{ $rombel->nama_rombel }}</span></h5>
                    <p class="text-slate-800 text-[16px] mb-3 leading-10 font-medium">{{ $tanggal }}</p>

                    <div class="grid md:grid-cols-12 mt-6 gap-3">
                        <div class="md:mb-0 mb-3 md:col-span-4">
                            <label for="file"
                                class="block mb-3 text-[16px] font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Template Excel
                            </label>
                            <button id="btn-download" type="button"
                                class=" w-full text-white bg-gray-600 border-transparent btn">
                                Download
                            </button>
                            {{-- template excel --}}
                            <input hidden type="text" id="nama_rombel_input" value="{{ $rombel->nama_rombel }}">
                            <table id="template-input" hidden>
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
                                        <th>
                                            rombongan_belajar</th>
                                        <th>
                                            tahun_pembelajaran</th>
                                        <th></th>
                                        <th></th>
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
                                        <td>{{ $rombel->nama_rombel }}</td>
                                        <td>{{ $tahun_pembelajaran }}</td>
                                        <td></td>
                                        <td></td>
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
                        <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data"
                            class="md:mb-0 mb-6 md:col-span-4">
                            @csrf
                            <label class="block mb-2 text-[16px] font-medium text-gray-900 dark:text-white"
                                for="file">Tambah Data Siswa</label>
                            <input
                                class="block w-full text-[16px] text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file" type="file" name="file" required>
                            <button type="submit" class="mt-3 w-full text-white bg-violet-500 border-transparent btn">
                                Simpan
                            </button>
                        </form>
                        @if (explode(' ', $rombel->nama_rombel)[0] != 'XII')
                            <div class="md:mb-0 mb-3 md:col-span-4">
                                <div
                                    class="max-w-[400px] text-left bg-slate-50 border-slate-400 rounded-lg shadow-md border-[0.5px] p-6">
                                    <label for="naik_kelas"
                                        class="block mb-4 text-[16px] font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Menaikkan semua siswa ke Kelas <span id="classname_container"></span>
                                    </label>
                                    <a data-tw-toggle="modal" data-tw-target="#modal_naik_kelas"
                                        class=" text-white px-5 cursor-pointer border-transparent py-2 rounded-md hover:bg-blue-300 bg-red-500">
                                        Naik Kelas
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="md:mb-0 mb-3 md:col-span-4">
                                <div
                                    class="max-w-[400px] text-right bg-slate-50 border-slate-400 rounded-lg shadow-md border-[0.5px] p-6">
                                    <label for="naik_kelas"
                                        class="block mb-4 text-[16px] font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Meluluskan semua siswa di kelas {{ $rombel->nama_rombel }}
                                    </label>
                                    <a data-tw-toggle="modal" data-tw-target="#modal_lulus"
                                        class=" text-white px-5 cursor-pointer border-transparent py-2 rounded-md hover:bg-blue-300 bg-red-500">
                                        Luluskan
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3 md:gap-5">
                        <div class="md:col-span-2">
                            <label for=""
                                class="block mb-3 text-[16px] font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Aktivasi Akun
                            </label>
                            <a href="{{ route('admin.siswa.tambah_aktivasi', ['id' => $rombel->id]) }}"
                                class=" w-full text-white bg-gray-600 border-transparent btn">
                                Aktivasi
                            </a>
                        </div>
                        <div class="md:col-span-2">
                            <label for=""
                                class="block mb-3 text-[16px] font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Deaktivasi Akun
                            </label>
                            <a data-tw-toggle="modal" data-tw-target="#modal-id_form_deaktivasi"
                                class=" w-full text-white bg-red-600 border-transparent btn cursor-pointer">
                                Deaktivasi
                            </a>
                        </div>
                    </div>

                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    No</th>
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nama</th>
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    NIS</th>
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    NISN</th>
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nomor Id</th>
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Tahun Pembelajaran</th>
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Username</th>
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Status Siswa</th>
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Status Akun</th>
                                <th class="p-4  border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4  border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4  border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->nama }}</td>

                                    <td class="p-4  border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->nis }}</td>
                                    <td class="p-4  border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->nisn }}</td>
                                    <td class="p-4  border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->nomor_id }}</td>
                                    <td class="p-4  border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->tahun_awal }}/{{ $data->tahun_akhir }}</td>
                                    <td class="p-4  border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->username }}</td>
                                    <td class="p-4  border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->status_siswa }}</td>
                                    <td class="p-4  border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->aktivasi_akun }}</td>
                                    <td
                                        class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600 min-w-[150px] ">
                                        <div class="relative dropdown min-w-[150px]">
                                            <button type="button"
                                                class="py-2 font-medium leading-tight text-white bg-gray-500 border border-gray-500 shadow-md btn dropdown-toggle shadow-gray-100 dark:shadow-zinc-600 hover:bg-gray-600 focus:bg-gray-600 focus:ring focus:ring-gray-200 focus:ring-gray-500/20"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"><i
                                                    class="text-lg align-middle bx bx-hive ltr:mr-2 rtl:ml-2"></i>Pilih Aksi
                                                <i class="mdi mdi-chevron-down "></i></button>

                                            <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                                aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        href="{{ route('admin.siswa.detail_siswa', ['id' => $data->id]) }}"><i
                                                            class="text-lg align-middle bx bx-show ltr:mr-2 rtl:ml-2"></i>Detail
                                                        Siswa</a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_form_edit_{{ $data->id }}"><i
                                                            class="text-lg align-middle bx bxs-edit ltr:mr-2 rtl:ml-2"></i>
                                                        Ubah</a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_move_class_{{ $data->id }}"><i
                                                            class="text-lg align-middle bx bxs-right-arrow-circle ltr:mr-2 rtl:ml-2"></i>Pidah
                                                        Kelas</a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_single_deaktivation_{{ $data->id }}"><i
                                                            class="text-lg align-middle bx bx-block ltr:mr-2 rtl:ml-2"></i>Deaktivasi</a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_form_destroy_{{ $data->id }}"><i
                                                            class="text-lg align-middle bx bx-trash ltr:mr-2 rtl:ml-2"></i>Hapus</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <div class="relative z-50 hidden modal" id="modal-id_form_edit_{{ $data->id }}"
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
                                                            Data Siswa <span
                                                                class="text-violet-700">{{ $data->nama }}</span></h3>
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
                                                                    <label for="status_siswa"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Status Siswa
                                                                    </label>
                                                                    <input type="text" name="status_siswa"
                                                                        id="status_siswa"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan statu Siswa"
                                                                        value="{{ $data->status_siswa }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 grid grid-cols-2 gap-3">
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
                                                                <div>
                                                                    <label for="password"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Password
                                                                    </label>
                                                                    <input type="text" name="password" id="password"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        value="{{ $data->nomor_id }}"
                                                                        placeholder="Masukan Password Siswa" required>
                                                                </div>
                                                            </div>
                                                            <div class="mt-6 mb-3 flex gap-3 items-center">
                                                                <input type="checkbox" value=""
                                                                    class="cursor-pointer align-middle rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                                    id="ketentuan" required>
                                                                <label for="ketentuan"
                                                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Pastikan semua data yang diisi sudah benar! <br>
                                                                    Siswa yang <span
                                                                        class="text-red-600 text-[16px] font-bold">status
                                                                        siswanya dirubah</span> tidak dapat
                                                                    dikembalikan statusnya lagi!
                                                                </label>
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

                                {{-- Modal Pindah Kelas --}}
                                <div class="relative z-50 hidden modal" id="modal-id_move_class_{{ $data->id }}"
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
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $rombel->nama_rombel == $item->nama_rombel ? 'selected' : '' }}>
                                                                            {{ $item->nama_rombel }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tahun_pembelajaran"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Tahun Pembelajaran
                                                                </label>
                                                                <input type="text" name="tahun_pembelajaran"
                                                                    id="tahun_pembelajaran"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    value="{{ $data->tahun_awal }}/{{ $data->tahun_akhir }}"
                                                                    required>
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
                                {{-- End Modal Pindah Kelas --}}

                                {{-- Modal Destroy --}}
                                <div class="relative z-50 hidden modal" id="modal-id_form_destroy_{{ $data->id }}"
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
                                                                class="text-red-500">{{ $data->nama }}</span></h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.siswa.destroy', ['id' => $data->id]) }}"
                                                            method="GET">
                                                            @csrf
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

                                {{-- Modal Single Deaktivasi --}}
                                <div class="relative z-50 hidden modal"
                                    id="modal-id_single_deaktivation_{{ $data->id }}" aria-labelledby="modal-title"
                                    role="dialog" aria-modal="true">
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
                                                            method="GET">
                                                            <h3
                                                                class="my-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                                Apakah anda ingin
                                                                mendeaktivasi siswa <span
                                                                    class="text-red-500">{{ $data->nama }}</span>
                                                            </h3>
                                                            @csrf
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Naik Kelas --}}
    <div class="relative z-50 hidden modal" id="modal_naik_kelas" aria-labelledby="modal-title" role="dialog"
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
                        <div class="py-5 px-10">
                            <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                Apakah anda ingin
                                menaikan siswa di rombel <span
                                    class="font-bold text-red-600">{{ $rombel->nama_rombel }}</span></h3>
                            <form class="space-y-4" action="{{ route('admin.siswa.next_grade', ['id' => $rombel->id]) }}"
                                method="POST">
                                @csrf
                                <div>
                                    <label for="target_rombel_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Pindah Ke Rombel:
                                    </label>
                                    <select id="target_rombel_id" name="target_rombel_id"
                                        class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                        @foreach ($rombels as $data_rombel)
                                            @if (explode(' ', $rombel->nama_rombel)[0] == 'X')
                                                @if (explode(' ', $data_rombel->nama_rombel)[0] == 'XI' &&
                                                        explode(' ', $data_rombel->nama_rombel)[1] == explode(' ', $rombel->nama_rombel)[1]
                                                )
                                                    <option value="{{ $data_rombel->id }}" selected>
                                                        {{ $data_rombel->nama_rombel }}
                                                    </option>
                                                    <input type="text" class="next_class_name"
                                                        value="{{ $data_rombel->nama_rombel }}" hidden>
                                                @endif
                                            @endif
                                        @endforeach
                                        @foreach ($rombels as $data_rombel)
                                            @if (explode(' ', $rombel->nama_rombel)[0] == 'XI')
                                                @if (explode(' ', $data_rombel->nama_rombel)[0] == 'XII' &&
                                                        explode(' ', $data_rombel->nama_rombel)[1] == explode(' ', $rombel->nama_rombel)[1]
                                                )
                                                    <option value="{{ $data_rombel->id }}" selected>
                                                        {{ $data_rombel->nama_rombel }}
                                                    </option>
                                                    <input type="text" class="next_class_name"
                                                        value="{{ $data_rombel->nama_rombel }}" hidden>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="tahun_pembelajaran"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Tahun Pembelajaran
                                    </label>
                                    <input type="text" name="tahun_pembelajaran" id="tahun_pembelajaran"
                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                        value="{{ $tahun_pembelajaran }}" required>
                                </div>
                                <button type="submit" class="w-full text-white bg-red-600 border-transparent btn">
                                    Naik Kelas
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Naik Kelas --}}

    {{-- Modal Lulus --}}
    <div class="relative z-50 hidden modal" id="modal_lulus" aria-labelledby="modal-title" role="dialog"
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
                        <div class="py-5 px-10">
                            <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                Apakah anda ingin
                                meluluskan siswa sebelumnya di rombel <span
                                    class="font-bold text-red-600">{{ $rombel->nama_rombel }}</span></h3>
                            <form class="space-y-4" action="{{ route('admin.siswa.lulus', ['id' => $rombel->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="w-full text-white bg-red-600 border-transparent btn">
                                    Lulus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Lulus --}}

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
                                action="{{ route('admin.siswa.deaktivasiAll', ['id' => $rombel->id]) }}" method="GET">
                                <h3 class="mt-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                    Apakah anda ingin
                                    mendeaktivasi semua akun siswa di rombel <span
                                        class="font-bold text-red-600">{{ $rombel->nama_rombel }}</span></h3>
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



    <script>
        const nama_rombel = document.getElementById('nama_rombel_input').value
        document.getElementById('btn-download').addEventListener('click', () => {
            const workbook = XLSX.utils.book_new();
            const tableInputSiswa = document.getElementById('template-input');
            const worksheetSiswa = XLSX.utils.table_to_sheet(tableInputSiswa);
            XLSX.utils.book_append_sheet(workbook, worksheetSiswa, 'Template Input Siswa');
            XLSX.writeFile(workbook, `template-input-siswa-${nama_rombel}.xlsx`);
        })

        const nextClass = document.querySelectorAll('.next_class_name')
        const classNameContainer = document.getElementById('classname_container')
        nextClass.forEach(data => {
            classNameContainer.innerHTML = `${data.value}`;
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
