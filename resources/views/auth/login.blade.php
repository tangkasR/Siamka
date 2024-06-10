<!DOCTYPE html>
<html lang="en">

<head>
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
    <style>
        .Section_top {
            width: 100%;
            height: 100%;
            background-image: url(asset('assets/bg-login/bg-login-1.jpg'));
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            animation: change 10s infinite ease-in-out;
        }

        @media only screen and (max-width: 600px) {
            .Section_top {
                animation: none;
            }
        }

        @keyframes change {
            0% {
                background-image: url({{ asset('assets/bg-login/bg-login-1.jpg') }});
            }

            25% {
                background-image: url({{ asset('assets/bg-login/bg-login-3.jpg') }});
            }

            50% {
                background-image: url({{ asset('assets/bg-login/bg-login-4.jpg') }});
            }

            75% {
                background-image: url({{ asset('assets/bg-login/bg-login-5.jpg') }});
            }

            100% {
                background-image: url({{ asset('assets/bg-login/bg-login-1.jpg') }});
            }
        }
    </style>

    @vite('resources/css/app.css')

    <script>
        window.addEventListener("load", (event) => {
            const loader = document.getElementById('loader')
            const container = document.getElementById('container')
            loader.classList.add('hidden')
            container.classList.remove('hidden')
            container.classList.add('flex')
        });
    </script>
</head>

<body>
    <div class="min-h-[100vh] flex justify-center items-center" id="loader">
        <img src="{{ asset('loader.gif') }}" class="w-[300px]" alt="">
    </div>
    <div class="items-center justify-center min-h-screen w-full hidden md:p-0 p-6 bg-gradient-to-r from-blue-500 to-blue-100 md:bg-none Section_top"
        id="container">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-12 sm:skew-y-0 sm:-rotate-6 rotate-0 sm:rounded-3xl rounded-md"
                id="bg-blue">
            </div>
            <div class="relative md:py-10 md:px-14 p-6 bg-white shadow-lg sm:rounded-3xl rounded-md">
                <div class="max-w-md mx-auto">

                    <form class="" action="login" method="POST">
                        @csrf
                        <div class="mb-2 w-full flex justify-center items-center flex-col">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo"
                                class="mb-4 md:max-w-[150px] max-w-[100px]">
                            <h3 class="md:text-[30px] text-[24px] font-bold text-gray-700 text-center">SMK KARTEK 2
                                JATILAWANG</h3>
                        </div>
                        <div class="mb-4 text-center">
                            <h3 class="text-[18px] font-semibold text-gray-500">Sistem Informasi Akademik Siswa</h3>
                        </div>
                        <div class="mb-2">
                            @if (Session::has('status'))
                                <div class="p-6 border-l-4 border-red-500 -6 rounded-r-xl bg-red-50">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-red-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm text-red-600">
                                                <p>{{ Session::get('message') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="username" id="floating_email"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Email</label>
                            </div>
                        </div>
                        <div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="password" name="password" id="floating_password"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="floating_password"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                            </div>
                        </div>
                        {{-- <div class="flex items-center justify-between gap-2 mt-6">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox"
                                        class="h-4 w-4 shrink-0 border-gray-300 rounded" />
                                    <label for="remember-me" class="ml-3 block text-sm">
                                        Remember me
                                    </label>
                                </div>
                                <div>
                                    <a href="jajvascript:void(0);" class="text-sm font-semibold hover:underline">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div> --}}
                        <div class="mt-10">
                            <button type="sumbit"
                                class=" w-full py-2.5 px-4 text-sm font-semibold rounded-full text-white bg-[#333] hover:bg-[#222] focus:outline-none">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
