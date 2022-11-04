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

    public function getTopic($id)
    {
        $id = substr($id, 3);
        return $this->database->getObject($id, $this->table);
    }

    public function getTopics()
    {
        return $this->database->get($this->table);
    }
}