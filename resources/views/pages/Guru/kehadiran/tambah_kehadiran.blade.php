@extends('layouts.dashboard')
@section('table-name', 'Menambah Data Kehadiran')
@section('table-role', 'Guru')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <form action="{{ route('guru.kehadiran.store') }}" method="POST">
                @csrf
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="px-[30px] pt-[20px]">
                        <div class="grid grid-cols-12">
                            <div class="col-span-3">
                                <h2 class="mb-3 text-gray-800 text-[20px] font-semibold">Daftar Siswa Di Rombel <span
                                        class="text-violet-700 font-bold  ms-1">{{ $rombel->nama_rombel }}</span></h2>
                                <div class="mb-4">
                                    <label for="example-text-input"
                                        class="block mb-2 font-medium text-gray-700 dark:text-gray-100">Tanggal</label>
                                    <input name="tanggal"
                                        class="w-full border-gray-100 rounded placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                        type="date" value="{{ $date }}" id="example-date-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    </div>
                    <div class="relative overflow-x-auto card-body mb-[20px] px-[30px]">
                        <!-- start grid -->
                        <input type="text" name="rombel_id" value="{{ $rombel->id }}" hidden />
                        @if (count($rombel->siswas) == 0)
                            <p class="my-3 text-[20px] font-semibold text-center">Daftar Siswa Kosong</p>
                        @endif

                        <div class="grid md:grid-cols-3 md:gap-4 gap-3 ">
                            @foreach ($siswas as $data)
                                <input type="text" name="siswa_id[]" value="{{ $data->id }}" hidden />
                                <div class="">
                                    <div class="card dark:bg-zinc-800 dark:border-zinc-600 ">
                                        <div class="card-body py-2 grid grid-cols-12 items-center">
                                            <h6 class="text-gray-600 text-[16px] font-semibold capitalize col-span-8">
                                                {{ $data->nama }}
                                            </h6>
                                            <div class="form-check col-span-4">
                                                <div>
                                                    <select id="daftar_kehadiran-{{ $loop->iteration }}"
                                                        name="daftar_kehadiran[]"
                                                        class="dark:bg-zinc-800  dark:border-zinc-700 w-full mt-2 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                        <option value="hadir" selected>Hadir</option>
                                                        <option value="sakit">Sakit</option>
                                                        <option value="izin">Izin</option>
                                                        <option value="alpa">Alpa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit"
                            class="px-10 py-2 rounded-lg mt-5 hover:bg-violet-600 bg-violet-400 text-[16px] font-medium text-white "
                            {{ count($rombel->siswas) == 0 ? 'hidden' : '' }}>Simpan</button>


                        <!-- end grid -->

                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (session('error'))
        <script>
            toast('error', '{{ Session::get('error') }}')
        </script>
    @endif
@endsection
