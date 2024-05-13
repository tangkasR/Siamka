@extends('layouts.dashboard')
@section('table-name', 'Jadwal Pelajaran')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="px-[30px] pt-[20px]">
                    <h1 class="text-[20px]">Daftar Rombongan Belajar</h1>
                </div>
                <hr class="text-[2px] my-[20px] text-black w-full" />
                <div class="relative overflow-x-auto card-body mb-[50px]">
                    <!-- start grid -->
                    <div class="grid sm:grid-cols-3  lg:grid-cols-4 gap-5">
                        @foreach ($rombel as $data)
                            <div
                                class="card dark:bg-zinc-800 dark:border-zinc-600 bg-blue-100    hover:border-violet-300 hover:border-2  ">
                                <div class="card-body  ">
                                    <i class='mb-6 bx bxs-calendar text-[30px] text-gray-600'></i>
                                    <h6 class="mb-6 text-slate-700 text-[30px] dark:text-gray-100 font-bold">
                                        {{ $data->nama_rombel }}
                                    </h6>
                                    <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                        Silahkan pilih kelas dengan menekan tombol dibawah!
                                    </p>
                                    <div class="">
                                        <a href="{{ route('admin.jadwal_pelajaran.show_jadwal', ['id' => $data->id]) }}"
                                            class="hover:bg-violet-700
                                                    block text-center text-white border-transparent shadow btn bg-violet-300  shadow-violet-300 dark:shadow-zinc-600">
                                            Pilih
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- end start grid -->
                </div>
            </div>
        </div>
    </div>


@endsection
