@extends('layouts.dashboard')
@section('table-name', 'Kehadiran')
@section('table-role', 'Guru')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="px-[30px] pt-[20px]">
                    <h2 class="mb-3 text-slate-800 text-[20px]">Menambah Data Kehadiran</h2>
                    <h5 class="mb-3 text-slate-600 text-[16px]">Daftar Siswa Rombel {{ $rombel->nama_rombel }}</h5>
                    <p class="text-[14px] font-semibold text-slate-600">{{ $date }}</p>

                </div>
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                </div>
                <div class="relative overflow-x-auto card-body mb-[50px]">
                    <!-- start grid -->
                    <form class="" action="{{ route('guru.kehadiran.store') }}" method="POST">
                        @csrf
                        <input type="text" name="tanggal" value="{{ $date }}" hidden />
                        <input type="text" name="rombel_id" value="{{ $rombel->id }}" hidden />
                        @if (count($rombel->siswas) == 0)
                            <p class="my-3 text-[20px] font-semibold text-center">Daftar Siswa Kosong</p>
                        @endif
                        @foreach ($rombel->siswas as $data)
                            <input type="text" name="siswa_id[]" value="{{ $data->id }}" hidden />
                            <div class="grid grid-cols-1 ">
                                <div class="col-span-12 lg:col-span-6">
                                    <div class="card dark:bg-zinc-800 dark:border-zinc-600 ">
                                        <div class="card-body py-2 flex justify-between items-center">
                                            <h6 class="mb-1 text-gray-700 text-15 dark:text-gray-100">Nama:
                                                {{ $data->nama }}
                                            </h6>
                                            <div class="form-check flex  justify-center items-center gap-5">
                                                <div>
                                                    <input type="checkbox" value="hadir" name="daftar_kehadiran[]"
                                                        class=" rounded  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500 focus:border-violet-100 focus:ring focus:ring-violet-500/20"
                                                        id="autoSizingCheck1-{{ $loop->iteration }}">

                                                    <label class="ms-2 text-gray-700 dark:text-zinc-100"
                                                        for="autoSizingCheck1-{{ $loop->iteration }}">
                                                        Hadir</label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" value="tidak hadir" name="daftar_kehadiran[]"
                                                        class=" rounded  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500 focus:border-violet-100 focus:ring focus:ring-violet-500/20"
                                                        id="autoSizingCheck2-{{ $loop->iteration }}">

                                                    <label class="ms-2 text-gray-700 dark:text-zinc-100"
                                                        for="autoSizingCheck2-{{ $loop->iteration }}">
                                                        Tidak Hadir</label>
                                                </div>
                                                <div>
                                                    <label class=" text-gray-700 dark:text-zinc-100"
                                                        for="autoSizingCheck2-{{ $loop->iteration }}">
                                                        Keterangan</label>
                                                    <input type="text" name="keterangan[]" id="keterangan"
                                                        class="bg-gray-800/5 border border-gray-100 mt-2 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                        placeholder="Masukan Keterangan" value="-" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <button type="submit" class="p-[10px] rounded-lg bg-green-500 text-[18px] font-bold text-white"
                            {{ count($rombel->siswas) == 0 ? 'hidden' : '' }}>Simpan</button>

                    </form>
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
