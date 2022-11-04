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
        return $this->database->getArticles($id, $this->table);
    }

    public function getArticle($id)
    {   
        $id = substr($id, 3);
        return $this->database->getObject($id, $this->table);
    }

    public function createArticle($data)
    {
        return $this->database->create($this->table, $data);
    }

    public function updateArticle($id, $data)
    {
        return $this->database->update($this->table, $id, $data);
    }
}