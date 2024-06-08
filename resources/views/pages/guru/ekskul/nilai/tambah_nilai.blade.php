@extends('layouts.dashboard')
@section('table-name', 'Menambah Nilai Siswa Ekskul')
@section('table-role', 'Guru')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <form class="" action="{{ route('guru.nilai_ekskul.store', ['ekskul_id' => $ekskul->id]) }}"
                    method="POST">
                    @csrf
                    <div class="px-[30px] pt-[20px] grid md:grid-cols-3 gap-4 items-start">
                        <div class="">
                            <h2 class="mb-3 text-gray-800 text-[20px] font-semibold">Daftar Siswa Di <br> Ekskul <span
                                    class="text-violet-700 font-bold  ms-1 capitalize">{{ $ekskul->nama_ekskul }}</span></h2>
                        </div>
                        <div class="md:p-6 md:border-[2px] md:border-gray-100 rounded-md">
                            <label for="semester"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Semester
                            </label>
                            <select id="semester" name="semester"
                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                required>
                                <option value="">Pilih Semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>

                            </select>
                        </div>
                        <div class="md:p-6 md:border-[2px] md:border-gray-100 rounded-md">
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
                                                <h6 class="text-gray-600 text-[16px] font-semibold capitalize col-span-8">
                                                    {{ $data->nama }}
                                                </h6>
                                                <div class="form-check flex  justify-center items-center gap-5 col-span-4">
                                                    <div>
                                                        <input type="text" name="nilai[]"
                                                            class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                            placeholder="Nilai" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit"
                                class="px-10 py-2 rounded-md mt-5 hover:bg-violet-600 bg-violet-400 text-[16px] font-medium text-white ">Simpan</button>
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
