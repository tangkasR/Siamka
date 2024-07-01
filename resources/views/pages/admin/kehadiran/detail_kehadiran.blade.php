@extends('layouts.dashboard')
@section('table-name')
    <span class="capitalize">
        Data Kehadiran {{ $rombel->nama_rombel }} - {{ str_replace('-', '/', $tahun) }} -
        {{ $semester }}</span>
@endsection
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.kehadiran.show_kehadiran', ['tahun' => $tahun, 'semester' => $semester]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="bg-white shadow-md">
        <div class="">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="relative overflow-x-auto card-body">
                    <div class="mb-4 md:flex md:justify-between md:items-center">
                        <div class="md:mb-0 mb-6">
                            <h6 class="mb-3 text-gray-700 text-[16px] dark:text-gray-100 font-medium leading-7">Menampilkan
                                daftar
                                kehadiran siswa tanggal {{ $tanggal }}
                            </h6>
                        </div>
                        <div class=" md:flex md:gap-4 md:items-center">
                            <a type="submit"
                                href="{{ route('admin.kehadiran.show_input', ['tahun' => $tahun, 'semester' => $semester, 'id' => $rombel->id]) }}"
                                class="md:mb-0 mb-4 md:w-fit w-full md:mt-0 mt-6 cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md flex items-center justify-center gap-2">
                                <span>Tambah Data</span> <i class='bx bxs-plus-circle text-[25px]'></i>
                            </a>
                            <form
                                action="{{ route('admin.kehadiran.detail_kehadiran', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}"
                                method="GET">
                                <input onchange="this.form.submit()"
                                    class="md:w-[200px] w-full border-gray-100 rounded placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                    type="date" name="tanggal">
                                <noscript><input type="submit" value="Submit"></noscript>
                            </form>
                        </div>
                    </div>
                    <div>
                        <table class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                            <thead>
                                <tr class="bg-blue-200">
                                    <th class="p-4 ">
                                        Nama Siswa</th>
                                    <th class="p-4 ">
                                        Kehadiran</th>
                                    <th class="p-4 ">
                                        Tanggal</th>
                                    <th class="p-4 ">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kehadirans as $data)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                        <td class="p-4">
                                            {{ $data->nama }}</td>
                                        <td class="p-4 ${text_color}">
                                            @if ($data->kehadiran == 'hadir')
                                                <span class="text-green-400 font-semibold">{{ $data->kehadiran }}</span>
                                            @endif
                                            @if ($data->kehadiran == 'sakit')
                                                <span class="text-blue-400 font-semibold">{{ $data->kehadiran }}</span>
                                            @endif
                                            @if ($data->kehadiran == 'izin')
                                                <span class="text-slate-400 font-semibold">{{ $data->kehadiran }}</span>
                                            @endif
                                            @if ($data->kehadiran == 'alpa')
                                                <span class="text-red-400 font-semibold">{{ $data->kehadiran }}</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            {{ $data->tanggal }}</td>
                                        <td class="p-4">
                                            <div class="relative dropdown ">
                                                <button type="button"
                                                    class="py-2 font-medium leading-tight  dropdown-toggle"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"><i
                                                        class='bx bx-menu text-[20px]'></i></button>
                                                <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                                    aria-labelledby="dropdownMenuButton1"
                                                    data-popper-placement="bottom-start"
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

                                    <div class="relative z-50 hidden modal" id="modal-id_form_edit_{{ $loop->iteration }}"
                                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                        <div class="fixed inset-0 z-50 overflow-y-auto">
                                            <div
                                                class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
                                            </div>
                                            <div class="p-4 mx-auto animate-translate sm:max-w-lg">
                                                <div
                                                    class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                                                    <div class="bg-white dark:bg-zinc-700 py-6 px-10">
                                                        <div class="">
                                                            <h3
                                                                class="mb-2 text-[24px] font-semibold text-gray-700 dark:text-gray-100">
                                                                Ubah
                                                                Data Kehadiran <span
                                                                    class="capitalize text-violet-500">{{ $data->nama }}</span>
                                                            </h3>
                                                            <p class="text-sm font-medium text-gray-600">Tanggal:
                                                                {{ $tanggal }}
                                                            </p>
                                                        </div>
                                                        <form class="mt-6"
                                                            action="{{ route('guru.kehadiran.update', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="text" value="{{ $rombel->id }}"
                                                                name="rombel_id" hidden>
                                                            <input type="text" value="{{ $tahun }}"
                                                                name="tahun" hidden>
                                                            <input type="text" value="{{ $semester }}"
                                                                name="semester" hidden>

                                                            <input type="text" name="siswa_id" id="siswa_id"
                                                                class="" value="{{ $data->siswa_id }}" hidden>
                                                            <div class="grid grid-cols-12 gap-4 items-center ">
                                                                <div class=" col-span-6">
                                                                    <label for="nama_siswa"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Nama Siswa
                                                                    </label>
                                                                    <input type="text"
                                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                        placeholder="Masukan Nama Rombongan Belajar"
                                                                        value="{{ $data->nama }}" disabled>

                                                                </div>
                                                                <div class="form-check col-span-6">
                                                                    <div>
                                                                        <label class=" text-gray-700 dark:text-zinc-100"
                                                                            for="daftar_kehadiran">
                                                                            Kehadiran</label>
                                                                        <select id="daftar_kehadiran"
                                                                            name="daftar_kehadiran"
                                                                            class="dark:bg-zinc-800  dark:border-zinc-700 w-full mt-2 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                            <option value="hadir"
                                                                                {{ $data->kehadiran == 'hadir' ? 'selected' : '' }}>
                                                                                Hadir</option>
                                                                            <option value="sakit"
                                                                                {{ $data->kehadiran == 'sakit' ? 'selected' : '' }}>
                                                                                Sakit</option>
                                                                            <option value="izin"
                                                                                {{ $data->kehadiran == 'izin' ? 'selected' : '' }}>
                                                                                Izin</option>
                                                                            <option value="alpa"
                                                                                {{ $data->kehadiran == 'alpa' ? 'selected' : '' }}>
                                                                                Alpa</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="mt-6">
                                                                <button type="submit"
                                                                    class=" w-full text-white bg-blue-600 border-transparent btn">
                                                                    Simpan
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
