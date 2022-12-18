<?php

namespace App\Controllers;

use App\Models\User;

class RegistrationController
{
    public function index(): void
    {
        require_once 'resources/views/registration.php';
    }

    public function register(User $user): void
    {
        if ($user->validatePassword($_POST)) {
            $user = $user->createUser($_POST);
            header('location: /');
        }
    }
}