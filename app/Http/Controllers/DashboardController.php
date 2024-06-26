<?php

namespace App\Http\Controllers;

use App\Charts\RataRataJamChart;
use App\Charts\TotalGuruChart;
use App\Charts\TotalSiswaChart;
use App\Models\TahunAjaran;
use App\Services\AuthService;
use App\Services\DateService;
use App\Services\PengumumanService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private $auth;
    private $pengumuman;
    private $date;
    private $chart_total_siswa;
    private $chart_total_guru;
    private $chart_jam_kerja;

    public function __construct(
        AuthService $auth,
        PengumumanService $pengumuman,
        DateService $date,
        TotalSiswaChart $chart_total_siswa,
        TotalGuruChart $chart_total_guru,
        RataRataJamChart $chart_jam_kerja
    ) {
        $this->auth = $auth;
        $this->pengumuman = $pengumuman;
        $this->date = $date;
        $this->chart_total_siswa = $chart_total_siswa;
        $this->chart_total_guru = $chart_total_guru;
        $this->chart_jam_kerja = $chart_jam_kerja;
    }

    public function index(Request $req)
    {
        $user = '';
        $role = '';
        $chart_total_siswa = '';
        $chart_total_guru = '';
        $chart_jam_kerja = '';
        $pengumumans = $this->pengumuman->paginate(4);

        $year = $this->date->getDate()->year;
        $month = $this->date->getDate()->month;
        if ($month < 7) {
            $tahun_ajaran = $year - 1 . '-' . $year;
            $semester = 'genap';
        } else {
            $tahun_ajaran = $year . '-' . $year + 1;
            $semester = 'ganjil';
        }
        $checkTahunAjaran = TahunAjaran::where('tahun_ajaran', $tahun_ajaran)->where('semester', $semester)->get();
        if (count($checkTahunAjaran) == 0) {
            TahunAjaran::create([
                'tahun_ajaran' => $tahun_ajaran,
                'semester' => $semester,
            ]);
        }

        if ($this->auth->getUser('siswa')) {
            $user = $user = $this->auth->getUser('siswa');
            $role = 'siswa';

        }
        if ($this->auth->getUser('guru')) {
            $user = $user = $this->auth->getUser('guru');

            $role = 'guru';
        }
        if ($this->auth->getUser('admin')) {
            $user = $this->auth->getUser('admin');
            $role = 'admin';
            $chart_total_siswa = $this->chart_total_siswa->build();
            $chart_total_guru = $this->chart_total_guru->build();
            $chart_jam_kerja = $this->chart_jam_kerja->build();
        }
        return view('pages.main-dashboard', [
            'user' => $user,
            'role' => $role,
            'pengumumans' => $pengumumans,
            'chart_siswa' => $chart_total_siswa,
            'chart_guru' => $chart_total_guru,
            'chart_jam_kerja' => $chart_jam_kerja,
        ]);
    }
}
