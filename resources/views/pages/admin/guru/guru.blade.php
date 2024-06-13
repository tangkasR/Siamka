@extends('layouts.dashboard')
@section('table-name', 'Data Guru')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card  dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="grid md:grid-cols-3 items-start md:gap-3 gap-5">
                        <div>
                            <label for="file"
                                class="block mb-3 text-lg font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
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
                                        <th>Pastikan tidak typo</th>
                                        <th></th>
                                        <th></th>
                                        <th>Password: tanggal lahir</th>
                                        <th>Format password</th>
                                        <th>tanggal bulan tahun</th>
                                        <th>02022002</th>
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
                            <label class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                                for="file">Tambah Data Guru</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file" type="file" name="file" required>
                            <button type="submit" class="mt-3 w-full text-white bg-violet-500 border-transparent btn">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    No</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nama</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Mata Pelajaran</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Jabatan</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nomor Induk Yayasan</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Username</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->nama }}</td>
                                    <td class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        @foreach ($data->mapels as $mapel)
                                            {{ $loop->iteration }}. {{ $mapel->nama_mata_pelajaran }} <br>
                                        @endforeach
                                    </td>
                                    <td class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->jabatan }}</td>
                                    <td class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->nomor_induk_yayasan }}</td>
                                    <td class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->username }}</td>
                                    <td
                                        class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600 min-w-[250px] w-[250px]">
                                        <div class="grid grid-cols-2 gap-2">
                                            <a class="btn-show "
                                                href="{{ route('admin.guru.detail_guru', ['id' => $data->id]) }}">
                                                <i class='bx bx-show'></i> Detail</a>
                                            <a class="btn-edit" data-tw-toggle="modal"
                                                data-tw-target="#modal-id_form_edit_{{ $data->id }}"><i
                                                    class='bx bxs-edit'></i> Ubah</a>
                                            <a class="btn-delete" data-tw-toggle="modal"
                                                data-tw-target="#modal-id_form_destroy_{{ $data->id }}">
                                                <i class='bx bx-trash'></i> Hapus</a>
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
                                                            Data Guru</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.guru.update', ['id' => $data->id]) }}"
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
