@extends('layouts.dashboard')
@section('table-name', 'Nilai')
@section('table-role', 'Guru')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="px-[30px] pt-[20px]">
                    <h2 class="mb-3 text-slate-700">Menambah Data Nilai</h2>
                    <h5 class="text-slate-600">Daftar Siswa Rombel {{ $rombel->nama_rombel }}</h5>
                </div>
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                </div>
                <div class="flex justify-center flex-col items-center card-body  mb-[50px]">
                    <!-- start grid -->
                    <div class="max-w-full w-[600px] ">
                        <form class="" action="{{ route('guru.nilai.store') }}" method="POST">
                            @csrf
                            <input type="text" value="{{ $rombel->id }}" name="rombel_id" hidden>
                            <div class="mb-3">
                                <label for="tipe_ujian"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                    Ujian
                                </label>
                                <select id="tipe_ujian" name="tipe_ujian"
                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                    required>
                                    <option value="">Pilih Ujian</option>
                                    <option value="uts">UTS</option>
                                    <option value="uas">UAS</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mata_pelajaran_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                    Mata Pelajaran
                                </label>
                                <select id="mata_pelajaran_id" name="mata_pelajaran_id"
                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                    required>
                                    @foreach ($mapel as $data_mapel)
                                        @if ($guru->mata_pelajaran_id == $data_mapel->id)
                                            <option value="{{ $data_mapel->id }}" selected>
                                                {{ $data_mapel->nama_mata_pelajaran }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @foreach ($rombel->siswas as $data)
                                <input type="text" name="siswa_id[]" value="{{ $data->id }}" hidden />
                                <div class="grid grid-cols-1 ">
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="card dark:bg-zinc-800 dark:border-zinc-600 ">
                                            <div class="card-body flex py-3 justify-between items-center">
                                                <h6 class="mb-1 text-gray-700 text-15 dark:text-gray-100">Nama:
                                                    {{ $data->nama }}
                                                </h6>
                                                <div class="form-check flex  justify-center items-center gap-5">
                                                    <div>
                                                        <input type="text" name="nilai[]"
                                                            class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                            placeholder="Masukan Nilai" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit"
                                class="p-[10px] rounded-lg bg-green-500 text-[18px] font-bold text-white">Simpan</button>

                        </form>
                    </div>
                    <!-- end grid -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @if (session('error'))
        <script>
            $(document).ready(function() {
                $.toast({
                    text: `
                        <div class="py-2 font-bold text-[14px]">
                            {{ Session::get('error') }}
                        </div>
                        `,
                    showHideTransition: 'slide',
                    // textColor: 'black',
                    icon: 'error',
                    position: 'top-right',
                    allowToastClose: false,
                    bgColor: '#fc3b2d',
                    loaderBg: '#6f00ff',
                    hideAfter: 6000,
                    stack: false
                })
            });
        </script>
    @endif
@endsection
