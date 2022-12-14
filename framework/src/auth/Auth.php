<?php

namespace Framework\Src\Auth;

use Framework\Src\Auth\Authenticate;
use Framework\Src\Auth\AuthUser;

class Auth
{
    public static function login($email, $password)
    {
        $authenticate = new Authenticate();
        if ($authenticate->auth($email, $password)) {
            $user = new AuthUser();
            return $user->user();
        }
        return false;
    }

    public static function user()
    {
        $user = new AuthUser();
        return $user->user();
    }
}