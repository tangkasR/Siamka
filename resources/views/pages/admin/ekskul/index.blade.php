@extends('layouts.dashboard')
@section('table-name', 'Ekstrakurikuler')
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('tahun_ajaran.index', 'admin_ekskul') }}" class="flex justify-center items-center"><i
                class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class=" bg-white shadow-md">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600 min-h-screen">
            <div class="card-body border-b border-gray-100 dark:border-zinc-600 ">
                <h6 class="mb-1 text-gray-600 text-[18px] font-medium dark:text-gray-100 leading-7">Silahkan pilih Ekskul
                    untuk melihat anggota</h6>
            </div>
            <div class="relative overflow-x-auto card-body ">
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach ($ekskuls as $data)
                        <div
                            class=" relative mx-auto max-w-md rounded-lg bg-gradient-to-tr from-pink-300 to-blue-300 p-0.5 border-violet-300  hover:shadow-lg hover:shadow-violet-200 transition-all  ">
                            <a
                                href="{{ route('admin.ekskul.detail_ekskul', ['tahun' => $tahun, 'semester' => $semester, 'ekskul' => $data]) }}">
                                <div class="bg-white p-3 rounded-md">
                                    <span
                                        class=" p-3 flex mb-3 justify-center items-center place-items-center rounded-md w-full duration-300 text-white bg-indigo-200">
                                        <img src="{{ asset('assets/img/img-ekskul.png') }}" alt=""
                                            class="max-w-[100px]">
                                    </span>
                                    <h1 class="font-bold text-[24px] m-0  capitalize">{{ $data->nama_ekskul }}</h1>
                                    <p class="mb-3 text-[16px] font-medium">Pembina Ekskul: {{ $data->gurus->nama }}</p>
                                    <p>Silahkan lihat anggota ekskul
                                        <span class="capitalize">{{ $data->nama_ekskul }}</span> dengan
                                        menekan kotak ini.
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
