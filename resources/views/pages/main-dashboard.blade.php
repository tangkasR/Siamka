@extends('layouts.dashboard')
@section('table-name', 'Dashboard')
@section('table-role')
    {{ $user->nama }}
@endsection
@section('content')
    @if ($role == 'admin')
        <div class="grid gap-8 md:grid-cols-4 md:p-8 p-4">
            <a href="{{ route('admin.ruangan') }}">
                <div
                    class="dashboard md:min-h-[360px] lg:min-h-[330px] group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl md:mx-auto md:max-w-sm sm:rounded-lg sm:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bx-home-alt text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Ruangan</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus ruangan dengan memilih fitur ini.</p>
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
                    class="dashboard md:min-h-[360px] lg:min-h-[330px] group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl md:mx-auto md:max-w-sm md:rounded-lg md:px-10">
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
                            class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus sesi dengan memilih fitur ini.</p>
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
                    class="dashboard md:min-h-[360px] lg:min-h-[330px] group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl md:mx-auto md:max-w-sm md:rounded-lg md:px-10">
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
                            class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus mata pelajaran dengan memilih fitur ini.</p>
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
                    class="dashboard md:min-h-[360px] lg:min-h-[330px] group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl md:mx-auto md:max-w-sm md:rounded-lg md:px-10">
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
                            class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus guru dengan memilih fitur ini.</p>
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
                    class="dashboard md:min-h-[360px] lg:min-h-[330px] group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl md:mx-auto md:max-w-sm md:rounded-lg md:px-10">
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
                            class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus rombel dengan memilih fitur ini.</p>
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
                    class="dashboard md:min-h-[360px] lg:min-h-[330px] group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl md:mx-auto md:max-w-sm md:rounded-lg md:px-10">
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
                            class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus siswa dengan memilih fitur ini.</p>
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
                    class="dashboard md:min-h-[360px] lg:min-h-[330px] group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl md:mx-auto md:max-w-sm md:rounded-lg md:px-10">
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
                            class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus jadwal pelajaran dengan memilih fitur ini.</p>
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
            <a href="{{ route('admin.pengumuman') }}">
                <div
                    class="dashboard md:min-h-[360px] lg:min-h-[330px] group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl md:mx-auto md:max-w-sm md:rounded-lg md:px-10">
                    <span
                        class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[10]"></span>
                    <div class="relative z-10 mx-auto w-full">
                        <span
                            class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                            <i class='bx bxs-user-voice text-white transition-all text-[35px]'></i>
                        </span>
                        <div
                            class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <h5 class="text-[18px] font-semibold">Pengumuman</h5>
                        </div>
                        <div
                            class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                            <p>Menambah, mengubah, dan menghapus pengumuman dengan memilih fitur ini.</p>
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
    @if ($role == 'guru')
        <div class="min-h-screen md:p-8 p-4">
            @if (count($pengumumans) == 0)
                <div class="grid gap-8 md:grid-cols-3 md:p-8 p-0">
                    <a href="{{ route('guru.kehadiran') }}">
                        <div
                            class="dashboard group md:min-h-[360px] lg:min-h-[300px] relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:rounded-lg ">
                            <span
                                class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                            <div class="relative z-10 mx-auto w-full">
                                <span
                                    class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                    <i class='bx bx-home-alt text-white transition-all text-[35px]'></i>
                                </span>
                                <div
                                    class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <h5 class="text-[18px] font-semibold">Kehadiran</h5>
                                </div>
                                <div
                                    class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <p>Menambah, mengubah, dan menghapus kehadiran dengan memilih fitur ini.</p>
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

                    <a href="{{ route('guru.ekskul') }}">
                        <div
                            class="dashboard group md:min-h-[360px] lg:min-h-[300px] relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl  md:rounded-lg ">
                            <span
                                class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                            <div class="relative z-10 mx-auto w-full">
                                <span
                                    class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                    <i class='bx bx-time-five text-white transition-all text-[35px]'></i>
                                </span>
                                <div
                                    class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <h5 class="text-[18px] font-semibold">Ekstrakurikuler</h5>
                                </div>
                                <div
                                    class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <p>Menambah, mengubah, dan menghapus ekstrakurikuler dengan memilih fitur ini.</p>
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
                            class="dashboard group md:min-h-[360px] lg:min-h-[300px] relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl  md:rounded-lg ">
                            <span
                                class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                            <div class="relative z-10 mx-auto w-full">
                                <span
                                    class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                    <i class='bx bx-time-five text-white transition-all text-[35px]'></i>
                                </span>
                                <div
                                    class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <h5 class="text-[18px] font-semibold">Nilai Mata Pelajaran</h5>
                                </div>
                                <div
                                    class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <p>Menambah, mengubah, dan menghapus nilai mata pelajaran dengan memilih fitur ini.
                                    </p>
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
                    <a href="{{ route('guru.show_ekskul') }}">
                        <div
                            class="dashboard group md:min-h-[360px] lg:min-h-[300px] relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl  md:rounded-lg ">
                            <span
                                class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                            <div class="relative z-10 mx-auto w-full">
                                <span
                                    class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                    <i class='bx bx-time-five text-white transition-all text-[35px]'></i>
                                </span>
                                <div
                                    class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <h5 class="text-[18px] font-semibold">Nilai Ekstrakurikuler</h5>
                                </div>
                                <div
                                    class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <p>Menambah, mengubah, dan menghapus nilai ekstrakurikuler dengan memilih fitur
                                        ini.</p>
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
                    <a href="{{ route('pengumuman.show_pengumuman') }}">
                        <div
                            class="dashboard group md:min-h-[360px] lg:min-h-[300px] relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl  md:rounded-lg ">
                            <span
                                class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                            <div class="relative z-10 mx-auto w-full">
                                <span
                                    class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                    <i class='bx bx-time-five text-white transition-all text-[35px]'></i>
                                </span>
                                <div
                                    class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <h5 class="text-[18px] font-semibold">Pengmuman</h5>
                                </div>
                                <div
                                    class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                    <p>Silahkan melihat pengmuman dengan memilih fitur ini.</p>
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
            @if (count($pengumumans) > 0)
                <div class="">
                    <div class=" font-medium mb-8">
                        <span class="text-[24px] block">Pengumuman <i
                                class='bx bxs-user-voice text-[30px] absolute -mt-2 ms-2 '></i></span>
                    </div>
                    <div class="grid md:grid-cols-4 gap-4">
                        @foreach ($pengumumans as $data)
                            <div>
                                <a href="{{ route('pengumuman.detail', ['id' => $data->id]) }}">
                                    <div
                                        class="p-6 min-h-[420px] max-w-lg border transition-all border-violet-300 rounded-2xl hover:shadow-2xl hover:shadow-violet-200 flex flex-col justify-start items-start">
                                        <img src="{{ $data->image != '-' ? asset('storage/' . $data->image) : asset('assets/img/attention-default.jpg') }}"
                                            class="shadow rounded-lg overflow-hidden border">
                                        <div class="mt-4">
                                            <h4 class="py-3 font-bold text-[25px] line-clamp-2">{{ $data->judul }}</h4>
                                            <div class="mt-2 text-gray-600 line-clamp-2">
                                                {!! $data->deskripsi !!}
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <button type="button"
                                                class="inline-flex w-fit items-center rounded-md border border-violet-500 bg-violet-500 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-gray-900">
                                                Detail Pengumuman
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('pengumuman.show_pengumuman') }}"
                            class="text-[16px] underline underline-offset-4 hover:text-blue-700 hover:font-medium">Selengkapnya
                        </a>
                    </div>
                </div>
            @endif
        </div>
    @endif
    @if ($role == 'siswa')
        <div class="min-h-screen md:p-8 p-4">
            <div class="">
                @if (count($pengumumans) == 0)
                    <div class="grid gap-8 md:grid-cols-3 md:p-8 p-0">
                        <a href="{{ route('siswa.show_jadwal') }}">
                            <div
                                class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:rounded-lg ">
                                <span
                                    class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                                <div class="relative z-10 mx-auto w-full">
                                    <span
                                        class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                        <i class='bx bx-home-alt text-white transition-all text-[35px]'></i>
                                    </span>
                                    <div
                                        class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <h5 class="text-[18px] font-semibold">Jadwal Pelajaran</h5>
                                    </div>
                                    <div
                                        class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <p>Silahkan melihat jadwal pelajaran dengan memilih fitur ini.</p>
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
                        <a href="{{ route('siswa.show_kehadiran') }}">
                            <div
                                class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:rounded-lg ">
                                <span
                                    class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                                <div class="relative z-10 mx-auto w-full">
                                    <span
                                        class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                        <i class='bx bx-home-alt text-white transition-all text-[35px]'></i>
                                    </span>
                                    <div
                                        class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <h5 class="text-[18px] font-semibold">Kehadiran</h5>
                                    </div>
                                    <div
                                        class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <p>Silahkan melihat kehadiran dengan memilih fitur ini.</p>
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
                        <a href="{{ route('siswa.show_nilai') }}">
                            <div
                                class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:rounded-lg ">
                                <span
                                    class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                                <div class="relative z-10 mx-auto w-full">
                                    <span
                                        class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                        <i class='bx bx-home-alt text-white transition-all text-[35px]'></i>
                                    </span>
                                    <div
                                        class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <h5 class="text-[18px] font-semibold">Nilai</h5>
                                    </div>
                                    <div
                                        class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <p>Silahkan melihat nilai dengan memilih fitur ini.</p>
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
                        <a href="{{ route('siswa.ekskul') }}">
                            <div
                                class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:rounded-lg ">
                                <span
                                    class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                                <div class="relative z-10 mx-auto w-full">
                                    <span
                                        class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                        <i class='bx bx-home-alt text-white transition-all text-[35px]'></i>
                                    </span>
                                    <div
                                        class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <h5 class="text-[18px] font-semibold">Ekstrakurikuler</h5>
                                    </div>
                                    <div
                                        class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <p>Silahkan melihat riwayat ekstrakurikuler dengan memilih fitur ini.</p>
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
                        <a href="{{ route('pengumuman.show_pengumuman') }}">
                            <div
                                class="dashboard group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:rounded-lg ">
                                <span
                                    class="absolute top-10 z-0 h-20 w-20 rounded-full bg-sky-500 transition-all duration-300 group-dashboard:group-hover:scale-[13]"></span>
                                <div class="relative z-10 mx-auto w-full">
                                    <span
                                        class="flex justify-center items-center h-20 w-20 place-items-center rounded-full  transition-all duration-300 group-dashboard:group-hover:bg-sky-400">
                                        <i class='bx bx-home-alt text-white transition-all text-[35px]'></i>
                                    </span>
                                    <div
                                        class="space-y-6 pt-5 text-base leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <h5 class="text-[18px] font-semibold">Pengumuman</h5>
                                    </div>
                                    <div
                                        class="space-y-6 pt-2 text-base line-clamp-5 leading-7  transition-all duration-300 group-dashboard:group-hover:text-white">
                                        <p>Silahkan melihat pengumuman dengan memilih fitur ini.</p>
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
                @if (count($pengumumans) > 0)
                    <div class=" font-medium mb-8">
                        <span class="text-[24px] block">Pengumuman <i
                                class='bx bxs-user-voice text-[30px] absolute -mt-2 ms-2 '></i></span>
                    </div>
                    <div class="grid md:grid-cols-4 gap-4">
                        @foreach ($pengumumans as $data)
                            <div>
                                <a href="{{ route('pengumuman.detail', ['id' => $data->id]) }}">
                                    <div
                                        class="p-6 min-h-[420px] max-w-lg border transition-all border-violet-300 rounded-2xl hover:shadow-2xl hover:shadow-violet-200 flex flex-col justify-start items-start">
                                        <img src="{{ $data->image != '-' ? asset('storage/' . $data->image) : asset('assets/img/attention-default.jpg') }}"
                                            class="shadow rounded-lg overflow-hidden border">
                                        <div class="mt-4">
                                            <h4 class="py-3 font-bold text-[25px] line-clamp-2">{{ $data->judul }}</h4>
                                            <div class="mt-2 text-gray-600 line-clamp-2">
                                                {!! $data->deskripsi !!}
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <button type="button"
                                                class="inline-flex w-fit items-center rounded-md border border-violet-500 bg-violet-500 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-gray-900">
                                                Detail Pengumuman
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('pengumuman.show_pengumuman') }}"
                            class="text-[16px] underline underline-offset-4 hover:text-blue-700 hover:font-medium">Selengkapnya
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endsection
