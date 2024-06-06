@extends('layouts.dashboard')
@section('table-name', 'Data Jadwal Pelajaran')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="px-[30px] pt-[20px]">
                    <h1 class="text-[20px] font-semibold text-gray-700">Daftar Rombongan Belajar</h1>
                </div>
                <hr class="text-[2px] my-[20px] text-black w-full" />
                <div class="relative overflow-x-auto card-body mb-[50px] h-[100%]">
                    {{-- Data Kelas X --}}
                    <div class="grid grid-cols-1 mb-10">
                        <div class="swiper mySwiper1">
                            <div class="swiper-wrapper">
                                @foreach ($rombel as $data)
                                    @if (explode(' ', $data->nama_rombel)[0] == 'X')
                                        <div class="swiper-slide">
                                            <div
                                                class="card dark:bg-zinc-800 dark:border-zinc-600   bg-blue-50 border-blue-300 border-2 hover:border-violet-300  hover:border-2 hover:shadow-lg hover:shadow-violet-300 transition-all">
                                                <div class="card-body  ">
                                                    <i class='mb-6 bx bxs-calendar text-[30px] text-gray-600'></i>
                                                    <h6
                                                        class="mb-6 text-slate-700 text-[30px] dark:text-gray-100 font-bold">
                                                        {{ $data->nama_rombel }}
                                                    </h6>
                                                    <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                        Silahkan pilih rombel dengan menekan tombol dibawah!
                                                    </p>
                                                    <div class="">
                                                        <a href="{{ route('admin.jadwal_pelajaran.show_jadwal', ['id' => $data->id]) }}"
                                                            class="hover:bg-violet-700
                                                            block text-center text-white border-transparent shadow btn bg-violet-300  shadow-violet-300 dark:shadow-zinc-600">
                                                            Pilih
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-3 mx-auto">
                            <div class="swiper-pagination1 "></div>
                        </div>
                    </div>
                    {{-- End Data Kelas X --}}
                    {{-- Data Kelas XI --}}
                    <div class="grid grid-cols-1 mb-10">
                        <div class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                @foreach ($rombel as $data)
                                    @if (explode(' ', $data->nama_rombel)[0] == 'XI')
                                        <div class="swiper-slide">
                                            <div
                                                class="card dark:bg-zinc-800 dark:border-zinc-600   bg-blue-50 border-blue-300 border-2 hover:border-violet-300  hover:border-2 hover:shadow-lg hover:shadow-violet-300 transition-all">
                                                <div class="card-body  ">
                                                    <i class='mb-6 bx bxs-calendar text-[30px] text-gray-600'></i>
                                                    <h6
                                                        class="mb-6 text-slate-700 text-[30px] dark:text-gray-100 font-bold">
                                                        {{ $data->nama_rombel }}
                                                    </h6>
                                                    <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                        Silahkan pilih rombel dengan menekan tombol dibawah!
                                                    </p>
                                                    <div class="">
                                                        <a href="{{ route('admin.jadwal_pelajaran.show_jadwal', ['id' => $data->id]) }}"
                                                            class="hover:bg-violet-700
                                                            block text-center text-white border-transparent shadow btn bg-violet-300  shadow-violet-300 dark:shadow-zinc-600">
                                                            Pilih
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-3 mx-auto">
                            <div class="swiper-pagination2 "></div>
                        </div>
                    </div>
                    {{-- End Data Kelas XI --}}
                    {{-- Data Kelas XII --}}
                    <div class="grid grid-cols-1 mb-10">
                        <div class="swiper mySwiper3">
                            <div class="swiper-wrapper">
                                @foreach ($rombel as $data)
                                    @if (explode(' ', $data->nama_rombel)[0] == 'XII')
                                        <div class="swiper-slide">
                                            <div
                                                class="card dark:bg-zinc-800 dark:border-zinc-600   bg-blue-50 border-blue-300 border-2 hover:border-violet-300  hover:border-2 hover:shadow-lg hover:shadow-violet-300 transition-all">
                                                <div class="card-body  ">
                                                    <i class='mb-6 bx bxs-calendar text-[30px] text-gray-600'></i>
                                                    <h6
                                                        class="mb-6 text-slate-700 text-[30px] dark:text-gray-100 font-bold">
                                                        {{ $data->nama_rombel }}
                                                    </h6>
                                                    <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                        Silahkan pilih rombel dengan menekan tombol dibawah!
                                                    </p>
                                                    <div class="">
                                                        <a href="{{ route('admin.jadwal_pelajaran.show_jadwal', ['id' => $data->id]) }}"
                                                            class="hover:bg-violet-700
                                                            block text-center text-white border-transparent shadow btn bg-violet-300  shadow-violet-300 dark:shadow-zinc-600">
                                                            Pilih
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-3 mx-auto">
                            <div class="swiper-pagination3 "></div>
                        </div>
                    </div>
                    {{-- End Data Kelas XII --}}

                </div>
            </div>
        </div>
    </div>



    <!-- Initialize Swiper -->
    <script type="module">
        var swiper = new Swiper(".mySwiper1", {
            initialSlide: 1,
            centeredSlides: true,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination1",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },
        });
        var swiper = new Swiper(".mySwiper2", {
            initialSlide: 1,
            centeredSlides: true,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination2",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },
        });
        var swiper = new Swiper(".mySwiper3", {
            initialSlide: 1,
            centeredSlides: true,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination3",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },
        });
    </script>
@endsection
