@extends('layouts.dashboard')
@section('table-name', 'Profil')
@section('table-role', 'Admin')
@section('content')
    <div class="max-w-2xl flex items-center h-auto lg:h-screen flex-wrap mx-auto md:my-32 lg:my-0 py-10">
        <!--Main Col-->
        <div id="profile"
            class="w-full rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white mx-6 mt-[40px] lg:mx-0">
            <div class="p-4 md:p-12 lg:text-left">
                <!-- Image for mobile view-->
                <div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-[100px] h-48 w-48 bg-cover bg-center"
                    style="background-image: url('{{ asset('assets/img/profil-default.jpg') }}')"></div>
                <div class="w-full flex flex-col justify-center items-center mt-10">
                    <div class="w-fit">
                        <h1 class="text-3xl font-bold pt-8 lg:pt-0 capitalize">{{ $admin->nama }}</h1>
                        <div class="mx-auto lg:mx-0 w-full pt-3 border-b-2 border-violet-500 opacity-25"></div>
                    </div>
                </div>
                <div class="mt-8 max-w-96 mx-auto p-6">
                    <div class="mb-3 grid grid-cols-2 gap-1">
                        <p class="text-[18px] font-semibold text-gray-600">Username</p>
                        <p class="text-[14px] text-gray-600">{{ $admin->username }}</p>
                    </div>
                    <div class="mx-auto lg:mx-0 w-full mb-5 border-b-[1px] border-violet-500 opacity-25"></div>
                </div>
            </div>
        </div>



    </div>
@endsection
