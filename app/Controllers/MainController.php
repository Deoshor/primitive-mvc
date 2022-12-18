<?php

namespace App\Controllers;

use App\Models\Topic;

class MainController
{
    public function index(Topic $topic)
    {
        $topic = $topic->getTopics($this->table);
        require_once 'resources/views/index.php';
    }
}