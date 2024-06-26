@extends('layouts.dashboard')
@section('table-name')
    @if ($rombel)
        Data Kehadiran Rombel {{ $rombel->nama_rombel }}
    @endif
@endsection
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('tahun_ajaran.index', 'kehadiran') }}" class="flex justify-center items-center"><i
                class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-5 bg-white shadow-md">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            @if ($rombel)
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="flex justify-between items-center">
                        <div class="">
                            <h6 class="mb-3 text-gray-700 text-[16px] dark:text-gray-100 font-medium">Menampilkan daftar
                                kehadiran siswa tanggal {{ $date }}
                            </h6>
                        </div>
                        <div class=" ">
                            <a type="submit"
                                href="{{ route('guru.kehadiran.show_input', ['tahun' => $tahun, 'semester' => $semester, 'id' => $rombel->id]) }}"
                                class=" w-fit md:mt-0 mt-6 cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md flex items-center justify-center gap-2">
                                <span>Tambah Data</span> <i class='bx bxs-plus-circle text-[25px]'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="table capitalize w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="p-4 ">
                                    No</th>
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
                                    <td class="p-4 ">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4 ">
                                        {{ $data->nama }}</td>
                                    <td class="p-4 ">
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
                                    <td class="p-4 ">
                                        {{ $date }}</td>
                                    <td class="p-4  min-w-[150px] w-[150px]">
                                        <a class="font-medium hover:text-blue-500 cursor-pointer" data-tw-toggle="modal"
                                            data-tw-target="#modal-id_form_edit_{{ $loop->iteration }}"><i
                                                class='bx bxs-edit'></i> Ubah</a>
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
                                                            {{ $date }}
                                                        </p>
                                                    </div>
                                                    <form class="mt-6"
                                                        action="{{ route('guru.kehadiran.update', ['id' => $data->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="text" value="{{ $rombel->id }}" name="rombel_id"
                                                            hidden>
                                                        <input type="text" value="{{ $tahun }}" name="tahun"
                                                            hidden>
                                                        <input type="text" value="{{ $semester }}" name="semester"
                                                            hidden>

                                                        <input type="text" name="siswa_id" id="siswa_id" class=""
                                                            value="{{ $data->siswa_id }}" hidden>
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
                                                                    <select id="daftar_kehadiran" name="daftar_kehadiran"
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
            @else
                <div
                    class="card-body border-b border-gray-100 dark:border-zinc-600 flex justify-center items-center min-h-[60vh]">
                    <h1 class="text-lg font-medium capitalize">Anda tidak mengajar sesi 1 hari ini</h1>
                </div>
            @endif
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
