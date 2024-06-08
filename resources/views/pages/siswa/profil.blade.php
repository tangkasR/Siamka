@extends('layouts.dashboard')
@section('table-name', 'Profil')
@section('table-role', 'Siswa')
@section('content')
    <div class="md:max-w-4xl max-w-2xl flex items-center h-auto lg:h-screen flex-wrap mx-auto md:my-32 mt-32 lg:my-0 py-10">
        <!--Main Col-->
        <div id="profile"
            class="w-full rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white md:mt-[40px] lg:mx-0">
            <div class="p-4 md:p-12 lg:text-left">
                <!-- Image for mobile view-->
                <form action="{{ route('siswa.update_profil') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="profile-photo-mobile"
                        class="block  rounded-full shadow-xl mx-auto md:-mt-[120px] -mt-[150px] md:min-w-[300px] md:min-h-[300px] h-[250px] w-[250px]   bg-cover bg-center z-50 border-2 border-slate-600"
                        style="background-image: url('{{ $siswa->profil != '-' ? asset('storage/' . $siswa->profil) : asset('assets/img/profil-default.jpg') }}')">
                        <div class="w-full h-full block">
                            <input
                                class="block w-full h-full opacity-0 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-slate-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file" type="file" name="profil" onchange="loadPhoto(this)"
                                value="{{ $siswa->profil }}">
                            <div
                                class="absolute md:text-[40px] text-[30px] px-2 pt-1  -mt-16 md:translate-x-5 border-2 bg-slate-200 border-slate-600 rounded-full">
                                <i class='bx bxs-camera'></i>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-center flex-col items-center md:mt-10 mt-6 ">
                        <input type="text" value="{{ $siswa->nama }}" name=""
                            class="border-none bg-transparent text-3xl font-medium capitalize text-center outline-none appearance-none focus:ring-0 w-full"
                            disabled>
                        <div class="mx-auto lg:mx-0 w-1/2 pt-2 border-b-2 border-violet-200 "></div>
                    </div>
                    <div class="mt-8 w-full mx-auto py-6 px-3">
                        <div class="grid grid-cols-2 gap-5">
                            <div class="relative z-0 w-full mb-10 ">
                                <input type="text" id="floating_email"
                                    class="block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    value="{{ $siswa->nis }}" disabled />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    NIS</label>
                            </div>
                            <div class="relative z-0 w-full mb-10">
                                <input type="text" id="floating_email"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    value="{{ $siswa->nisn }}" disabled />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    NISN</label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-5">
                            <div class="relative z-0 w-full mb-10">
                                <input type="text" id="floating_email"
                                    class="block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    value="{{ $siswa->nomor_id }}" disabled />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Nomor Id</label>
                            </div>
                            <div class="relative z-0 w-full mb-10">
                                <input type="text" id="floating_email"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    value="{{ $siswa->status_siswa }}" disabled />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Status</label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-5">
                            <div class="relative z-0 w-full mb-10 ">
                                <input type="text" id="floating_email"
                                    class="block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    value="{{ $siswa->username }}" disabled />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Username</label>
                            </div>
                            <div class="relative z-0 w-full mb-10">
                                <select id="floating_email" name="jenis_kelamin"
                                    class="block py-2.5 px-3 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    required>
                                    <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Jenis Kelamin</label>
                            </div>
                        </div>
                        <div class="md:grid md:grid-cols-2 md:gap-5">
                            <div class="relative z-0 w-full mb-10">
                                <div
                                    class="grid grid-cols-12 capitalize   w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    @foreach ($siswa->rombels as $rombel)
                                        <input type="text" id="" name=""
                                            class="bg-transparent border-0 col-span-3 appearance-none py-2.5 px-3 ring-0 mt-[1px]"
                                            value="{{ $rombel->nama_rombel }}"disabled />
                                    @endforeach
                                </div>
                                <label for=""
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Riwayat Rombel</label>
                            </div>
                            <div class="relative z-0 w-full mb-10">
                                <select id="floating_email" name="kompetensi_keahlian"
                                    class="block py-2.5 px-3 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    required>
                                    <option value="" hidden>
                                        Pilih</option>
                                    <option value="farmasi"
                                        {{ $siswa->kompetensi_keahlian == 'farmasi' ? 'selected' : '' }}
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
                        </div>
                        <div class="md:grid md:grid-cols-2 md:gap-5 mt-3">
                            <div class="relative z-0 w-full mb-10 " style="background-color: rgba(237, 233, 254, 0.473)">
                                <input type="text" id="floating_email" name="nik"
                                    class=" capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                    value="{{ old('nik', $siswa->nik) }}" />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                    NIK</label>
                            </div>
                            <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                                <input type="text" id="floating_email" name="tempat_tanggal_lahir"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                    value="{{ old('tempat_tanggal_lahir', $siswa->tempat_tanggal_lahir) }}" />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                    Tempat Tanggal Lahir</label>
                            </div>
                        </div>
                        <div class="md:grid md:grid-cols-2 md:gap-5">
                            <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                                <input type="text" id="floating_email" name="alamat"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                    value="{{ old('alamat', $siswa->alamat) }}" />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                    Alamat</label>
                            </div>
                            <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                                <input type="text" id="floating_email" name="no_hp"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                    value="{{ old('no_hp', $siswa->no_hp) }}" />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                    No Handphone</label>
                            </div>
                        </div>
                        <div class="md:grid md:grid-cols-2 md:gap-5">
                            <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                                <input type="text" id="floating_email" name="agama"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                    value="{{ old('agama', $siswa->agama) }}" />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                    Agama</label>
                            </div>
                            <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                                <input type="text" id="floating_email" name="no_hp_orang_tua"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                    value="{{ old('no_hp_orang_tua', $siswa->no_hp_orang_tua) }}" />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                    No Handphone Orang Tua</label>
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
                                <input type="text" id="floating_email" name="pekerjaan_orang_tua"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                    value="{{ old('pekerjaan_orang_tua', $siswa->pekerjaan_orang_tua) }}" />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                    Pekerjaan Orang Tua</label>
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
                        <div class="md:grid md:grid-cols-2 md:gap-5">
                            <div class="relative z-0 w-full mb-10" style="background-color: rgba(237, 233, 254, 0.473)">
                                <input type="text" id="floating_email" name="asal_smp"
                                    class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                                    value="{{ old('asal_smp', $siswa->asal_smp) }}" />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                                    Asal SMP</label>
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
