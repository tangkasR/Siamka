@extends('layouts.dashboard')
@section('table-name', 'Data Sesi')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 bg-white shadow-md">
        <div class="md:col-span-8 order-last md:order-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="p-4">
                                    No</th>
                                <th class="p-4">
                                    Sesi</th>
                                <th class="p-4">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sesi as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4">
                                        {{ $data->nama_sesi }}</td>
                                    <td class="p-4">
                                        <div class="relative dropdown ">
                                            <button type="button" class="py-2 font-medium leading-tight  dropdown-toggle"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"><i
                                                    class='bx bx-menu text-[20px]'></i></button>

                                            <ul class="absolute z-50 float-left py-2 mt-1 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                                                aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                                                <li>
                                                    <a class="block w-full px-4 py-1 text-sm font-medium text-gray-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_form_edit_{{ $loop->iteration }}">
                                                        <i class='bx bxs-edit'></i>
                                                        Ubah
                                                    </a>
                                                </li>
                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                <li>
                                                    <a class="block text-red-500 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                        data-tw-toggle="modal"
                                                        data-tw-target="#modal-id_form_destroy_{{ $loop->iteration }}">
                                                        <i class='bx bx-trash'></i> Hapus</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>

                                {{-- Modal Edit --}}
                                <div class="relative z-50 hidden modal" id="modal-id_form_edit_{{ $loop->iteration }}"
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
                                                            Data Sesi</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.sesi.update', ['sesi' => $data]) }} "
                                                            method="POST">
                                                            @csrf
                                                            <div>
                                                                <label for="nama_sesi"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama Sesi
                                                                </label>
                                                                <input type="text" name="nama_sesi" id="nama_sesi"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Sesi"
                                                                    value="{{ $data->nama_sesi }}" required>
                                                            </div>
                                                            <button type="submit"
                                                                class="w-full mt-3 text-white hover:bg-blue-700 bg-blue-600 border-transparent btn">
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

                                {{-- Modal Destroy --}}
                                <div class="relative z-50 hidden modal" id="modal-id_form_destroy_{{ $loop->iteration }}"
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
                                                        <div class="w-full">
                                                            <div
                                                                class="mx-auto p-2 bg-red-50 rounded-full text-red-500 font-medium w-fit mb-3">
                                                                <i class='bx bx-trash text-[40px] '></i>
                                                            </div>
                                                        </div>
                                                        <h3
                                                            class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                            Apakah anda ingin
                                                            menghapus data {{ $data->nama_sesi }}?</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.sesi.destroy', ['sesi' => $data]) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit"
                                                                class="w-full text-white bg-red-600 border-transparent btn">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="md:col-span-4 w-full p-3 md:order-2">
            <form class="space-y-4" action="{{ route('admin.sesi.store') }}" method="POST">
                @csrf
                <div class="flex justify-between">
                    <h1 class="text-slate-600 font-semibold text-[20px]">Tambah Data Sesi</h1>
                    <button type="button" class="
                    text-blue-600 text-[40px] " id="add_input"><i
                            class='bx bxs-plus-circle'></i></button>
                    <div id="count"
                        class="text-gray-500 absolute right-9 rounded-full z-50 text-[16px] top-15 px-2 border bg-green-50 ">
                    </div>
                </div>
                <div id="container_add" class="">

                </div>

                <button type="submit"
                    class="
                w-full
                text-white
                hover:bg-blue-700
                bg-blue-600
                py-2
                btn
                rounded-md ">
                    Simpan
                </button>
            </form>
        </div>
    </div>





    <script>
        let index = 1;
        let container = document.getElementById('container_add');
        let count = document.getElementById('count')

        for (let i = 0; i < index; i++) {
            container.innerHTML = `
            <div>
                <label for="nama_sesi"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                    Nama Sesi - 1
                </label>
                <input type="text" name="nama_sesi[]" id="nama_sesi"
                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                    placeholder="Masukan Nama Sesi" required>
            </div>
            `
        }
        document.getElementById('add_input').addEventListener('click', () => {
            container.innerHTML = ``;
            index++;

            for (let i = 0; i < index; i++) {
                count.innerHTML = `${i+1}`
                container.innerHTML += `
            <div class="mb-3">
                <label for="nama_sesi"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                    Nama Sesi - ${i+1}
                </label>
                <input type="text" name="nama_sesi[]" id="nama_sesi"
                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                    placeholder="Masukan Nama Sesi" required>
            </div>
            `
            }

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
