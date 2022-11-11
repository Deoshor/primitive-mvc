<?php

namespace Framework\Src;

use Framework\Src\Database;

class ArticleModel
{
    public $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function getArticles($id)
    {
        $id = substr($id, 3);
        return $this->database->getArticles($this->table, $id);
    }

    public function getArticle($id)
    {   
        $id = substr($id, 3);
        return $this->database->getObjectById($this->table, $id);
    }

    public function createArticle($data)
    {
        return $this->database->createObject($this->table, $data);
    }

    public function updateArticle($id, $data)
    {
        return $this->database->updateObject($this->table, $id, $data);
    }

}