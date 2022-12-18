<?php

use App\Models\Article;
use App\Models\ArticleFile;
use App\Models\Comment;
use App\Models\CommentFile;
use App\Models\Topic;
use App\Models\User;

$route =  $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$id = $_SERVER['QUERY_STRING'];

switch ($route) {
    case '/':
        $controller = new \App\Controllers\MainController();
        $controller->index(new Topic());
        break;
    case '/users/store':
        if($method == 'POST') {
            $controller = new \App\Controllers\UserController();
            $controller->store(new User());
        }
        break;
    case '/registration':
        $controller = new \App\Controllers\RegistrationController();
        $controller->index();
        break;
    case '/registration/create':
        if($method == 'POST') {
            $controller = new \App\Controllers\RegistrationController();
            $controller->register(new User());
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
        $controller->index(new Topic(), new Article());
        break;
    case "/topic/create":
        $controller = new \App\Controllers\TopicController();
        $controller->create(new Topic());
        break;
    case "/topic/edit?$id":
        $controller = new \App\Controllers\TopicController();
        $controller->edit(new Topic());
        break; 
    case "/topic/update":
        $controller = new \App\Controllers\TopicController();
        $controller->update(new Topic);
        break;
    case "/topic/delete":
        $controller = new \App\Controllers\TopicController();
        $controller->delete(new Topic);
        break;            
    case "/article?$id":
        $controller = new \App\Controllers\ArticleController();
        $controller->index(new Article(), new Comment());
        break;
    case '/article/create':
        $controller = new \App\Controllers\ArticleController();
        $controller->create(new Article());
        break;
    case "/article/update":
        $controller = new \App\Controllers\ArticleController();
        $controller->update(new Article());
        break;
    case "/article/delete":
        $controller = new \App\Controllers\ArticleController();
        $controller->delete(new Article(), new ArticleFile());
        break;    
    case '/comment/create':
        $controller = new \App\Controllers\CommentController();
        $controller->create(new Comment());
        break;
    case '/comment/update':
        $controller = new \App\Controllers\CommentController();
        $controller->update(new Comment());
        break;
    case '/comment/delete':
        $controller = new \App\Controllers\CommentController();
        $controller->delete(new Comment(), new CommentFile());
        break;
    default:
        echo ("404 Not Found");
}
