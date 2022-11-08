<?php

namespace App\Controllers;

use App\Models\Topic;
use App\Models\Article;

class TopicController
{
    public function index()
    {
        $topics = new Topic;
        $topic = $topics->getTopic($_SERVER['QUERY_STRING']);
        $articles = new Article;
        $article = $articles->getArticles($_SERVER['QUERY_STRING']);
        require_once 'resources/views/topic.php';
    }

    public function store()
    {
        
    }
}