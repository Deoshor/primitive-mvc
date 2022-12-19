<?php

namespace App\Controllers;

use App\Models\User; 

class UserController
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(): void
    {
        $users = $this->user->getAllDataFromTable();
        require_once 'resources/views/index.html';
    }

    public function store(): void
    {
        $this->user->createUser($_POST);
        header('location: /');
    } 
}