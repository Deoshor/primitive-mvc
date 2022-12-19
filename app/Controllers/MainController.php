<?php

namespace App\Controllers;

use App\Models\Topic;

class MainController
{
    public $topic;
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function index(): void
    {
        $topic = $this->topic->getTopics();
        require_once 'resources/views/index.php';
    }
}