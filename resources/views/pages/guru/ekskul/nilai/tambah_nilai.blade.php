@extends('layouts.dashboard')
@section('table-name', 'Menambah Nilai Siswa Ekskul')
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('guru.nilai_ekskul', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel, 'id' => Crypt::encrypt($ekskul->id)]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <form class="" action="{{ route('guru.nilai_ekskul.store', ['ekskul' => $ekskul]) }}" method="POST">
                    @csrf
                    <input type="text" value="{{ $tahun_ajaran_id }}" name="tahun_ajaran_id" hidden>
                    <div class="px-[30px] pt-[20px]">
                        <h2 class=" text-gray-800 text-[18px] font-medium">Silahkan masukan nilai ekskul <span
                                class="text-violet-700 font-bold  ms-1 capitalize">{{ $ekskul->nama_ekskul }}</span></h2>
                    </div>
                    <div class="px-[30px] pt-[20px] grid md:grid-cols-3 gap-4 items-start">
                        <div class="">
                            <label for="semester"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Semester
                            </label>
                            <select id="semester" name="semester"
                                class="dark:bg-zinc-800 capitalize dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                required>
                                @if ($semester == 'ganjil')
                                    @if ($rombel == 'X')
                                        <option value="1">Semester {{ $semester }}</option>
                                    @endif
                                    @if ($rombel == 'XI')
                                        <option value="3">Semester {{ $semester }}</option>
                                    @endif
                                    @if ($rombel == 'XII')
                                        <option value="5">Semester {{ $semester }}</option>
                                    @endif
                                @endif
                                @if ($semester == 'genap')
                                    @if ($rombel == 'X')
                                        <option value="2">Semester {{ $semester }}</option>
                                    @endif
                                    @if ($rombel == 'XI')
                                        <option value="4">Semester {{ $semester }}</option>
                                    @endif
                                    @if ($rombel == 'XII')
                                        <option value="6">Semester {{ $semester }}</option>
                                    @endif
                                @endif
                            </select>
                        </div>
                        <div class="">
                            <label for="ekskul_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Nama Ekskul
                            </label>
                            <select id="ekskul_id" name="ekskul_id"
                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                required>
                                <option value="{{ $ekskul->id }}" selected>{{ $ekskul->nama_ekskul }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 border-b border-gray-100 dark:border-zinc-600">
                    </div>
                    <div class="flex justify-center flex-col items-center card-body px-[30px] mb-[20px]">
                        <!-- start grid -->
                        <div class=" w-full ">
                            <div class="grid md:grid-cols-3 md:gap-4 gap-3">
                                @foreach ($siswas as $data)
                                    <input type="text" name="siswa_id[]" value="{{ $data->id }}" hidden />
                                    <div class="">
                                        <div class="card dark:bg-zinc-800 dark:border-zinc-600 ">
                                            <div class="card-body grid grid-cols-12 gap-3 items-center">
                                                <div class=" col-span-7">
                                                    <h6 class="mb-2 text-gray-600 text-[16px] font-semibold capitalize">
                                                        {{ $data->nama }}</h6>
                                                    <p class="text-[14px] font-medium">
                                                        <span>( </span>{{ $data->rombels[0]->nama_rombel }}
                                                        <span>)</span>
                                                    </p>
                                                </div>
                                                <div class="form-check  col-span-5">
                                                    <div>
                                                        <select name="nilai[]"
                                                            class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                            required>
                                                            <option value="Amat Baik">Amat Baik</option>
                                                            <option value="Baik">Baik</option>
                                                            <option value="Cukup">Cukup</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" value="{{ $rombel }}" name="rombel" hidden>
                            <button type="submit"
                                class="px-10 py-2 rounded-md mt-5 hover:bg-blue-700 bg-blue-500 text-[16px] font-medium text-white btn">Simpan</button>
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
