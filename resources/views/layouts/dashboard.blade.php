<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">
    <title>Dashboard | Minia - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Tailwind Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/minia/assets/images/favicon.ico') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/minia/assets/libs/swiper/swiper-bundle.min.css') }}">



    {{-- toaster --}}
    <link rel="stylesheet" href="{{ asset('assets/toast/jquery.toast.min.css') }}">

    @vite('resources/css/app.css')

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('assets/minia/assets/css/tailwind2.css') }}">

    <style>
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
    </style>


</head>

<body data-mode="light" data-sidebar-size="lg" class="group">

    <x-dashboard.sidebar></x-dashboard>

        <x-dashboard.topbar></x-dashboard>
            <div class="page-content dark:bg-zinc-700">
                <div class="main-content group-data-[sidebar-size=sm]:ml-[70px] ">
                    <div class="min-h-screen">
                        @if (!auth()->guard('siswa')->check())
                            <div class="grid grid-cols-1 pb-6 ">
                                <div class="md:flex items-center justify-between px-[2px]">
                                    <h4
                                        class="text-[30px] font-medium text-gray-800 mb-sm-0 grow dark:text-gray-100 mb-2 md:mb-0">
                                        @yield('table-name')</h4>
                                    <nav class="flex" aria-label="Breadcrumb">
                                        <ol
                                            class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
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
                        @endif
                        @yield('content')
                    </div>
                    <x-dashboard.footer></x-dashboard>
                </div>
            </div>




            <script src="{{ asset('assets/minia/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/feather-icons/feather.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/metismenujs/metismenujs.min.js') }}"></script>
            <script src="{{ asset('assets/minia/assets/libs/simplebar/simplebar.min.js') }}"></script>


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <!-- apexcharts -->
            <script src="{{ asset('assets/minia/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
            <!-- Plugins js-->
            <script src="{{ asset('assets/minia/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
            </script>
            <script
                src="{{ asset('assets/minia/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
            </script>

            <script src="{{ asset('assets/minia/assets/libs/swiper/swiper-bundle.min.js') }}"></script>


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
            <script src="{{ asset('assets/minia/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
            </script>
            <script src="{{ asset('assets/minia/assets/js/pages/datatables.init.js') }}"></script>

            {{-- export excel --}}
            <script type="text/javascript" src="{{ asset('assets/table_to_excel/tableToExcel.js') }}"></script>




            {{--  toaster --}}
            <script src="{{ asset('assets/toast/jquery.toast.min.js') }}"></script>



</body>

</html>
