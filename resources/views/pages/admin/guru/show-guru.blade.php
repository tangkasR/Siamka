@extends('layouts.dashboard')
@section('table-name', 'Detail Guru')
@section('table-role', 'Admin')
@section('content')
    <div class="md:max-w-4xl max-w-2xl flex items-center h-auto lg:h-screen flex-wrap mx-auto md:my-32 mt-32 lg:my-0 py-10">
        <div id="profile"
            class="w-full rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white md:mt-[40px] lg:mx-0">
            <div class="p-4 md:p-12 lg:text-left">
                <div id="profile-photo-mobile"
                    class="block  rounded-full shadow-xl mx-auto md:-mt-[120px] -mt-[150px] md:min-w-[300px] md:min-h-[300px] h-[200px] w-[200px]   bg-cover bg-center z-50 border-2 border-slate-600"
                    style="background-image: url('{{ $guru->profil != '-' ? asset('storage/' . $guru->profil) : asset('assets/img/profil-default.jpg') }}')">
                </div>
                <div class="w-full flex justify-center flex-col items-center md:mt-10 mt-6 ">
                    <input type="text" value="{{ $guru->nama }}" name="nama"
                        class="border-none bg-transparent text-3xl font-medium capitalize text-center outline-none appearance-none focus:ring-0"
                        disabled>
                    <div class="mx-auto lg:mx-0 w-1/2 pt-2 border-b-2 border-violet-200 "></div>
                </div>
                <div class="mt-8 w-full mx-auto py-6 px-3">
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-8">
                            <div class="md:col-span-3 grid grid-cols-2 mt-3 md:mt-6 gap-4">
                                <div class="py-2">
                                    <a href="{{ route('admin.guru.cetak_kehadiran', ['id' => $guru->id]) }}"
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
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email"
                                class="block py-2.5 px-0 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $guru->mata_pelajarans->nama_mata_pelajaran }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Mata Pelajaran</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email"
                                class="capitalize block py-2.5 px-0 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $guru->jabatan }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Jabatan</label>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email"
                                class="block py-2.5 px-0 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $guru->username }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Username</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email"
                                class="block py-2.5 px-0 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $guru->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Jenis Kelamin</label>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email" name="tempat_tanggal_lahir"
                                class="capitalize block py-2.5 px-0 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $guru->tempat_tanggal_lahir }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Tempat Tanggal Lahir</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email" name="alamat"
                                class="capitalize block py-2.5 px-0 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $guru->alamat }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Alamat</label>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-5">
                        <div class="relative z-0 w-full mb-10 ">
                            <input type="text" id="floating_email" name="pendidikan_terakhir"
                                class="capitalize block py-2.5 px-0 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $guru->pendidikan_terakhir }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                Pendidikan Terakhir</label>
                        </div>
                        <div class="relative z-0 w-full mb-10">
                            <input type="text" id="floating_email" name="no_hp"
                                class="capitalize block py-2.5 px-0 w-full text-[14px] text-gray-900 font-medium bg-transparent border-0 border-b-2 border-violet-200 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                value="{{ $guru->no_hp }}" disabled />
                            <label for="floating_email"
                                class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                No Handphone</label>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-3 md:gap-5 ">
                        <div class="">
                            <div class="relative z-0 w-full mb-10 col-span-9 pt-5">
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    KTP</label>
                                <a class="hover:text-blue-600  left-0 peer-focus:font-medium absolute md:text-[20px] text-[16px] cursor-pointer  text-gray-500 font-medium dark:text-gray-400 duration-300 transform scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 md:peer-focus:-translate-y-8"
                                    data-tw-toggle="modal" data-tw-target="#modal_view_ktp">
                                    <i class='bx bx-show'></i> Lihat File KTP</a>
                            </div>
                        </div>
                        <div class="">
                            <div class="relative z-0 w-full mb-10 col-span-9 pt-5">
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Ijazah</label>
                                <a class=" hover:text-blue-600  left-0 peer-focus:font-medium absolute md:text-[20px] text-[16px] cursor-pointer  text-gray-500 font-medium dark:text-gray-400 duration-300 transform scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 md:peer-focus:-translate-y-8"
                                    data-tw-toggle="modal" data-tw-target="#modal_view_ijazah">
                                    <i class='bx bx-show'></i> Lihat File Ijazah</a>
                            </div>
                        </div>
                        <div class="">
                            <div class="relative z-0 w-full mb-10 col-span-9 pt-5">
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-[16px] text-gray-500 font-medium dark:text-gray-400 duration-300 transform -translate-y-7 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">
                                    Kartu Keluarga</label>
                                <a class="hover:text-blue-600  left-0 peer-focus:font-medium absolute md:text-[20px] text-[16px] cursor-pointer  text-gray-500 font-medium dark:text-gray-400 duration-300 transform scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 md:peer-focus:-translate-y-8"
                                    data-tw-toggle="modal" data-tw-target="#modal_view_kartu_keluarga">
                                    <i class='bx bx-show'></i> Lihat File KK</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal ktp --}}
    <div class="relative z-50 hidden modal" id="modal_view_ktp" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
            </div>
            <div class="p-x-6 mx-auto animate-translate md:max-w-4xl w-full ">
                <div
                    class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                    <div class="bg-white dark:bg-zinc-700">
                        <iframe src="{{ url('storage/' . $guru->ktp) }}" class="w-full min-h-[90vh]"
                            frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal ktp --}}
    {{-- Modal ijazah --}}
    <div class="relative z-50 hidden modal" id="modal_view_ijazah" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
            </div>
            <div class="p-x-6 mx-auto animate-translate md:max-w-4xl w-full ">
                <div
                    class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                    <div class="bg-white dark:bg-zinc-700">
                        <iframe src="{{ url('storage/' . $guru->ijazah) }}" class="w-full min-h-[90vh]"
                            frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal ijazah --}}
    {{-- Modal kartu keluarga --}}
    <div class="relative z-50 hidden modal" id="modal_view_kartu_keluarga" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
            </div>
            <div class="p-x-6 mx-auto animate-translate md:max-w-4xl w-full ">
                <div
                    class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                    <div class="bg-white dark:bg-zinc-700">
                        <iframe src="{{ url('storage/' . $guru->kartu_keluarga) }}"
                            class="w-full min-h-[90vh]" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal kartu keluarga --}}
@endsection
