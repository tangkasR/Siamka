<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\PengumumanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    private $auth;
    private $pengumuman;

    public function __construct(AuthService $auth, PengumumanService $pengumuman)
    {
        $this->auth = $auth;
        $this->pengumuman = $pengumuman;
    }

    public function index(Request $req)
    {
        $user = '';
        $role = '';
        $pengumumans = $this->pengumuman->paginate(4);

        if ($this->auth->getUser('siswa')) {
            if ($this->auth->getUser('siswa')->aktivasi_akun == 'tidak aktif') {
                $this->auth->logout();
                $req->session()->invalidate();
                $req->session()->regenerateToken();
                Session::flash('status', 'failed');
                Session::flash('message', 'Akun anda belum di aktivasi oleh Admin!');
                return redirect('/');
            }

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
        }
        return view('pages.main-dashboard', [
            'user' => $user,
            'role' => $role,
            'pengumumans' => $pengumumans,
        ]);
    }
}
