<?php

namespace App\Controllers;

use App\Models\Topic;
use App\Models\Article;
use App\Models\User;

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

    public function create()
    {
        $topics = new Topic();
        $user = new User();
        $id = $user->getUserId($_SESSION);
        $data['topic_name'] = $_POST['topic_name'];
        $data['topic2user'] = $id['id'];
        $topic = $topics->createTopic($data);
        header('Location: /');
    }

    public function edit()
    {
        $topics = new Topic;
        $topic = $topics->getTopicById($_REQUEST['id']);
        require_once 'resources/views/editTopic.php';
    }

    public function update()
    {
        $topics = new Topic;
        $id = $_POST['topic_id'];
        unset($_POST['topic_id']);
        $topic = $topics->updateTopic($id, $_POST);
        header('Location: /');
    }
}