@extends('layouts.dashboard')
@section('table-name')
    Daftar Jadwal Mengajar
@endsection
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="" class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="md:flex md:justify-between md:items-center ">
                        <div>
                            <h1 class="text-[18px] font-medium capitalize leading-7">Tahun Ajaran
                                {{ str_replace('-', '/', $tahun) }},
                                Semester
                                {{ $semester }}</h1>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body" id="template_pdf">
                    <div class="ms-12 hidden" id="print_nama_rombel">
                        <h1 class="text-[20px] font-medium">Daftar Jadwal Mengajar</h1>
                    </div>
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100 capitalize">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="p-4">
                                    Hari</th>
                                <th class="p-4">
                                    Sesi</th>
                                <th class="p-4">
                                    Rombel</th>
                                <th class="p-4">
                                    Ruangan</th>
                                <th class="p-4">
                                    Mata Pelajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4">
                                        {{ $data->hari }}</td>
                                    <td class="p-4">
                                        {{ $data->sesis->nama_sesi }}</td>
                                    <td class="p-4">
                                        {{ $data->rombels->nama_rombel }}</td>
                                    <td class="p-4">
                                        {{ $data->ruangans->nomor_ruangan }}</td>
                                    <td class="p-4">
                                        {{ $data->nama_mata_pelajaran }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
