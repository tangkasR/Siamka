@extends('layouts.dashboard')
@section('table-name', 'Data Siswa')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 ">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600  ">
                    <div class="flex justify-between mt-3 flex-wrap">
                        <div>
                            <h5 class="text-slate-800 text-[20px] leading-10 font-medium">Daftar Siswa
                                <span class="text-red-600 font-bold">Lulus atau Keluar</span>
                            </h5>
                            <p>Tanggal hari ini: {{ $tanggal }}</p>
                        </div>
                        <div class="md:mt-0 mt-3 ">
                            <div class="px-6 py-4  shadow-md border border-red-100 rounded-md">
                                <p class="mb-3 text-sm font-medium">Hapus data siswa diangkatan {{ $angkatan }}
                                </p>
                                <a class="btn-delete
                                    text-center" data-tw-toggle="modal"
                                    data-tw-target="#modal-id_form_destroy">
                                    <i class='bx bx-trash'></i> Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="p-4 ">
                                    No</th>
                                <th class="p-4 ">
                                    Nama</th>
                                <th class="p-4 ">
                                    NIS</th>
                                <th class="p-4 ">
                                    NISN</th>
                                <th class="p-4 ">
                                    Nomor Id</th>
                                <th class="p-4 ">
                                    Jenis Kelamin</th>
                                <th class="p-4 ">
                                    Status Siswa</th>
                                <th class="p-4 ">
                                    Status Akun</th>
                                <th class="p-4 ">
                                    Tanggal Lulus / Keluar
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4 ">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4  ">
                                        {{ $data->nama }}</td>

                                    <td class="p-4  ">
                                        {{ $data->nis }}</td>
                                    <td class="p-4  ">
                                        {{ $data->nisn }}</td>
                                    <td class="p-4  ">
                                        {{ $data->nomor_id }}</td>
                                    <td class="p-4  ">
                                        {{ $data->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                    <td class="p-4   font-semibold text-red-600">
                                        {{ $data->status_siswa }}</td>
                                    <td class="p-4  ">
                                        {{ $data->aktivasi_akun }}</td>
                                    <td class="p-4  ">
                                        {{ $data->updated_at }}</td>
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
                                Apakah anda ingin
                                menghapus semua data siswa di angkatan
                                <span class="text-red-600 font-bold">{{ $angkatan }}!</span>
                            </h3>
                            <form class="space-y-4"
                                action="{{ route('admin.siswa.clear_data', ['angkatan' => $angkatan]) }}" method="GET">
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
