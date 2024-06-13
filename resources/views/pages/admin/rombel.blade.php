@extends('layouts.dashboard')
@section('table-name', 'Data Rombongan Belajar')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 bg-white shadow-md">
        <div class="md:col-span-7 order-last md:order-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="relative overflow-x-auto card-body">
                    <table id="datatable" class="uppercase table w-full pt-4 text-center text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    No</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Nama Rombongan Belajar</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Wali Kelas</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rombel as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->nama_rombel }}</td>
                                    <td class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->nama ?? '-' }}</td>
                                    <td
                                        class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600 min-w-[250px] w-[250px]">
                                        <div class="grid grid-cols-2 gap-2">
                                            <a class="btn-edit" data-tw-toggle="modal"
                                                data-tw-target="#modal-id_form_edit_{{ $data->id }}"><i
                                                    class='bx bxs-edit'></i> Ubah</a>
                                            <a class="btn-delete" data-tw-toggle="modal"
                                                data-tw-target="#modal-id_form_destroy_{{ $data->id }}">
                                                <i class='bx bx-trash'></i> Hapus</a>
                                        </div>
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
                                                            Data Rombongan Belajar </h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.rombel.update', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="guru_id"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Wali Kelas
                                                                </label>
                                                                <select id="guru_id" name="guru_id"
                                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                                    @foreach ($guruAll as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $data->guru_id == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <label for="nama_rombel"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                    Nama Rombongan Belajar
                                                                </label>
                                                                <input type="text" name="nama_rombel" id="nama_rombel"
                                                                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                    placeholder="Masukan Nama Rombongan Belajar"
                                                                    value="{{ $data->nama_rombel }}" required>
                                                            </div>
                                                            <button type="submit"
                                                                class="w-full text-white mt-3 bg-violet-600 border-transparent btn">
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
                                                            menghapus data {{ $data->nama_rombel }}</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.rombel.destroy', ['id' => $data->id]) }}"
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
        <div class="md:col-span-5 p-3  w-full md:order-2">
            <form class="space-y-4" action="{{ route('admin.rombel.store') }}" method="POST">
                @csrf
                <div class="flex justify-between">
                    <h1 class="text-slate-600 font-semibold text-[20px]">Tambah Data Sesi</h1>
                    <button type="button" class="
                    text-violet-600 text-[40px] " id="add_input"><i
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
        let index = 1;
        let container = document.getElementById('container_add');
        let count = document.getElementById('count')
        for (let i = 0; i < index; i++) {
            container.innerHTML = `
            <div class='mb-3 grid md:grid-cols-2 gap-3'>
                <div class="">
                    <label for="nama_rombel"
                        class="mb-3 block  text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                        Nama Rombongan Belajar - 1
                    </label>
                    <input type="text" name="nama_rombel[]" id="nama_rombel"
                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                        placeholder="X ../XI ../XII .." required>
                </div>
                <div class="">
                    <label for="guru_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                        Wali Kelas - 1
                    </label>
                    <select id="guru_id" name="guru_id[]"
                        class="mt-1 dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                        @foreach ($guru as $item)
                            <option value="{{ $item['id'] }}">
                                {{ $item['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            `
        }
        document.getElementById('add_input').addEventListener('click', () => {
            container.innerHTML = ``;
            index++;

            for (let i = 0; i < index; i++) {
                count.innerHTML = `${i+1}`
                if (i == 0) {
                    container.innerHTML += `
                    <div class='mb-3 grid md:grid-cols-2 gap-3'>
                        <div class="">
                            <label for="nama_rombel"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Nama Rombongan Belajar - ${i+1}
                            </label>
                            <input type="text" name="nama_rombel[]" id="nama_rombel"
                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                placeholder="X ../XI ../XII .." required>
                        </div>
                        <div class="">
                            <label for="guru_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Wali Kelas - ${i+1}
                            </label>
                            <select id="guru_id" name="guru_id[]"
                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                @foreach ($guru as $item)
                                    <option value="{{ $item['id'] }}">
                                        {{ $item['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    `
                }
                if (i != 0) {
                    container.innerHTML += `
                    <hr class="w-full text-black mb-5" />
                    <div class='mb-3 grid md:grid-cols-2 gap-3'>
                        <div class="">
                            <label for="nama_rombel"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Nama Rombongan Belajar - ${i+1}
                            </label>
                            <input type="text" name="nama_rombel[]" id="nama_rombel"
                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                placeholder="X ../XI ../XII .." required>
                        </div>
                        <div class="">
                            <label for="guru_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Wali Kelas - ${i+1}
                            </label>
                            <select id="guru_id" name="guru_id[]"
                                class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                @foreach ($guru as $item)
                                    <option value="{{ $item['id'] }}">
                                        {{ $item['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    `
                }

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
