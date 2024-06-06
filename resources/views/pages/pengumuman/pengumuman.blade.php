@extends('layouts.dashboard')
@section('table-name')
    Pengumuman
@endsection
@section('table-role')
    @if ($auth->guard('siswa')->check())
        Siswa
    @endif
    @if ($auth->guard('guru')->check())
        Guru
    @endif
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="relative overflow-x-auto card-body mb-[50px]">
                    <div class="relative overflow-x-auto card-body text-center">
                        <div class="grid md:grid-cols-4 gap-4" id="container">
                            @include('pages.pengumuman.data-pengumuman')
                        </div>
                        @if (count($pengumumans) > 0)
                            <div class="mt-6" id="btn-next">
                                <button class="btn">Load More</button>
                            </div>
                        @else
                            <div class="mt-6 min-h-[40vh] flex flex-col justify-center items-center">
                                <h1 class="text-[20px] font-bold">Tidak Ada Pengumuman</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let page = 1;
            $('#btn-next').on('click', function() {
                page++;
                const container = $('#container');

                url = '{{ route('pengumuman.show_pengumuman') }}';
                $.ajax({
                    url: url + '?page=' + page,
                    type: 'get',
                    datatype: 'html'
                }).done((response) => {
                    $('#btn-next').hide()
                    if (response.html != '') {
                        $('#btn-next').show()
                        container.append(response.html)
                    }
                }).fail((jqXHR, ajaxOptions, thrownError) => {
                    alert('server not responding...');
                });
            });
        })
    </script>
@endsection
