<?php

namespace App\Controllers;

use App\Models\User;
use Framework\Src\Auth\Auth;

class AuthorizationController
{
    public function index(): void
    {
        require_once('resources/views/login.php');
    } 

    public function login(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (Auth::login($email, $password)) {
            header('location: /');
        } else {
            $alert = 'Авторизация не прошла. Попробуйте снова';
            require_once('resources/views/login.php');
        }
    }
}