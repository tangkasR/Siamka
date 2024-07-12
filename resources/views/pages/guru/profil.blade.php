@extends('layouts.dashboard')
@section('table-name', 'Profil')
@section('table-role', 'Guru')
@section('content')
    <div class=" lg:my-0 md:p-10  min-h-screen bg-white ">
        <div class="relative pb-10">
            <form action="{{ route('guru.update_profil') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!--Main Col-->
                <div class="md:flex md:justify-between items-end">
                    <div class="md:flex  md:gap-6 items-center p-6  md:p-0">
                        <div id="profile-photo-mobile"
                            class="block md:mx-0 mx-auto  rounded-full shadow-xl h-[200px] w-[200px] bg-cover bg-center "
                            style="background-image: url('{{ $guru->profil != '-' ? asset('storage/' . $guru->profil) : asset('assets/img/profil-default.jpg') }}')">
                            <div class="w-full h-full relative">
                                <div class="absolute -bottom-2 w-full  text-center py-2 px-6 rounded-full"
                                    style="background-color: rgb(237, 233, 254)">
                                    <p class="text-[16px] font-medium capitalize">{{ $guru->jabatan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-left md:mt-0 mt-6">
                            <div class="mb-3">
                                <span class="font-semibold text-[24px] capitalize">{{ $guru->nama }} </span>
                            </div>
                            <div class="mb-3">
                                <span class="font-medium text-[16px] text-gray-500">Kompetensi:
                                    @foreach ($guru->mapels as $index => $mapel)
                                        @if ($index == 1)
                                            <span class="mx-2">&</span>
                                        @endif
                                        <span class="ms-1">{{ $mapel->nama_mata_pelajaran }}</span>
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="relative p-6 ">
                        <span class="px-6 py-2 text-blue-600 font-medium border border-blue-500 rounded-md">Ubah Foto <i
                                class='bx bxs-edit ms-1'></i></span>
                        <input class="absolute w-full h-full opacity-0 cursor-pointer top-0 right-0 z-50" id="file"
                            type="file" name="profil" onchange="loadPhoto(this)" value="{{ $guru->profil }}">

                    </div>

                </div>
                <div class="mt-8 w-full mx-auto md:py-6 px-6 pb-0">

                    {{-- ----- --}}
                    <div class="md:grid md:grid-cols-2 md:gap-5 mt-3">
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email"
                                class="block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $guru->username }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Username</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <select id="floating_email" name="jenis_kelamin"
                                class="block py-2.5 px-3 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                required>
                                <option value="" hidden>
                                    Pilih</option>
                                <option value="L" {{ $guru->jenis_kelamin == 'L' ? 'selected' : '' }}
                                    {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="P" {{ $guru->jenis_kelamin == 'P' ? 'selected' : '' }}
                                    {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Jenis Kelamin</label>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                            <input type="text" id="floating_email" name="tempat_tanggal_lahir"
                                class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                value="{{ old('tempat_tanggal_lahir', $guru->tempat_tanggal_lahir) }}" />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                Tempat Tanggal Lahir</label>
                        </div>
                        <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                            <input type="text" id="floating_email" name="alamat"
                                class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                value="{{ old('alamat', $guru->alamat) }}" />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                Alamat</label>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                            <input type="text" id="floating_email" name="pendidikan_terakhir"
                                class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                value="{{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) }}" />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                Pendidikan Terakhir</label>
                        </div>
                        <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                            <input type="text" id="floating_email" name="no_hp"
                                class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                value="{{ old('no_hp', $guru->no_hp) }}" />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                No Handphone</label>
                        </div>
                    </div>
                    {{--  --}}
                    <div class="md:grid md:grid-cols-3 md:gap-5">
                        <div class="">
                            <div class="relative z-0 w-full mb-10 col-span-9 pt-5">
                                <input
                                    class=" block w-full  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="file" type="file" name="ktp">
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    KTP</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="relative z-0 w-full mb-10 col-span-9 pt-5">
                                <input
                                    class="block w-full  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="file" type="file" name="ijazah">
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Ijazah</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="relative z-0 w-full mb-10 col-span-9 pt-5">
                                <input
                                    class="block w-full  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="file" type="file" name="kartu_keluarga">
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Kartu Keluarga</label>
                            </div>
                        </div>
                    </div>
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

                    <input type="text" name="old_profil" value="{{ $guru->profil }}" hidden>
                    <input type="text" name="old_ktp" value="{{ $guru->ktp }}" hidden>
                    <input type="text" name="old_ijazah" value="{{ $guru->ijazah }}" hidden>
                    <input type="text" name="old_kartu_keluarga" value="{{ $guru->kartu_keluarga }}" hidden>

                    <div class="absolute bottom-0 left-6">
                        <button type="submit"
                            class="w-fit bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 rounded-md ">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
            <div class="absolute bottom-0 left-44">
                <div class="relative dropdown">
                    <button type="button"
                        class="flex gap-2 items-center dropdown-toggle w-fit border border-blue-600 hover:bg-blue-700 text-blue-600 hover:text-white font-bold py-2 px-6 rounded-md "
                        id="dropdownMenuButton1" data-bs-toggle="dropdown"><span> Download</span> <i
                            class='bx bxs-cloud-download text-[20px]'></i></button>
                    <ul class="absolute text-left z-50 float-left py-2 mt-1  list-none bg-white border-none rounded-lg shadow-lg dropdown-menu w-44 bg-clip-padding dark:bg-zinc-700 hidden"
                        aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(49px, 1636.5px, 0px);">
                        <li>
                            <form action="{{ route('guru.download_ktp') }}" method="POST">
                                @csrf
                                <input type="text" name="ktp" value="{{ $guru->ktp }}" id="" hidden>
                                <button
                                    class="text-left block w-full px-4 py-1 text-sm font-medium text-gray-700 bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                    type="submit">
                                    Download KTP
                                </button>
                            </form>
                        </li>
                        <hr class="my-1 border-gray-50 dark:border-zinc-600">
                        <li>
                            <form action="{{ route('guru.download_kk') }}" method="POST">
                                @csrf
                                <input type="text" name="kk" value="{{ $guru->kartu_keluarga }}" id=""
                                    hidden>
                                <button
                                    class="text-left block text-gray-700  w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                    type="submit">
                                    Download KK
                                </button>
                            </form>
                        </li>
                        <hr class="my-1 border-gray-50 dark:border-zinc-600">
                        <li>
                            <form action="{{ route('guru.download_ijazah') }}" method="POST">
                                @csrf
                                <input type="text" name="ijazah" value="{{ $guru->ijazah }}" id="" hidden>
                                <button
                                    class="text-left block text-gray-700  w-full px-4 py-1 text-sm font-medium  bg-transparent dropdown-item whitespace-nowrap hover:bg-gray-50/50 dark:text-gray-100 dark:hover:bg-zinc-600/50"
                                    type="submit">
                                    Download Ijazah
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (session('message'))
        <script>
            toast('message', '{{ Session::get('message') }}')
        </script>
    @endif
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
    </script>
@endsection
