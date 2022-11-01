<?php

namespace App\Controllers;

use App\Models\User;

class AuthorizationController
{
    public function index()
    {
        require_once('resources/views/login.html');
    } 

    public function login()
    {
        $users = new User();
        if($users->existsUser($users->table, $_POST)){
            if($users->login($users->table, $_POST)){
                echo "Вы успешно авторизованы";
                header('location: /');
            } else {
                echo "Попробуйте снова";
                require_once('resources/views/login.html');
            }
        }
    }
}