@extends('layouts.dashboard')
@section('table-name')
    @if ($siswa)
        Wali Kelas Rombel {{ $rombel->nama_rombel }}
    @endif
@endsection
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('tahun_ajaran.index', 'wali_kelas') }}" class="flex justify-center items-center"><i
                class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class=" bg-white shadow-md">
        @if ($siswa)
            <div class="">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                        <h5 class="text-slate-800 text-[20px] leading-10 font-medium m-0">Daftar Siswa </h5>
                    </div>
                    <div class="relative overflow-x-auto card-body">
                        <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                            <thead>
                                <tr class="bg-blue-100">
                                    <th class="p-4">
                                        No</th>
                                    <th class="p-4">
                                        Nama</th>
                                    <th class="p-4">
                                        NIS</th>
                                    <th class="p-4">
                                        NISN</th>
                                    <th class="p-4">
                                        Nomor Id</th>
                                    <th class="p-4">
                                        Tahun Pembelajaran</th>
                                    <th class="p-4">
                                        Username</th>
                                    <th class="p-4">
                                        Status Siswa</th>
                                    <th class="p-4">
                                        Status Akun</th>
                                    <th class="p-4">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $data)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                        <td class="p-4">
                                            {{ $loop->iteration }}</td>
                                        <td class="p-4">
                                            {{ $data->nama }}</td>
                                        <td class="p-4">
                                            {{ $data->nis }}</td>
                                        <td class="p-4">
                                            {{ $data->nisn }}</td>
                                        <td class="p-4">
                                            {{ $data->nomor_id }}</td>
                                        <td class="p-4">
                                            {{ $data->tahun_ajaran->tahun_ajaran }}</td>
                                        <td class="p-4">
                                            {{ $data->username }}</td>
                                        <td class="p-4 min-w-[200px]">
                                            {{ $data->status_siswa }}</td>
                                        <td class="p-4 min-w-[200px]">
                                            @if ($data->aktivasi_akun == 'aktif')
                                                <p
                                                    class="mx-auto py-1 px-6 border  bg-green-50 rounded-xl  text-green-900 capitalize w-[120px]">
                                                    {{ $data->aktivasi_akun }}
                                                </p>
                                            @else
                                                <p
                                                    class="mx-auto py-1 px-6 border  bg-red-50 rounded-xl text-red-900 capitalize w-[120px]">
                                                    {{ $data->aktivasi_akun }}
                                                </p>
                                            @endif
                                        </td>
                                        <td class="p-4  ">
                                            <div class="relative dropdown">
                                                <button type="button"
                                                    class="py-2 font-medium leading-tight  dropdown-toggle"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"><i
                                                        class='bx bx-menu text-[20px]'></i></button>

                                                <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                                    aria-labelledby="dropdownMenuButton1"
                                                    data-popper-placement="bottom-start"
                                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                                    <li>
                                                        <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                            href="{{ route('admin.siswa.detail_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel, 'id' => Crypt::encrypt($data->id)]) }}"><i
                                                                class="text-lg align-middle bx bx-show ltr:mr-2 rtl:ml-2"></i>Detail
                                                            Siswa</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="min-h-[60vh] flex justify-center items-center">
                <h1 class="text-[20px] font-semibold capitalize">Anda tidak menjadi wali kelas</h1>
            </div>
        @endif
    </div>

    <script>
        const nama_rombel = document.getElementById('nama_rombel_input').value
        document.getElementById('btn-download').addEventListener('click', () => {
            const workbook = XLSX.utils.book_new();
            const tableInputSiswa = document.getElementById('template-input');
            const worksheetSiswa = XLSX.utils.table_to_sheet(tableInputSiswa);
            XLSX.utils.book_append_sheet(workbook, worksheetSiswa, 'Template Input Siswa');
            XLSX.writeFile(workbook, `template-input-siswa-${nama_rombel}.xlsx`);
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
@endsection
