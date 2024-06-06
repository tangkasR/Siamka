@extends('layouts.dashboard')
@section('table-name', 'Aktivasi Siswa')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <form class="" action="{{ route('admin.siswa.aktivasi') }}" method="POST">
                    @csrf
                    <div class="px-[30px] pt-[20px]">
                        <div class="">
                            <h2 class="mb-3 text-gray-800 text-[24px] font-semibold">Mengaktifkan Siswa</h2>
                            <h5 class="text-slate-700">Daftar Siswa Rombel <span
                                    class="text-violet-700 font-bold text-[18px] ms-1">{{ $rombel->nama_rombel }}</span>
                            </h5>
                        </div>
                    </div>
                    <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    </div>
                    <div class="flex justify-center flex-col items-center card-body">
                        <!-- start grid -->
                        <div class=" w-full ">
                            <input type="text" value="{{ $rombel->id }}" name="rombel_id" hidden>
                            <div class="grid md:grid-cols-2 md:gap-4 gap-3">
                                @foreach ($siswas as $data)
                                    <div class="">
                                        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                            <div class="card-body flex justify-between items-center gap-3">
                                                <h6 class="text-gray-600 text-[16px] font-semibold capitalize">
                                                    {{ $data->nama }}
                                                </h6>
                                                <div class="form-check flex justify-center items-center gap-5">
                                                    <div>
                                                        <div class="form-check">
                                                            <label
                                                                class="font-normal text-gray-700 ltr:mr-2 rtl:ml-2 dark:text-zinc-100"
                                                                for="formrow-customCheck-{{ $data->id }}">Aktifkan</label>
                                                            <input type="checkbox" name="siswa_id[]"
                                                                value="{{ $data->id }}"
                                                                class="cursor-pointer align-middle rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                                id="formrow-customCheck-{{ $data->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit"
                                class="px-6 py-2 mt-3 rounded-lg bg-green-500 text-[16px] font-bold text-white">Simpan</button>
                        </div>
                        <!-- end grid -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
