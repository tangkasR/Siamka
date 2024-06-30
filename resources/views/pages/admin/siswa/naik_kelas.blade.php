@extends('layouts.dashboard')
@section('table-name', 'Menaikkan Siswa')
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.siswa.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $rombel]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <form action="{{ route('admin.siswa.next_grade') }}" method="POST">
                @csrf
                <input type="text" name="tahun_ajaran_id" id="" value="{{ $tahun_ajaran_id }}" hidden>
                <input type="text" name="tahun" id="" value="{{ $tahun }}" hidden>
                <input type="text" name="semester" id="" value="{{ $semester }}" hidden>
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body border-b border-gray-100 dark:border-zinc-600" id="template_pdf">
                        <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                            <h5 class="text-slate-800 text-[20px] leading-10 font-medium m-0">Menaikkan Siswa dari rombel
                                <span class="text-violet-800 font-bold">{{ $rombel->nama_rombel }}</span> ke rombel <span
                                    class="text-violet-800 font-bold" id="classname_container"></span>
                            </h5>
                        </div>
                        <div>
                            @foreach ($rombels as $data_rombel)
                                @if (explode(' ', $rombel->nama_rombel)[0] == 'X')
                                    @if (explode(' ', $data_rombel->nama_rombel)[0] == 'X' &&
                                            explode(' ', $data_rombel->nama_rombel)[1] == explode(' ', $rombel->nama_rombel)[1]
                                    )
                                        <input type="text" class="class_id_now" name="class_id_now"
                                            value="{{ $data_rombel->id }}" hidden>
                                    @endif
                                    @if (explode(' ', $data_rombel->nama_rombel)[0] == 'XI' &&
                                            explode(' ', $data_rombel->nama_rombel)[1] == explode(' ', $rombel->nama_rombel)[1]
                                    )
                                        <input type="text" class="next_class_id" name="id_next"
                                            value="{{ $data_rombel->id }}" hidden>
                                    @endif
                                @endif
                                @if (explode(' ', $rombel->nama_rombel)[0] == 'XI')
                                    @if (explode(' ', $data_rombel->nama_rombel)[0] == 'XI' &&
                                            explode(' ', $data_rombel->nama_rombel)[1] == explode(' ', $rombel->nama_rombel)[1]
                                    )
                                        <input type="text" class="class_id_now" name="class_id_now"
                                            value="{{ $data_rombel->id }}" hidden>
                                    @endif
                                    @if (explode(' ', $data_rombel->nama_rombel)[0] == 'XII' &&
                                            explode(' ', $data_rombel->nama_rombel)[1] == explode(' ', $rombel->nama_rombel)[1]
                                    )
                                        <input type="text" class="next_class_id" name="id_next"
                                            value="{{ $data_rombel->id }}" hidden>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="relative overflow-x-auto card-body">

                            <div class="grid gap-4 md:grid-cols-2  ">
                                @foreach ($siswas as $siswa)
                                    <div
                                        class="grid md:grid-cols-12 items-center gap-4  bg-white border border-indigo-100 px-1 py-3">
                                        <div class="md:col-span-3 flex items-center justify-center ">
                                            <div class="block rounded-full  mx-auto  min-w-[80px] min-h-[80px]    bg-cover  bg-no-repeat bg-center "
                                                style="background-image: url('{{ $siswa->profil != '-' ? asset('storage/' . $siswa->profil) : asset('assets/img/profil-default.jpg') }}')">
                                            </div>
                                        </div>
                                        <div class="md:col-span-9">
                                            <h5 class="mb-3 font-bold text-lg ">{{ $siswa->nama }}</h5>
                                            <input type="text" value="{{ $siswa->id }}" name="siswa_id[]" hidden>
                                            <div>
                                                <select id="status" name="status[]"
                                                    class="dark:bg-zinc-800 max-w-[150px]  dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                                    <option value="naik" selected>Naik Kelas</option>
                                                    <option value="tinggal">Tinggal Kelas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <button type="submit"
                                class="w-fit mt-6 px-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded-md btn">
                                Naikkan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const nextClass = document.querySelectorAll('.next_class_name')
        const classNameContainer = document.getElementById('classname_container')
        nextClass.forEach(data => {
            classNameContainer.innerHTML = `${data.value}`;
        });
    </script>
@endsection
