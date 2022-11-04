<?php


if($_SERVER['REQUEST_URI'] == '/'){
    $controller = new \App\Controllers\MainController();
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
} elseif($_SERVER['REQUEST_URI'] == '/login/authorize' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new \App\Controllers\AuthorizationController();
    $controller->login();
} elseif($_SERVER['REQUEST_URI'] == ('/topic?' . $_SERVER['QUERY_STRING'])) {
    $controller = new \App\Controllers\TopicController();
    echo $controller->index();
} elseif($_SERVER['REQUEST_URI'] == ('/article?' . $_SERVER['QUERY_STRING'])) {
    $controller = new \App\Controllers\ArticleController();
    echo $controller->index();
}  elseif($_SERVER['REQUEST_URI'] == '/articles/store') {
    $controller = new \App\Controllers\ArticleController();
    echo $controller->store();
}  elseif($_SERVER['REQUEST_URI'] == '/articles/create') {
    $controller = new \App\Controllers\ArticleController();
    echo $controller->create();
} 
?>