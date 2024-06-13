@extends('layouts.dashboard')
@section('table-name', 'Jadwal Pelajaran')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 ">
                    <h5 class="text-slate-800 text-[20px] mb-3 font-semibold">Jadwal
                        Pelajaran di Rombel <span class="text-violet-800 font-bold">{{ $rombel->nama_rombel }}</span></h5>
                    <div class="grid md:grid-cols-3  mt-6 md:gap-3 gap-5">
                        {{-- <form action="/siswa" method="POST" enctype="multipart/form-data"> --}}
                        <div>
                            <label for="file"
                                class="block mb-3 text-[16px] font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Template Excel Tambah Data
                            </label>
                            <button id="btn-download" type="button"
                                class=" w-full text-white bg-gray-600 border-transparent btn">
                                Download
                            </button>
                            {{-- template excel --}}
                            <input hidden type="text" id="nama_rombel_input" value="{{ $rombel->nama_rombel }}">
                            <table id="template-input" hidden>
                                <thead>
                                    <tr>
                                        <th>
                                            hari</th>
                                        <th>
                                            sesi</th>
                                        <th>
                                            guru</th>
                                        <th>
                                            mapel</th>
                                        <th>
                                            ruangan</th>
                                        <th>
                                            rombel</th>

                                    </tr>
                                </thead>
                                <tbody id="data_template">
                                    @foreach ($templates as $template)
                                        <tr>
                                            <td>{{ $template['hari'] }}</td>
                                            <td>{{ $template['sesi'] }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $template['rombel'] }}</td>
                                        </tr>
                                    @endforeach
                                    <tr></tr>
                                    <tr></tr>
                                    <tr>
                                        <th>Pilih Mapel -> </th>
                                        @foreach ($mapel as $data_mapel)
                                            <th>
                                                {{ $data_mapel->nama_mata_pelajaran }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        <th>Pilih Ruangan -> </th>
                                        @foreach ($ruangan as $data_ruangan)
                                            <th>
                                                {{ $data_ruangan->nomor_ruangan }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Pilih guru -> </th>
                                        @foreach ($gurus as $data_guru)
                                            <th>
                                                {{ $data_guru->nama }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            {{-- end template excel --}}
                        </div>
                        <form action="{{ route('admin.jadwal_pelajaran.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <label class="block mb-2 text-[16px] font-medium text-gray-900 dark:text-white"
                                for="file">Tambah Data Jadwal Pelajaran</label>
                            <input
                                class="block w-full text-[16px] text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file" type="file" name="file" required>
                            <button type="submit" class="mt-3 w-full text-white bg-violet-500 border-transparent btn">
                                Simpan
                            </button>
                        </form>
                        <div class=" text-right flex justify-end">
                            <div class="w-[250px]">
                                <p class="md:text-[16px] text-[14px] font-semibold text-gray-500">Hapus Semua Data Jadwal di
                                    Rombel
                                    {{ $rombel->nama_rombel }}</p>
                                <a class="cursor-pointer text-white btn w-full mt-3 bg-red-300 border-red-500 hover:bg-red-300 focus:ring ring-red-200 focus:bg-red-600"
                                    data-tw-toggle="modal" data-tw-target="#modal-id_form_destroy"><i
                                        class='bx bxs-edit'></i>
                                    Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
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
                            @foreach ($sesi as $item_sesi)
                                <tr>
                                    <td class="  border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                        <div class="p-4 bg-blue-50">
                                            {{ $item_sesi->nama_sesi }}
                                        </div>
                                        <div class="p-4 bg-white border-b">
                                            Ruangan
                                        </div>
                                        <div class="p-4 bg-white">
                                            Pengajar
                                        </div>
                                    </td>
                                    @foreach ($jadwal_pelajaran as $data)
                                        @if ($data->sesis->nama_sesi == $item_sesi->nama_sesi)
                                            <td
                                                class="border cursor-pointer border-t-0 rtl:border-l-0 border-gray-200 hover:bg-blue-500 hover:text-blue-500">
                                                <a class="" data-tw-toggle="modal"
                                                    data-tw-target="#modal-id_form_edit_{{ $loop->iteration }}"
                                                    data-tw-id="{{ $loop->iteration }}">
                                                    <div class="p-4 bg-blue-50">
                                                        {{ $data->nama_mata_pelajaran ?? '-' }}
                                                    </div>
                                                    <div class="p-4 bg-white border-b">
                                                        {{ $data->ruangans->nomor_ruangan }}
                                                    </div>
                                                    <div class="p-4 bg-white">
                                                        {{ $data->gurus->nama }}
                                                    </div>
                                                </a>
                                            </td>
                                            {{-- Modal Edit --}}
                                            <div class="relative z-50 hidden modal"
                                                id="modal-id_form_edit_{{ $loop->iteration }}"
                                                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                <div class="fixed inset-0 z-50 overflow-y-auto">
                                                    <div
                                                        class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
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
                                                                        class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                                        Ubah
                                                                        Data Jadwal Pelajaran</h3>
                                                                    <form class="space-y-4"
                                                                        action="{{ route('admin.jadwal_pelajaran.update', ['id' => $data->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="hari"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                                Hari
                                                                            </label>
                                                                            <input type="text" name="hari"
                                                                                id="hari"
                                                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                                placeholder="Masukan Nama Hari"
                                                                                value="{{ $data->hari }}" disabled>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="hari"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                                Sesi
                                                                            </label>
                                                                            <input type="text" name="hari"
                                                                                id="hari"
                                                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                                placeholder="Masukan Nama Hari"
                                                                                value="{{ $data->sesis->nama_sesi }}"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="guru_id"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                                Guru
                                                                            </label>
                                                                            <select id="guru_id_{{ $loop->iteration }}"
                                                                                name="guru_id"
                                                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                                <option value="">-</option>
                                                                                @foreach ($gurus as $item_guru)
                                                                                    <option value="{{ $item_guru->id }}"
                                                                                        {{ $item_guru->id == $data->guru_id ? 'selected' : '' }}>
                                                                                        {{ $item_guru->nama }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="nama_mata_pelajaran"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                                Mata Pelajaran
                                                                            </label>
                                                                            <select required
                                                                                id="mapel_select_{{ $loop->iteration }}"
                                                                                name="nama_mata_pelajaran"
                                                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                                <option
                                                                                    value="{{ $data->nama_mata_pelajaran }}">
                                                                                    {{ $data->nama_mata_pelajaran }}
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="ruangan_id"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                                Ruangan
                                                                            </label>
                                                                            <select id="ruangan_id" name="ruangan_id"
                                                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                                <option value="">-</option>
                                                                                @foreach ($ruangan as $item_ruangan)
                                                                                    <option
                                                                                        value="{{ $item_ruangan->id }}"
                                                                                        {{ $item_ruangan->id == $data->ruangan_id ? 'selected' : '' }}>
                                                                                        {{ $item_ruangan->nomor_ruangan }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <div class="mb-3">
                                                                                <label for="hari"
                                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                                    Rombongan Belajar
                                                                                </label>
                                                                                <input type="text" name="hari"
                                                                                    id="hari"
                                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                                    placeholder="Masukan Nama Hari"
                                                                                    value="{{ $rombel->nama_rombel }}"
                                                                                    disabled>
                                                                            </div>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="w-full text-white bg-violet-600 border-transparent btn">
                                                                            Simpan
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Modal Edit --}}
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
    {{-- Modal Destroy --}}
    <div class="relative z-50 hidden modal" id="modal-id_form_destroy" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
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
                            <i class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                        </button>
                        <div class="p-5">
                            <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                Apakah Anda ingin menghapus semua jadwal <br> Rombel {{ $rombel->nama_rombel }}</h3>
                            <form class="space-y-4"
                                action="{{ route('admin.jadwal_pelajaran.destroy', ['id' => $rombel->id]) }}"
                                method="GET">
                                @csrf
                                <button type="submit" class="w-full text-white bg-red-600 border-transparent btn">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Destroy --}}


    <script>
        const nama_rombel = document.getElementById('nama_rombel_input').value
        document.getElementById('btn-download').addEventListener('click', () => {
            const workbook = XLSX.utils.book_new();
            const tableInputJadwalPelajaran = document.getElementById('template-input');
            const worksheetJadwalPelajaran = XLSX.utils.table_to_sheet(tableInputJadwalPelajaran);
            XLSX.utils.book_append_sheet(workbook, worksheetJadwalPelajaran, 'Template Input Jadwal Pelajaran');
            XLSX.writeFile(workbook, `template-input-jadwal-pelajaran-${nama_rombel}.xlsx`);
        })
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

    <script>
        $(document).ready(function() {
            function updateMapelDropdown(teacherId, id) {
                var url = '{{ route('admin.jadwal_pelajaran.get-mapels', ':teacherId') }}';
                url = url.replace(':teacherId', teacherId);
                let mapelContainer = $(`#mapel_select_${id}`);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        mapelContainer.html(`<option value="">-- Pilih Mata Pelajaran --</option>`)
                        data.map((mapel) => {
                            mapelContainer.append(
                                `<option value=${mapel.nama_mata_pelajaran}>${mapel.nama_mata_pelajaran}</option>`
                            )
                        })
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }







            // Reattach event listener every time the modal is shown
            $('[data-tw-toggle="modal"]').on('click', function() {
                var modalId = $(this).data('tw-target');
                let id = $(this).data('tw-id');

                $(document).on("change", `#guru_id_${id}`, function() {
                    // console.log($(`#guru_id_${id}`));
                    var teacherId = $(`#guru_id_${id}`).val();
                    if (teacherId) {
                        updateMapelDropdown(teacherId, id);
                    } else {
                        $('#mapel_select').empty();
                        $('#mapel_select').append(
                            '<option value="">-- Pilih Mata Pelajaran --</option>');
                    }
                });
                // $(modalId).on('shown.bs.modal', function() {
                //     console.log(modalId, id);
                //     $(`#guru_id_${id}`).trigger('change');

                // });

            });
        });
    </script>

@endsection
