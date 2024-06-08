@extends('layouts.dashboard')
@section('table-name', 'Pengumuman')
@section('table-role', 'Admin')
@section('content')
    <div class="w-full bg-white shadow-md">
        <div class="">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="md:max-w-6xl mx-auto">
                        <form class="space-y-4" action="{{ route('admin.pengumuman.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <h1 class="text-slate-600 font-semibold text-[20px]">Tambah Data Pengumuman</h1>
                            <div class="grid lg:grid-cols-12 grid-cols-1 lg:gap-4">
                                <div class="lg:col-span-4">
                                    <label for=""
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Gambar Tampilan Pengumuman
                                    </label>
                                    <div id="profile-photo-mobile"
                                        class="block md:w-[300px] md:h-[300px] w-[300px] h-[300px] bg-cover bg-center rounded-2xl "
                                        style="background-image: url('{{ asset('assets/img/attention-default.jpg') }}')">
                                        <input
                                            class="block w-full  h-full opacity-0 text-sm text-gray-900 border border-gray-300  cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="file" type="file" name="image" onchange="loadPhoto(this)"
                                            value="url('{{ asset('assets/img/attention-default.jpg') }}')">
                                        <div
                                            class="absolute text-[30px] px-2  -mt-14 md:translate-x-2 border-2 bg-slate-200 border-slate-600 rounded-full">
                                            <i class='bx bxs-camera'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:col-span-8">
                                    <div class="mb-3 lg:mt-0 mt-6">
                                        <label for="judul"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                            Judul
                                        </label>
                                        <input type="text" name="judul" id="judul"
                                            class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                            placeholder="Masukan Judul" required>
                                    </div>
                                    <div id="editor"></div>
                                    <div class="my-3">
                                        <label for="judul"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                            Deskripsi
                                        </label>
                                        <textarea id="summernote" name="deskripsi"> </textarea>
                                    </div>
                                    <button type="submit"
                                        class="w-full mt-3 text-white bg-violet-600 border-transparent btn">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body">
                    <div>
                        <h6 class="my-6 text-gray-600 text-[20px] font-semibold dark:text-gray-100">Data Pengumuman</h6>
                    </div>
                    <table id="datatable" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    No</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Gambar</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Judul</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Deskripsi</th>
                                <th class="p-4 border rtl:border-l-0  border-gray-200 dark:border-zinc-600">
                                    Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengumumans as $data)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-blue-50' : 'bg-white' }}">
                                    <td class="p-4 border border-t-0 rtl:border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $loop->iteration }}</td>
                                    <td class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        <div class="block w-[100px] h-[100px] bg-cover bg-center col-span-5 rounded-2xl"
                                            style="background-image: url('{{ $data->image != '-' ? asset('storage/pengumuman/' . $data->image) : asset('assets/img/attention-default.jpg') }}')">

                                        </div>

                                    </td>
                                    <td class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600">
                                        {{ $data->judul }}</td>
                                    <td
                                        class=" p-4 border border-t-0 border-l-0 max-w-[100px]  border-gray-200 dark:border-zinc-600">
                                        <div class="line-clamp-3 text-left max-h-[100px]">
                                            {!! $data->deskripsi !!}
                                        </div>
                                    </td>
                                    <td
                                        class="p-4 border border-t-0 border-l-0 border-gray-200 dark:border-zinc-600 min-w-[300px] w-[300px]">
                                        <div class="grid grid-cols-2 gap-2">
                                            <a class="btn-show"
                                                href="{{ route('pengumuman.detail', ['id' => $data->id]) }}"><i
                                                    class='bx bx-show'></i> Detail</a>
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
                                            class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay lg:h-full h-[140vh]">
                                        </div>
                                        <div class="p-4 mx-auto animate-translate sm:max-w-6xl">
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
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.pengumuman.update', ['id' => $data->id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <h1 class="text-slate-600 font-semibold text-[20px]">Ubah
                                                                Data
                                                                Pengumuman</h1>
                                                            <div class="grid lg:grid-cols-12 grid-cols-1 gap-4">
                                                                <div class="lg:col-span-3 mt-3">
                                                                    <label for=""
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                        Gambar Tampilan Pengumuman
                                                                    </label>
                                                                    <div id="profile-photo-mobile_edit_{{ $data->id }}"
                                                                        class=" block w-[200px]  h-[200px] lg:w-[240px] lg:h-[240px] bg-cover bg-center  rounded-2xl"
                                                                        style="background-image: url('{{ $data->image != '-' ? asset('storage/pengumuman/' . $data->image) : asset('assets/img/attention-default.jpg') }}')">
                                                                        <input
                                                                            class="block w-full  h-full opacity-0 text-sm text-gray-900 border border-gray-300  cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                                            id="file" type="file" name="image"
                                                                            onchange="loadPhotoEdit(this, {{ $data->id }})">
                                                                        <div
                                                                            class="absolute text-[30px] px-2  -mt-14 md:translate-x-2 border-2 bg-slate-200 border-slate-600 rounded-full">
                                                                            <i class='bx bxs-camera'></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="lg:col-span-9 w-full mt-3">
                                                                    <div class="mb-3">
                                                                        <label for="judul"
                                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                                            Judul
                                                                        </label>
                                                                        <input type="text" name="judul"
                                                                            id="judul"
                                                                            class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                                            placeholder="Masukan Judul"
                                                                            value="{{ $data->judul }}" required>
                                                                    </div>
                                                                    <div class="my-3">
                                                                        <textarea id="" class="summernote_edit" name="deskripsi"> {{ $data->deskripsi }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="text" name="old_image"
                                                                value="{{ $data->image }}" hidden>
                                                            <button type="submit"
                                                                class="w-full mt-3 text-white bg-violet-600 border-transparent btn">
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
                                                            menghapus data {{ $data->judul }}</h3>
                                                        <form class="space-y-4"
                                                            action="{{ route('admin.pengumuman.destroy', ['id' => $data->id]) }}"
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

    </div>
    <script>
        function loadPhoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var profilePhotoMobile = document.getElementById('profile-photo-mobile');
                    profilePhotoMobile.style.backgroundImage = 'url(' + e.target.result + ')';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function loadPhotoEdit(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var profilePhotoMobile = document.getElementById(`profile-photo-mobile_edit_${id}`);
                    profilePhotoMobile.style.backgroundImage = 'url(' + e.target.result + ')';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Deskripsi..',
                tabsize: 2,
                height: 300,
            });
            $('.summernote_edit').summernote({
                placeholder: 'Deskripsi..',
                tabsize: 2,
                height: 250,
            });
        });
    </script>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <script>
                        toast('error', '{{ $error }}')
                    </script>
                @endforeach
            </ul>
        </div>
    @endif

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
