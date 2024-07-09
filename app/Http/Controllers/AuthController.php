<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $req)
    {
        $credentials = $req->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if ($this->auth->checkLogin('admin', $credentials)) {
            $req->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        if ($this->auth->checkLogin('siswa', $credentials)) {
            $req->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        if ($this->auth->checkLogin('guru', $credentials)) {
            $req->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        Session::flash('status', 'failed');
        Session::flash('message1', 'Username atau Password salah!');
        Session::flash('message2', 'Konfirmasi ke Admin jika username dan password sudah benar!');
        return redirect('/');
    }

    public function logout(Request $req)
    {
        $this->auth->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/');
    }
}
