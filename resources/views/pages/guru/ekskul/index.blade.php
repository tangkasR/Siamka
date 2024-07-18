@extends('layouts.dashboard')
@section('table-name', 'Ekstrakurikuler')
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('tahun_ajaran.index', 'ekskul') }}" class="flex justify-center items-center"><i
                class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class=" bg-white shadow-md">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600 min-h-screen">
            <div class="card-body border-b border-gray-100 dark:border-zinc-600 flex justify-between items-center flex-wrap">
                <h6 class="mb-1 text-gray-600 text-[18px] font-medium dark:text-gray-100 leading-7">Silahkan pilih Ekskul
                    untuk
                    menambah anggota</h6>
                <a type="submit" data-tw-toggle="modal" data-tw-target="#modal-id_form_add"
                    class="w-fit md:mt-0 mt-6 cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md flex items-center gap-2 transition-all duration-300">
                    <span>Tambah Data</span> <i class='bx bxs-plus-circle text-[25px]'></i>
                </a>
            </div>
            <div class="relative overflow-x-auto card-body ">
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach ($ekskuls as $data)
                        <div
                            class=" w-full  relative mx-auto  rounded-lg border border-violet-300  hover:shadow-lg hover:shadow-violet-200 transition-all ">
                            <a
                                href="{{ route('guru.ekskul.daftar_anggota', ['tahun' => $tahun, 'semester' => $semester, 'id' => Crypt::encrypt($data->id)]) }}">
                                <div class="bg-white p-3 rounded-md">
                                    <span
                                        class=" p-3 flex mb-3 justify-center items-center place-items-center rounded-md w-full duration-300 text-white bg-indigo-200">
                                        <img src="{{ asset('assets/img/img-ekskul.png') }}" alt=""
                                            class="max-w-[100px]">
                                    </span>
                                    <h1 class="font-bold text-[24px] m-0  capitalize">{{ $data->nama_ekskul }} </h1>
                                    <p class="mb-3 text-[16px] font-medium">Pembina Ekskul: {{ $data->nama }}</p>
                                    <p>Silahkan ubah, hapus, atau tambah anggota ekskul
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
                        <h1 class="text-[20px] font-bold">Silahkan tambah ekskul -></h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
    <div class="relative z-50 hidden modal" id="modal-id_form_add" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
            </div>
            <div class="p-4 mx-auto animate-translate sm:max-w-lg">
                <div
                    class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                    <div class="bg-white dark:bg-zinc-700">
                        <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600"
                            data-tw-dismiss="modal">
                            <i class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                        </button>
                        <div class="p-5">
                            <form action="{{ route('guru.ekskul.store') }}" method="POST">
                                @csrf
                                <h1 class="text-slate-600 font-semibold text-[20px] mb-2">Tambah Data Ekskul</h1>
                                <div class="mb-3">
                                    <label for="nama_ekskul"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Nama Ekskul
                                    </label>
                                    <input type="text" name="nama_ekskul"
                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                        placeholder="Masukan Nama Ekskul" required>
                                </div>
                                <div class="mb-6">
                                    <label for="nama_ekskul"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Pembina
                                    </label>
                                    <input type="text"
                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                        value="{{ $guru->nama }}" disabled>
                                </div>
                                <input type="text" value="{{ $guru->id }}" name="guru_id" hidden>
                                <input type="text" value="{{ $tahun_ajaran_id }}" name="tahun_ajaran_id" hidden>
                                <button type="submit"
                                    class="w-full text-white hover:bg-blue-700 bg-blue-500 py-2 rounded-md transition-all duration-300">
                                    Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit --}}


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
