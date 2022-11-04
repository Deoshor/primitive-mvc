<?php

if($_SERVER['REQUEST_URI'] == '/'){
    $controller = new \App\Controllers\UserController();
    echo $controller->index();
} elseif($_SERVER['REQUEST_URI'] == '/users/store' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new \App\Controllers\UserController();
    $controller->store();
} elseif($_SERVER['REQUEST_URI'] == '/registration') {
    $controller = new \App\Controllers\RegistrationController();
    $controller->index();
} elseif($_SERVER['REQUEST_URI'] == '/registration/create' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new \App\Controllers\RegistrationController();
    $controller->register();
} elseif($_SERVER['REQUEST_URI'] == '/login') {
    $controller = new \App\Controllers\AuthorizationController();
    $controller->index();
} elseif($_SERVER['REQUEST_URI'] == '/login/authorize'  && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new \App\Controllers\AuthorizationController();
    $controller->login();
}

?>