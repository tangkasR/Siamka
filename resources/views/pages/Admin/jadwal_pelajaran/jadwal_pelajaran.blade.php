@extends('layouts.dashboard')
@section('table-name', 'Jadwal Pelajaran')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 ">
                    <h5 class="text-slate-800 text-[26px] mb-3">Rombel <span
                            class="text-violet-800 font-bold">{{ $rombel->nama_rombel }}</span></h5>
                    <div class="grid grid-cols-3 mt-6 gap-3">
                        {{-- <form action="/siswa" method="POST" enctype="multipart/form-data"> --}}
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
                            <input hidden type="text" id="nama_rombel_input" value="{{ $rombel->nama_rombel }}">
                            <table id="template-input" hidden>
                                <thead>
                                    <tr>
                                        <th>
                                            hari</th>
                                        <th>
                                            sesi</th>
                                        <th>
                                            mapel</th>
                                        <th>
                                            ruangan</th>
                                        <th>
                                            rombel</th>

                                    </tr>
                                </thead>
                                <tbody id="data_template">
                                    @foreach ($templates as $template)
                                        <tr>
                                            <td>{{ $template['hari'] }}</td>
                                            <td>{{ $template['sesi'] }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $template['rombel'] }}</td>
                                        </tr>
                                    @endforeach
                                    <tr></tr>
                                    <tr></tr>
                                    <tr>
                                        <th>Pilih Mapel -> </th>
                                        @foreach ($mapel as $data_mapel)
                                            <th>
                                                {{ $data_mapel->nama_mata_pelajaran }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        <th>Pilih Ruangan -> </th>
                                        @foreach ($ruangan as $data_ruangan)
                                            <th>
                                                {{ $data_ruangan->nomor_ruangan }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            {{-- end template excel --}}
                        </div>
                        <form action="{{ route('admin.jadwal_pelajaran.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <label for="file"
                                class="block mb-3 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Tambah Data Jadwal Pelajaran
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
                    <table id="" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Sesi</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Senin</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Selasa</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Rabu</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Kamis</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Jumat</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Sabtu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sesi as $item_sesi)
                                <tr>
                                    <td class="  border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        <div class="mb-3 p-4">
                                            {{ $item_sesi->nama_sesi }}
                                        </div>
                                        <hr class="text-[0.5px] w-full opacity-50">
                                        <div class="p-4">
                                            Ruangan
                                        </div>
                                    </td>
                                    @foreach ($jadwal_pelajaran as $data)
                                        @if ($data->sesis->nama_sesi == $item_sesi->nama_sesi)
                                            <td
                                                class="  border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                                <div class="mb-3 p-4">
                                                    {{ $data->mata_pelajarans->nama_mata_pelajaran ?? '-' }}
                                                </div>
                                                <hr class="text-[0.5px] w-full opacity-50">
                                                <div class="p-4">
                                                    {{ $data->ruangans->nomor_ruangan }}
                                                </div>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="py-3 pr-6 flex justify-between">
                    <div></div>
                    <div class="flex flex-col items-end">
                        <h1 class="text-[20px] font-semibold text-gray-500">Hapus Semua Data Jadwal di Rombel
                            {{ $rombel->nama_rombel }}</h1>
                        <a class="cursor-pointer text-white btn w-[100px] mb-3 bg-red-300 border-red-500 hover:bg-red-300 focus:ring ring-red-200 focus:bg-red-600"
                            data-tw-toggle="modal" data-tw-target="#modal-id_form_destroy"><i class='bx bxs-edit'></i>
                            HAPUS</a>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    No</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Hari</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Sesi</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Mata Pelajaran</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Ruangan</th>

                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal_pelajaran as $data)
                                <tr>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $loop->iteration ?? '-' }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->hari }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->sesis->nama_sesi ?? '-' }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->mata_pelajarans->nama_mata_pelajaran ?? '-' }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->ruangans->nomor_ruangan ?? '-' }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        <a class="text-white btn w-[100px] mb-3 bg-violet-500 border-violet-500 hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600"
                                            data-tw-toggle="modal"
                                            data-tw-target="#modal-id_form_edit_{{ $data->id }}"><i
                                                class='bx bxs-edit'></i> Ubah</a>
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
                                                            Data Jadwal Pelajaran</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.jadwal_pelajaran.update', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="hari"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Hari
                                                                </label>
                                                                <input type="text" name="hari" id="hari"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Hari"
                                                                    value="{{ $data->hari }}" disabled>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="hari"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Sesi
                                                                </label>
                                                                <input type="text" name="hari" id="hari"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Hari"
                                                                    value="{{ $data->sesis->nama_sesi }}" disabled>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="mata_pelajaran_id"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Mata Pelajaran
                                                                </label>
                                                                <select id="mata_pelajaran_id" name="mata_pelajaran_id"
                                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                    <option value="">-</option>
                                                                    @foreach ($mapel as $item_mapel)
                                                                        <option value="{{ $item_mapel->id }}"
                                                                            {{ $item_mapel->id == $data->mata_pelajaran_id ? 'selected' : '' }}>
                                                                            {{ $item_mapel->nama_mata_pelajaran }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="ruangan_id"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Ruangan
                                                                </label>
                                                                <select id="ruangan_id" name="ruangan_id"
                                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                    <option value="">-</option>
                                                                    @foreach ($ruangan as $item_ruangan)
                                                                        <option value="{{ $item_ruangan->id }}"
                                                                            {{ $item_ruangan->id == $data->ruangan_id ? 'selected' : '' }}>
                                                                            {{ $item_ruangan->nomor_ruangan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="mb-3">
                                                                    <label for="hari"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Rombongan Belajar
                                                                    </label>
                                                                    <input type="text" name="hari" id="hari"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Nama Hari"
                                                                        value="{{ $rombel->nama_rombel }}" disabled>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="w-full text-white bg-green-600 border-transparent btn">
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
                            @endforeach
                        </tbody>
                    </table>
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
                                Apakah Anda ingin menghapus semua jadwal <br> Rombel {{ $rombel->nama_rombel }}</h3>
                            <form class="space-y-4"
                                action="{{ route('admin.jadwal_pelajaran.destroy', ['id' => $rombel->id]) }}"
                                method="GET">
                                @csrf
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


    <script>
        const nama_rombel = document.getElementById('nama_rombel_input').value
        document.getElementById('btn-download').addEventListener('click', () => {
            TableToExcel.convert(document.getElementById("template-input"), {
                name: `template-input-jadwal-pelajaran-${nama_rombel}.xlsx`,
                sheet: {
                    name: `Sheet template-input-jadwal-pelajaran-${nama_rombel}`
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
                    stack: false
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
                    stack: false
                })
            });
        </script>
    @endif

@endsection
