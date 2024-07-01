@extends('layouts.dashboard')
@section('table-name', 'Data Rombongan Belajar')
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('tahun_ajaran.index', 'rombel') }}" class="flex justify-center items-center"><i
                class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class=" bg-white shadow-md">
        <div class="">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <div class="md:flex md:justify-between md:items-start ">
                        <h1 class="md:mb-0 mb-6 text-[18px] font-medium capitalize leading-7">Tahun Ajaran
                            {{ str_replace('-', '/', $tahun_ajaran->tahun_ajaran) }},
                            Semester
                            {{ $tahun_ajaran->semester }}</h1>

                        <div class="relative dropdown ">
                            <button type="button"
                                class="dropdown-toggle flex gap-2 justify-center items-center cursor-pointer text-center w-[180px] border border-blue-500 bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-all duration-300"
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
                                        href="{{ route('admin.rombel.tambah_data', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester]) }}">
                                        Import Rombel</a>
                                </li>
                                @if (count($rombel) == 0)
                                    <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                    <li>
                                        <a data-tw-toggle="modal" data-tw-target="#modal-id_migration"
                                            class="cursor-pointer block text-green-500 w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 ">
                                            Transfer Data</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="" hidden>
                            {{-- template excel --}}
                            <table id="template-input">
                                <thead>
                                    <tr>
                                        <th>nama_rombel</th>
                                        <th>niy</th>
                                        <th></th>
                                        <th></th>
                                        <th>Pilih NIY Guru</th>
                                        <th></th>
                                        <th></th>
                                        <th>Wali Kelas:</th>
                                        <th>nomor induk yayasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gurus as $guru)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $guru->nomor_induk_yayasan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- end template excel --}}

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="relative overflow-x-auto card-body mb-[50px] h-[100%]">
                        {{-- Data Kelas X --}}
                        <div class="grid grid-cols-1 mb-10">
                            <div class="swiper mySwiper1">
                                <div class="swiper-wrapper">
                                    @foreach ($rombel as $data)
                                        @if (explode(' ', $data->nama_rombel)[0] == 'X')
                                            <div class="swiper-slide">
                                                <div
                                                    class="hover:scale-98 relative card bg-blue-50 border-blue-300 border-2  transition-all">
                                                    <div class="absolute top-0 right-5" style="z-index:1000;">
                                                        <div class="relative dropstart">
                                                            <button type="button" class="py-2 font-medium leading-tight">
                                                                <i class="bx bx-menu text-[20px] dropdown-toggle"
                                                                    id="dropdownMenu1" data-bs-toggle="dropdown"></i>
                                                            </button>
                                                            <ul class="absolute z-50 float-left py-2 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu min-w-max bg-clip-padding dark:bg-zinc-700 hidden"
                                                                aria-labelledby="dropdownMenu1"
                                                                data-popper-placement="left-start"
                                                                style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-913.5px, 1304.5px, 0px);">
                                                                <li>
                                                                    <a class="block w-full px-4 py-2 text-sm font-normal text-green-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                                        data-tw-toggle="modal"
                                                                        data-tw-target="#modal-id_form_edit_{{ $loop->iteration }}">
                                                                        <i class='bx bxs-edit'></i>
                                                                        Ubah
                                                                    </a>
                                                                </li>
                                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                                <li>
                                                                    <a class="block w-full px-4 py-2 text-sm font-normal text-red-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                                        data-tw-toggle="modal"
                                                                        data-tw-target="#modal-id_form_destroy_{{ $loop->iteration }}"><i
                                                                            class='bx bx-trash'></i> Hapus
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6
                                                            class="mb-3 text-slate-700 text-[25px] dark:text-gray-100 font-bold">
                                                            {{ $data->nama_rombel }}
                                                        </h6>
                                                        <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                            Silahkan pilih rombel dengan menekan tombol dibawah!
                                                        </p>
                                                        <div class="">
                                                            <a href="{{ route('admin.rombel.show', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'rombel' => $data]) }}"
                                                                class="hover:bg-blue-700
                                                                block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
                                                                Pilih
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-3 mx-auto">
                                <div class="swiper-pagination1 "></div>
                            </div>
                        </div>
                        {{-- End Data Kelas X --}}
                        {{-- Data Kelas XI --}}
                        <div class="grid grid-cols-1 mb-10">
                            <div class="swiper mySwiper2">
                                <div class="swiper-wrapper">
                                    @foreach ($rombel as $data)
                                        @if (explode(' ', $data->nama_rombel)[0] == 'XI')
                                            <div class="swiper-slide">
                                                <div
                                                    class="card relative hover:scale-98 duration-300 bg-blue-50 border-blue-300 border-2  transition-all">
                                                    <div class="absolute top-0 right-5" style="z-index:1000;">
                                                        <div class="relative dropstart">
                                                            <button type="button" class="py-2 font-medium leading-tight">
                                                                <i class="bx bx-menu text-[20px] dropdown-toggle"
                                                                    id="dropdownMenu1" data-bs-toggle="dropdown"></i>
                                                            </button>
                                                            <ul class="absolute z-50 float-left py-2 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu min-w-max bg-clip-padding dark:bg-zinc-700 hidden"
                                                                aria-labelledby="dropdownMenu1"
                                                                data-popper-placement="left-start"
                                                                style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-913.5px, 1304.5px, 0px);">
                                                                <li>
                                                                    <a class="block w-full px-4 py-2 text-sm font-normal text-green-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                                        data-tw-toggle="modal"
                                                                        data-tw-target="#modal-id_form_edit_{{ $loop->iteration }}">
                                                                        <i class='bx bxs-edit'></i>
                                                                        Ubah
                                                                    </a>
                                                                </li>
                                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                                <li>
                                                                    <a class="block w-full px-4 py-2 text-sm font-normal text-red-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                                        data-tw-toggle="modal"
                                                                        data-tw-target="#modal-id_form_destroy_{{ $loop->iteration }}"><i
                                                                            class='bx bx-trash'></i> Hapus
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6
                                                            class="mb-3 text-slate-700 text-[25px] dark:text-gray-100 font-bold">
                                                            {{ $data->nama_rombel }}
                                                        </h6>
                                                        <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                            Silahkan pilih rombel dengan menekan tombol dibawah!
                                                        </p>
                                                        <div class="">
                                                            <a href="{{ route('admin.rombel.show', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'rombel' => $data]) }}"
                                                                class="hover:bg-blue-700
                                                                block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
                                                                Pilih
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-3 mx-auto">
                                <div class="swiper-pagination2 "></div>
                            </div>
                        </div>
                        {{-- End Data Kelas XI --}}
                        {{-- Data Kelas XII --}}
                        <div class="grid grid-cols-1 mb-10">
                            <div class="swiper mySwiper3">
                                <div class="swiper-wrapper">
                                    @foreach ($rombel as $data)
                                        @if (explode(' ', $data->nama_rombel)[0] == 'XII')
                                            <div class="swiper-slide">
                                                <div
                                                    class="card relative hover:scale-98 duration-300 bg-blue-50 border-blue-300 border-2  transition-all">
                                                    <div class="absolute top-0 right-5" style="z-index:1000;">
                                                        <div class="relative dropstart">
                                                            <button type="button" class="py-2 font-medium leading-tight">
                                                                <i class="bx bx-menu text-[20px] dropdown-toggle"
                                                                    id="dropdownMenu1" data-bs-toggle="dropdown"></i>
                                                            </button>
                                                            <ul class="absolute z-50 float-left py-2 text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu min-w-max bg-clip-padding dark:bg-zinc-700 hidden"
                                                                aria-labelledby="dropdownMenu1"
                                                                data-popper-placement="left-start"
                                                                style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-913.5px, 1304.5px, 0px);">
                                                                <li>
                                                                    <a class="block w-full px-4 py-2 text-sm font-normal text-green-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                                        data-tw-toggle="modal"
                                                                        data-tw-target="#modal-id_form_edit_{{ $loop->iteration }}">
                                                                        <i class='bx bxs-edit'></i>
                                                                        Ubah
                                                                    </a>
                                                                </li>
                                                                <hr class="my-1 border-gray-50 dark:border-zinc-600">
                                                                <li>
                                                                    <a class="block w-full px-4 py-2 text-sm font-normal text-red-500 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                                                        data-tw-toggle="modal"
                                                                        data-tw-target="#modal-id_form_destroy_{{ $loop->iteration }}"><i
                                                                            class='bx bx-trash'></i> Hapus
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h6
                                                            class="mb-3 text-slate-700 text-[25px] dark:text-gray-100 font-bold">
                                                            {{ $data->nama_rombel }}
                                                        </h6>
                                                        <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                            Silahkan pilih rombel dengan menekan tombol dibawah!
                                                        </p>
                                                        <div class="">
                                                            <a href="{{ route('admin.rombel.show', ['tahun' => $tahun_ajaran->tahun_ajaran, 'semester' => $tahun_ajaran->semester, 'rombel' => $data]) }}"
                                                                class="hover:bg-blue-700
                                                                block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
                                                                Pilih
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-3 mx-auto">
                                <div class="swiper-pagination3 "></div>
                            </div>
                        </div>
                        {{-- End Data Kelas XII --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($rombel as $data)
        <div class="relative z-50 hidden modal" id="modal-id_form_edit_{{ $loop->iteration }}"
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
                                <i class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                            </button>
                            <div class="p-5">
                                <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                    Ubah
                                    Data Rombongan Belajar </h3>
                                <form class="space-y-4" action="{{ route('admin.rombel.update', ['rombel' => $data]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="guru_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                            Wali Kelas
                                        </label>
                                        <select id="guru_id" name="guru_id"
                                            class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                            @foreach ($gurus as $item)
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
                                            placeholder="Masukan Nama Rombongan Belajar" value="{{ $data->nama_rombel }}"
                                            required>
                                    </div>
                                    <button type="submit"
                                        class="w-full text-white mt-3 bg-blue-600 border-transparent btn">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                <i class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                            </button>
                            <div class="p-5">
                                <h3 class="mb-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                    Apakah anda ingin
                                    menghapus data {{ $data->nama_rombel }}?</h3>
                                <form class="space-y-4" action="{{ route('admin.rombel.destroy', ['rombel' => $data]) }}"
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
    @endforeach
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
                                Transfer data rombel dari semester sebelumnya!</h3>
                            <form action="{{ route('admin.rombel.migrasi') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="tahun" value="{{ $tahun_ajaran->tahun_ajaran }}"
                                    id="" hidden>
                                <input type="text" name="semester" value="{{ $tahun_ajaran->semester }}"
                                    id="" hidden>
                                <input type="text" name="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}"
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

    <!-- Initialize Swiper -->
    <script type="module">
        var swiper = new Swiper(".mySwiper1", {
            centeredSlides: false,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination1",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
        var swiper = new Swiper(".mySwiper2", {
            centeredSlides: false,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination2",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
        var swiper = new Swiper(".mySwiper3", {
            centeredSlides: false,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination3",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
    </script>

    <script>
        document.getElementById('btn-download').addEventListener('click', () => {
            const workbook = XLSX.utils.book_new();
            const tableInputGuru = document.getElementById('template-input');
            const worksheetGuru = XLSX.utils.table_to_sheet(tableInputGuru);
            XLSX.utils.book_append_sheet(workbook, worksheetGuru, `Template Input Rombel`);
            XLSX.writeFile(workbook, `template-input-rombel.xlsx`);
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
