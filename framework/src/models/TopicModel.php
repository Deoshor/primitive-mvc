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

    public function getTopic()
    {
        return $this->database->get($this->table);
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
        return $this->database->get($this->table, $data);
    }
    
    public function updateTopic($id, $data)
    {
        return $this->database->updateObject($this->table, $id, $data);
    }

    public function deleteTopic($id)
    {
        return $this->database->deleteObject($this->table, $id);
    }

    public function where($key, $value)
    {
        $this->database = $this->database->where($key, $value);
        return $this;
    }
}