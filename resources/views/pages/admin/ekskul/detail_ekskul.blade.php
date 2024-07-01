@extends('layouts.dashboard')
@section('table-name')
    <span class="capitalize">Daftar Nilai Ekskul {{ $ekskul->nama_ekskul }}</span>
@endsection
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.ekskul.show_ekskul', ['tahun' => $tahun, 'semester' => $semester]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100 capitalize">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="p-4">
                                    Nama Siswa</th>
                                <th class="p-4">
                                    Nama Ekskul</th>
                                <th class="p-4">
                                    Semester</th>
                                <th class="p-4">
                                    Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilais as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4 ">
                                        {{ $data->nama }}</td>
                                    <td class="p-4 ">
                                        {{ $data->nama_ekskul }}</td>
                                    <td class="p-4 ">
                                        {{ $data->semester }}</td>
                                    <td class="p-4 font-bold">
                                        @if ($data->nilai == 'Amat Baik')
                                            <span class="text-[#007BFF]">{{ $data->nilai }}</span>
                                        @endif
                                        @if ($data->nilai == 'Baik')
                                            <span class="text-[#0047AB]">{{ $data->nilai }}</span>
                                        @endif
                                        @if ($data->nilai == 'Cukup')
                                            <span class="text-[#808080]">{{ $data->nilai }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
