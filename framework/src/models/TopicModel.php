<?php

namespace framework\src\models;

use Framework\Src\Database\Query;

class TopicModel
{
    public $database;
    public function __construct()
    {
        $this->database = new Query;
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
        return $this->database->createObject($this->table, $data);
    }

    public function getTopicById($data)
    {
        return $this->database->getObjectById($this->table, $data);
    }
    
    public function updateTopic($id, $data)
    {
        return $this->database->updateObject($this->table, $id, $data);
    }

    public function deleteTopic($id)
    {
        return $this->database->deleteObject($this->table, $id);
    }
}