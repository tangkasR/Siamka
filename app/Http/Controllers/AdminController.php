<?php

namespace App\Http\Controllers;

use App\Services\AuthService;

class AdminController extends Controller
{
    private $auth;
    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }
    public function index()
    {
        return view('pages.admin.profil', ['admin' => $this->auth->getUser('admin')]);
    }
}
