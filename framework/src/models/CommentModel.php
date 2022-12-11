<?php

namespace framework\src\models;

use Framework\Src\Database\Query;

class CommentModel
{
    public $database;

    public function __construct()
    {
        $this->database = new Query();
    }

    public function getComment($id): array
    {
        return $this->database->getObjectById($this->table, $id);
    }
    
    public function getComments($id): array
    {
        $id = substr($id, 3);
        return $this->database->getComments($this->table, $id);
    }

    public function createComment($data): bool|\PgSql\Result
    {
        return $this->database->createObject($this->table, $data);
    }

    public function updateComment($id, $data): bool|\PgSql\Result
    {
        return $this->database->updateObject($this->table, $id, $data);
    }

    public function deleteComment($id): bool|\PgSql\Result
    {
        return $this->database->deleteObject($this->table, $id);
    }

    public function getLastComment(): array
    {
        return $this->database->getLastObject($this->table);
    }
}