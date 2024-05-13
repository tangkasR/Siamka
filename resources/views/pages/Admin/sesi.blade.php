@extends('layouts.dashboard')
@section('table-name', 'Sesi')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-5">
        <div class="col-span-7">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <h6 class="mb-1 text-gray-700 text-15 dark:text-gray-100">Data Sesi</h6>

                </div>
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    No</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Sesi</th>
                                <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sesi as $data)
                                <tr>
                                    <td
                                        class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4 pr-8 border border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        {{ $data->nama_sesi }}</td>
                                    <td class="p-4 pr-8 border  border-t-0 border-l-0 border-gray-50 dark:border-zinc-600">
                                        <a class="text-white btn bg-violet-500 w-[100px] mb-3 border-violet-500 hover:bg-violet-600 focus:ring ring-violet-50focus:bg-violet-600"
                                            data-tw-toggle="modal"
                                            data-tw-target="#modal-id_form_edit_{{ $data->id }}"><i
                                                class='bx bxs-edit'></i> Ubah</a>
                                        <a class="text-white btn w-[100px] bg-red-500  border-red-500 hover:bg-red-600 focus:ring ring-violet-50 focus:bg-red-600"
                                            data-tw-toggle="modal"
                                            data-tw-target="#modal-id_form_destroy_{{ $data->id }}">
                                            <i class='bx bx-trash'></i> Hapus</a>
                                    </td>

                                </tr>

                                {{-- Modal Edit --}}
                                <div class="relative z-50 hidden modal" id="modal-id_form_edit_{{ $data->id }}"
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
                                                            action="{{ route('admin.sesi.update', ['id' => $data->id]) }} "
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
                                                                class="w-full mt-3 text-white bg-green-600 border-transparent btn">
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
                                <div class="relative z-50 hidden modal" id="modal-id_form_destroy_{{ $data->id }}"
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
                                                            Apakah anda ingin
                                                            menghapus data {{ $data->nama_sesi }}</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.sesi.destroy', ['id' => $data->id]) }}"
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
        <div class="col-span-5 w-full ">
            <form class="space-y-4" action="{{ route('admin.sesi.store') }}" method="POST">
                @csrf
                <div class="flex justify-between">
                    <h1 class="text-slate-600 font-semibold text-[20px]">Tambah Data Sesi</h1>
                    <button type="button" class="
                    text-violet-600 text-[40px] " id="add_input"><i
                            class='bx bxs-plus-circle'></i></button>
                </div>
                <div id="container_add" class="">

                </div>
                <button type="submit"
                    class="
                w-full
                text-white
                bg-violet-400
                hover:bg-black
                py-2
                rounded-md ">
                    Simpan
                </button>
            </form>
        </div>
    </div>





    <script>
        console.log('tes')
        let index = 1;
        let container = document.getElementById('container_add');

        for (let i = 0; i < index; i++) {
            container.innerHTML = `
            <div>
                <label for="nama_sesi"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                    Nama Sesi
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
                container.innerHTML += `
            <div class="mb-3">
                <label for="nama_sesi"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                    Nama Sesi
                </label>
                <input type="text" name="nama_sesi[]" id="nama_sesi"
                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                    placeholder="Masukan Nama Sesi" required>
            </div>
            `
            }

        })
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
                })
            });
        </script>
    @endif
@endsection
