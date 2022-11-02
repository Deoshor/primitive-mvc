<?php

namespace Framework\Src;

use Framework\Src\Database;

class TopicModel
{
    public $database;
    public function __construct()
    {
        $this->database = new Database;
    }

    public function getTopics($table)
    {
        return $this->database->get($this->table);
    }
}