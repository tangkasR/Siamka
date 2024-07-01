@extends('layouts.dashboard')
@section('table-name', 'Dashboard')
@section('table-role')
    {{ $user->nama }}
@endsection
@section('content')
    @if ($role == 'admin')
        <div class="md:block hidden">
            <div class="grid md:gap-4 md:grid-cols-3 md:p-0 p-4">
                <a href="{{ route('admin.ruangan') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bx-home-alt text-sky-500   text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Ruangan</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola ruangan.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.sesi') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bx-time-five text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Sesi</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola sesi.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.mapel') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bx-book-content text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Mata Pelajaran</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola mata pelajaran.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('tahun_ajaran.index', 'guru') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bxs-user text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Guru</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola guru.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('tahun_ajaran.index', 'rombel') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bx-group text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Rombel</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola rombel.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.pengumuman') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bxs-user-voice text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Pengumuman</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola pengumuman.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <div class="mt-6 md:grid md:grid-cols-2 md:gap-4 md:items-end">
            <div>
                {!! $chart_siswa->container() !!}
            </div>
            <div class="">
                {!! $chart_guru->container() !!}
            </div>
        </div>
        <div class="">
            {!! $chart_jam_kerja->container() !!}
        </div>

        <script src="{{ $chart_siswa->cdn() }}"></script>

        {{ $chart_siswa->script() }}

        <script src="{{ $chart_guru->cdn() }}"></script>

        {{ $chart_guru->script() }}

        <script src="{{ $chart_jam_kerja->cdn() }}"></script>

        {{ $chart_jam_kerja->script() }}
    @endif
    @if ($role == 'guru')
        <div class="min-h-screen md:p-8 p-4">
            <div class="font-semibold flex gap-3 items-center mb-5">
                <div class="rounded-full p-2 bg-blue-100 flex justify-center items-center border">
                    <i class='bx bx-menu text-[25px]'></i>
                </div>
                <span class="text-[20px] block">Menu</span>
            </div>
            <div class="grid gap-8 md:grid-cols-3 md:p-8 p-0">
                <a href="{{ route('tahun_ajaran.index', 'kehadiran') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bx-calendar-alt text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Kehadiran Siswa</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola kehadiran siswa.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('tahun_ajaran.index', 'ekskul') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bx-walk text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Ekstrakurikuler</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola ekstrakurikuler.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('tahun_ajaran.index', 'nilai') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bxs-report text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Nilai Mata Pelajaran</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola nilai mata pelajaran.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('tahun_ajaran.index', 'nilai_ekskul') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bxs-report text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Nilai Ekstrakurikuler</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola nilai ekstrakurikuler.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('pengumuman.show_pengumuman') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bxs-user-voice text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Pengumuman</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk mengelola pengumuman.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('tahun_ajaran.index', 'wali_kelas') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bx-group text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Wali Kelas</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Fitur ini untuk melihat daftar siswa.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="mt-10">
                <div class="font-semibold flex justify-between flex-wrap items-end mb-6 ">
                    <div class="flex gap-3 items-center md:mb-0 mb-6">
                        <div class="rounded-full p-2 bg-blue-100 flex justify-center items-center border">
                            <i class='bx bxs-user-voice text-[25px]  '></i>
                        </div>
                        <span class="text-[20px] block">Pengumuman</span>
                    </div>
                    <div
                        class="py-1 px-2 pl-6 dashboard group flex gap-1 justify-center items-center bg-white  rounded-xl transition-all hover:bg-blue-600 hover:text-white border border-blue-500 text-blue-600">
                        <a href="{{ route('pengumuman.show_pengumuman') }}" class="text-[16px] ">Selengkapnya
                        </a>
                        <i class='bx bx-chevron-right text-[30px]'></i>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-4 gap-4">
                    @foreach ($pengumumans as $data)
                        <div>
                            <a href="{{ route('pengumuman.detail', ['pengumuman' => $data]) }}">
                                <div
                                    class="p-3 pb-6 max-w-lg border transition-all border-violet-300 rounded-2xl hover:shadow-2xl hover:shadow-violet-200 flex flex-col justify-start items-start">
                                    <img src="{{ $data->image != '-' ? asset('storage/' . $data->image) : asset('assets/img/attention-default.jpg') }}"
                                        class="shadow rounded-lg overflow-hidden border ">

                                    <div class="mt-4">
                                        <h4 class="py-3 font-bold text-[18px]">{{ $data->judul }}</h4>
                                        <div class="mt-2 text-gray-600 line-clamp-2">
                                            {!! $data->deskripsi !!}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if ($role == 'siswa')
        <div class="min-h-screen md:p-8 p-4">
            <div class="font-semibold flex gap-3 items-center mb-5">
                <div class="rounded-full p-2 bg-blue-100 flex justify-center items-center border">
                    <i class='bx bx-menu text-[25px]'></i>
                </div>
                <span class="text-[20px] block">Menu</span>
            </div>
            <div class="grid gap-8 md:grid-cols-3 md:p-8 p-0">
                <a href="{{ route('siswa.show_jadwal') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bx-home-alt text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Jadwal Pelajaran</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Silahkan melihat jadwal pelajaran dengan memilih fitur ini.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('siswa.show_kehadiran') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bxs-spreadsheet text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Kehadiran</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Silahkan melihat kehadiran dengan memilih fitur ini.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('siswa.show_nilai') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bxs-report text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Nilai</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Silahkan melihat nilai dengan memilih fitur ini.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('siswa.ekskul') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bx-walk text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Ekstrakurikuler</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Silahkan melihat ekstrakurikuler dengan memilih fitur ini.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full     group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('pengumuman.show_pengumuman') }}">
                    <div
                        class="w-full p-3 bg-white rounded-3xl shadow-md grid grid-cols-12 gap-4 items-center dashboard group border-2 hover:border-sky-400 transition-all  cursor-pointer">
                        <div class="col-span-3 flex justify-center items-center">
                            <span
                                class="flex justify-center items-center md:w-20 md:h-20 w-16 h-16 place-items-center rounded-full  bg-sky-50 bg-opacity-30">
                                <i class='bx bxs-user-voice text-sky-500  text-[30px]'></i>
                            </span>
                        </div>
                        <div class="col-span-9 flex justify-between gap-1">
                            <div>
                                <div class="space-y-6 text-base leading-7 mb-1">
                                    <h5 class="text-[18px] font-semibold">Pengumuman</h5>
                                </div>
                                <div class="space-y-6 text-base line-clamp-5 leading-7">
                                    <p>Silahkan melihat pengumuman dengan memilih fitur ini.</p>
                                </div>
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span
                                    class="w-fit flex justify-center items-center place-items-center rounded-full group-dashboard:group-hover:bg-sky-200 ">
                                    <i
                                        class='bx bx-chevron-right   text-[30px] group-dashboard:group-hover:text-sky-500'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="mt-10">
                <div class="font-semibold flex justify-between flex-wrap items-end mb-6 ">
                    <div class="flex gap-3 items-center md:mb-0 mb-6">
                        <div class="rounded-full p-2 bg-blue-100 flex justify-center items-center border">
                            <i class='bx bxs-user-voice text-[25px]  '></i>
                        </div>
                        <span class="text-[20px] block">Pengumuman</span>
                    </div>
                    <div
                        class="py-1 px-2 pl-6 dashboard group flex gap-1 justify-center items-center bg-white  rounded-xl transition-all hover:bg-blue-600 hover:text-white border border-blue-500 text-blue-600">
                        <a href="{{ route('pengumuman.show_pengumuman') }}" class="text-[16px] ">Selengkapnya
                        </a>
                        <i class='bx bx-chevron-right text-[30px]'></i>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-4 gap-4">
                    @foreach ($pengumumans as $data)
                        <div>
                            <a href="{{ route('pengumuman.detail', ['pengumuman' => $data]) }}">
                                <div
                                    class="p-3 pb-6 max-w-lg border transition-all border-violet-300 rounded-2xl hover:shadow-2xl hover:shadow-violet-200 flex flex-col justify-start items-start">
                                    <img src="{{ $data->image != '-' ? asset('storage/' . $data->image) : asset('assets/img/attention-default.jpg') }}"
                                        class="shadow rounded-lg overflow-hidden border ">

                                    <div class="mt-4">
                                        <h4 class="py-3 font-bold text-[18px]">{{ $data->judul }}</h4>
                                        <div class="mt-2 text-gray-600 line-clamp-2">
                                            {!! $data->deskripsi !!}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
