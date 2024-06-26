@extends('layouts.dashboard')
@section('table-name', 'Detail Siswa')
@section('table-role', 'Admin')
@section('back')
    @if (auth()->guard('admin')->check())
        <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
            <a href="{{ route('admin.siswa.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}"
                class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
        </div>
    @endif
    @if (auth()->guard('guru')->check())
        <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
            <a href="{{ route('guru.wali_kelas', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}"
                class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
        </div>
    @endif
@endsection
@section('content')
    <div class=" lg:my-0 md:p-10  min-h-screen bg-white">
        <div class="md:flex md:justify-between items-end">
            <div class="md:flex  md:gap-6 items-center p-6  md:p-0">
                <div id="profile-photo-mobile"
                    class="block md:mx-0 mx-auto  rounded-full shadow-xl h-[200px] w-[200px] bg-cover bg-center "
                    style="background-image: url('{{ $siswa->profil != '-' ? asset('storage/' . $siswa->profil) : asset('assets/img/profil-default.jpg') }}')">
                    <div class="w-full h-full relative">
                        <div class="absolute -bottom-2  w-full  text-center py-2 px-6 rounded-full"
                            style="background-color: rgb(237, 233, 254)">
                            <p class="text-[16px] font-medium">{{ $siswa->status_siswa }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-left md:mt-0 mt-6">
                    <div class="mb-3">
                        <span class="font-semibold text-[24px] capitalize">{{ $siswa->nama }} </span><span
                            class="ms-6 text-[16px] font-medium text-gray-500">
                            Nomor Id:
                            {{ $siswa->nomor_id }}</span>
                        <span>{{ $tahun }}{{ $semester }}</span>
                    </div>
                    <div class="mb-3">
                        <span class="font-medium text-[16px] text-gray-500">NISN: {{ $siswa->nisn }}</span>
                        <span class="mx-6 text-[20px] text-slate-300">&bull;</span>
                        <span class="font-medium text-[16px] text-gray-500">NIS: {{ $siswa->nis }}</span>
                        <span class="mx-6 text-[20px] text-slate-300">&bull;</span>
                        <span class="font-medium text-[16px] text-gray-500">Jenis Kelamin:
                            {{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</span>
                    </div>
                    <div class="">
                        <span class="font-medium text-[16px] text-gray-500">Username: {{ $siswa->username }}</span>
                        <span class="mx-6 text-[20px] text-slate-300">&bull;</span>
                        <span class="font-medium text-[16px] text-gray-500">Riwayat Rombel:
                            @foreach ($siswa->rombels as $rombel)
                                <span class="ms-1">{{ $rombel->nama_rombel }}</span>
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex gap-2 p-6 ">
                <div>
                    <a href="{{ route('admin.siswa.rekap_nilai', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel, 'id' => Crypt::encrypt($siswa->id)]) }}"
                        class="flex gap-2 items-center w-fit border border-slate-600 hover:bg-slate-700 text-slate-600 hover:text-white font-bold py-2 px-6 rounded-md">
                        <span>Rekap Nilai</span> <i class='bx bxs-report text-[20px]'></i></i>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.siswa.rekap_kehadiran', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel, 'id' => Crypt::encrypt($siswa->id)]) }}"
                        class="flex gap-2 items-center w-fit border border-slate-600 hover:bg-slate-700 text-slate-600 hover:text-white font-bold py-2 px-6 rounded-md">
                        <span>Rekap Kehadiran</span><i class='bx bx-calendar-alt text-[20px]'></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-8 w-full mx-auto md:py-6 px-6">
            <div class="md:grid md:grid-cols-2 md:gap-5">
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="nik"
                        class=" capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->kompetensi_keahlian != '-' ? $siswa->kompetensi_keahlian : '-' }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Kompetensi Keahlian</label>
                </div>
                <div class="relative z-0 w-full mb-10 ">
                    <input type="text" id="floating_email" name="nik"
                        class=" capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->nik }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        NIK</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-5 mt-3">
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="tempat_tanggal_lahir"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->tempat_tanggal_lahir }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Tempat Tanggal Lahir</label>
                </div>
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="alamat"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->alamat }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Alamat</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-5">

                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="no_hp"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->no_hp }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        No Handphone</label>
                </div>
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="agama"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->agama }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Agama</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-5">
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="no_hp_orang_tua"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->no_hp_orang_tua }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        No Handphone Orang Tua</label>
                </div>
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="pekerjaan_orang_tua"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->pekerjaan_orang_tua }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Pekerjaan Orang Tua</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-5">
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="nama_ayah"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->nama_ayah }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Nama Ayah</label>
                </div>
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="nama_ibu"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->nama_ibu }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Nama Ibu</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-5">
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="asal_smp"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->asal_smp }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Asal SMP</label>
                </div>
                <div class="relative z-0 w-full mb-10">
                    <input type="text" id="floating_email" name="tahun_lulus_smp"
                        class="capitalize block py-2.5 px-3 w-full text-[16px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-violet-400 peer"
                        value="{{ $siswa->tahun_lulus_smp }}" disabled />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-11 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-11">
                        Tahun Lulus SMP</label>
                </div>
            </div>
        </div>
    </div>
@endsection
