@extends('layouts.dashboard')
@section('table-name')
    Daftar rombel diajar oleh {{ $guru->nama }}
@endsection
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.guru', ['tahun' => $tahun, 'semester' => $semester]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-1 bg-white shadow-md">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body border-b border-gray-100 dark:border-zinc-600 flex justify-between flex-wrap">
                <h1 class="text-[18px] font-medium capitalize">Tahun Ajaran
                    {{ str_replace('-', '/', $tahun) }},
                    Semester
                    {{ $semester }}</h1>
                <a href="{{ route('admin.tambah_rombel', ['tahun' => $tahun, 'semester' => $semester, 'guru' => $guru]) }}"
                    class="flex gap-2 justify-center items-center w-[200px] bg-blue-500 hover:bg-blue-700 text-white font-medium px-4 rounded-md btn">
                    <span>Tambah Data Rombel</span><i class='bx bxs-plus-circle text-[20px]'></i>
                </a>
            </div>
            <div class="relative overflow-x-auto card-body">
                <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                    <thead>
                        <tr class="bg-blue-200">
                            <th class="p-4">
                                No</th>
                            <th class="p-4">
                                Rombel</th>
                            <th class="p-4">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guru->rombels as $data)
                            <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                <td class="p-4">
                                    {{ $loop->iteration }}</td>
                                <td class="p-4">
                                    {{ $data->nama_rombel }}</td>
                                <td class="p-4">
                                    <div class="relative dropdown ">
                                        <button type="button" class="py-2 font-medium leading-tight  dropdown-toggle"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown"><i
                                                class='bx bx-menu text-[20px]'></i></button>

                                        <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                            aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                            <li>
                                                <a class="block text-red-500 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                    data-tw-toggle="modal"
                                                    data-tw-target="#modal-id_form_destroy_{{ $loop->iteration }}">
                                                    Keluarkan</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            {{-- Modal Destroy --}}
                            <div class="relative z-50 hidden modal" id="modal-id_form_destroy_{{ $loop->iteration }}"
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
                                                    <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                        Apakah anda ingin
                                                        mengeluarkan <br>data <span
                                                            class="text-red-600">{{ $data->nama_rombel }}</span> ?</h3>
                                                    <form class="space-y-4"
                                                        action="{{ route('admin.detach_rombel', ['rombel' => $data, 'guru' => $guru]) }}"
                                                        method="GET">
                                                        @csrf
                                                        <button type="submit"
                                                            class="w-full text-white bg-red-600 border-transparent btn">
                                                            Keluarkan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Destroy --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
