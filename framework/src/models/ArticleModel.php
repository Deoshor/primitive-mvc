<?php

namespace framework\src\models;

use Framework\Src\Database\Query;

class ArticleModel
{
    public $database;

    public function __construct()
    {
        $this->database = new Query;
    }

    public function getArticles($id): array
    {
        $id = substr($id, 3);
        return $this->database->getArticles($this->table, $id);
    }

    public function getArticle($id): bool|array
    {   
        $id = substr($id, 3);
        return $this->database->getObjectById($this->table, $id);
    }

    public function createArticle($data): bool|\PgSql\Result
    {
        return $this->database->createObject($this->table, $data);
    }

    public function getArticleById($data): array
    {
        return $this->database->getObjectById($this->table, $data);
    }
    
    public function updateArticle($id, $data): bool|\PgSql\Result
    {
        return $this->database->updateObject($this->table, $id, $data);
    }

    public function deleteArticle($id): bool|\PgSql\Result
    {
        return $this->database->deleteObject($this->table, $id);
    }

    public function getLastArticle(): array
    {
        return $this->database->getLastObject($this->table);
    }
}