@extends('layouts.dashboard')
@section('table-name', 'Tahun Ajaran')
@section('table-role', '')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="px-[30px] pt-[20px]">
                    <h1 class="text-[18px] font-medium text-gray-700 leading-5">Silahkan pilih Tahun Ajaran untuk
                        melihat data</h1>
                </div>
                <hr class="text-[2px] my-[20px] text-black w-full" />
                <div class="relative overflow-x-auto card-body mb-[50px] h-[100%]">
                    {{-- Data --}}
                    <div class="grid md:grid-cols-3 gap-4 mb-10 px-[10px]">
                        @foreach ($tahun_ajarans as $data)
                            <div
                                class="card hover:scale-98 duration-300 bg-blue-50 border-blue-300 border-2  transition-all">
                                <div class="card-body">
                                    <h6 class="mb-6 text-slate-700 text-[25px] dark:text-gray-100 font-bold">
                                        {{ $data->tahun_ajaran }}
                                    </h6>
                                    <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                        Silahkan pilih tahun ajaran dengan menekan tombol dibawah!
                                    </p>
                                    <div class="">
                                        <a data-tw-toggle="modal" data-tw-target="#modal-id_semester{{ $loop->iteration }}"
                                            class="cursor-pointer hover:bg-blue-700 block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
                                            Pilih
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Semester --}}
                            <div class="absolute z-50 hidden modal" id="modal-id_semester{{ $loop->iteration }}"
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
                                                    <i
                                                        class="text-xl text-gray-500 mdi mdi-close dark:text-zinc-100/60"></i>
                                                </button>
                                                <div class="py-5 px-10 mb-4">
                                                    <h3 class="my-4 text-xl font-medium text-gray-700 dark:text-gray-100">
                                                        Pilih Semester
                                                    </h3>
                                                    @if ($type == 'guru')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="admin.guru" :tahun="$data->tahun_ajaran"
                                                                    :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    @if ($type == 'rombel')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="admin.rombel" :tahun="$data->tahun_ajaran"
                                                                    :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if ($type == 'kehadiran')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="guru.kehadiran" :tahun="$data->tahun_ajaran"
                                                                    :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if ($type == 'nilai')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="guru.nilai" :tahun="$data->tahun_ajaran"
                                                                    :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if ($type == 'ekskul')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="guru.ekskul" :tahun="$data->tahun_ajaran"
                                                                    :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if ($type == 'nilai_ekskul')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="guru.show_ekskul" :tahun="$data->tahun_ajaran"
                                                                    :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if ($type == 'wali_kelas')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="guru.wali_kelas" :tahun="$data->tahun_ajaran"
                                                                    :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if ($type == 'admin_nilai')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="admin.nilai.show_nilai" :tahun="$data->tahun_ajaran"
                                                                    :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if ($type == 'admin_kehadiran')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="admin.kehadiran.show_kehadiran"
                                                                    :tahun="$data->tahun_ajaran" :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if ($type == 'admin_ekskul')
                                                        <div class="grid grid-cols-2 gap-4">
                                                            @foreach ($data->semesters as $semester)
                                                                <x-link link="admin.ekskul.show_ekskul" :tahun="$data->tahun_ajaran"
                                                                    :semester="$semester"></x-link>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Semester --}}
                        @endforeach
                    </div>
                    {{-- End Data  --}}
                </div>
            </div>
        </div>
    </div>
@endsection
