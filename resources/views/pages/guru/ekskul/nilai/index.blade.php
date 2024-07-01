@extends('layouts.dashboard')
@section('table-name', 'Data Nilai Ekstrakurikuler')
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('tahun_ajaran.index', 'nilai_ekskul') }}" class="flex justify-center items-center"><i
                class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-5 bg-white shadow-md">
        <div class="order-last md:order-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 min-h-screen">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <h6 class="mb-1 text-gray-600 text-[18px] font-medium dark:text-gray-100">Pilih Eksktrakurikuler</h6>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <div class="grid md:grid-cols-3 mb-3 gap-5">
                        @foreach ($ekskuls as $data)
                            <div
                                class=" w-full rounded-lg bg-gradient-to-tr from-pink-300 to-blue-300 p-0.5 border-violet-300  hover:shadow-lg hover:shadow-violet-200 transition-all  ">
                                <a
                                    href="{{ route('guru.nilai_ekskul.show_rombel', ['tahun' => $tahun, 'semester' => $semester, 'ekskul_id' => Crypt::encrypt($data->id)]) }}">
                                    <div class="bg-white p-3 rounded-md">
                                        <span
                                            class=" p-3 flex mb-3 justify-center items-center place-items-center rounded-md w-full duration-300 text-white bg-indigo-200">
                                            <img src="{{ asset('assets/img/img-ekskul.png') }}" alt=""
                                                class="max-w-[100px]">
                                        </span>
                                        <h1 class="font-bold text-[20px] m-0  capitalize">{{ $data->nama_ekskul }}</h1>
                                        <p class="mb-3 text-[14px] font-medium">Pembina Ekskul: {{ $data->nama }}</p>
                                        <p>Silahkan kelola nilai ekskul
                                            <span class="capitalize">{{ $data->nama_ekskul }}</span> dengan
                                            menekan kotak ini.
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if (count($ekskuls) == 0)
                        <div class="w-full mt-6 min-h-[40vh] flex flex-col justify-center items-center">
                            <h1 class="text-[20px] font-bold">Silahkan tambah ekskul <a
                                    href="{{ route('guru.ekskul', ['tahun' => $tahun, 'semester' => $semester]) }}"
                                    class="text-blue-600">disini</a></h1>
                        </div>
                    @endif
                </div>
            </div>
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
