@extends('layouts.dashboard')
@section('table-name', 'Profil')
@section('table-role', 'Siswa')
@section('content')
    <div class=" lg:my-0 md:p-10  min-h-screen bg-white">
        <form action="{{ route('siswa.update_profil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!--Main Col-->
            <div class="md:flex md:justify-between items-end">
                <div class="md:flex  md:gap-6 items-center p-6  md:p-0">
                    <div id="profile-photo-mobile"
                        class="block md:mx-0 mx-auto  rounded-full shadow-xl h-[200px] w-[200px] bg-cover bg-center "
                        style="background-image: url('{{ $siswa->profil != '-' ? asset('storage/' . $siswa->profil) : asset('assets/img/profil-default.jpg') }}')">
                        <div class="w-full h-full relative">
                            <div class="absolute -bottom-2 right-8 w-fit  text-center py-2 px-6 rounded-full"
                                style="background-color: rgb(237, 233, 254)">
                                <p class="text-[16px] font-medium">{{ $siswa->status_siswa }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-left md:mt-0 mt-10">
                        <div class="mb-3">
                            <span class="font-semibold text-[24px] capitalize">{{ $siswa->nama }} </span>
                            <br class="md:hidden block">
                            <div class="md:hidden block mb-3"></div>
                            <span class="md:ms-6 text-[16px] font-medium text-gray-500">
                                Nomor Id:
                                {{ $siswa->nomor_id }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-medium text-[16px] text-gray-500">NISN: {{ $siswa->nisn }}</span>
                            <span class="md:opacity-100 opacity-0  mx-6 text-[20px] text-slate-300">&bull;</span>
                            <br class="md:hidden block">
                            <div class="md:hidden block mb-3"></div>
                            <span class="font-medium text-[16px] text-gray-500">NIS: {{ $siswa->nis }}</span>
                            <span class="md:opacity-100 opacity-0 hidden mx-6 text-[20px] text-slate-300">&bull;</span>
                            <br class="md:hidden block">
                            <div class="md:hidden block mb-3"></div>
                            <span class="font-medium text-[16px] text-gray-500">Jenis Kelamin:
                                {{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</span>
                        </div>
                        <div class="">
                            <span class="font-medium text-[16px] text-gray-500">Username: {{ $siswa->username }}</span>
                            <span class="md:opacity-100 opacity-0 mx-6 text-[20px] text-slate-300">&bull;</span>
                            <br class="md:hidden block">
                            <div class="md:hidden block mb-3"></div>
                            <span class="font-medium text-[16px] text-gray-500">Riwayat Rombel:
                                @foreach ($siswa->rombels as $rombel)
                                    <span class="ms-1">{{ $rombel->nama_rombel }}</span>
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative p-6">
                    <span class=" px-6 py-2 text-blue-600 font-medium border border-blue-500 rounded-md">Ubah
                        Foto <i class='bx bxs-edit ms-1'></i></span>
                    <input class="absolute w-full h-full opacity-0 cursor-pointer top-0 right-0 z-50" id="file"
                        type="file" name="profil" onchange="loadPhoto(this)" value="{{ $siswa->profil }}">
                </div>

            </div>
            <div class="mt-8 w-full mx-auto md:py-6 px-6">
                <div class="md:grid md:grid-cols-2 md:gap-5">

                    <div class="relative z-0 w-full mb-10">
                        <select id="floating_email" name="kompetensi_keahlian"
                            class="block py-2.5 px-3 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            required>
                            <option value="" hidden>
                                Pilih Kompetensi Keahlian</option>
                            <option value="farmasi" {{ $siswa->kompetensi_keahlian == 'farmasi' ? 'selected' : '' }}
                                {{ old('kompetensi_keahlian', $siswa->kompetensi_keahlian) == 'farmasi' ? 'selected' : '' }}>
                                Farmasi</option>
                            <option value="analis kesehatan"
                                {{ $siswa->kompetensi_keahlian == 'analis kesehatan' ? 'selected' : '' }}
                                {{ old('kompetensi_keahlian', $siswa->kompetensi_keahlian) == 'analis kesehatan' ? 'selected' : '' }}>
                                Analis Kesehatan</option>
                        </select>
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                            Kompetensi Keahlian</label>
                    </div>
                    <div class="relative z-0 w-full mb-10 " style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="nik"
                            class=" capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('nik', $siswa->nik) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            NIK</label>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-5 mt-3">
                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="tempat_tanggal_lahir"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('tempat_tanggal_lahir', $siswa->tempat_tanggal_lahir) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            Tempat Tanggal Lahir</label>
                    </div>
                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="alamat"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('alamat', $siswa->alamat) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            Alamat</label>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-5">

                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="no_hp"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('no_hp', $siswa->no_hp) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            No Handphone</label>
                    </div>
                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="agama"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('agama', $siswa->agama) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            Agama</label>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-5">
                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="no_hp_orang_tua"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('no_hp_orang_tua', $siswa->no_hp_orang_tua) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            No Handphone Orang Tua</label>
                    </div>
                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="pekerjaan_orang_tua"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('pekerjaan_orang_tua', $siswa->pekerjaan_orang_tua) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            Pekerjaan Orang Tua</label>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-5">
                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="nama_ayah"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('nama_ayah', $siswa->nama_ayah) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            Nama Ayah</label>
                    </div>
                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="nama_ibu"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('nama_ibu', $siswa->nama_ibu) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            Nama Ibu</label>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-5">
                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="asal_smp"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('asal_smp', $siswa->asal_smp) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            Asal SMP</label>
                    </div>
                    <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                        <input type="text" id="floating_email" name="tahun_lulus_smp"
                            class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                            value="{{ old('tahun_lulus_smp', $siswa->tahun_lulus_smp) }}" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                            Tahun Lulus SMP</label>
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

                <input type="text" name="old_profil" value="{{ $siswa->profil }}" hidden>
                <button type="submit" class=" w-full text-white bg-blue-500 border-transparent btn ">
                    Simpan
                </button>
            </div>
        </form>
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
