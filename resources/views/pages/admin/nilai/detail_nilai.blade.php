@extends('layouts.dashboard')
@section('table-name')
    <span class="capitalize">Data Nilai {{ $rombel->nama_rombel }} - {{ str_replace('-', '/', $tahun) }} -
        {{ $semester }}</span>
@endsection
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('admin.nilai.show_nilai', ['tahun' => $tahun, 'semester' => $semester]) }}"
            class="flex justify-center items-center"><i class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 bg-white shadow-md">
        <div class="md:col-span-7 order-last md:order-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="relative overflow-x-auto card-body">
                    <table id="" class="text-center table w-full pt-4 text-gray-700 dark:text-zinc-100">
                        <thead>
                            <tr class="bg-blue-100">
                                <th class="p-4">Nama</th>
                                <th class="p-4">Mata Pelajaran</th>
                                <th class="p-4">Tipe Ujian</th>
                                <th class="p-4">Nilai</th>
                            </tr>
                        </thead>
                        <tbody id="tabel-container">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="md:col-span-5 w-full md:order-2">
            <div class="flex justify-between items-center my-6">
                <h1 class="text-[20px] font-medium">Daftar Guru</h1>
                <div class="w-[200px]">
                    <select id="tipe_ujian"
                        class="dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                        <option value="uts">UTS</option>
                        <option value="uas">UAS</option>
                    </select>
                </div>
            </div>
            @foreach ($gurus as $guru)
                <div class="">
                    <div class=" rounded-xl mb-6 capitalize grid grid-cols-3 gap-4 items-center">
                        <div class="flex justify-between items-center">
                            <p class="p-3 font-medium text-[16px]">{{ $guru->nama }}</p><i
                                class='bx bx-chevrons-right text-[20px]'></i>
                        </div>
                        @if (count($guru->mapels) > 1)
                            <div
                                class=" border-l-4  {{ $loop->iteration % 2 == 1 ? 'border-l-green-300' : 'border-l-pink-300' }} subject-container hover:bg-blue-300 p-3 cursor-pointer leading-6 font-semibold ">
                                <label class="cursor-pointer">
                                    <input type="radio" name="selected_subject" class="hidden"
                                        value="{{ $guru->mapels[0]->nama_mata_pelajaran }}"
                                        onclick="selectSubject(this, '{{ $guru->mapels[0]->nama_mata_pelajaran }}')">
                                    {{ $guru->mapels[0]->nama_mata_pelajaran }}
                                </label>
                            </div>
                            <div
                                class="border-l-4  {{ $loop->iteration % 2 == 1 ? 'border-l-green-300' : 'border-l-pink-300' }} subject-container hover:bg-blue-300 p-3  cursor-pointer leading-6 font-semibold ">
                                <label class="cursor-pointer">
                                    <input type="radio" name="selected_subject" class="hidden"
                                        value="{{ $guru->mapels[1]->nama_mata_pelajaran }}"
                                        onclick="selectSubject(this, '{{ $guru->mapels[1]->nama_mata_pelajaran }}')">
                                    {{ $guru->mapels[1]->nama_mata_pelajaran }}
                                </label>
                            </div>
                        @else
                            <div
                                class="border-l-4  {{ $loop->iteration % 2 == 1 ? 'border-l-green-300' : 'border-l-pink-300' }} subject-container hover:bg-blue-300 p-3  cursor-pointer leading-6 font-semibold ">
                                <label class="cursor-pointer">
                                    <input type="radio" name="selected_subject" class="hidden"
                                        value="{{ $guru->mapels[0]->nama_mata_pelajaran }}"
                                        onclick="selectSubject(this, '{{ $guru->mapels[0]->nama_mata_pelajaran }}')">
                                    {{ $guru->mapels[0]->nama_mata_pelajaran }}
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if (explode(' ', $rombel->nama_rombel)[0] == 'X')
        @if ($semester == 'ganjil')
            <input value="1" id="semester" hidden />
        @endif
        @if ($semester == 'genap')
            <input value="2" id="semester" hidden />
        @endif
    @endif
    @if (explode(' ', $rombel->nama_rombel)[0] == 'XI')
        @if ($semester == 'ganjil')
            <input value="3" id="semester" hidden />
        @endif
        @if ($semester == 'genap')
            <input value="4" id="semester"hidden />
        @endif
    @endif
    @if (explode(' ', $rombel->nama_rombel)[0] == 'XII')
        @if ($semester == 'ganjil')
            <input value="5" id="semester" hidden />
        @endif
        @if ($semester == 'genap')
            <input value="6" id="semester" hidden />
        @endif
    @endif

    <input type="text" id="rombel_id" value="{{ $rombel->id }}" hidden>
    <input type="text" id="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}" hidden>

    <script>
        function selectSubject(element, subject) {
            // Remove active class from any previously selected subject container
            const previouslySelected = document.querySelector('.bg-blue-600.text-white');
            if (previouslySelected) {
                previouslySelected.classList.remove('bg-blue-600', 'text-white');
            }

            // Add active class to the currently selected subject container
            const subjectContainer = element.closest('.subject-container');
            subjectContainer.classList.add('bg-blue-600', 'text-white');

            // Get selected exam type


            // console.log('Selected Subject:', subject);
            // console.log('Selected Exam Type:', examType);


            let container = document.getElementById('tabel-container')
            let url = '{{ route('admin.nilai.get_nilai') }}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: url,
                data: getDatas(),
                success: function(response) {
                    container.innerHTML = ''
                    createTable(response)

                }
            });


            function getDatas() {
                let rombel_id = $('#rombel_id').val()
                let tahun_ajaran_id = $('#tahun_ajaran_id').val()
                let tipe_ujian = document.getElementById('tipe_ujian').value;
                let semester = $('#semester').val()

                let datas = {
                    'tipe_ujian': tipe_ujian,
                    'rombel_id': rombel_id,
                    'tahun_ajaran_id': tahun_ajaran_id,
                    'nama_mapel': subject,
                    'semester': semester,
                }
                return datas
            }

            function createTable(datas) {
                let row = ''

                for (let i = 0; i < datas.length; i++) {
                    let semester = '';
                    if (datas[i].semester % 2 == 0) {
                        semester = 'genap'
                    } else {
                        semester = 'ganjil'
                    }

                    row = `
                    <tr class="${(i + 1) % 2 == 0 ? 'bg-blue-50' : 'bg-white'}">
                        <td class="p-4 pr-8">
                            ${datas[i].nama}</td>
                        <td class="p-4 pr-8">
                            ${datas[i].nama_mata_pelajaran}</td>
                        <td class="p-4 pr-8 capitalize">
                            ${datas[i].tipe_ujian}</td>
                        <td class="p-4 pr-8">
                            ${datas[i].nilai}</td>
                    </tr>
                    `;
                    container.innerHTML += row
                }
            }
        }
    </script>

@endsection
