<?php

namespace App\Controllers;

use App\Models\Article;

class ArticleController
{
    public function index()
    {
        $articles = new Article();
        $article = $articles->getArticle($_SERVER['QUERY_STRING']);
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