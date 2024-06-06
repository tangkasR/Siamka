@extends('layouts.dashboard')
@section('table-name', 'Pengumuman')
@section('table-role')
    @if ($auth->guard('siswa')->check())
        Siswa
    @endif
    @if ($auth->guard('guru')->check())
        Guru
    @endif
    @if ($auth->guard('admin')->check())
        Admin
    @endif
@endsection

@section('content')
    <div class="md:max-w-4xl max-w-2xl flex items-center h-auto lg:h-screen flex-wrap mx-auto  lg:my-0 pt-10 md:pt-6 pb-20 ">
        <div id="profile"
            class="w-full rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white md:mt-[40px] lg:mx-0 p-3">
            <div class=" md:py-6 md:px-24  lg:text-left">
                <div id="profile-photo-mobile"
                    class="block  rounded-md shadow-lg mx-auto md:min-w-[400px] md:-mt-16 md:min-h-[400px] h-[250px] w-[250px]   bg-cover bg-center z-50 border-[1px] border-slate-600"
                    style="background-image: url('{{ $pengumuman->image != '-' ? asset('storage/pengumuman/' . $pengumuman->image) : asset('assets/img/attention-default.jpg') }}')">
                </div>
                <div class="w-full flex justify-center flex-col items-center md:mt-10 mt-6 ">
                </div>
                <div class=" w-full mx-auto md:p-6 p-3">
                    <div class=" md:text-center  text-[22px] font-semibold mb-2 md:mb-3 capitalize">
                        <h1>{{ $pengumuman->judul }}</h1>
                    </div>
                    <div class="text-[16px] ">
                        {!! $pengumuman->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
