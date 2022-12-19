<?php

use App\Models\Article;
use App\Models\ArticleFile;
use App\Models\Comment;
use App\Models\CommentFile;
use App\Models\Topic;
use \Framework\Src\Container;

$route =  $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$id = $_SERVER['QUERY_STRING'];

$controller = new Container();

switch ($route) {
    case '/':
        $controller->controllers['MainController']->index();
        break;
    case '/users/store':
        if($method == 'POST') {
            $controller->controllers['UserController']->store();
        }
        break;
    case '/registration':
        $controller->controllers['RegistrationController']->index();
        break;
    case '/registration/create':
        if($method == 'POST') {
            $controller->controllers['RegistrationController']->register();
        }
        break;
    case '/login':
        $controller->controllers['AuthorizationController']->index();
        break;
    case '/login/authorize':
        $controller->controllers['AuthorizationController']->login();
        break;
    case "/topic?$id":
        $controller->controllers['TopicController']->index();
        break;
    case "/topic/create":
        $controller->controllers['TopicController']->create();
        break;
    case "/topic/edit?$id":
        $controller->controllers['TopicController']->edit();
        break; 
    case "/topic/update":
        $controller->controllers['TopicController']->update();
        break;
    case "/topic/delete":
        $controller->controllers['TopicController']->delete();
        break;            
    case "/article?$id":
        $controller->controllers['ArticleController']->index();
        break;
    case '/article/create':
        $controller->controllers['ArticleController']->create();
        break;
    case "/article/update":
        $controller->controllers['ArticleController']->update();
        break;
    case "/article/delete":
        $controller->controllers['ArticleController']->delete();
        break;    
    case '/comment/create':
        $controller->controllers['CommentController']->create();
        break;
    case '/comment/update':
        $controller->controllers['CommentController']->update();
        break;
    case '/comment/delete':
        $controller->controllers['CommentController']->delete();
        break;
    default:
        echo ("404 Not Found");
}
