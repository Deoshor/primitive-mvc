<?php

namespace App\Controllers;

use App\Models\User;

class RegistrationController
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(): void
    {
        require_once 'resources/views/registration.php';
    }

    public function register(): void
    {
        if ($this->user->validatePassword($_POST)) {
            $user = $this->user->createUser($_POST);
            header('location: /');
        }
    }
}