@extends('layouts.dashboard')
@section('table-name', 'Data Nilai Ekskul')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-1 gap-5 bg-white shadow-md">
        <div class="order-last md:order-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 min-h-screen">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <h6 class="mb-1 text-gray-600 text-[20px] font-semibold dark:text-gray-100">Pilih Ekskul</h6>
                </div>
                <div class="relative overflow-x-auto card-body ">
                    <div class="grid md:grid-cols-3 mb-3 gap-5">
                        @foreach ($ekskuls as $data)
                            <div
                                class=" relative mx-auto max-w-md rounded-lg bg-gradient-to-tr from-pink-300 to-blue-300 p-0.5 border-violet-300  hover:shadow-lg hover:shadow-violet-200 transition-all  ">
                                <a href="{{ route('guru.nilai_ekskul', ['ekskul_id' => $data->id]) }}">
                                    <div class="bg-white p-7 rounded-md">
                                        <span
                                            class=" p-6 flex mb-3 justify-center items-center w-1/2 place-items-center rounded-full  duration-300 text-white"
                                            style="background-color: rgb(199, 182, 252)">
                                            <img src="{{ asset('assets/img/img-ekskul.png') }}" alt="">
                                        </span>
                                        <h1 class="font-bold text-[28px] mb-1  capitalize">{{ $data->nama_ekskul }}</h1>
                                        <p class="mb-3 text-[18px] font-medium">Pembina Ekskul: {{ $data->gurus->nama }}</p>
                                        <p>Silahkan ubah, hapus, atau tambah anggota ekskul
                                            <span class="capitalize">{{ $data->nama_ekskul }}</span> dengan
                                            menekan kotak ini.
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if (count($ekskuls) == 0)
                        <div class="w-full mt-6 min-h-[40vh] flex flex-col justify-center items-center">
                            <h1 class="text-[20px] font-bold">Silahkan tambah ekskul <a href="{{ route('guru.ekskul') }}"
                                    class="text-blue-600">disini</a></h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script>
        var swiper = new Swiper(".mySwiper4", {
            centeredSlides: true,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination4",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
            },
        });
    </script>



    @if (session('message'))
        <script>
            toast('message', '{{ Session::get('message') }}')
        </script>
    @endif
    @if (session('error'))
        <script>
            toast('error', '{{ Session::get('error') }}')
        </script>
    @endif
@endsection
