<?php

namespace App\Controllers;

use App\Models\Topic;
use App\Models\Article;
use Framework\Src\Auth\Auth;

class TopicController
{
    public function index()
    {
        $topics = new Topic;
        $topic_id = substr($_SERVER['QUERY_STRING'], 3);
        $topic = $topics->where('id', $topic_id)->getTopic();
        $articles = new Article;
        $article = $articles->where('article2topic', $topic_id)->getArticles();
        require_once 'resources/views/topic.php';
    }

    public function create()
    {
        $topics = new Topic();
        $user = Auth::user();
        $data['topic_name'] = $_POST['topic_name'];
        $data['topic2user'] = $user['id'];
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

    public function delete()
    {
        $topics = new Topic;
        $topic = $topics->deleteTopic($_POST['topic_id']);
        header('Location: /');
    }
}