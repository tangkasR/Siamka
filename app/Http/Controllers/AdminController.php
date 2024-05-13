<?php

namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth()->guard('admin')->user();
        return view('pages.admin.profil', ['admin' => $admin]);
    }
}
