<?php

namespace App\Controllers;

use App\Models\Topic;

class TopicController
{
    public function index()
    {
        $topics = new Topic;
        $topic = $topics->getTopic($_SERVER['QUERY_STRING']);
        require_once 'resources/views/group.php';
    }
}