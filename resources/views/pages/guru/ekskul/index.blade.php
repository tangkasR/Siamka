@extends('layouts.dashboard')
@section('table-name', 'Ekskul')
@section('table-role', 'Admin')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 bg-white shadow-md">
        <div class="md:col-span-8 order-last md:order-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600 min-h-screen">
                <div class="card-body border-b border-gray-100 dark:border-zinc-600">
                    <h6 class="mb-1 text-gray-600 text-[16px] font-semibold dark:text-gray-100">Silahkan pilih Ekskul untuk
                        menambah anggota</h6>
                </div>
                <div class="relative overflow-x-auto card-body ">
                    <div class="grid md:grid-cols-2 mb-3 gap-5">
                        @foreach ($ekskuls as $data)
                            <div
                                class=" relative mx-auto max-w-md rounded-lg bg-gradient-to-tr from-pink-300 to-blue-300 p-0.5 border-violet-300  hover:shadow-lg hover:shadow-violet-200 transition-all  ">
                                <a href="{{ route('guru.ekskul.daftar_anggota', ['id' => $data->id]) }}">
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
                            <h1 class="text-[20px] font-bold">Silahkan tambah ekskul -></h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="md:col-span-4 w-full p-3 md:order-2">
            <form class="space-y-4" action="{{ route('guru.ekskul.store') }}" method="POST">
                @csrf
                <div class="flex justify-between">
                    <h1 class="text-slate-600 font-semibold text-[20px]">Tambah Data Ekskul</h1>
                    <button type="button" class="
                    text-violet-600 text-[40px] " id="add_input"><i
                            class='bx bxs-plus-circle'></i></button>
                    <div id="count"
                        class="text-gray-500 absolute right-9 rounded-full z-50 text-[16px] top-15 px-2 border bg-green-50 ">
                    </div>
                </div>
                <div id="container_add" class="">

                </div>
                <input type="text" value="{{ $guru->id }}" name="guru_id" hidden>
                <button type="submit"
                    class="
                w-full
                text-white
                bg-violet-400
                hover:bg-black
                py-2
                rounded-md ">
                    Simpan
                </button>
            </form>
        </div>
    </div>


    <script>
        let index = 1;
        let container = document.getElementById('container_add');
        let count = document.getElementById('count')

        for (let i = 0; i < index; i++) {
            container.innerHTML = `
            <div>
                <label for="nama_ekskul"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                    Nama Ekskul - 1
                </label>
                <input type="text" name="nama_ekskul[]" id="nama_ekskul"
                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                    placeholder="Masukan Nama Ekskul" required>
            </div>
            `
        }
        document.getElementById('add_input').addEventListener('click', () => {
            container.innerHTML = ``;
            index++;

            for (let i = 0; i < index; i++) {
                count.innerHTML = `${i+1}`
                container.innerHTML += `
            <div class="mb-3">
                <label for="nama_ekskul"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100 ltr:text-left rtl:text-right">
                    Nama Ekskul - ${i+1}
                </label>
                <input type="text" name="nama_ekskul[]" id="nama_ekskul"
                    class="bg-gray-800/5 border border-gray-100 text-gray-900 dark:text-gray-100 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder-gray-400 dark:placeholder:text-zinc-100/60 focus:ring-0"
                    placeholder="Masukan Nama Ekskul" required>
            </div>
            `
            }

        })
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
