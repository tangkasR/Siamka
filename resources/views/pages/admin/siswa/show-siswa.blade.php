@extends('layouts.dashboard')
@section('table-name', 'Detail Siswa')
@section('table-role', 'Admin')
@section('content')
    <div class="md:max-w-4xl max-w-2xl flex items-center h-auto lg:h-screen flex-wrap mx-auto md:my-32 mt-32 lg:my-0 py-10">
        <div id="profile"
            class="w-full rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white md:mt-[40px] lg:mx-0">
            <div class="p-4 md:p-12 lg:text-left">
                <div id="profile-photo-mobile"
                    class="block  rounded-full shadow-xl mx-auto md:-mt-[120px] -mt-[150px] md:min-w-[300px] md:min-h-[300px] h-[250px] w-[250px]   bg-cover bg-center z-50 border-2 border-slate-600"
                    style="background-image: url('{{ $siswa->profil != '-' ? asset('storage/' . $siswa->profil) : asset('assets/img/profil-default.jpg') }}')">
                </div>
                <div class="w-full flex justify-center flex-col items-center md:mt-10 mt-6 ">
                    <input type="text" value="{{ $siswa->nama }}" name="nama"
                        class="border-none bg-transparent text-3xl font-medium capitalize text-center outline-none appearance-none focus:ring-0"
                        disabled>
                    <div class="mx-auto lg:mx-0 w-1/2 pt-2 border-b-2 border-violet-200 "></div>
                </div>
                <div class="mt-8 w-full mx-auto py-6 px-3">
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-8 ">
                            <div class="md:col-span-3 grid grid-cols-2 mt-3 md:mt-6 gap-4">
                                <div class="py-2">
                                    <a href="{{ route('admin.siswa.rekap_nilai', ['id' => $siswa->id]) }}"
                                        class="w-full  py-1 border px-5  border-slate-900   font-medium
                                            hover:bg-gray-700 hover:text-white text-slate-900 bg-slate-50
                                            rounded-md text-[14px]">
                                        Cetak Nilai
                                    </a>
                                </div>
                            </div>
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Rekap Nilai</label>
                        </div>
                        <div class="relative z-0 w-full mb-8">
                            <div class="md:col-span-3 grid grid-cols-2 mt-3 md:mt-6 gap-4">
                                <div class="py-2">
                                    <a href="{{ route('admin.siswa.rekap_kehadiran', ['id' => $siswa->id]) }}"
                                        class="w-full  py-1 border px-5  border-slate-900   font-medium
                                            hover:bg-gray-700 hover:text-white text-slate-900 bg-slate-50
                                            rounded-md text-[14px]">
                                        Cetak Kehadiran
                                    </a>
                                </div>
                            </div>
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Rekap Kehadiran</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email"
                                class="block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->nis }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                NIS</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->nisn }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                NISN</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email"
                                class="block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->nomor_id }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Nomor Id</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->status_siswa }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Status</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email"
                                class="block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->username }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Username</label>
                        </div>
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email"
                                class="block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value=" {{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Jenis Kelamin</label>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email" name="nik"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->nik }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                NIK</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email" name="tempat_tanggal_lahir"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->tempat_tanggal_lahir }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Tempat Tanggal Lahir</label>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10">
                            <div
                                class="grid grid-cols-12 capitalize   w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                @foreach ($siswa->rombels as $rombel)
                                    <input type="text" id="floating_email" name="no_hp"
                                        class="bg-transparent border-0 col-span-2 appearance-none py-2.5 px-0 ring-0 mt-[1px]"
                                        value="{{ $rombel->nama_rombel }}"disabled />
                                @endforeach
                            </div>
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Riwayat Rombel</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email" name="no_hp"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->no_hp }}"disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                No Handphone</label>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email" name="agama"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->kompetensi_keahlian }}"disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Kompetensi Keahlian</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email" name="agama"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->agama }}"disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Agama</label>
                        </div>
                    </div>

                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email" name="pekerjaan_orang_tua"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->pekerjaan_orang_tua }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Pekerjaan Orang Tua</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email" name="no_hp_orang_tua"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->no_hp_orang_tua }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                No Handphone Orang Tua</label>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email" name="asal_smp"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->asal_smp }}"disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Asal SMP</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email" name="tahun_lulus_smp"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->tahun_lulus_smp }}"disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Tahun Lulus SMP</label>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email" name="nama_ayah"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->nama_ayah }}"disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Nama Ayah</label>
                        </div>
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email" name="alamat"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->alamat }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Alamat</label>
                        </div>
                    </div>

                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email" name="nama_ibu"
                                class="capitalize block py-2.5 px-0 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $siswa->nama_ibu }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Nama Ibu</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
