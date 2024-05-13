@extends('layouts.dashboard')
@section('table-name', 'Data Kehadiran')
@section('table-role', 'Guru')
@section('content')
    <div class="grid grid-cols-1 gap-5">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                <div class="grid grid-cols-12">
                    <div class="col-span-10">
                        <h6 class="mb-1 text-gray-700 text-15 dark:text-gray-100">Data Kehadiran</h6>
                        <input type="text" id="rombel_id" value="{{ $rombel_id }}" hidden>
                        <a href="{{ route('guru.kehadiran.show_input', ['id' => $rombel_id]) }}"
                            class="mt-3 text-white bg-violet-500 border-transparent btn">
                            Tambah Data
                        </a>
                    </div>
                    <div class="col-span-2">
                        <label for=""
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                            Tanggal
                        </label>
                        <select id="tanggal"
                            class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                            @foreach ($tanggal as $data)
                                <option value="{{ $data->tanggal }}" {{ $data->tanggal == $date ? 'selected' : '' }}>
                                    {{ $data->tanggal }}
                                </option>
                            @endforeach
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
                                Kehadiran</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                Keterangan</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                Tanggal</th>
                            <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="container_data">
                        @foreach ($kehadiran as $data)
                            @if ($data->tanggal == $date)
                                <tr>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->nama }}</td>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->kehadiran }}</td>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->keterangan == null ? '-' : $data->keterangan }}</td>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->tanggal }}</td>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        <button onclick="edit_modal({{ $data->siswa_id }}, {{ $data->id }})"
                                            class="text-white mb-3 w-[100px] btn bg-violet-500 border-violet-500 hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600"
                                            data-tw-toggle="modal"><i class='bx bxs-edit'></i> Ubah</button>
                                    </td>
                                </tr>
                            @endif

                            {{-- Modal Edit --}}
                            <div class="relative z-50 hidden modal"
                                id="modal-id_form_edit_{{ $data->siswa_id }}_{{ $data->id }}"
                                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="fixed inset-0 z-50 overflow-y-auto">
                                    <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
                                    </div>
                                    <div class="p-4 mx-auto animate-translate sm:max-w-4xl">
                                        <div
                                            class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                                            <div class="bg-white dark:bg-zinc-700">
                                                <div class="p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
                                                    <h3 class="mb-2 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                        Ubah
                                                        Data Kehadiran {{ $data->nama }} </h3>
                                                    <p class="text-sm font-medium text-gray-600">Tanggal:
                                                        {{ $data->tanggal }}</p>
                                                </div>
                                                <form class="space-y-4"
                                                    action="{{ route('guru.kehadiran.update', ['id' => $data->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="p-6 grid grid-cols-12 gap-4 items-center">
                                                        <div class="mx-auto col-span-4">
                                                            <label for="nama_siswa"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                Nama Siswa
                                                            </label>
                                                            <input type="text" name="nama_siswa" id="nama_siswa"
                                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                placeholder="Masukan Nama Rombongan Belajar"
                                                                value="{{ $data->nama }}" required>
                                                        </div>
                                                        <div class="mx-auto col-span-2">
                                                            <input type="checkbox" value="hadir" name="daftar_kehadiran"
                                                                class=" rounded  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500 focus:border-violet-100 focus:ring focus:ring-violet-500/20"
                                                                id="autoSizingCheck1">
                                                            <label class="ms-2 text-gray-700 dark:text-zinc-100"
                                                                for="autoSizingCheck1">
                                                                Hadir</label>
                                                        </div>
                                                        <div class="mx-auto col-span-2">
                                                            <input type="checkbox" value="tidak hadir"
                                                                name="daftar_kehadiran"
                                                                class=" rounded  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 dark:checked:bg-violet-500 focus:border-violet-100 focus:ring focus:ring-violet-500/20"
                                                                id="autoSizingCheck2">
                                                            <label class="ms-2 text-gray-700 dark:text-zinc-100"
                                                                for="autoSizingCheck2">
                                                                Tidak Hadir</label>
                                                        </div>
                                                        <div class="mx-auto col-span-4">
                                                            <label class=" text-gray-700 dark:text-zinc-100"
                                                                for="autoSizingCheck">
                                                                Keterangan</label>
                                                            <input type="text" name="keterangan" id="keterangan"
                                                                class="bg-gray-800/5 border border-gray-100 mt-2 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                placeholder="Masukan Keterangan">
                                                        </div>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div
                                                        class=" gap-3 p-5 grid grid-cols-12 border-t rounded-b border-gray-50 dark:border-zinc-600">
                                                        <button type="submit"
                                                            class="col-span-3 w-full text-white bg-green-600 border-transparent btn">
                                                            Simpan
                                                        </button>
                                                        <a href="{{ url()->previous() }}"
                                                            class="w-full text-white bg-gray-600  col-span-3 border-transparent btn">
                                                            Batal
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Edit --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function edit_modal(id_siswa, id_kehadiran) {
            // console.log(`masok ${id}`)
            const container = document.getElementById(`modal-id_form_edit_${id_siswa}_${id_kehadiran}`)
            container.classList.remove('hidden')
        }

        $(document).ready(function() {
            $('#tanggal').on('click', function() {
                let tanggal = $('#tanggal').val()
                let rombel_id = $('#rombel_id').val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let url = '{{ route('guru.kehadiran.filter') }}';
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        'tanggal': tanggal,
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
                let container = document.getElementById('container_data')
                container.innerHTML = ''
                let row = ''
                let keterangan = '-'
                for (i = 0; i < data.length; i++) {
                    if (data[i].keterangan != null) {
                        keterangan = data[i].keterangan
                    }
                    row = `
                    <tr>
                        <td
                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${i+1}</td>
                        <td
                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].nama}</td>
                        <td
                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].kehadiran}</td>
                        <td
                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${keterangan}</td>
                        <td
                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].tanggal}</td>
                        <td
                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            <button onclick="edit_modal(${data[i].siswa_id}, ${data[i].id})"
                                class="text-white mb-3 w-[100px] btn bg-violet-500 border-violet-500 hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600"
                                data-tw-toggle="modal"><i class='bx bxs-edit'></i> Ubah</button>
                        </td>
                    </tr>
                    `;
                    container.innerHTML += row
                    keterangan = '-'
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
