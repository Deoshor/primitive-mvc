<?php

namespace App\Controllers;

use App\Models\User; 

class UserController
{
    public function index()
    {
        $users = new User;
        $users = $users->getAllDataFromTable();
        require_once 'resources/views/index.html';
    }

    public function store()
    {
        $users = new User;
        $user = $users->createUser($_POST);
        $dir = 'C:\Users\user\Documents\php\oop\storage\\' . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $dir);
        $users->updateUser($user[0]['id'], $user);
        header('location: /');
    } 
}

?>