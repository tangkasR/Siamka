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
                    <h6 class="mb-1 text-gray-600 text-[18px] font-medium dark:text-gray-100 leading-7">Pilih rombel untuk
                        menambah
                        nilai ekskul!</h6>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <div class="grid md:grid-cols-3 mb-3 gap-5">
                        @foreach ($rombels as $data)
                            <div
                                class=" w-full  relative mx-auto  rounded-lg border border-violet-300  hover:shadow-lg hover:shadow-violet-200 transition-all ">
                                <a
                                    href="{{ route('guru.nilai_ekskul', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $data, 'id' => Crypt::encrypt($ekskul->id)]) }}">
                                    <div class="bg-white p-3 rounded-md">
                                        <h1 class="font-bold text-[24px] m-0  capitalize">Rombel {{ $data }}</h1>
                                        <p class="mb-3 text-[16px] font-medium">Nama Ekskul: {{ $ekskul->nama_ekskul }}</p>
                                        <p>Silahkan kelola nilai ekskul {{ $ekskul->nama_ekskul }} di kelas
                                            <span class="capitalize">{{ $data }}</span> dengan
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
