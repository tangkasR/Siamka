<!-- ========== Left Sidebar Start ========== -->
<div
    class="fixed bottom-0 z-50 h-screen ltr:border-r rtl:border-l vertical-menu rtl:right-0 ltr:left-0 top-[70px] bg-slate-50 border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700 overflow-y-auto">

    <div data-simplebar class="h-full">
        <!--- Sidemenu -->
        <div class="metismenu pb-10 pt-2.5" id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul id="side-menu">
                <li class="px-5 py-3 text-xs font-medium text-gray-500 cursor-default leading-[18px] group-data-[sidebar-size=sm]:hidden block"
                    data-key="t-menu">Menu</li>

                <li>
                    <a href="/dashboard"
                        class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i class='bx bxs-dashboard'></i>
                        <span data-key="t-dashboard"> Dashboard</span>
                    </a>
                </li>
                @if (auth()->guard('admin')->check())
                    <li>
                        <a href="{{ route('admin.ruangan') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-home-alt'></i>
                            <span data-key="t-dashboard"> Ruangan </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sesi') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-time-five'></i>
                            <span data-key="t-dashboard"> Sesi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.mapel') }} "
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-book-content'></i>
                            <span data-key="t-dashboard"> Mata Pelajaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tahun_ajaran.index', 'guru') }} "
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bxs-user'></i>
                            <span data-key="t-dashboard"> Data Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tahun_ajaran.index', 'rombel') }}  "
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-group'></i>
                            <span data-key="t-dashboard"> Data Rombel</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pengumuman') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bxs-user-voice'></i>
                            <span data-key="t-dashboard"> Pengumuman </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tahun_ajaran.index', 'admin_nilai') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bxs-report'></i>
                            <span data-key="t-dashboard"> Data Nilai</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tahun_ajaran.index', 'admin_kehadiran') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-calendar-alt'></i>
                            <span data-key="t-dashboard"> Data Kehadiran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tahun_ajaran.index', 'admin_ekskul') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-walk'></i>
                            <span data-key="t-dashboard"> Data Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.siswa.siswa_not_active') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bxs-user'></i>
                            <span data-key="t-dashboard"> Data Siswa Lulus / Keluar</span>
                        </a>
                    </li>
                @endif

                @if (auth()->guard('guru')->check())
                    <li>
                        <a href="{{ route('tahun_ajaran.index', 'kehadiran') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-calendar-alt'></i>
                            <span data-key="t-dashboard"> Kehadiran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tahun_ajaran.index', 'ekskul') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-walk'></i>
                            <span data-key="t-dashboard"> Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear nav-menu hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bxs-report'></i>
                            <span data-key="t-charts">Nilai</span>
                        </a>
                        <ul class="mm-collapse">
                            <li>
                                <a href="{{ route('tahun_ajaran.index', 'nilai') }}"
                                    class="block py-[6.4px] pr-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear pl-[52.8px] hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Nilai
                                    Mata Pelajaran</a>
                            </li>
                            <li>
                                <a href="{{ route('tahun_ajaran.index', 'nilai_ekskul') }}"
                                    class="block py-[6.4px] pr-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear pl-[52.8px] hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Nilai
                                    Ekstrakurikuler</a>
                            </li>
                        </ul>

                    </li>
                    <li>
                        <a href="{{ route('pengumuman.show_pengumuman') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bxs-user-voice'></i>
                            <span data-key="t-dashboard"> Pengumuman</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guru.kehadiran_guru') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-check-double'></i>
                            <span data-key="t-dashboard"> Absen</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tahun_ajaran.index', 'wali_kelas') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-group'></i>
                            <span data-key="t-dashboard">Wali Kelas</span>
                        </a>
                    </li>
                @endif
                @if (auth()->guard('siswa')->check())
                    <li>
                        <a href="{{ route('siswa.show_jadwal') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bxs-spreadsheet'></i>
                            <span data-key="t-dashboard"> Jadwal Pelajaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.show_kehadiran') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-calendar-alt'></i>
                            <span data-key="t-dashboard"> Kehadiran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.show_nilai') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bxs-report'></i>
                            <span data-key="t-dashboard"> Nilai</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.ekskul') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bx-walk'></i>
                            <span data-key="t-dashboard"> Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengumuman.show_pengumuman') }}"
                            class="block py-2.5 px-6 text-sm font-medium text-gray-950 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i class='bx bxs-user-voice'></i>
                            <span data-key="t-dashboard"> Pengumuman</span>
                        </a>
                    </li>
                @endif
            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
