<?php

namespace App\Controllers;

use App\Models\User; 

class UserController
{
    public function index()
    {
        $users = new User;
        $users = $users->get();
        require_once 'resources/view/index.php';
    }

    public function store()
    {
        $users = new User;
        $user = $users->create($_POST);
        $dir = 'C:\Users\user\Documents\php\oop\storage\\' . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $dir);
        $users->update($user['id'], ['filename' => basename($_FILES['file']['name'])]);
        header('location: /');
    } 
}

?>