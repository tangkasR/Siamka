@extends('layouts.dashboard')
@section('table-name', 'Data Siswa Lulus Atau Keluar')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="px-[30px] pt-[20px]">
                    <div>
                        <h1 class="text-[18px]
                    font-medium text-gray-800">Pilih Angkatan Untuk Melihat
                            Daftar Siswa</h1>
                    </div>
                </div>
                <hr class="text-[2px] my-[20px] text-black w-full" />
                <div class="relative overflow-x-auto card-body mb-[50px] h-[100%]">
                    {{-- Data Kelas X --}}
                    <div class=" grid md:grid-cols-4 gap-4">
                        @foreach ($angkatans as $data)
                            <div
                                class="card dark:bg-zinc-800 dark:border-zinc-600   bg-blue-50 border-blue-300 border-2 hover:border-blue-300  hover:border-2 hover:shadow-lg hover:shadow-blue-300 transition-all">
                                <div class="card-body  py-6">
                                    <h6 class="mb-6 text-slate-700 text-[25px] dark:text-gray-100 font-bold">
                                        Angkatan {{ $data->angkatan }}
                                    </h6>
                                    <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                        Silahkan pilih angkatan dengan menekan tombol dibawah!
                                    </p>
                                    <div class="">
                                        <a href="{{ route('admin.siswa.siswa_not_active_rombel', ['angkatan' => $data->angkatan]) }}"
                                            class="hover:bg-blue-700 block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-300 dark:shadow-zinc-600">
                                            Pilih
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- End Data Kelas X --}}
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
