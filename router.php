<?php

$route =  $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$id = $_SERVER['QUERY_STRING'];

switch ($route) {
    case '/':
        $controller = new \App\Controllers\MainController();
        echo $controller->index();
        break;
    case '/users/store':
        if($method == 'POST') {
            $controller = new \App\Controllers\UserController();
            $controller->store();
        }
        break;
    case '/registration':
        $controller = new \App\Controllers\RegistrationController();
        $controller->index();
        break;
    case '/registration/create':
        if($method == 'POST') {
            $controller = new \App\Controllers\RegistrationController();
            $controller->register();
        }
        break;
    case '/login':
        $controller = new \App\Controllers\AuthorizationController();
        $controller->index();
        break;
    case '/login/authorize':
        $controller = new \App\Controllers\AuthorizationController();
        $controller->login();
        break;
    case "/topic?$id":
        $controller = new \App\Controllers\TopicController();
        echo $controller->index();
        break;
    case "/topic/create":
        $controller = new \App\Controllers\TopicController();
        echo $controller->create();
        break;
    case "/topic/edit?$id":
        $controller = new \App\Controllers\TopicController();
        $controller->edit();
        break; 
    case "/topic/update":
        $controller = new \App\Controllers\TopicController();
        $controller->update();
        break;        
    case "/article?$id":
        $controller = new \App\Controllers\ArticleController();
        echo $controller->index();
        break;
    case '/articles/store':
        $controller = new \App\Controllers\ArticleController();
        echo $controller->store();
        break;
    case '/articles/create':
        $controller = new \App\Controllers\ArticleController();
        $controller->create();
        break;
    default:
        echo ("404 Not Found");
}
