<?php

namespace App\Controllers;

use App\Models\Topic;

class MainController
{
    public function index()
    {
        $topics = new Topic;
        $topic = $topics->getTopics($this->table);
        require_once 'resources/views/index.php';
    }
}