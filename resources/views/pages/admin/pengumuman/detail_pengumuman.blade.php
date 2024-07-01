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
    <div class="grid md:grid-cols-12 md:gap-10 bg-white p-6 border shadow-md ">
        <img class="w-full rounded-xl md:col-span-4"
            src="{{ $pengumuman->image != '-' ? asset('storage/' . $pengumuman->image) : asset('assets/img/attention-default.jpg') }}"
            alt="">
        <div class="md:col-span-8 md:mt-0 mt-6">
            <div class=" md:text-center  text-[22px] font-semibold mb-2 md:mb-3 capitalize">
                <h1 class="leading-8">{{ $pengumuman->judul }}</h1>
            </div>
            <div class="text-[16px]">
                {!! $pengumuman->deskripsi !!}
            </div>
        </div>
    </div>
@endsection
