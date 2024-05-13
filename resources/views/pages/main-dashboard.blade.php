@extends('layouts.dashboard')

@section('content')
    @if (auth()->guard('admin')->check())
        <div class="grid gap-8 md:grid-cols-4 px-2 pb-20">
            <a href="{{ route('admin.ruangan') }}">
                <div
                    class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bx-home-alt text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Data Ruangan</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus data ruangan dengan memilih fitur ini.</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                            <p class="transition-all duration-300 group-dashboard:group-hover:text-white ">
                                Masuk ke fitur
                                &rarr;
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.sesi') }}">
                <div
                    class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bx-time-five text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Sesi</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus data sesi dengan memilih fitur ini.</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                            <p class="transition-all duration-300 group-dashboard:group-hover:text-white ">
                                Masuk ke fitur
                                &rarr;
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.mapel') }}">
                <div
                    class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bx-book-content text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Mata Pelajaran</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus data mata pelajaran dengan memilih fitur ini.</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                            <p class="transition-all duration-300 group-dashboard:group-hover:text-white ">
                                Masuk ke fitur
                                &rarr;
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.guru') }}">
                <div
                    class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bxs-user text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Guru</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus data guru dengan memilih fitur ini.</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                            <p class="transition-all duration-300 group-dashboard:group-hover:text-white ">
                                Masuk ke fitur
                                &rarr;
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.rombel') }}">
                <div
                    class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bx-group text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Rombel</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus data rombel dengan memilih fitur ini.</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                            <p class="transition-all duration-300 group-dashboard:group-hover:text-white ">
                                Masuk ke fitur
                                &rarr;
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.siswa') }}">
                <div
                    class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bxs-user text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Siswa</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus data siswa dengan memilih fitur ini.</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                            <p class="transition-all duration-300 group-dashboard:group-hover:text-white ">
                                Masuk ke fitur
                                &rarr;
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.jadwal_pelajaran') }}">
                <div
                    class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bxs-spreadsheet text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Jadwal Pelajaran</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus data jadwal pelajaran dengan memilih fitur ini.</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                            <p class="transition-all duration-300 group-dashboard:group-hover:text-white ">
                                Masuk ke fitur
                                &rarr;
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endif
    @if (auth()->guard('guru')->check())
        <div class="grid gap-8 md:grid-cols-2 px-2 pb-20">
            <a href="{{ route('guru.kehadiran') }}">
                <div
                    class="dashboard group  relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[20]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bx-calendar-alt text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Data Kehadiran</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah data kehadiran dengan memilih fitur ini.</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                            <p class="transition-all duration-300 group-dashboard:group-hover:text-white ">
                                Masuk ke fitur
                                &rarr;
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('guru.nilai') }}">
                <div
                    class="dashboard group  relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto  sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[20]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bxs-report text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Nilai</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, data nilai dengan memilih fitur ini.</p>
                        </div>
                        <div class="pt-5 text-base font-semibold leading-7">
                            <p>
                            <p class="transition-all duration-300 group-dashboard:group-hover:text-white ">
                                Masuk ke fitur
                                &rarr;
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endif
    @if (auth()->guard('siswa')->check())
        <h1>asdasd</h1>
        <h1>asdasd</h1>
        <h1>asdasd</h1>
        <h1>asdasd</h1>
        <h1>asdasd</h1>
        <h1>asdasd</h1>
        <h1>asdasd</h1>
        <h1>asdasd</h1>
    @endif
@endsection
