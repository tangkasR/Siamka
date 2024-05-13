@extends('layouts.dashboard')
@section('table-name', 'Guru')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="grid grid-cols-3 mt-6 gap-3">
                        <div>
                            <label for="file"
                                class="block mb-3 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Template Excel Tambah Data
                            </label>
                            <button id="btn-download" type="button"
                                class=" w-full text-white bg-gray-600 border-transparent btn">
                                Download
                            </button>
                            {{-- template excel --}}
                            <table id="template-input" hidden>
                                <thead>
                                    <tr>
                                        <th>nama</th>
                                        <th>nomor_induk</th>
                                        <th>jenis_kelamin</th>
                                        <th>email</th>
                                        <th>password</th>
                                        <th>nama_mapel</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>List Mata Pelajaran</th>
                                        <th>Pilih Mapel</th>
                                        <th></th>
                                        <th></th>
                                        <th>Pilih Jenis Kelamin</th>
                                        <th>Laki-Laki</th>
                                        <th>Perempuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mapel as $item_mapel)
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
                                            <td>{{ $item_mapel->nama_mata_pelajaran }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- end template excel --}}

                        </div>
                        <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="file"
                                class="block mb-3 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Tambah Data Guru
                            </label>
                            <input type="file" name="file"
                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                required>
                            <button type="submit" class="mt-3 w-full text-white bg-violet-500 border-transparent btn">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    No</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Nama</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Nomor Induk</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Jenis Kelamin</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Mata Pelajaran</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Email</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $data)
                                <tr>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->nama }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->nomor_induk }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->jenis_kelamin }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->nama_mata_pelajaran }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->email }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        <a class="text-white btn mb-3 w-[100px] bg-violet-500 border-violet-500 hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600"
                                            data-tw-toggle="modal"
                                            data-tw-target="#modal-id_form_edit_{{ $data->id }}"><i
                                                class='bx bxs-edit'></i> Ubah</a>
                                        <a class="text-white btn w-[100px] bg-red-500 border-red-500 hover:bg-red-600 focus:ring ring-violet-50 focus:bg-red-600"
                                            data-tw-toggle="modal"
                                            data-tw-target="#modal-id_form_destroy_{{ $data->id }}">
                                            <i class='bx bx-trash'></i> Hapus</a>
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
                                                            Data Guru</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.guru.update', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div>
                                                                <label for="mata_pelajaran_id"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Mata Pelajaran
                                                                </label>
                                                                <select name="mata_pelajaran_id"
                                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                    @foreach ($mapel as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $data->nama_mata_pelajaran == $item->nama_mata_pelajaran ? 'selected' : '' }}>
                                                                            {{ $item->nama_mata_pelajaran }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label for="nama"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama
                                                                </label>
                                                                <input type="text" name="nama" id="nama"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Guru"
                                                                    value="{{ $data->nama }}" required>
                                                            </div>
                                                            <div>
                                                                <label for="nomor_induk"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nomor Induk
                                                                </label>
                                                                <input type="text" name="nomor_induk" id="nomor_induk"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nomor Induk Siswa"
                                                                    value="{{ $data->nomor_induk }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jenis_kelamin"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Jenis Kelamin
                                                                </label>
                                                                <select id="jenis_kelamin" name="jenis_kelamin"
                                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                    <option value="Laki-Laki"
                                                                        {{ $data->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                                                        Laki-Laki</option>
                                                                    <option value="Perempuan"
                                                                        {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label for="email"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Email
                                                                </label>
                                                                <input type="text" name="email" id="email"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Email Siswa"
                                                                    value="{{ $data->email }}" required>
                                                            </div>
                                                            <div>
                                                                <label for="password"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Password
                                                                </label>
                                                                <input type="text" name="password" id="password"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Password Siswa" required>
                                                            </div>
                                                            <button type="submit"
                                                                class="w-full text-white mt-3 bg-green-600 border-transparent btn">
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
                                                            menghapus data {{ $data->nama }}</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.guru.destroy', ['id' => $data->id]) }}"
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
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btn-download').addEventListener('click', () => {
            TableToExcel.convert(document.getElementById("template-input"), {
                name: `template-input-guru.xlsx`,
                sheet: {
                    name: `Sheet template-input-guru`
                }
            });
        })
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @if (session('message'))
        <script>
            $(document).ready(function() {
                $.toast({
                    text: `
        <div class="py-2 font-bold text-[14px]">
            {{ Session::get('message') }}
        </div>
        `,
                    showHideTransition: 'slide',
                    // textColor: 'black',
                    icon: 'success',
                    position: 'top-right',
                    allowToastClose: false,
                    bgColor: '#00d447',
                    loaderBg: '#6f00ff',
                    hideAfter: 3000,
                })
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            $(document).ready(function() {
                $.toast({
                    text: `
        <div class="py-2 font-bold text-[14px]">
            {{ Session::get('error') }}
        </div>
        `,
                    showHideTransition: 'slide',
                    // textColor: 'black',
                    icon: 'error',
                    position: 'top-right',
                    allowToastClose: false,
                    bgColor: '#fc3b2d',
                    loaderBg: '#6f00ff',
                    hideAfter: 6000,
                })
            });
        </script>
    @endif
@endsection
