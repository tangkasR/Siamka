@extends('layouts.dashboard')
@section('table-name')
    Mengelola Rombongan Belajar {{ $rombel->nama_rombel }}
@endsection
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.rombel', ['tahun' => $tahun, 'semester' => $semester]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class=" bg-white shadow-md">
        <div class="">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="flex justify-between items-start ">
                        <h1 class="text-[18px] font-medium capitalize">Tahun Ajaran
                            {{ str_replace('-', '/', $tahun) }},
                            Semester
                            {{ $semester }}</h1>

                    </div>
                </div>
                <div class="">
                    <div class="relative overflow-x-auto card-body mb-[50px] h-[100%] flex items-center  gap-10">
                        <div
                            class="max-w-[350px] card hover:scale-98 duration-300 bg-blue-50 border-blue-300 border-2  transition-all">
                            <div class="card-body">
                                <h6 class="mb-3 text-slate-700 text-[20px] dark:text-gray-100 font-bold leading-7">
                                    Mengelola Siswa
                                </h6>
                                <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                    Silahkan kelola siswa dengan menekan tombol dibawah!
                                </p>
                                <div class="">
                                    <a href="{{ route('admin.siswa.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}"
                                        class="hover:bg-blue-700 block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
                                        Pilih
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div
                            class="max-w-[350px] card hover:scale-98 duration-300 bg-blue-50 border-blue-300 border-2  transition-all">
                            <div class="card-body">
                                <h6 class="mb-3 text-slate-700 text-[20px] dark:text-gray-100 font-bold leading-7">
                                    Mengelola Jadwal Pelajaran
                                </h6>
                                <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                    Silahkan kelola jadwal dengan menekan tombol dibawah!
                                </p>
                                <div class="">
                                    <a href="{{ route('admin.jadwal_pelajaran.show_jadwal', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}"
                                        class="hover:bg-blue-700 block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
                                        Pilih
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>=
@endsection
