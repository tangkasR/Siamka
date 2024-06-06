@extends('layouts.dashboard')
@section('table-name', 'Ubah Kehadiran')
@section('table-role', 'Guru')
@section('content')
    <div class="relative z-50  modal" id="" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="absolute inset-0 transition-opacity bg-black bg-opacity-50 modal-overlay">
            </div>
            <div class="p-4 mx-auto animate-translate sm:max-w-lg">
                <div
                    class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-600">
                    <div class="bg-white dark:bg-zinc-700">
                        <div class="pt-6 px-10 pb-6 border-b rounded-t border-gray-50 dark:border-zinc-600">
                            <h3 class="mb-2 text-[24px] font-semibold text-gray-700 dark:text-gray-100">
                                Ubah
                                Data Kehadiran <span class="capitalize text-violet-500">{{ $siswa->nama }}</span></h3>
                            <p class="text-sm font-medium text-gray-600">Tanggal:
                                {{ \Carbon\Carbon::createFromTimestamp(strtotime($kehadiran->tanggal))->format('d-m-Y') }}
                            </p>
                        </div>
                        <form class="space-y-4" action="{{ route('guru.kehadiran.update', ['id' => $kehadiran->id]) }}"
                            method="POST">
                            @csrf
                            <input type="text" value="{{ $rombel_id }}" name="rombel_id" hidden>
                            <div class="grid grid-cols-12 gap-4 items-center px-[40px]">
                                <div class=" col-span-6">
                                    <label for="nama_siswa"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                        Nama Siswa
                                    </label>
                                    <input type="text" name="nama_siswa" id="nama_siswa"
                                        class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                                        placeholder="Masukan Nama Rombongan Belajar" value="{{ $siswa->nama }}" readonly>
                                </div>
                                <div class="form-check col-span-6">
                                    <div>
                                        <label class=" text-gray-700 dark:text-zinc-100" for="daftar_kehadiran">
                                            Kehadiran</label>
                                        <select id="daftar_kehadiran" name="daftar_kehadiran"
                                            class="dark:bg-zinc-800  dark:border-zinc-700 w-full mt-2 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                            <option value="hadir" selected>Hadir</option>
                                            <option value="sakit">Sakit</option>
                                            <option value="izin">Izin</option>
                                            <option value="alpa">Alpa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class=" gap-3 px-10 py-6 grid grid-cols-12 border-t rounded-b border-gray-50 dark:border-zinc-600">
                                <button type="submit"
                                    class="col-span-3 w-full text-white bg-violet-600 border-transparent btn">
                                    Simpan
                                </button>
                                <a href="{{ route('guru.kehadiran.show_siswa', ['id' => $rombel_id]) }}"
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
@endsection
