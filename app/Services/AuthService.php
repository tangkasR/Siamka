<?php

namespace App\Services;

use App\Interfaces\AuthInterface;

class AuthService
{
    private $auth;
    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }
    public function checkLogin($role, $credentials)
    {
        return $this->auth->checkLogin($role, $credentials);
    }
    public function logout()
    {
        return $this->auth->logout();
    }
    public function getUser($role)
    {
        return $this->auth->getUser($role);
    }
}
