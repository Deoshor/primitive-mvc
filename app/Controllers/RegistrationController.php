<?php

namespace App\Controllers;

use App\Models\User;

class RegistrationController
{
    public function index()
    {
        require_once 'resources/views/registration.php';
    }

    public function register()
    {
        $users = new User;
        if ($users->validatePassword($_POST)) {
            $user = $users->createUser($_POST);
            header('location: /');
        }
    }
}