@extends('layouts.dashboard')
@section('table-name', 'Data Nilai')
@section('table-role', 'Guru')
@section('content')
    <div class="grid grid-cols-1 gap-5">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                <div class="grid grid-cols-12">
                    <div class="col-span-10">
                        <h6 class="mb-3 text-gray-600 text-[30px] font-semibold dark:text-gray-100">
                            {{ $rombel->nama_rombel }}</h6>
                        <input type="text" id="rombel_id" value="{{ $rombel_id }}" hidden>
                        <a href="{{ route('guru.nilai.show_input', ['id' => $rombel_id]) }}"
                            class="mt-3 text-white bg-violet-500 border-transparent btn">
                            Tambah Data
                        </a>
                    </div>
                    <div class="col-span-2">
                        <label for=""
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                            Tipe Ujian
                        </label>
                        <select id="tipe_ujian"
                            class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                            <option value="uts">
                                UTS
                            </option>
                            <option value="uas">
                                UAS
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="relative overflow-x-auto card-body">
                <table id="datatable" class="table uppercase w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                    <thead>
                        <tr>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                No</th>

                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                Nama Siswa</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                Nama Mapel</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                Tipe Ujian</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                Nilai</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-container">
                        @foreach ($nilai as $data)
                            @if ($data->tipe_ujian == 'uts')
                                <tr>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>

                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->nama }}</td>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->nama_mata_pelajaran }}</td>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->tipe_ujian }}</td>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->nilai }}</td>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        <button onclick="edit_modal({{ $data->id }})"
                                            class="text-white mb-3 w-[100px] btn bg-violet-500 border-violet-500 hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600"
                                            data-tw-toggle="modal"><i class='bx bxs-edit'></i> Ubah</button>
                                    </td>
                                </tr>
                            @endif
                            <div class="relative z-50 hidden modal" id="modal-id_form_edit_{{ $data->id }}"
                                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="fixed inset-0 z-50 overflow-y-auto">
                                    <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
                                    </div>
                                    <div class="p-4 mx-auto animate-translate sm:max-w-lg">
                                        <div
                                            class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                                            <div class="bg-white dark:bg-zinc-700">
                                                <button type="button"
                                                    class="absolute top-3 right-2.5 text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600"
                                                    data-tw-dismiss="modal">
                                                    <i
                                                        class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                                                </button>
                                                <div class="p-5">
                                                    <h3
                                                        class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100 capitalize">
                                                        Ubah
                                                        Data Nilai {{ $data->nama }}</h3>
                                                    <form class="space-y-4"
                                                        action="{{ route('guru.nilai.update', ['id' => $data->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="nama_siswa"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                Nama Siswa
                                                            </label>
                                                            <input type="text" name="nama_siswa" id="nama_siswa"
                                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                placeholder="Masukan Nama Rombongan Belajar"
                                                                value="{{ $data->nama }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="mapel_id"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                Nama Mata Pelajaran
                                                            </label>
                                                            <input type="text" name="nama_mata_pelajaran"
                                                                id="nama_mata_pelajaran"
                                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                placeholder="Masukan Nama Rombongan Belajar"
                                                                value="{{ $data->nama_mata_pelajaran }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tipe_ujian"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                Tipe Ujian
                                                            </label>
                                                            <select id="tipe_ujian" name="tipe_ujian"
                                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                <option value="uts"
                                                                    {{ $data->tipe_ujian == 'uts' ? 'selected' : '' }}>
                                                                    uts</option>
                                                                <option value="uas"
                                                                    {{ $data->tipe_ujian == 'uas' ? 'selected' : '' }}>
                                                                    uas</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nilai"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                Nilai
                                                            </label>
                                                            <input type="text" name="nilai" id="nilai"
                                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                placeholder="Masukan Nama Rombongan Belajar"
                                                                value="{{ $data->nilai }}" required>
                                                        </div>
                                                        <button type="submit"
                                                            class="w-full text-white bg-green-600 border-transparent btn">
                                                            Simpan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function edit_modal(id) {
            console.log(`masok ${id}`)
            const container = document.getElementById(`modal-id_form_edit_${id}`)
            container.classList.remove('hidden')
        }
        $(document).ready(function() {
            $('#tipe_ujian').on('change', function() {
                let tipe_ujian = $('#tipe_ujian').val()
                let rombel_id = $('#rombel_id').val()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let url = '{{ route('guru.nilai.filter') }}';
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        'tipe_ujian': tipe_ujian,
                        'rombel_id': rombel_id
                    },
                    success: function(response) {
                        if (response != null) {
                            if (response != null) {
                                tabel(response)
                            } else {}
                        }
                    }
                });

            })

            function tabel(data) {
                console.log(data)
                let container = document.getElementById('tabel-container')
                container.innerHTML = ''
                let row = ''
                for (i = 0; i < data.length; i++) {
                    row = `
                    <tr>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${i+1}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].nama}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].nama_mata_pelajaran}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].tipe_ujian}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].nilai}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            <button onclick="edit_modal(${data[i].id})"
                                class="text-white mb-3 w-[100px] btn bg-violet-500 border-violet-500 hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600"
                                data-tw-toggle="modal"><i class='bx bxs-edit'></i> Ubah</button>
                        </td>
                    </tr>
                    `;
                    container.innerHTML += row
                }
            }
        });
    </script>

    @if (session('message'))
        <script>
            $(document).ready(function() {
                $.toast({
                    text: `
        <div class="py-2 font-bold text-[14px]">
            {{ Session::get('message') }}
        </div>
        `,
                    showHideTransition: 'slide',
                    // textColor: 'black',
                    icon: 'success',
                    position: 'top-right',
                    allowToastClose: false,
                    bgColor: '#00d447',
                    loaderBg: '#6f00ff',
                    hideAfter: 3000,
                    stack: false
                })
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            $(document).ready(function() {
                $.toast({
                    text: `
        <div class="py-2 font-bold text-[14px]">
            {{ Session::get('error') }}
        </div>
        `,
                    showHideTransition: 'slide',
                    // textColor: 'black',
                    icon: 'error',
                    position: 'top-right',
                    allowToastClose: false,
                    bgColor: '#fc3b2d',
                    loaderBg: '#6f00ff',
                    hideAfter: 6000,
                    stack: false
                })
            });
        </script>
    @endif
@endsection
