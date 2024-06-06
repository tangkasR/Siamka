@extends('layouts.dashboard')
@section('table-name', 'Ubah Nilai')
@section('table-role', 'Guru')
@section('content')
    <div>
        <div class="relative z-50  modal" id="id_edit_{{ $data->id }}" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 z-50 overflow-y-auto">
                <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
                </div>
                <div class="p-4 mx-auto animate-translate sm:max-w-4xl">
                    <div
                        class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                        <div class="bg-white dark:bg-zinc-700">
                            <div class="py-4 md:px-[100px] px-10 border-b rounded-t border-gray-50 dark:border-zinc-600">
                                <h3 class="mt-3 text-[24px] font-semibold text-gray-700 dark:text-gray-100">
                                    Ubah
                                    Data Nilai <span class="text-violet-500 capitalize">{{ $data->siswas->nama }}</span>
                                </h3>
                            </div>
                            <form class="space-y-4 w-full" action="{{ route('guru.nilai.update', ['id' => $data->id]) }}"
                                method="POST">
                                @csrf
                                <div class="md:px-[100px] px-10">
                                    <input type="text" name="rombel_id" id="rombel_id" class="" placeholder=""
                                        value="{{ $rombel_id }}" hidden>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="mb-3 w-full">
                                            <label for="nama"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                Nama Siswa
                                            </label>
                                            <input type="text" name="nama" id="nama"
                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                placeholder="Masukan Nama Siswa" value="{{ $data->siswas->nama }}" required
                                                readonly>
                                        </div>
                                        <div class="mb-3 w-full">
                                            <label for="mapel"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                Mata Pelajaran
                                            </label>
                                            <input type="text" name="mapel" id="mapel"
                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                placeholder="" value="{{ $data->mapels->nama_mata_pelajaran }}" required
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="mb-3 w-full">
                                            <label for="semester"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                Semester
                                            </label>
                                            <input type="text" name="semester" id="semester"
                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                placeholder="Masukan Semester" value="{{ $data->semester }}" required
                                                readonly>
                                        </div>
                                        <div class="mb-3 w-full">
                                            <label for="tipe_ujian"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                Tipe Ujian
                                            </label>
                                            <input type="text" name="tipe_ujian" id="tipe_ujian"
                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                placeholder="Masukan Tipe Ujian" value="{{ $data->tipe_ujian }}" required
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="mb-3 w-full">
                                            <label for="nilai"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                                Nilai
                                            </label>
                                            <input type="text" name="nilai" id="nilai"
                                                class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                                placeholder="Masukan Nilai Siswa" value="{{ $data->nilai }}" required>
                                        </div>
                                        <div></div>
                                    </div>
                                    <!-- Modal footer -->
                                </div>
                                <div
                                    class=" gap-3 md:px-[100px] px-10 pb-6 py-3 grid grid-cols-12 border-t rounded-b border-gray-50 dark:border-zinc-600">
                                    <button type="submit"
                                        class="col-span-3 w-full text-white bg-violet-600 border-transparent btn">
                                        Simpan
                                    </button>
                                    <a href="{{ route('guru.nilai.show_siswa', ['id' => $rombel_id]) }}"
                                        class="w-full text-white bg-gray-600  col-span-3 border-transparent btn">
                                        Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
