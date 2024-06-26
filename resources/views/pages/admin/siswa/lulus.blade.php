@extends('layouts.dashboard')
@section('table-name', 'Meluluskan Siswa')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <form action="{{ route('admin.siswa.lulus') }}" method="POST">
                @csrf
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body border-b border-gray-100 dark:border-zinc-600" id="template_pdf">
                        <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                            <h5 class="text-slate-800 text-[20px] leading-10 font-medium m-0">Meluluskan Siswa dari rombel
                                <span class="text-violet-800 font-bold">{{ $rombel->nama_rombel }}</span>
                            </h5>
                        </div>
                        <div class="relative overflow-x-auto card-body">
                            <div class="grid gap-4 md:grid-cols-2  ">
                                @foreach ($siswas as $siswa)
                                    <div
                                        class="grid md:grid-cols-12 items-center gap-4  bg-white border border-indigo-100 px-1 py-3">
                                        <div class="md:col-span-3 flex items-center justify-center ">
                                            <div class="block rounded-full  mx-auto  min-w-[80px] min-h-[80px]    bg-cover  bg-no-repeat bg-center "
                                                style="background-image: url('{{ $siswa->profil != '-' ? asset('storage/' . $siswa->profil) : asset('assets/img/profil-default.jpg') }}')">
                                            </div>
                                        </div>
                                        <div class="md:col-span-9">
                                            <h5 class="mb-3 font-bold text-lg ">{{ $siswa->nama }}</h5>
                                            <input type="text" value="{{ $siswa->id }}" name="siswa_id[]" hidden>
                                            <div>
                                                <select id="status" name="status[]"
                                                    class="dark:bg-zinc-800 max-w-[150px]  dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                    <option value="lulus" selected>Lulus</option>
                                                    <option value="tidak lulus">Tidak Lulus</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <input type="text" value="{{ $tahun }}" name="tahun" hidden>
                            <input type="text" value="{{ $semester }}" name="semester" hidden>
                            <button type="submit"
                                class="w-fit mt-6 px-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded-md">
                                Luluskan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
