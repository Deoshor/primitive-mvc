<?php

namespace App\Controllers;

use App\Models\Topic;

class MainController
{
    public function index(Topic $topic): void
    {
        $topic = $topic->getTopics();
        require_once 'resources/views/index.php';
    }
}