<?php

namespace App\Interfaces;

interface AuthInterface
{
    public function checkLogin($role, $credentials);
    public function logout();
    public function getUser($role);
}
