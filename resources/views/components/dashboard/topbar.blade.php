<nav
    class="fixed top-0 left-0 right-0 z-50 flex items-center bg-slate-50  dark:bg-zinc-800 print:hidden dark:border-zinc-700 ltr:pr-6 rtl:pl-6">

    <div class="flex justify-between w-full">
        <div class="flex items-center topbar-brand">
            <div
                class="hidden lg:flex navbar-brand items-center justify-between shrink px-6 h-[70px]  ltr:border-r rtl:border-l bg-[#fbfaff] border-gray-50 dark:border-zinc-700 dark:bg-zinc-800 shadow-none">
                <a href="#"
                    class="flex items-center text-lg flex-shrink-0 font-bold dark:text-white leading-[69px]">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo"
                        class="inline-block w-12 align-middle ltr:xl:mr-2 rtl:xl:ml-2">
                    <span
                        class="hidden font-semibold text-gray-700 align-middle xl:block dark:text-gray-100 leading-5 ms-3 text-[16px]">SMK
                        Kartek 2 <br> Jatilawang</span>
                </a>
            </div>
            <button type="button"
                class="group-data-[sidebar-size=sm]:border-b border-b border-[#e9e9ef] dark:border-zinc-600 dark:lg:border-transparent lg:border-transparent  group-data-[sidebar-size=sm]:border-[#e9e9ef] group-data-[sidebar-size=sm]:dark:border-zinc-600 text-gray-800 dark:text-white h-[70px] px-4 ltr:-ml-[52px] rtl:-mr-14 py-1 vertical-menu-btn text-16"
                id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>
        <div
            class=" flex justify-between w-full items-center border-b border-[#e9e9ef] dark:border-zinc-600 ltr:pl-6 rtl:pr-6">
            <div></div>
            <div class="">
                <div class="">
                    <div class="relative dropdown">
                        @if (auth()->guard('admin')->check())
                            <button type="button"
                                class="flex items-center px-3 py-2 h-[70px] border-x border-gray-50 bg-gray-50/30  dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
                                id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="true">
                                <i class='bx bxs-user text-[30px] mr-2'></i>
                                <span
                                    class="hidden font-medium xl:block">{{ auth()->guard('admin')->user()->nama }}</span>
                                <i class="hidden align-bottom mdi mdi-chevron-down xl:block"></i>
                            </button>
                            <div class="absolute top-0 z-50 hidden w-36 list-none bg-white dropdown-menu dropdown-animation rounded shadow  dark:bg-zinc-800"
                                id="profile/log">
                                <div class="border border-gray-50 dark:border-zinc-600"
                                    aria-labelledby="navNotifications">
                                    <div class="dropdown-item dark:text-gray-100">
                                        <a class="block px-3 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50"
                                            href="{{ route('admin.profil') }}">
                                            <i class="mr-1 align-middle mdi mdi-face-man text-16"></i> Profile
                                        </a>
                                    </div>
                                    <hr class="border-gray-50 dark:border-gray-700">
                                    <div class="dropdown-item dark:text-gray-100">
                                        <a class="block p-3 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50"
                                            href="/logout">
                                            <i class="mr-1 align-middle mdi mdi-logout text-16"></i> Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (auth()->guard('guru')->check())
                            <button type="button"
                                class="w-full md:max-w-[150px] md:min-w-[150px] flex items-center px-3  py-4 h-[70px] border-x border-gray-50 bg-gray-50/30  dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
                                id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="true">
                                <img src="{{ auth()->guard('guru')->user()->profil != '-' ? asset('storage/' . auth()->guard('guru')->user()->profil) : asset('assets/img/profil-default.jpg') }}"
                                    alt="Logo"
                                    class="inline-block md:w-[70px] md:h-12 w-10 h-10 me-3 rounded-full border border-black">
                                <div class="truncate">
                                    <span
                                        class="hidden font-medium xl:block">{{ auth()->guard('guru')->user()->nama }}</span>
                                    <span class="mt-1 hidden text-[12px] xl:block">Guru</span>
                                </div>
                                <i class="hidden align-bottom mdi mdi-chevron-down xl:block"></i>
                            </button>
                            <div class="md:w-[175px] absolute top-0 right-0 z-50 hidden  list-none bg-white dropdown-menu dropdown-animation rounded shadow  dark:bg-zinc-800"
                                id="profile/log">
                                <div class="border border-gray-50 dark:border-zinc-600"
                                    aria-labelledby="navNotifications">
                                    <div class="dropdown-item dark:text-gray-100">
                                        <a class="block px-3 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50"
                                            href="{{ route('guru.profil') }}">
                                            <i class="mr-1 align-middle mdi mdi-face-man text-16"></i> Profile
                                        </a>
                                    </div>
                                    <hr class="border-gray-50 dark:border-gray-700">
                                    <div class="dropdown-item dark:text-gray-100">
                                        <a class="block p-3 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50"
                                            href="/logout">
                                            <i class="mr-1 align-middle mdi mdi-logout text-16"></i> Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (auth()->guard('siswa')->check())
                            <button type="button"
                                class=" w-full md:max-w-[150px] flex items-center px-3 py-4 h-[70px] border-x border-gray-50 bg-gray-50/30  dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
                                id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="true">
                                <img src="{{ auth()->guard('siswa')->user()->profil != '-' ? asset('storage/' . auth()->guard('siswa')->user()->profil) : asset('assets/img/profil-default.jpg') }}"
                                    alt="Logo"
                                    class="inline-block  md:w-[70px] md:h-12 w-10 h-10 me-3 rounded-full border border-black">
                                <div class="truncate">
                                    <span
                                        class="hidden font-medium xl:block ">{{ auth()->guard('siswa')->user()->nama }}</span>
                                    <span class="mt-1 hidden text-[12px] xl:block">Siswa</span>
                                </div>
                                {{-- <span
                                    class="hidden font-medium xl:block truncate ">{{ auth()->guard('siswa')->user()->nama }}</span> --}}
                                <i class="hidden align-bottom mdi mdi-chevron-down xl:block"></i>
                            </button>
                            <div class="absolute top-0 z-50 hidden md:w-[175px] list-none bg-white dropdown-menu dropdown-animation rounded shadow  dark:bg-zinc-800"
                                id="profile/log">
                                <div class="border border-gray-50 dark:border-zinc-600"
                                    aria-labelledby="navNotifications">
                                    <div class="dropdown-item dark:text-gray-100">
                                        <a class="block px-3 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50"
                                            href="{{ route('siswa.profil') }}">
                                            <i class="mr-1 align-middle mdi mdi-face-man text-16"></i> Profile
                                        </a>
                                    </div>
                                    <hr class="border-gray-50 dark:border-gray-700">
                                    <div class="dropdown-item dark:text-gray-100">
                                        <a class="block p-3 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50"
                                            href="/logout">
                                            <i class="mr-1 align-middle mdi mdi-logout text-16"></i> Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
