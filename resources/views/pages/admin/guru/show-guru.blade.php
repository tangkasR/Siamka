@extends('layouts.dashboard')
@section('table-name', 'Detail Guru')
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.guru', ['tahun' => $tahun, 'semester' => $semester]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class=" lg:my-0 md:p-10  min-h-screen bg-white ">
        <div class="md:flex md:justify-between items-end">
            <div class="md:flex  md:gap-6 items-center p-6  md:p-0">
                <div id="profile-photo-mobile"
                    class="block md:mx-0 mx-auto  rounded-full shadow-xl h-[200px] w-[200px] bg-cover bg-center "
                    style="background-image: url('{{ $guru->profil != '-' ? asset('storage/' . $guru->profil) : asset('assets/img/profil-default.jpg') }}')">
                    <div class="w-full h-full relative">
                        <div class="absolute -bottom-2 w-full  text-center py-2 px-6 rounded-full"
                            style="background-color: rgb(237, 233, 254)">
                            <p class="text-[16px] font-medium capitalize">{{ $guru->jabatan }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-left md:mt-0 mt-6">
                    <div class="mb-3">
                        <span class="font-semibold text-[24px] capitalize">{{ $guru->nama }} </span>
                    </div>
                    <div class="mb-3">
                        <span class="font-medium text-[16px] text-gray-500">Kompetensi:
                            @foreach ($guru->mapels as $index => $mapel)
                                @if ($index == 1)
                                    <span class="mx-2">&</span>
                                @endif
                                <span class="ms-1">{{ $mapel->nama_mata_pelajaran }}</span>
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-6 flex gap-2 items-center">
                <div>
                    <div class="relative dropdown ">
                        <button type="button"
                            class="flex gap-2 items-center dropdown-toggle w-fit border border-blue-600 hover:bg-blue-700 text-blue-600 hover:text-white font-bold py-2 px-6 rounded-md "
                            id="dropdownMenuButton1" data-bs-toggle="dropdown"><span> Download</span> <i
                                class='bx bxs-cloud-download text-[20px]'></i></button>
                        <ul class="absolute text-left z-50 float-left py-2 mt-1  list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                            aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                            <li>
                                <form action="{{ route('guru.download_ktp') }}" method="POST">
                                    @csrf
                                    <input type="text" name="ktp" value="{{ $guru->ktp }}" id="" hidden>
                                    <button
                                        class="text-left block w-full px-4 py-1 text-sm font-medium text-gray-700 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                        type="submit">
                                        Download KTP
                                    </button>
                                </form>
                            </li>
                            <hr class="my-1 border-gray-50 dark:border-zinc-600">
                            <li>
                                <form action="{{ route('guru.download_kk') }}" method="POST">
                                    @csrf
                                    <input type="text" name="kk" value="{{ $guru->kartu_keluarga }}" id=""
                                        hidden>
                                    <button
                                        class="text-left block text-gray-700  w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                        type="submit">
                                        Download KK
                                    </button>
                                </form>
                            </li>
                            <hr class="my-1 border-gray-50 dark:border-zinc-600">
                            <li>
                                <form action="{{ route('guru.download_ijazah') }}" method="POST">
                                    @csrf
                                    <input type="text" name="ijazah" value="{{ $guru->ijazah }}" id="" hidden>
                                    <button
                                        class="text-left block text-gray-700  w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                        type="submit">
                                        Download Ijazah
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.guru.cetak_kehadiran', ['tahun' => $tahun, 'semester' => $semester, 'guru' => $guru]) }}"
                        class="flex gap-2 items-center w-fit border border-slate-600 hover:bg-slate-700 text-slate-600 hover:text-white font-bold py-2 px-6 rounded-md">
                        <span>Rekap Kehadiran</span><i class='bx bx-calendar-alt text-[20px]'></i>
                    </a>
                </div>
            </div>

        </div>
        <div class="mt-8 w-full mx-auto md:py-6 px-6 pb-0">
            <div class="md:grid md:grid-cols-2 md:gap-5 mt-3">
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email"
                        class="block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        value="{{ $guru->username }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                        Username</label>
                </div>
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email"
                        class="block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        value="{{ $guru->jenis_kelamin != '-' ? $guru->jenis_kelamin : '-' }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                        Jenis Kelamin</label>
                </div>
            </div>
            {{--  --}}
            <div class="md:grid md:grid-cols-2 md:gap-5">
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="tempat_tanggal_lahir"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $guru->tempat_tanggal_lahir }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Tempat Tanggal Lahir</label>
                </div>
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="alamat"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $guru->alamat }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Alamat</label>
                </div>
            </div>
            {{--  --}}
            <div class="md:grid md:grid-cols-2 md:gap-5">
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="pendidikan_terakhir"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $guru->pendidikan_terakhir }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Pendidikan Terakhir</label>
                </div>
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="no_hp"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $guru->no_hp }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        No Handphone</label>
                </div>
            </div>
        </div>
    </div>
    @if (session('message'))
        <script>
            toast('message', '{{ Session::get('message') }}')
        </script>
    @endif
@endsection
