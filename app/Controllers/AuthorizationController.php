<?php

namespace App\Controllers;

use App\Models\User;

class AuthorizationController
{
    public function index()
    {
        require_once('resources/views/login.php');
    } 

    public function login()
    {
        $users = new User();
        if($users->login($_POST)){
            $_SESSION['user'] = $_POST['email'];
            $user_data = $users->getUserData($_POST);
            $_SESSION['userData'] = $user_data['name'] . ' ' . $user_data['lastname'];
            echo "<p>Вы успешно авторизованы<p>";
            header('location: /');
        } else {
            $alert = 'Авторизация не прошла. Попробуйте снова';
            require_once('resources/views/login.php');
        }
    }

    public function logout()
    {
        if(isset($_SESSION)){
            $_SESSION['user'] = null;
            $_SESSION['userData'] = null;
        }
    }
}