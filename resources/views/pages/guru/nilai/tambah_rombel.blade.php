@extends('layouts.dashboard')
@section('table-name', 'Tambah Data Rombel')
@section('table-role', 'Guru')
@section('content')
    <div class="grid grid-cols-12 gap-6 bg-white shadow-md">
        <div class="col-span-12">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <form action="{{ route('guru.store_rombel') }}" method="POST">
                    @csrf
                    <div class="px-[30px] pt-[20px] flex justify-between items-center flex-wrap">
                        <div class="md:mb-0 mb-3">
                            <h1 class="text-[18px] font-medium text-gray-800 leading-5">Silakan pilih rombongan belajar yang
                                Anda ampu
                            </h1>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full bg-violet-500 hover:bg-violet-700 text-white font-medium py-2 px-10 rounded-md">
                                Simpan
                            </button>
                        </div>
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
                                                    class=" card dark:bg-zinc-800 dark:border-zinc-600 bg-blue-50 border-blue-300 border-2 hover:border-violet-300 hover:border-2 hover:shadow-lg hover:shadow-violet-300 transition-all">
                                                    <div class="card-body">
                                                        <input type="checkbox" name="rombel_ids[]"
                                                            value="{{ $data->id }}"
                                                            class="mb-6 w-[20px] h-[20px] text-[20px]"
                                                            id="rombel_{{ $loop->iteration }}" hidden>
                                                        <h6
                                                            class="mb-6 text-slate-700 text-[30px] dark:text-gray-100 font-bold">
                                                            {{ $data->nama_rombel }}
                                                        </h6>
                                                        <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                            Silahkan pilih rombel dengan menekan tombol dibawah!
                                                        </p>
                                                        <div class="flex items-center">
                                                            <label for="rombel_{{ $loop->iteration }}"
                                                                class="text-center cursor-pointer w-full bg-violet-500 hover:bg-violet-700 text-white font-normal py-2 px-4 rounded-md">Pilih</label>
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
                                                    class=" card dark:bg-zinc-800 dark:border-zinc-600 bg-blue-50 border-blue-300 border-2 hover:border-violet-300 hover:border-2 hover:shadow-lg hover:shadow-violet-300 transition-all">
                                                    <div class="card-body">
                                                        <input type="checkbox" name="rombel_ids[]"
                                                            value="{{ $data->id }}"
                                                            class="mb-6 w-[20px] h-[20px] text-[20px]"
                                                            id="rombel_{{ $loop->iteration }}">
                                                        <h6
                                                            class="mb-6 text-slate-700 text-[30px] dark:text-gray-100 font-bold">
                                                            {{ $data->nama_rombel }}
                                                        </h6>
                                                        <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                            Silahkan pilih rombel dengan menekan tombol dibawah!
                                                        </p>
                                                        <div class="flex items-center">
                                                            <label for="rombel_{{ $loop->iteration }}"
                                                                class="text-center cursor-pointer w-full bg-violet-500 hover:bg-violet-700 text-white font-normal py-2 px-4 rounded-md">Pilih</label>
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
                                                    class=" card dark:bg-zinc-800 dark:border-zinc-600 bg-blue-50 border-blue-300 border-2 hover:border-violet-300 hover:border-2 hover:shadow-lg hover:shadow-violet-300 transition-all ">
                                                    <div class="card-body">
                                                        <input type="checkbox" name="rombel_ids[]"
                                                            value="{{ $data->id }}"
                                                            class="mb-6 w-[20px] h-[20px] text-[20px]"
                                                            id="rombel_{{ $loop->iteration }}">
                                                        <h6
                                                            class="mb-6 text-slate-700 text-[30px] dark:text-gray-100 font-bold">
                                                            {{ $data->nama_rombel }}
                                                        </h6>
                                                        <p class="text-slate-600 card-text dark:text-zinc-100 mb-2">
                                                            Silahkan pilih rombel dengan menekan tombol dibawah!
                                                        </p>
                                                        <div class="flex items-center">
                                                            <label for="rombel_{{ $loop->iteration }}"
                                                                class="text-center cursor-pointer w-full bg-violet-500 hover:bg-violet-700 text-white font-normal py-2 px-4 rounded-md">Pilih</label>
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
                </form>
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
