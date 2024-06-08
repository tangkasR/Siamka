@extends('layouts.dashboard')
@section('table-name', 'Riwayat Ekstrakurikuler')
@section('table-role', 'Siswa')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 p-0">
                <div class="relative overflow-x-auto card-body mb-[50px] ">
                    <div class="grid md:grid-cols-4 mb-3 gap-5">
                        @foreach ($ekskuls as $data)
                            <div
                                class=" relative mx-auto max-w-xl rounded-lg bg-gradient-to-tr from-pink-300 to-blue-300 p-0.5 border-violet-300  hover:shadow-lg hover:shadow-violet-200 transition-all  ">
                                <div class="bg-white p-7 rounded-md grid grid-cols-12 gap-3">
                                    <span
                                        class="md:col-span-5 col-span-6 p-3 flex justify-center items-center w-full place-items-center rounded-full  duration-300 text-white"
                                        style="background-color: rgb(199, 182, 252)">
                                        <img src="{{ asset('assets/img/img-ekskul.png') }}" alt="">
                                    </span>
                                    <div class="md:col-span-7 col-span-6">
                                        <h1 class="font-bold text-[20px]   capitalize">{{ $data->nama_ekskul }}</h1>
                                        <p class=" text-[16px] capitalize">Pembina Ekstrakurikuler:
                                            {{ $data->gurus->nama }}</p>
                                    </div>
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
