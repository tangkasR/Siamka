@extends('layouts.dashboard')
@section('table-name')
    <span class="capitalize">Daftar Anggota</span>
@endsection
@section('table-role', 'Guru')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('guru.ekskul', ['tahun' => $tahun, 'semester' => $semester]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class=" bg-white shadow-md">
        <div class="md:grid md:grid-cols-12 ">
            <div class="md:col-span-4 py-4">
                <div class=" relative mx-auto max-w-md rounded-lg bg-gradient-to-tr  ">
                    <div class="bg-white rounded-md">
                        <span
                            class="flex justify-center items-center h-48 w-48 place-items-center rounded-md  duration-300  text-blue-100 ">
                            <img src="{{ asset('assets/img/img-ekskul.png') }}" alt="">
                        </span>
                        <form class="space-y-4" action="{{ route('guru.ekskul.update', ['id' => $ekskul->id]) }}"
                            method="POST">
                            @csrf
                            <h1 class="font-medium text-[16px] capitalize">Nama Ekstrakurikuler</h1>
                            <input type="text" name="nama_ekskul" id="nama_ekskul"
                                class=" border border-slate-300 text-black capitalize font-medium  dark:text-gray-100 text-sm rounded focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5 focus:ring-1"
                                placeholder="Masukan Nama Ekskul" value="{{ $ekskul->nama_ekskul }}" required>
                            <h1 class="font-medium text-[16px]  capitalize " style="margin-top: 0 !important;">Pembina
                                Ekskul
                            </h1>
                            <input style="background-color: rgb(243, 243, 243); margin-top: 0px !important" type="text"
                                name="" id=""
                                class="border border-blue-100 text-black capitalize font-medium  dark:text-gray-100 text-sm rounded w-full p-2.5 focus:ring-1"
                                placeholder="Masukan Nama Ekskul" value="{{ $ekskul->gurus->nama }}" disabled>
                            <div class="text-center">
                                <button type="submit"
                                    class="w-full  text-white hover:bg-slate-700  border bg-slate-600 font-medium  btn py-2">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="md:col-span-8">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body border-b border-gray-100 dark:border-zinc-600 pt-6">
                        <div class="flex justify-end">
                            <a href="{{ route('guru.ekskul.daftar_rombel', ['tahun' => $tahun, 'semester' => $semester, 'tahun_ajaran' => $tahun_ajaran, 'ekskul' => $ekskul]) }}"
                                class="w-[200px] flex gap-2 justify-center items-center text-white hover:bg-blue-700 font-medium border border-blue-700 bg-blue-500 border-transparent btn">
                                <span>Tambah Anggota</span><i class='bx bxs-plus-circle text-[20px]'></i>
                            </a>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto card-body">
                        <table id="datatable" class="text-center table w-full pt-4 text-gray-700 capitalize">
                            <thead>
                                <tr class="bg-blue-100">
                                    <th class="p-4 ">
                                        No</th>
                                    <th class="p-4 ">
                                        Nama Siswa</th>
                                    <th class="p-4 ">
                                        Rombel</th>
                                    <th class="p-4 ">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $data)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                        <td class="p-4">
                                            {{ $loop->iteration }}</td>
                                        <td class="p-4">
                                            {{ $data->nama }}</td>
                                        <td class="p-4">
                                            {{ $data->rombels[0]->nama_rombel }}</td>
                                        <td class="p-4">
                                            <div class="relative dropdown ">
                                                <button type="button"
                                                    class="py-2 font-medium leading-tight  dropdown-toggle"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"><i
                                                        class='bx bx-menu text-[20px]'></i></button>

                                                <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                                    aria-labelledby="dropdownMenuButton1"
                                                    data-popper-placement="bottom-start"
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
                                    <div class="relative z-50 hidden modal"
                                        id="modal-id_form_destroy_{{ $loop->iteration }}" aria-labelledby="modal-title"
                                        role="dialog" aria-modal="true">
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
                                                        <div class="p-10">
                                                            <h3
                                                                class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                                Apakah anda ingin
                                                                mengeluarkan data <span
                                                                    class="text-red-600">{{ $data->nama }}</span> dari
                                                                ekskul
                                                                <span
                                                                    class="text-red-600">{{ $ekskul->nama_ekskul }}</span>
                                                            </h3>
                                                            <form class="space-y-4"
                                                                action="{{ route('guru.ekskul.delete_member', ['id' => $data->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="text" value="{{ $ekskul->id }}"
                                                                    name="ekskul_id" hidden>
                                                                <button type="submit"
                                                                    class="w-full text-white hover:bg-red-700 bg-red-500 border-transparent btn">
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
