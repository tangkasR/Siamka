@extends('layouts.dashboard')
@section('table-name', 'Jadwal Pelajaran')
@section('table-role', 'Siswa')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 p-0">
                <div class="relative overflow-x-auto card-body  ">
                    <table id="" class="text-center table w-full pt-4 text-gray-800 dark:text-zinc-100 capitalize">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="p-4">
                                    Sesi</th>
                                <th class="p-4">
                                    Senin</th>
                                <th class="p-4">
                                    Selasa</th>
                                <th class="p-4">
                                    Rabu</th>
                                <th class="p-4">
                                    Kamis</th>
                                <th class="p-4">
                                    Jumat</th>
                                <th class="p-4">
                                    Sabtu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sesi_perhari as $item_sesi)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="">
                                        <div class="p-4 ">
                                            {{ $item_sesi->nama_sesi }}
                                        </div>
                                        <div class="p-4 ">
                                            Ruangan
                                        </div>
                                        <div class="p-4 ">
                                            Pengajar
                                        </div>
                                    </td>
                                    @foreach ($jadwal_pelajaran as $data)
                                        @if ($data->sesis->nama_sesi == $item_sesi->nama_sesi)
                                            <td class="">
                                                <div class="p-4 ">
                                                    {{ $data->nama_mata_pelajaran ?? '-' }}
                                                </div>
                                                <div class="p-4 ">
                                                    {{ $data->ruangans->nomor_ruangan }}
                                                </div>
                                                <div class="p-4 ">
                                                    {{ $data->gurus->nama }}
                                                </div>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
