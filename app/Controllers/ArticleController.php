<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

class ArticleController
{
    public function index()
    {
        $articles = new Article();
        $article = $articles->getArticle($_SERVER['QUERY_STRING']);
        
        $comments = new Comment();
        $comment = $comments->getComments($_SERVER['QUERY_STRING']);

        $comments_data[] = array();
        foreach($comment as $item) {
            $user = new User();
            $user = $user->getUser($item['comment2user']);
            $item['author']  = $user['name'] . ' ' . $user['lastname'];
            array_push($comments_data, $item);
        }
        unset($comments_data[0]);
        require_once 'resources/views/article.php';
    }

    public function store()
    {
        require_once 'resources/views/createArticle.php';
    }

    public function create()
    {
        $articles = new Article();
        $article = $articles->createArticle($_POST);
        $dir = 'C:\Users\user\Documents\php\oop\storage\articles\\' . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $dir);
        $articles->updateArticle($articles[0]['id'], $articles);
        header('location: /');
    }
}