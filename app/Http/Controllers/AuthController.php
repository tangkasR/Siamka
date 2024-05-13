<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function auth(Request $req)
    {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $req->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        if (Auth::guard('siswa')->attempt($credentials)) {
            $req->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        if (Auth::guard('guru')->attempt($credentials)) {
            $req->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Email atau Password salah!');
        return redirect('/');
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/');
    }
}
