<?php

namespace Framework\Src\Auth;

use App\Models\User;

class Authenticate
{

    public function ident($email): bool|array
    {
        $users = new User;
        return $users->where('email', $email)->get();
    }

    public function auth($email, $password): bool|array
    {
        $user = $this->ident($email);
        if (!$user){
            return false;
        }
        if(password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['userData'] = $user['name'] . ' ' . $user['lastname'];
            $_SESSION['id'] = $user['id'];
            header('location: /');
            return true;
        } else {
            $alert = 'Авторизация не прошла. Попробуйте снова';
            require_once('resources/views/login.php');
        }
    }
}