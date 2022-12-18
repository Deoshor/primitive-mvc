<?php

namespace App\Controllers;

use App\Models\User; 

class UserController
{
    public function index(User $user): void
    {
        $users = $user->getAllDataFromTable();
        require_once 'resources/views/index.html';
    }

    public function store(User $user): void
    {
        $user->createUser($_POST);
        header('location: /');
    } 
}