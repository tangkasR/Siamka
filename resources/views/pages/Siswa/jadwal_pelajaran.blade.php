@extends('layouts.dashboard')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 p-0">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 p-0">
                    <div class="px-[30px] pt-[20px] pb-[20px]">
                        <h2 class=" text-slate-700 text-[20px] font-bold">Jadwal Pelajaran</h2>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body mb-[50px] ">
                    <div class="relative overflow-x-auto card-body  ">
                        <table id="" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                            <thead class="bg-gray-50 bg-opacity-5">
                                <tr>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Sesi</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Senin</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Selasa</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Rabu</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Kamis</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Jumat</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                        Sabtu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sesi_perhari as $item_sesi)
                                    <tr>
                                        <td class="  border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                            <div class=" p-4">
                                                {{ $item_sesi->nama_sesi }}
                                            </div>
                                            <hr class="text-[0.5px] text-gray-200 w-full ">
                                            <div class="p-4">
                                                Ruangan
                                            </div>
                                        </td>
                                        @foreach ($jadwal_pelajaran as $data)
                                            @if ($data->sesis->nama_sesi == $item_sesi->nama_sesi)
                                                <td
                                                    class="  border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                                    <div class=" p-4">
                                                        {{ $data->mata_pelajarans->nama_mata_pelajaran ?? '-' }}
                                                    </div>
                                                    <hr class="text-[0.5px] w-full text-gray-200">
                                                    <div class="p-4">
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
    </div>
@endsection
