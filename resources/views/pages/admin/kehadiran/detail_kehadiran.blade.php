@extends('layouts.dashboard')
@section('table-name')
    <span class="capitalize">Data Kehadiran {{ $rombel->nama_rombel }} - {{ str_replace('-', '/', $tahun) }} -
        {{ $semester }}</span>
@endsection
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.kehadiran.show_kehadiran', ['tahun' => $tahun, 'semester' => $semester]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="bg-white shadow-md">
        <div class="">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="relative overflow-x-auto card-body">
                    <div class="mb-3">
                        <input
                            class="w-[200px] border-gray-100 rounded placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                            type="date" value="{{ $tanggal }}" id="tanggal">
                    </div>
                    <table id="" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nama Siswa</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Kehadiran</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-container">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="text" value="{{ $rombel->id }}" id="rombel_id" hidden>

    <script>
        $(document).ready(function() {
            let url = null;
            let container = document.getElementById('tabel-container')

            url = '{{ route('admin.kehadiran.get_kehadiran') }}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: url,
                data: getDatas(),
                success: function(response) {
                    if (response.length != 0) {
                        container.innerHTML = ''
                        createTable(response)
                    }
                }
            });


            // filter
            filter('#tanggal')

            function filter(id_select) {
                $(id_select).on('change', function() {
                    url = '{{ route('admin.kehadiran.get_kehadiran') }}';
                    page = 1;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: getDatas(),
                        success: function(response) {
                            container.innerHTML = ''
                            if (response.length != 0) {
                                createTable(response)
                            }
                        }
                    });
                })
            }

            function getDatas() {
                let rombel_id = $('#rombel_id').val()
                let tanggal = $('#tanggal').val()
                let datas = {
                    'tanggal': tanggal,
                    'rombel_id': rombel_id,
                }
                return datas
            }

            function createTable(datas) {
                let row = ''
                for (let i = 0; i < datas.length; i++) {
                    let keterangan = '-'

                    let date = datas[i].tanggal
                    let tahun = date.split('-')[0]
                    let bulan = date.split('-')[1]
                    let tanggal = date.split('-')[2]
                    let text_color = '';
                    if (datas[i].kehadiran == 'hadir') {
                        text_color = 'text-green-500 font-medium'
                    }
                    if (datas[i].kehadiran == 'sakit') {
                        text_color = 'text-blue-500 font-medium'
                    }
                    if (datas[i].kehadiran == 'izin') {
                        text_color = 'text-slate-500 font-medium'
                    }
                    if (datas[i].kehadiran == 'alpa') {
                        text_color = 'text-red-500 font-medium'
                    }

                    if (datas[i].keterangan != null) {
                        keterangan = datas[i].keterangan
                    }
                    row = `
                <tr class="${(i + 1) % 2 == 0 ? 'bg-blue-50' : 'bg-white'}">
                    <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                        ${datas[i].nama}</td>
                    <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600 ${text_color}">
                        ${datas[i].kehadiran}</td>
                    <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                        ${tanggal}-${bulan}-${tahun}</td>
                </tr>
                `;
                    container.innerHTML += row
                }
            }


        });
    </script>
@endsection
