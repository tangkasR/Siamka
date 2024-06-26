@extends('layouts.dashboard')
@section('table-name', 'Data Siswa')
@section('table-role', 'Admin')
@section('back')
    <div class="font-medium  border border-slate-500 bg-slate-500 text-white rounded-full  me-3">
        <a href="{{ route('tahun_ajaran.index', 'siswa') }}" class="flex justify-center items-center"><i
                class='bx bx-chevron-left text-[30px]'></i></a>
    </div>
@endsection
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card ">
                <div class="px-[30px] pt-[20px]">
                    <h1 class="text-[18px] font-medium text-gray-700 leading-5">Silahkan pilih rombongan belajar untuk
                        melihat data
                        siswa</h1>
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
                                                class="hover:scale-98  card bg-blue-50 border-blue-300 border-2  transition-all">
                                                <div class="card-body">
                                                    <h6
                                                        class="mb-3 text-slate-700 text-[25px] dark:text-gray-100 font-bold">
                                                        {{ $data->nama_rombel }}
                                                    </h6>
                                                    <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                        Silahkan pilih rombel dengan menekan tombol dibawah!
                                                    </p>
                                                    <div class="">
                                                        <a href="{{ route('admin.siswa.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $data]) }}"
                                                            class="hover:bg-blue-700
                                                            block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
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
                                                class="card hover:scale-98 duration-300 bg-blue-50 border-blue-300 border-2  transition-all">
                                                <div class="card-body">
                                                    <h6
                                                        class="mb-3 text-slate-700 text-[25px] dark:text-gray-100 font-bold">
                                                        {{ $data->nama_rombel }}
                                                    </h6>
                                                    <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                        Silahkan pilih rombel dengan menekan tombol dibawah!
                                                    </p>
                                                    <div class="">
                                                        <a href="{{ route('admin.siswa.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $data]) }}"
                                                            class="hover:bg-blue-700
                                                            block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
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
                                                class="card hover:scale-98 duration-300 bg-blue-50 border-blue-300 border-2  transition-all">
                                                <div class="card-body">
                                                    <h6
                                                        class="mb-3 text-slate-700 text-[25px] dark:text-gray-100 font-bold">
                                                        {{ $data->nama_rombel }}
                                                    </h6>
                                                    <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                        Silahkan pilih rombel dengan menekan tombol dibawah!
                                                    </p>
                                                    <div class="">
                                                        <a href="{{ route('admin.siswa.show_siswa', ['tahun' => $tahun, 'semester' => $semester, 'rombel' => $data]) }}"
                                                            class="hover:bg-blue-700
                                                            block text-center text-white border-transparent shadow btn bg-blue-500  shadow-blue-500 dark:shadow-zinc-600">
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
            centeredSlides: false,
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
            centeredSlides: false,
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
            centeredSlides: false,
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
