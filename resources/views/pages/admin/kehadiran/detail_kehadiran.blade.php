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
                    <div class="mb-3 flex justify-between items-center">
                        <div class="">
                            <h6 class="mb-3 text-gray-700 text-[16px] dark:text-gray-100 font-medium">Menampilkan daftar
                                kehadiran siswa tanggal {{ $tanggal }}
                            </h6>
                        </div>
                        <div class=" flex gap-4 items-center">
                            <a type="submit"
                                href="{{ route('admin.kehadiran.show_input', ['tahun' => $tahun, 'semester' => $semester, 'id' => $rombel->id]) }}"
                                class=" w-fit md:mt-0 mt-6 cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md flex items-center justify-center gap-2">
                                <span>Tambah Data</span> <i class='bx bxs-plus-circle text-[25px]'></i>
                            </a>
                            <input
                                class="w-[200px] border-gray-100 rounded placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                type="date" value="{{ $tanggal }}" id="tanggal">
                        </div>
                    </div>
                    <div id="tabel-container">
                    </div>
                </div>
            </div>
        </div>
        <input type="text" value="{{ $rombel->id }}" id="rombel_id" hidden>
        <input type="text" value="{{ $tahun }}" id="tahun" hidden>
        <input type="text" value="{{ $semester }}" id="semester" hidden>
        <input type="text" value="{{ $tahun_ajaran_id }}" id="tahun_ajaran_id" hidden>

        <script>
            $(document).ready(function() {
                let url = null;

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
                        $('#tabel-container').html(response.html)
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
                            datatype: 'html',
                            success: function(response) {
                                $('#tabel-container').html(response.html)
                            }
                        });
                    })
                }

                function getDatas() {
                    let rombel_id = $('#rombel_id').val()
                    let tahun = $('#tahun').val()
                    let semester = $('#semester').val()
                    let tahun_ajaran_id = $('#tahun_ajaran_id').val()
                    let tanggal = $('#tanggal').val()
                    let datas = {
                        'tanggal': tanggal,
                        'rombel_id': rombel_id,
                        'tahun': tahun,
                        'semester': semester,
                        'tahun_ajaran_id': tahun_ajaran_id,
                    }
                    return datas
                }
            });
        </script>


        @if (session('message'))
            <script>
                toast('message', '{{ Session::get('message') }}')
            </script>
        @endif
        @if (session('error'))
            <script>
                toast('error', '{{ Session::get('error') }}')
            </script>
        @endif
    @endsection
