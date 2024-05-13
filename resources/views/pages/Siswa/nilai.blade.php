@extends('layouts.dashboard')
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600 p-0">
                    <div class="px-[30px] pt-[20px] pb-[20px] grid grid-cols-12 items-center">
                        <div class="col-span-10">
                            <h2 class=" text-slate-700 text-[20px] font-bold">Nilai <span
                                    class="text-[25px] text-violet-500 ms-1 uppercase"
                                    id="tipe_ujian_title">{{ $tipe_ujian }}</span></h2>
                        </div>
                        <div class="col-span-2">
                            <label for=""
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                                Tipe Ujian
                            </label>
                            <select id="tipe_ujian"
                                class=" dropdown dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100">
                                <option value="uts">
                                    UTS
                                </option>
                                <option value="uas">
                                    UAS
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto card-body mb-[50px]">
                    <div class="relative overflow-x-auto card-body  ">
                        <table id=""
                            class="text-center uppercase table w-full pt-4 text-gray-700 dark:text-zinc-100">
                            <thead>
                                <tr>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                        Mata Pelajaran</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                        Tipe Ujian</th>
                                    <th class="p-4 pr-8 border rtl:border-l-0  border-gray-50 dark:border-zinc-600">
                                        Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-container">
                                @foreach ($nilai as $data)
                                    <tr>
                                        <td
                                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                            {{ $data->mapels->nama_mata_pelajaran }}
                                        </td>
                                        <td
                                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                            {{ $data->tipe_ujian }}
                                        </td>
                                        <td
                                            class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                                            {{ $data->nilai }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#tipe_ujian').on('click', function() {
                let tipe_ujian = $('#tipe_ujian').val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let url = '{{ route('siswa.nilai.filter') }}';
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        'tipe_ujian': tipe_ujian,
                    },
                    success: function(response) {
                        if (response != null) {
                            if (response != null) {
                                tabel(response)
                            } else {}
                        }
                    }
                });

            })

            function tabel(data) {
                console.log(data)
                let container = document.getElementById('tabel-container')
                container.innerHTML = ''
                let row = ''
                let tipe_ujian_title = document.getElementById('tipe_ujian_title');
                tipe_ujian_title.innerHTML = data[0].tipe_ujian
                for (i = 0; i < data.length; i++) {
                    row = `
                    <tr>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].mapels.nama_mata_pelajaran}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].tipe_ujian}</td>
                        <td class="p-4 pr-8 border border-t-0 rtl:border-l-0 border-gray-50 dark:border-zinc-600">
                            ${data[i].nilai}</td>
                    </tr>
                    `;
                    container.innerHTML += row
                }
            }
        });
    </script>
@endsection
