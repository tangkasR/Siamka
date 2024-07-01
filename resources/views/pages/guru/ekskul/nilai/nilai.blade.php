@extends('layouts.dashboard')
@section('table-name')
    <span class="capitalize">Daftar Nilai Ekskul {{ $ekskul->nama_ekskul }} rombel {{ $rombel }}</span>
@endsection
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('guru.show_ekskul', ['tahun' => $tahun, 'semester' => $semester]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div
                    class="card-body border-b border-gray-100 dark:border-zinc-600 pt-6 md:flex justify-between md:items-center">
                    <h1 class="md:mb-0 mb-6 text-[18px] font-medium capitalize leading-7">Tahun Ajaran
                        {{ str_replace('-', '/', $tahun) }},
                        Semester
                        {{ $semester }}</h1>
                    <a type="submit"
                        href="{{ route('guru.tambah_nilai', ['rombel' => $rombel, 'tahun_ajaran_id' => Crypt::encrypt($tahun_ajaran_id), 'ekskul' => $ekskul]) }}"
                        class=" md:w-fit justify-center md:mt-0 mt-6 cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md flex items-center gap-2">
                        <span>Tambah Data</span> <i class='bx bxs-plus-circle text-[25px]'></i>
                    </a>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100 capitalize">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="p-4">
                                    No</th>
                                <th class="p-4">
                                    Nama Siswa</th>
                                <th class="p-4">
                                    Rombel</th>
                                <th class="p-4">
                                    Nama Ekskul</th>
                                <th class="p-4">
                                    Semester</th>
                                <th class="p-4">
                                    Nilai</th>
                                <th class="p-4">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilais as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4 ">
                                        {{ $data->nama }}</td>
                                    <td class="p-4 ">
                                        {{ $data->nama_rombel }}</td>
                                    <td class="p-4 ">
                                        {{ $data->nama_ekskul }}</td>
                                    <td class="p-4 ">
                                        {{ $semester }}</td>
                                    <td class="p-4 font-bold">
                                        @if ($data->nilai == 'Amat Baik')
                                            <span class="text-[#007BFF]">{{ $data->nilai }}</span>
                                        @endif
                                        @if ($data->nilai == 'Baik')
                                            <span class="text-[#0047AB]">{{ $data->nilai }}</span>
                                        @endif
                                        @if ($data->nilai == 'Cukup')
                                            <span class="text-[#808080]">{{ $data->nilai }}</span>
                                        @endif
                                    </td>
                                    <td class="p-4  ">
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
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block text-red-500 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_form_destroy_{{ $loop->iteration }}">
                                                        <i class='bx bx-trash'></i> Hapus</a>
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
                                                            <div class="mb-6">
                                                                <label for=""
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nilai
                                                                </label>
                                                                <select name="nilai"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    required>
                                                                    <option value="Amat Baik"
                                                                        {{ $data->nilai == 'Amat Baik' ? 'selected' : '' }}>
                                                                        Amat Baik</option>
                                                                    <option value="Baik"
                                                                        {{ $data->nilai == 'Baik' ? 'selected' : '' }}>Baik
                                                                    </option>
                                                                    <option value="Cukup"
                                                                        {{ $data->nilai == 'Cukup' ? 'selected' : '' }}>
                                                                        Cukup</option>
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
