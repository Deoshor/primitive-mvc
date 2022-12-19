<?php

namespace Framework\Src;

use App\Controllers\ArticleController;
use App\Controllers\AuthorizationController;
use App\Controllers\CommentController;
use App\Controllers\MainController;
use App\Controllers\RegistrationController;
use App\Controllers\TopicController;
use App\Controllers\UserController;
use App\Models\Article;
use App\Models\ArticleFile;
use App\Models\Comment;
use App\Models\CommentFile;
use App\Models\Topic;
use App\Models\User;

class Container
{
    public array $controllers = [];

    public function __construct()
    {
        $this->controllers['MainController'] = new MainController(
            new Topic
        );
        $this->controllers['UserController'] = new UserController(
            new User()
        );
        $this->controllers['RegistrationController'] = new RegistrationController(
            new User()
        );
        $this->controllers['AuthorizationController'] = new AuthorizationController();
        $this->controllers['TopicController'] = new TopicController(
            new Topic(),
            new Article()
        );
        $this->controllers['ArticleController'] = new ArticleController(
            new Article(), new Comment(), new ArticleFile()
        );
        $this->controllers['CommentController'] = new CommentController(
            new Comment(),
            new CommentFile()
        );
    }
}