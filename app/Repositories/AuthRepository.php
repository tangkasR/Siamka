<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface
{
    private $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function checkLogin($role, $credentials)
    {
        return $this->auth::guard($role)->attempt($credentials);
    }
    public function logout()
    {
        return $this->auth::logout();
    }
    public function getUser($role)
    {
        return $this->auth::guard($role)->user();
    }
}
