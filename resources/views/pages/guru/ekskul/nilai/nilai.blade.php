@extends('layouts.dashboard')
@section('table-name')
    <span class="capitalize">Daftar Nilai Ekskul {{ $ekskul->nama_ekskul }}</span>
@endsection
@section('table-role', 'Guru')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 pt-6">
                    <div class="grid md:grid-cols-12">
                        <div class="md:col-span-2">
                            <h6 class=" text-gray-600 text-[16px] font-medium dark:text-gray-100">
                                Tambah Nilai Semua Siswa
                            </h6>
                            <a href="{{ route('guru.tambah_nilai', ['ekskul_id' => $ekskul->id]) }}"
                                class="mt-3 text-white bg-violet-500 border-transparent btn w-full">
                                Tambah Nilai Semua Siswa
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100 capitalize">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    No</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nama Siswa</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nama Ekskul</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Semester</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nilai</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilais as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4 border border-t-0 border-l-0  border-gray-200 dark:border-zinc-600">
                                        {{ $data->nama }}</td>
                                    <td class="p-4 border border-t-0 border-l-0  border-gray-200 dark:border-zinc-600">
                                        {{ $data->nama_ekskul }}</td>
                                    <td class="p-4 border border-t-0 border-l-0  border-gray-200 dark:border-zinc-600">
                                        {{ $data->semester }}</td>
                                    <td class="p-4 border border-t-0 border-l-0  border-gray-200 dark:border-zinc-600">
                                        {{ $data->nilai }}</td>
                                    <td
                                        class="p-4 border  border-t-0 border-l-0 border-gray-200 dark:border-zinc-600 min-w-[300px] w-[300px]">
                                        <div class="grid grid-cols-2 gap-4">
                                            <a class="btn-edit " data-tw-toggle="modal"
                                                data-tw-target="#modal-id_form_edit_{{ $data->id }}"><i
                                                    class='bx bxs-edit'></i> Ubah Data</a>
                                            <a class="btn-delete" data-tw-toggle="modal"
                                                data-tw-target="#modal-id_form_destroy_{{ $data->id }}"><i
                                                    class='bx bxs-edit'></i> Hapus Data</a>
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
                                                            Nilai Siswa</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('guru.nilai_ekskul.update', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for=""
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama Siswa
                                                                </label>
                                                                <input type="text" name="" id=""
                                                                    name="nama_siswa"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Ekskul"
                                                                    value="{{ $data->nama }}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for=""
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama Ekskul
                                                                </label>
                                                                <input type="text" name="" id=""
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Ekskul"
                                                                    value="{{ $data->nama_ekskul }}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for=""
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nilai
                                                                </label>
                                                                <input type="text" id="" name="nilai"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Ekskul"
                                                                    value="{{ $data->nilai }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="semester"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Semester
                                                                </label>
                                                                <select id="semester" name="semester"
                                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                                    required>
                                                                    <option value="">Pilih Semester</option>
                                                                    <option value="1"
                                                                        {{ $data->semester == '1' ? 'selected' : '' }}>
                                                                        Semester 1</option>
                                                                    <option value="2"
                                                                        {{ $data->semester == '2' ? 'selected' : '' }}>
                                                                        Semester 2</option>
                                                                    <option value="3"
                                                                        {{ $data->semester == '3' ? 'selected' : '' }}>
                                                                        Semester 3</option>
                                                                    <option value="4"
                                                                        {{ $data->semester == '4' ? 'selected' : '' }}>
                                                                        Semester 4</option>
                                                                    <option value="5"
                                                                        {{ $data->semester == '5' ? 'selected' : '' }}>
                                                                        Semester 5</option>
                                                                    <option value="6"
                                                                        {{ $data->semester == '6' ? 'selected' : '' }}>
                                                                        Semester 6</option>

                                                                </select>
                                                            </div>
                                                            <button type="submit"
                                                                class="w-full text-white bg-violet-600 border-transparent btn">
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
                                                    <div class="p-10">
                                                        <h3
                                                            class="mb-4 text-[18px] font-medium text-gray-700 dark:text-gray-100">
                                                            Apakah anda ingin
                                                            menghapus <span class="text-red-600">Siswa
                                                                {{ $data->nama }}</span>
                                                            dengan <span class="text-red-600">Nilai
                                                                {{ $data->nilai }}</span>
                                                            dan <span class="text-red-600">Semester
                                                                {{ $data->semester }}</span>
                                                            di
                                                            ekskul
                                                            <span class="text-red-600">{{ $ekskul->nama_ekskul }}?</span>
                                                        </h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('guru.nilai_ekskul.destroy', ['id' => $data->id]) }}"
                                                            method="GET">
                                                            @csrf
                                                            <input type="text" value="{{ $data->id }} "
                                                                name="ekskul_id" hidden>
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
