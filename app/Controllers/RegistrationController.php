<?php

namespace App\Controllers;

use App\Models\User;

class RegistrationController
{
    public function index()
    {
        require_once 'resources/views/registration.html';
    }

    public function register()
    {
        $users = new User;
        $user = $users->create($_POST);
        header('location: /');
    }
}