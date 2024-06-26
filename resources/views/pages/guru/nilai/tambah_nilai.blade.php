@extends('layouts.dashboard')
@section('table-name', 'Menambah Data Nilai')
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('guru.nilai.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <form class="" action="{{ route('guru.nilai.store') }}" method="POST">
                    @csrf
                    <input type="text" name="tahun_ajaran_" value="{{ $tahun }}" hidden>
                    <input type="text" name="semester_" value="{{ $semester }}" hidden>
                    <input type="text" name="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}" hidden>
                    <div class="px-[30px] pt-[20px]">
                        <h2 class=" text-gray-800 text-[20px] font-semibold">Daftar Siswa Di Rombel <span
                                class="text-violet-700 font-bold  ms-1">{{ $rombel->nama_rombel }}</span></h2>
                    </div>
                    <div class="px-[30px] pt-[20px] grid md:grid-cols-3 gap-4">
                        <div class="">
                            <label for="semester"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Semester
                            </label>
                            <select id="semester" name="semester"
                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                required>
                                @if (explode(' ', $rombel->nama_rombel)[0] == 'X')
                                    @if ($semester == 'ganjil')
                                        <option value="1">Semester Ganjil</option>
                                    @endif
                                    @if ($semester == 'genap')
                                        <option value="2">Semester Genap</option>
                                    @endif
                                @endif
                                @if (explode(' ', $rombel->nama_rombel)[0] == 'XI')
                                    @if ($semester == 'ganjil')
                                        <option value="3">Semester Ganjil</option>
                                    @endif
                                    @if ($semester == 'genap')
                                        <option value="4">Semester Genap</option>
                                    @endif
                                @endif
                                @if (explode(' ', $rombel->nama_rombel)[0] == 'XII')
                                    @if ($semester == 'ganjil')
                                        <option value="5">Semester Ganjil</option>
                                    @endif
                                    @if ($semester == 'genap')
                                        <option value="6">Semester Genap</option>
                                    @endif
                                @endif
                            </select>
                        </div>
                        <div class="">
                            <label for="tipe_ujian"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Tipe Ujian
                            </label>
                            <select id="tipe_ujian" name="tipe_ujian"
                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                required>
                                <option value="">Pilih Ujian</option>
                                <option value="uts">UTS</option>
                                <option value="uas">UAS</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="mata_pelajaran_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Mata Pelajaran
                            </label>
                            <select id="mata_pelajaran_id" name="mata_pelajaran_id"
                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                required>
                                @foreach ($mapel as $data_mapel)
                                    <option value="{{ $data_mapel->id }}"
                                        {{ $guru->mata_pelajaran_id == $data_mapel->id ? 'selected' : '' }}>
                                        {{ $data_mapel->nama_mata_pelajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    </div>
                    <div class="flex justify-center flex-col items-center card-body">
                        <!-- start grid -->
                        <div class="px-[10px] pb-[20px] w-full ">
                            <input type="text" value="{{ $rombel->id }}" name="rombel_id" hidden>
                            <div class="grid md:grid-cols-3 md:gap-4 gap-3 ">
                                @foreach ($siswas as $data)
                                    <input type="text" name="siswa_id[]" value="{{ $data->id }}" hidden />
                                    <div class="card dark:bg-zinc-800 dark:border-zinc-600 ">
                                        <div class="card-body grid md:grid-cols-12 md:gap-3 items-center">
                                            <div class="md:col-span-8 mb-4 md:mb-0 ">
                                                <h6 class="text-gray-600 text-[16px] font-semibold capitalize ">
                                                    {{ $data->nama }}
                                                </h6>
                                            </div>
                                            <div class="form-check gap-5 md:col-span-4">
                                                <div>
                                                    <input type="text" name="nilai[]"
                                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                        placeholder="Nilai" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-10 flex gap-3 items-center">
                                <input type="checkbox" value=""
                                    class="cursor-pointer align-middle rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                    id="ketentuan" required>
                                <label for="ketentuan"
                                    class="block mb-1 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                    Pastikan semua data yang diisi sudah benar!
                                </label>
                            </div>
                            <div class="flex gap-3">
                                <button type="submit"
                                    class="px-10 py-2 rounded-md mt-5 hover:bg-blue-700 bg-blue-500 text-[16px] font-medium text-white btn"
                                    {{ count($rombel->siswas) == 0 ? 'hidden' : '' }}>Simpan</button>
                            </div>

                        </div>
                        <!-- end grid -->
                    </div>
                </form>
            </div>
        </div>
    </div>


    @if (session('error'))
        <script>
            toast('error', '{{ Session::get('error') }}')
        </script>
    @endif
@endsection
