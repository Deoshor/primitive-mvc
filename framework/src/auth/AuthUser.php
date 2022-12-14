<?php

namespace Framework\Src\Auth;

class AuthUser
{
    public function user()
    {
        session_start();
        return $_SESSION['user'] ?? false;
    }
}