@extends('layouts.dashboard')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 p-0">
                    <div class="px-[30px] pt-[20px] pb-[20px]">
                        <h2 class=" text-slate-700 text-[20px] font-bold">Kehadiran</h2>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body mb-[50px]">
                    <div class="relative overflow-x-auto card-body text-center">
                        {{-- <div class="grid grid-cols-7 ">
                            <div class="p-3 outline outline-1 outline-gray-300 rounded-tl-md">
                                <div>
                                    <h5>Sesi</h5>
                                </div>
                            </div>
                            <div class="p-3 outline outline-1 outline-gray-300">
                                <h5>Senin</h5>
                            </div>
                            <div class="p-3 outline outline-1 outline-gray-300">
                                <h5>Selasa</h5>
                            </div>
                            <div class="p-3 outline outline-1 outline-gray-300">
                                <h5>Rabu</h5>
                            </div>
                            <div class="p-3 outline outline-1 outline-gray-300">
                                <h5>Kamis</h5>
                            </div>
                            <div class="p-3 outline outline-1 outline-gray-300">
                                <h5>Jumat</h5>
                            </div>
                            <div class="p-3 outline outline-1 outline-gray-300 rounded-tr-md">
                                <h5>Sabtu</h5>
                            </div>
                        </div>
                        <div class="grid grid-cols-7">
                            <div class="outline outline-1 outline-gray-300 rounded-b-md">
                                @foreach ($jadwal_pelajaran as $data_jadwal)
                                    @if ($data_jadwal->hari == 'senin')
                                        <div class="outline outline-1 outline-gray-300 col-span-3">
                                            <div class="p-3 ">
                                                {{ $data_jadwal->sesi->nama_sesi }}
                                            </div>
                                        </div>
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                Ruang
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class=" outline outline-1 outline-gray-300">
                                @foreach ($jadwal_pelajaran as $data_jadwal)
                                    @if ($data_jadwal->hari == 'senin')
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->mapel->nama_mata_pelajaran }}
                                            </div>
                                        </div>
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->ruangan->nomor_ruangan }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class=" outline outline-1 outline-gray-300">
                                @foreach ($jadwal_pelajaran as $data_jadwal)
                                    @if ($data_jadwal->hari == 'selasa')
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->mapel->nama_mata_pelajaran }}
                                            </div>
                                        </div>
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->ruangan->nomor_ruangan }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class=" outline outline-1 outline-gray-300">
                                @foreach ($jadwal_pelajaran as $data_jadwal)
                                    @if ($data_jadwal->hari == 'rabu')
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->mapel->nama_mata_pelajaran }}
                                            </div>
                                        </div>
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->ruangan->nomor_ruangan }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class=" outline outline-1 outline-gray-300">
                                @foreach ($jadwal_pelajaran as $data_jadwal)
                                    @if ($data_jadwal->hari == 'kamis')
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->mapel->nama_mata_pelajaran }}
                                            </div>
                                        </div>
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->ruangan->nomor_ruangan }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class=" outline outline-1 outline-gray-300">
                                @foreach ($jadwal_pelajaran as $data_jadwal)
                                    @if ($data_jadwal->hari == 'jumat')
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->mapel->nama_mata_pelajaran }}
                                            </div>
                                        </div>
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->ruangan->nomor_ruangan }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class=" outline outline-1 outline-gray-300 rounded-br-md">
                                @foreach ($jadwal_pelajaran as $data_jadwal)
                                    @if ($data_jadwal->hari == 'sabtu')
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->mapel->nama_mata_pelajaran }}
                                            </div>
                                        </div>
                                        <div class="outline outline-1 outline-gray-300">
                                            <div class="p-3">
                                                {{ $data_jadwal->ruangan->nomor_ruangan }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
