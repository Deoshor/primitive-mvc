<?php

namespace App\Controllers;

use App\Models\Topic;
use App\Models\Article;
use Framework\Src\Auth\Auth;

class TopicController
{
    public function index(Topic $topic, Article $article): void
    {
        $topic_id = substr($_SERVER['QUERY_STRING'], 3);
        $topic = $topic->where('id', $topic_id)->getTopic();
        $article = $article->where('article2topic', $topic_id)->getArticles();
        require_once 'resources/views/topic.php';
    }

    public function create(Topic $topic): void
    {
        $user = Auth::user();
        $data['topic_name'] = $_POST['topic_name'];
        $data['topic2user'] = $user['id'];
        $topic = $topic->createTopic($data);
        header('Location: /');
    }

    public function edit(Topic $topic)
    {
        $topic = $topic->getTopicById($_REQUEST['id']);
        require_once 'resources/views/editTopic.php';
    }

    public function update(Topic $topic)
    {
        $id = $_POST['topic_id'];
        unset($_POST['topic_id']);
        $topic = $topic->updateTopic($id, $_POST);
        header('Location: /');
    }

    public function delete(Topic $topic)
    {
        $topic = $topic->deleteTopic($_POST['topic_id']);
        header('Location: /');
    }
}