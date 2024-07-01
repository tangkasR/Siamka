@extends('layouts.dashboard')
@section('table-name', 'Data Nilai Mata Pelajaran')
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('tahun_ajaran.index', 'nilai') }}" class="flex justify-center items-center"><i
                class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="px-[30px] pt-[20px] ">
                    <h1 class="text-[18px] font-medium text-gray-800 md:mb-0 mb-4 leading-7">Pilih Rombel Untuk
                        Memasukan
                        Nilai</h1>
                </div>
                <hr class="text-[2px] mt-[20px]  text-black w-full" />
                <div class="relative overflow-x-auto card-body mb-[50px] h-[100%]">
                    <div class="grid md:grid-cols-3 gap-4">
                        @foreach ($rombel as $data)
                            <div class="swiper-slide">
                                <div class="hover:scale-98  card bg-blue-50 border-blue-300 border-2  transition-all">
                                    <div class="card-body">
                                        <h6 class="mb-3 text-slate-700 text-[25px] dark:text-gray-100 font-bold">
                                            {{ $data->nama_rombel }}
                                        </h6>
                                        <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                            Silahkan pilih rombel dengan menekan tombol dibawah!
                                        </p>
                                        <div class="">
                                            <a href="{{ route('guru.nilai.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => Crypt::encrypt($data->id)]) }}"
                                                class="hover:bg-blue-700
                                                block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
                                                Pilih
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
