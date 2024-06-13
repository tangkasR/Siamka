@extends('layouts.dashboard')
@section('table-name', 'Profil')
@section('table-role', 'Guru')
@section('content')
    <div class="md:max-w-4xl max-w-2xl flex items-center h-auto lg:h-screen flex-wrap mx-auto md:my-32 mt-32 lg:my-0 py-10">
        <!--Main Col-->
        <div id="profile"
            class="w-full rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white md:mt-[40px] lg:mx-0">
            <div class="p-4 md:p-12 lg:text-left">
                <!-- Image for mobile view-->
                <form action="{{ route('guru.update_profil') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="profile-photo-mobile"
                        class="block  rounded-full shadow-xl mx-auto md:-mt-[120px] -mt-[150px] md:min-w-[300px] md:min-h-[300px] h-[250px] w-[250px]   bg-cover bg-center z-50 border-2 border-slate-600"
                        style="background-image: url('{{ $guru->profil != '-' ? asset('storage/' . $guru->profil) : asset('assets/img/profil-default.jpg') }}')">
                        <div class="w-full h-full block">
                            <input
                                class="block w-full h-full opacity-0 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file" type="file" name="profil" onchange="loadPhoto(this)"
                                value="{{ $guru->profil }}">
                            <div
                                class="absolute md:text-[40px] text-[30px] px-2 pt-1  -mt-16 md:translate-x-5 border-2 bg-slate-200 border-slate-600 rounded-full">
                                <i class='bx bxs-camera'></i>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-center flex-col items-center md:mt-10 mt-6 ">
                        <input type="text" value="{{ $guru->nama }}"
                            class="border-none bg-transparent text-3xl font-medium capitalize text-center outline-none appearance-none focus:ring-0"
                            disabled>
                        <div class="mx-auto lg:mx-0 w-1/2 pt-2 border-b-2 border-violet-200 "></div>
                    </div>
                    <div class="mt-8 w-full mx-auto pt-6 px-3">
                        <div class="grid grid-cols-2 gap-5">
                            <div class="relative z-0 w-full mb-10 ">
                                <div
                                    class="grid grid-cols-12 capitalize   w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    @foreach ($guru->mapels as $mapel)
                                        <input type="text" id="" name=""
                                            class="bg-transparent border-0 col-span-6 appearance-none py-2.5 px-3 ring-0 mt-[1px]"
                                            value="{{ $mapel->nama_mata_pelajaran }}" disabled />
                                    @endforeach
                                </div>
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Mata Pelajaran</label>
                            </div>
                            <div class="relative z-0 w-full mb-10">
                                <input type="text" id="floating_email"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    value="{{ $guru->jabatan }}" disabled />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Jabatan</label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-5">
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
                        <div class="md:grid md:grid-cols-2 md:gap-5 mt-3">
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
                        <div class="md:grid md:grid-cols-2 md:gap-5">
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
                        </div>
                        <div class="md:grid md:grid-cols-2 md:gap-5">
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

                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                            Simpan
                        </button>
                    </div>
                </form>
                <div class="grid md:grid-cols-3 md:gap-4 md:mt-4 px-[10px]">
                    <div class="md:mt-0 mt-4">
                        <form action="{{ route('guru.download_ktp') }}" method="POST">
                            @csrf
                            <input type="text" name="ktp" value="{{ $guru->ktp }}" id="" hidden>
                            <button type="submit"
                                class="w-full bg-violet-500 hover:bg-violet-700 text-white font-bold py-2 px-4 rounded-md">
                                Download KTP
                            </button>
                        </form>
                    </div>
                    <div class="md:mt-0 mt-4">
                        <form action="{{ route('guru.download_ijazah') }}" method="POST">
                            @csrf
                            <input type="text" name="ijazah" value="{{ $guru->ijazah }}" id="" hidden>
                            <button type="submit"
                                class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                                Download Ijazah
                            </button>
                        </form>
                    </div>
                    <div class="md:mt-0 mt-4">
                        <form action="{{ route('guru.download_kk') }}" method="POST">
                            @csrf
                            <input type="text" name="kk" value="{{ $guru->kartu_keluarga }}" id=""
                                hidden>
                            <button type="submit"
                                class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md">
                                Download KK
                            </button>
                        </form>
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
