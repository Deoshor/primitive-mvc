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

    public function getArticles(): array
    {
        return $this->database->getAll($this->table);
    }

    public function getArticle(): bool|array
    {
        return $this->database->get($this->table);
    }

    public function createArticle($data): bool|\PgSql\Result
    {
        return $this->database->createObject($this->table, $data);
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

    public function where($key, $value)
    {
        $this->database = $this->database->where($key, $value);
        return $this;
    }
}