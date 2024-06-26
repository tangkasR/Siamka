@extends('layouts.dashboard')
@section('table-name', 'Riwayat Ekstrakurikuler')
@section('table-role', 'Siswa')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 p-0">
                <div class="relative overflow-x-auto card-body mb-[50px] ">
                    <div class="grid md:grid-cols-6 mb-3 gap-4 capitalize">
                        @foreach ($ekskuls as $data)
                            <div
                                class="w-full relative mx-auto  rounded-lg bg-gradient-to-tr from-pink-300 to-blue-300 p-0.5 border-violet-300  hover:shadow-lg hover:shadow-violet-200 transition-all  ">
                                <div class="bg-white p-3 rounded-md min-h-[300px] w-full">
                                    <span
                                        class=" p-3 flex mb-3 justify-center items-center place-items-center rounded-md w-full duration-300 text-white bg-indigo-200">
                                        <img src="{{ asset('assets/img/img-ekskul.png') }}" alt=""
                                            class="max-w-[100px]">
                                    </span>
                                    <h1 class="font-bold text-[20px] m-0  capitalize">{{ $data->nama_ekskul }}</h1>
                                    <p class="mb-3 text-[16px] font-medium">Pembina Ekskul: {{ $data->nama_guru }}</p>
                                    <p class="mb-3 text-[16px] font-medium">Tahun Ajaran: {{ $data->tahun_ajaran }}</p>
                                    <p class="mb-3 text-[16px] font-medium">Semester: {{ $data->semester }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if (count($ekskuls) == 0)
                        <div class="w-full mt-6 min-h-[40vh] flex flex-col justify-center items-center">
                            <h1 class="text-[20px] font-bold">Anda tidak memiliki Ekstrakurikuler</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
