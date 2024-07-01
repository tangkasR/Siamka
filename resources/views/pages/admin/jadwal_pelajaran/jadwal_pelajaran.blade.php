@extends('layouts.dashboard')
@section('table-name')
    Jadwal Pelajaran {{ $rombel->nama_rombel }}
@endsection
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.rombel.show', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 ">
                    <div class="md:flex md:justify-between md:items-start">
                        <div class="md:mb-0 mb-6">
                            <h1 class="text-[18px] font-medium capitalize leading-7">Tahun Ajaran
                                {{ str_replace('-', '/', $tahun) }},
                                Semester
                                {{ $semester }}</h1>
                        </div>
                        <div class="flex gap-4">

                            <div class="relative dropdown ">
                                <button type="button"
                                    class="dropdown-toggle flex gap-2 justify-center items-center cursor-pointer text-center md:w-[180px] w-[148px] border border-blue-500 bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"><span>Tambah Data</span> <i
                                        class='bx bxs-plus-circle text-[20px]'></i></button>

                                <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                    aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                    <li>
                                        <a class="cursor-pointer block w-full px-4 py-1 text-sm font-medium text-black bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                            id="btn-download">
                                            Download Template
                                        </a>
                                    </li>
                                    <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                    <li>
                                        <a class="cursor-pointer block text-blue-700 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 "
                                            href="{{ route('admin.jadwal.tambah_data', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}">
                                            Import Jadwal</a>
                                    </li>
                                    @if (count($jadwal_pelajaran) == 0)
                                        <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                        <li>
                                            <a data-tw-toggle="modal" data-tw-target="#modal-id_migration"
                                                class="cursor-pointer block text-green-500 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 ">
                                                Transfer Data</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="">
                                <a class="flex gap-2 justify-center items-center cursor-pointer text-center md:w-[180px] w-[148px] border border-blue-500 hover:bg-blue-500 hover:text-white text-blue-500 font-medium py-2 px-4 rounded-md transition-all duration-300"
                                    data-tw-toggle="modal" data-tw-target="#modal-id_form_destroy">
                                    <span> Hapus</span><i class='bx bxs-trash text-[20px]'></i></a>
                            </div>
                        </div>
                        <div class="" hidden>
                            {{-- template excel --}}
                            <input type="text" id="nama_rombel_input" value="{{ $rombel->nama_rombel }}">
                            <table id="template-input">
                                <thead>
                                    <tr>
                                        <th>
                                            hari</th>
                                        <th>
                                            sesi</th>
                                        <th>
                                            niy_guru</th>
                                        <th>
                                            ruangan</th>
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
                                        </tr>
                                    @endforeach
                                    <tr></tr>
                                    <tr></tr>
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
                                                {{ $data_guru->nomor_induk_yayasan }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            {{-- end template excel --}}
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="" class="text-center table w-full pt-4 text-gray-800 dark:text-zinc-100 capitalize">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="p-4 ">
                                    Sesi</th>
                                <th class="p-4 ">
                                    Senin</th>
                                <th class="p-4 ">
                                    Selasa</th>
                                <th class="p-4 ">
                                    Rabu</th>
                                <th class="p-4 ">
                                    Kamis</th>
                                <th class="p-4 ">
                                    Jumat</th>
                                <th class="p-4 ">
                                    Sabtu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sesi as $item_sesi)
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
                                            <td class=" cursor-pointer  hover:bg-blue-400  hover:text-white">
                                                <a class="" data-tw-toggle="modal"
                                                    data-tw-target="#modal-id_form_edit_{{ $loop->iteration }}"
                                                    data-tw-id="{{ $loop->iteration }}">
                                                    <div class="p-4">
                                                        {{ $data->nama_mata_pelajaran ?? '-' }}
                                                    </div>
                                                    <div class="p-4">
                                                        {{ $data->ruangans->nomor_ruangan }}
                                                    </div>
                                                    <div class="p-4">
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
                                                    <div class="p-4 mx-auto animate-translate sm:max-w-2xl">
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
                                                                        <div class="mb-3 grid grid-cols-2 gap-4">
                                                                            <div>
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
                                                                            <div>
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
                                                                        </div>
                                                                        <div class="mb-3 grid grid-cols-2 gap-4">
                                                                            <div>
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
                                                                            <div>
                                                                                <label for="guru_id"
                                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                                    Guru
                                                                                </label>
                                                                                <select
                                                                                    id="guru_id_{{ $loop->iteration }}"
                                                                                    name="guru_id"
                                                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                                    <option value="">-</option>
                                                                                    @foreach ($gurus as $item_guru)
                                                                                        <option
                                                                                            value="{{ $item_guru->id }}"
                                                                                            {{ $item_guru->id == $data->guru_id ? 'selected' : '' }}>
                                                                                            {{ $item_guru->nama }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-6 grid grid-cols-2 gap-4">
                                                                            <div>
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
                                                                            <div>
                                                                                <label for="nama_mata_pelajaran"
                                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                                    Mata Pelajaran
                                                                                </label>
                                                                                <select required
                                                                                    id="mapel_select_{{ $loop->iteration }}"
                                                                                    name="nama_mata_pelajaran"
                                                                                    class="testMapel  dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                                    <option
                                                                                        value="{{ $data->nama_mata_pelajaran }}">
                                                                                        {{ $data->nama_mata_pelajaran }}
                                                                                    </option>
                                                                                </select>
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
                                action="{{ route('admin.jadwal_pelajaran.destroy', ['id' => $tahun_ajaran_id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
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

    {{-- Modal Migrasi --}}
    <div class="relative z-50 hidden modal" id="modal-id_migration" aria-labelledby="modal-title" role="dialog"
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
                            <div class="mx-auto p-3 bg-green-50 rounded-full text-green-500 font-medium w-fit mb-3">
                                <i class='bx bxs-user-account text-[40px]'></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-700 dark:text-gray-100">
                                Transfer data jadwal dari semester sebelumnya!</h3>
                            <form action="{{ route('admin.jadwal.migrasi') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="tahun" value="{{ $tahun }}" id="" hidden>
                                <input type="text" name="semester" value="{{ $semester }}" id=""
                                    hidden>
                                <input type="text" name="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}"
                                    id="" hidden>
                                <input type="text" name="rombel_id" value="{{ $rombel->id }}" id=""
                                    hidden>
                                <input type="text" name="nama_rombel" value="{{ $rombel->nama_rombel }}"
                                    id="" hidden>
                                <button type="submit"
                                    class="mt-3 w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300">
                                    Transfer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Migrasi --}}
    <script>
        document.getElementById('btn-download').addEventListener('click', () => {
            let nama_rombel = document.getElementById('nama_rombel_input').value

            const workbook = XLSX.utils.book_new();
            const tableInputJadwalPelajaran = document.getElementById('template-input');
            const worksheetJadwalPelajaran = XLSX.utils.table_to_sheet(tableInputJadwalPelajaran);
            XLSX.utils.book_append_sheet(workbook, worksheetJadwalPelajaran,
                `Template Input Jadwal Pelajaran`);
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
                var url = '{{ route('admin.jadwal_pelajaran.get-mapels') }}';
                url = url.replace(':teacherId', teacherId);
                let mapelContainer = $(`#mapel_select_${id}`);

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        'guru_id': teacherId
                    },
                    dataType: 'json',
                    success: function(data) {
                        mapelContainer.html(`<option value="">-- Pilih Mata Pelajaran --</option>`)
                        data.map((mapel) => {
                            mapelContainer.append(
                                `<option value="${mapel.nama_mata_pelajaran}">${mapel.nama_mata_pelajaran}</option>`
                            )
                        })
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }

            $('[data-tw-toggle="modal"]').on('click', function() {
                var modalId = $(this).data('tw-target');
                let id = $(this).data('tw-id');

                $(document).on("click", `#guru_id_${id}`, function() {
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
            });
        });
    </script>

@endsection
