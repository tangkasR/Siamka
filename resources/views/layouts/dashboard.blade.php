<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <script>
        window.addEventListener("load", (event) => {
            const loader = document.getElementById('loader')
            const container = document.getElementById('container')
            loader.classList.add('hidden')
            container.classList.remove('hidden')
        });
    </script>
    <!-- Web Application Manifest -->
    <link rel="manifest" href="/manifest.json">
    <!-- Chrome for Android theme color -->
    <meta name="theme-color" content="#36b5ff">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="PWA">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#36b5ff">
    <meta name="apple-mobile-web-app-title" content="PWA">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/logo.png') }}">

    <link href="/images/icons/splash-screen.png"
        media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-screen.png"
        media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-screen.png"
        media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)"
        rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-screen.png"
        media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)"
        rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-screen.png"
        media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-screen.png"
        media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)"
        rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-screen.png"
        media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-screen.png"
        media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-screen.png"
        media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image" />
    <link href="/images/icons/splash-screen.png"
        media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image" />

    <!-- Tile for Win8 -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/logo.png') }}">


    <meta charset="utf-8">
    <title>Sistem Informasi Akademik Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="SMK Kartek 2 Jatilawang" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}">

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('assets/minia/assets/css/tailwind2.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- toaster --}}
    <link rel="stylesheet" href="{{ asset('assets/toast/jquery.toast.min.css') }}">

    <style>
        .card {
            margin-bottom: 0 !important;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            border-radius: 5px !important;
        }

        #datatable_length {
            margin-bottom: 20px !important
        }

        #dataTables_filter {
            margin-bottom: 20px !important
        }

        #datatable_paginate {
            margin-top: 20px !important
        }

        .dataTables_empty {
            visibility: hidden
        }

        #datatable_info {
            visibility: hidden
        }

        .note-modal-backdrop {
            visibility: hidden;
        }

        .note-editor {
            background-color: white;
            color: black;
        }

        .note-editable {
            background-color: white;
            color: black;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-pagination-bullet {
            width: 8px !important;
            height: 8px !important;
        }

        #map {
            height: 200px;
            width: 100%;
            max-width: none;
            max-height: none
        }
    </style>
    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/toast/toast.js') }}"></script>


    {{-- summoner note --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    {{-- excel --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    {{-- year picker --}}
    <link rel="stylesheet" href="{{ asset('assets/year_picker/yearpicker.css') }}">
    <script src="{{ asset('assets/year_picker/yearpicker.js') }}"></script>
</head>

<body data-mode="light" data-sidebar-size="lg" class="group">
    <x-dashboard.sidebar></x-dashboard>
        <x-dashboard.topbar></x-dashboard>
            <div class="page-content dark:bg-zinc-700 bg-zinc-50">
                <div class="main-content group-data-[sidebar-size=sm]:ml-[70px] ">
                    <div class="min-h-screen">

                        <div
                            class="grid grid-cols-1 p-6  bg-white mb-3  shadow-sm rounded-md border-[0.5px] border-gray-50">
                            <div class="md:flex items-center justify-between px-[2px]">
                                <h4 class="text-[25px] font-medium text-gray-800 mb-sm-0 grow dark:text-gray-100 mb-2 md:mb-0"
                                    style="line-height: 32px">
                                    @yield('table-name')</h4>
                                <nav class="flex" aria-label="Breadcrumb">
                                    <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                                        <li class="inline-flex items-center">
                                            <a href="#"
                                                class="inline-flex items-center text-sm text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                                @yield('table-role')</h4>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="flex items-center rtl:mr-2">
                                                <i
                                                    class="font-semibold text-gray-600 align-middle far fa-angle-right text-13 rtl:rotate-180 dark:text-zinc-100"></i>
                                                <p
                                                    class="text-sm font-medium text-gray-500 ltr:ml-2 rtl:mr-2 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">
                                                    @yield('table-name')</h4>
                                                </p>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                        <div class="min-h-[60vh] flex justify-center items-center" id="loader">
                            <img src="{{ asset('loader.gif') }}" class="md:w-[300px] w-[150px]" alt="">
                        </div>
                        <div class=" hidden" id="container">
                            @yield('content')
                        </div>

                    </div>
                    <x-dashboard.footer></x-dashboard>
                </div>
            </div>


            <script src="{{ asset('assets/minia/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/feather-icons/feather.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/metismenujs/metismenujs.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/simplebar/simplebar.min.js') }}"></script>




            <!-- dashboard init -->
            <script src="{{ asset('assets/minia/assets/js/pages/dashboard.init.js') }}"></script>

            <script src="{{ asset('assets/minia/assets/js/pages/nav&tabs.js') }}"></script>

            <script src="{{ asset('assets/minia/assets/js/pages/login.init.js') }}"></script>

            <script src="{{ asset('assets/minia/assets/js/app.js') }}"></script>

            {{-- datatables --}}
            <!-- Required datatable js -->
            <script src="{{ asset('assets/minia/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
            <!-- Buttons examples -->
            <script src="{{ asset('assets/minia/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/jszip/jszip.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

            <!-- Responsive examples -->
            <script src="{{ asset('assets/minia/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
            </script>
            </script>
            <script src="{{ asset('assets/minia/assets/js/pages/datatables.init.js') }}"></script>



            {{-- jquery toast --}}
            <script type="text/javascript" src="{{ asset('assets/toast/jquery.toast.min.js') }}"></script>

            <script src="{{ asset('assets/filter/filter.js') }}"></script>
</body>

</html>
