<?php

namespace App\Controllers;

use App\Models\Topic;
use App\Models\Article;
use Framework\Src\Auth\Auth;

class TopicController
{
    public $topic;
    public $article;

    public function __construct(Topic $topic, Article $article)
    {
        $this->topic = $topic;
        $this->article = $article;
    }

    public function index(): void
    {
        $topic_id = substr($_SERVER['QUERY_STRING'], 3);
        $topic = $this->topic->where('id', $topic_id)->getTopic();
        $article = $this->article->where('article2topic', $topic_id)->getArticles();
        require_once 'resources/views/topic.php';
    }

    public function create(): void
    {
        $user = Auth::user();
        $data['topic_name'] = $_POST['topic_name'];
        $data['topic2user'] = $user['id'];
        $topic = $this->topic->createTopic($data);
        header('Location: /');
    }

    public function edit()
    {
        $topic = $this->topic->getTopicById($_REQUEST['id']);
        require_once 'resources/views/editTopic.php';
    }

    public function update()
    {
        $id = $_POST['topic_id'];
        unset($_POST['topic_id']);
        $topic = $this->topic->updateTopic($id, $_POST);
        header('Location: /');
    }

    public function delete()
    {
        $topic = $this->topic->deleteTopic($_POST['topic_id']);
        header('Location: /');
    }
}