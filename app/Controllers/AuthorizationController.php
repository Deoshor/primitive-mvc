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
            $_SESSION['email'] = $_POST['email'];
            $user_data = $users->getUserData($_POST);
            $_SESSION['userData'] = $user_data['name'] . ' ' . $user_data['lastname'];
            $_SESSION['id'] = $user_data['id'];
            header('location: /');
        } else {
            $alert = 'Авторизация не прошла. Попробуйте снова';
            require_once('resources/views/login.php');
        }
    }
}