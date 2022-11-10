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
        return $this->database->getObjectById($this->table, $id);
    }

    public function getTopics()
    {
        return $this->database->getAllDataFromTable($this->table);
    }

    public function createTopic($data)
    {
        return $this->database->create($this->table, $data);
    }

    public function getTopicById($data)
    {
        return $this->database->getObjectById($this->table, $data);
    }
    
    public function updateTopic($id, $data)
    {
        return $this->database->updateObject($this->table, $id, $data);
    }
}