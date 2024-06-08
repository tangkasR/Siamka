@extends('layouts.dashboard')
@section('table-name', 'Jadwal Pelajaran')
@section('table-role', 'Siswa')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 p-0">
                <div class="relative overflow-x-auto card-body  ">
                    <table id="" class="text-center table w-full pt-4 text-gray-800 dark:text-zinc-100">
                        <thead>
                            <tr class="">
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600 bg-blue-200">
                                    Sesi</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600 bg-blue-200">
                                    Senin</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600 bg-blue-200">
                                    Selasa</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600 bg-blue-200">
                                    Rabu</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600 bg-blue-200">
                                    Kamis</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600 bg-blue-200">
                                    Jumat</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600 bg-blue-200">
                                    Sabtu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sesi_perhari as $item_sesi)
                                <tr>
                                    <td class="  border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                        <div class="p-4 bg-blue-50">
                                            {{ $item_sesi->nama_sesi }}
                                        </div>
                                        <div class="p-4 bg-white">
                                            Ruangan
                                        </div>
                                    </td>
                                    @foreach ($jadwal_pelajaran as $data)
                                        @if ($data->sesis->nama_sesi == $item_sesi->nama_sesi)
                                            <td
                                                class="border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                                <div class="p-4 bg-blue-50">
                                                    {{ $data->mata_pelajarans->nama_mata_pelajaran ?? '-' }}
                                                </div>
                                                <div class="p-4 bg-white">
                                                    {{ $data->ruangans->nomor_ruangan }}
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
