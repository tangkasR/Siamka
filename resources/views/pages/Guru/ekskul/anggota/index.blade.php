@extends('layouts.dashboard')
@section('table-name')
    <span class="capitalize">Daftar Anggota</span>
@endsection
@section('table-role', 'Guru')
@section('content')
    <div class="grid md:grid-cols-12 gap-6 bg-white shadow-md">
        <div class="md:col-span-8 order-last md:order-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 pt-6">
                    <div class=" grid md:grid-cols-12 md:gap-4">
                        <div class="md:col-span-3">
                            <h6 class=" text-gray-600 text-[16px] font-medium dark:text-gray-100">
                                Tambah Anggota Siswa
                            </h6>
                            <a href="{{ route('guru.ekskul.daftar_rombel', ['id' => $id]) }}"
                                class="mt-3 text-white bg-violet-500 border-transparent btn w-full">
                                Tambah Anggota
                            </a>
                        </div>
                        {{-- <div class="md:col-span-3">
                            <h6 class=" text-gray-600 text-[16px] font-medium dark:text-gray-100 capitalize">
                                Daftar Nilai Ekskul {{ $ekskul->nama_ekskul }}
                            </h6>
                            <a href="{{ route('guru.nilai_ekskul', ['ekskul_id' => $ekskul->id]) }}"
                                class="mt-3 text-white bg-gray-800 border-transparent btn w-full">
                                Daftar Nilai
                            </a>
                        </div> --}}
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
                                    Status</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4 border border-t-0 border-l-0  border-gray-200 dark:border-zinc-600">
                                        {{ $data->nama }}</td>
                                    <td class="p-4 border border-t-0 border-l-0  border-gray-200 dark:border-zinc-600">
                                        {{ $data->status }}</td>
                                    <td
                                        class="p-4 border  border-t-0 border-l-0 border-gray-200 dark:border-zinc-600 min-w-[350px] w-[350px] ">
                                        <div class="grid grid-cols-2 gap-2 ">
                                            <a class="btn-edit" data-tw-toggle="modal"
                                                data-tw-target="#modal-id_form_edit_{{ $data->id }}"><i
                                                    class='bx bxs-edit'></i> Ubah Status</a>
                                            <a class="btn-delete" data-tw-toggle="modal"
                                                data-tw-target="#modal-id_form_destroy_{{ $data->id }}">
                                                <i class='bx bx-trash'></i> Keluarkan Siswa</a>
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
                                                            Status Siswa</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('guru.ekskul.change_status') }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for=""
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama Siswa
                                                                </label>
                                                                <input type="text" name="" id=""
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Ekskul"
                                                                    value="{{ $data->nama }}" readonly>
                                                                <input type="text" value="{{ $data->id }}"
                                                                    name="siswa_id" hidden>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for=""
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama Ekskul
                                                                </label>
                                                                <input type="text" name="" id=""
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Ekskul"
                                                                    value="{{ $ekskul->nama_ekskul }}" readonly>
                                                                <input type="text" value="{{ $ekskul->id }}"
                                                                    name="ekskul_id" hidden>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Status
                                                                </label>
                                                                <input type="text" name="status" id="status"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Ekskul"
                                                                    value="{{ $data->status }}" required>
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
                                                            class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                            Apakah anda ingin
                                                            mengeluarkan data <span
                                                                class="text-red-600">{{ $data->nama }}</span> dari
                                                            ekskul
                                                            <span class="text-red-600">{{ $ekskul->nama_ekskul }}</span>
                                                        </h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('guru.ekskul.delete_member', ['id' => $data->id]) }}"
                                                            method="GET">
                                                            @csrf
                                                            <input type="text" value="{{ $ekskul->id }}"
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
        <div class="md:col-span-4 md:order-2">
            <div
                class=" relative mx-auto max-w-md rounded-lg bg-gradient-to-tr from-pink-300 to-blue-300 p-0.5 border-violet-300 ">
                <div class="bg-white p-7 rounded-md">
                    <span
                        class="flex justify-center items-center h-48 w-48 place-items-center rounded-md  duration-300  text-violet-100 ">
                        <img src="{{ asset('assets/img/img-ekskul.png') }}" alt="">
                    </span>
                    <form class="space-y-4" action="{{ route('guru.ekskul.update', ['id' => $ekskul->id]) }}"
                        method="POST">
                        @csrf
                        <h1 class="font-medium text-[20px]  capitalize">Nama Ekstrakurikuler</h1>
                        <input
                            style="background-color: rgb(240, 237, 250); margin-top: 3px !important;margin-bottom: 0px !important"
                            type="text" name="nama_ekskul" id="nama_ekskul"
                            class=" border border-violet-600 text-black capitalize font-medium  dark:text-gray-100 text-xl rounded focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5 focus:ring-1"
                            placeholder="Masukan Nama Ekskul" value="{{ $ekskul->nama_ekskul }}" required>
                        <h1 class="font-medium text-[16px]  capitalize " style="margin-top: 0 !important;">Pembina Ekskul
                        </h1>
                        <input style="background-color: rgb(240, 237, 250); margin-top: 0px !important" type="text"
                            name="" id=""
                            class=" border border-violet-600 text-black capitalize font-medium  dark:text-gray-100 text-sm rounded focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5 focus:ring-1"
                            placeholder="Masukan Nama Ekskul" value="{{ $ekskul->gurus->nama }}" readonly>
                        <h1 class="font-medium text-[16px]  capitalize " style="margin-top: 0 !important;">Status Ekskul
                        </h1>
                        <input style="background-color: rgb(240, 237, 250); margin-top: 0px !important" type="text"
                            name="" id=""
                            class=" border border-violet-600 text-black capitalize font-medium  dark:text-gray-100 text-sm rounded focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5 focus:ring-1"
                            placeholder="Masukan Nama Ekskul" value="{{ $ekskul->status }}" readonly>
                        <div class="grid grid-cols-2 text-center gap-4">
                            <button type="submit" class="w-full text-white bg-violet-600 border-transparent btn py-2">
                                <i class='bx bxs-edit'></i> Ubah
                            </button>
                            @if ($ekskul->status == 'aktif')
                                <a class="w-full text-white bg-red-600 border-transparent btn cursor-pointer py-2"
                                    data-tw-toggle="modal" data-tw-target="#modal-id_form_destroy">
                                    <i class='bx bx-trash'></i> Nonaktif</a>
                            @else
                                <a class="w-full text-white bg-gray-600 border-transparent btn cursor-pointer py-2"
                                    data-tw-toggle="modal" data-tw-target="#modal-id_form_aktivasi">
                                    <i class='bx bx-trash'></i> Aktifkan</a>
                            @endif
                        </div>
                    </form>
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
                        <div class="py-5 px-10">
                            <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                Apakah anda ingin
                                menonaktifkan ekskul<br> <span
                                    class="capitalize text-red-600 font-semibold">{{ $ekskul->nama_ekskul }}</span></h3>
                            <form class="space-y-4" action="{{ route('guru.ekskul.destroy', ['id' => $ekskul->id]) }}"
                                method="GET">
                                @csrf
                                <p>Jika anda menonaktifkan ekskul maka <span class="text-red-600 font-medium">status semua
                                        anggota akan
                                        ternonaktifkan!</span></p>
                                <button type="submit" class="w-full text-white bg-red-600 border-transparent btn">
                                    Nonaktif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal End Destroy --}}
    {{-- Modal Aktivasi --}}
    <div class="relative z-50 hidden modal" id="modal-id_form_aktivasi" aria-labelledby="modal-title" role="dialog"
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
                                mengaktifkan ekskul<br> <span
                                    class="capitalize text-black font-semibold">{{ $ekskul->nama_ekskul }}</span></h3>
                            <form class="space-y-4" action="{{ route('guru.ekskul.activate', ['id' => $ekskul->id]) }}"
                                method="GET">
                                @csrf
                                <button type="submit" class="w-full text-white bg-black border-transparent btn">
                                    Aktif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal End Aktivasi --}}
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
