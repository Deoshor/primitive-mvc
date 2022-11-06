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
        if($users->isExistsUser($_POST)){
            if($users->login($_POST)){
                echo "Вы успешно авторизованы";
                header('location: /');
            } else {
                echo "Попробуйте снова";
                require_once('resources/views/login.php');
            }
        }
    }
}