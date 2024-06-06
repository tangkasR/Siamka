@extends('layouts.dashboard')
@section('table-name', 'Menambah Anggota Extrakurikuler')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <form class="" action="{{ route('guru.ekskul.addmember') }}" method="POST">
                    @csrf
                    <div class="px-[30px] pt-[20px]">
                        <h2 class=" text-gray-800 text-[20px] font-semibold">Daftar Siswa Di Rombel <span
                                class="text-violet-700 font-bold  ms-1 capitalize">{{ $rombel->nama_rombel }}</span></h2>
                    </div>
                    <div class="mt-6 border-b border-gray-100 dark:border-zinc-600">
                    </div>
                    <div class="flex justify-center flex-col items-center card-body mb-[20px] px-[30px]">
                        <!-- start grid -->
                        <div class=" w-full ">
                            <input type="text" value="{{ $id }}" name="ekskul_id" hidden>
                            <div class="grid md:grid-cols-3 md:gap-2">
                                @foreach ($siswas as $data)
                                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                        <div class="card-body  grid grid-cols-12 items-center gap-2">
                                            <h6 class="text-gray-600 text-[16px] font-semibold capitalize col-span-8 "
                                                style="line-height: 25px">
                                                {{ $data->nama }}
                                            </h6>
                                            <div class="form-check col-span-4 flex justify-end">
                                                <div>
                                                    <div class="form-check grid grid-cols-2 items-center">
                                                        <label
                                                            class="font-normal text-gray-700 ltr:mr-2 rtl:ml-2 dark:text-zinc-100"
                                                            for="formrow-customCheck-{{ $data->id }}">Pilih</label>
                                                        <input type="checkbox" name="siswa_id[]" value="{{ $data->id }}"
                                                            class="cursor-pointer align-middle rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                            id="formrow-customCheck-{{ $data->id }}">
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
@endsection
