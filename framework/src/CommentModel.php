<?php

namespace Framework\Src;

use Framework\Src\Database;

class CommentModel
{
    public $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getComment($id)
    {
        return $this->database->getObjectById($this->table, $id);
    }
    
    public function getComments($id)
    {
        $id = substr($id, 3);
        return $this->database->getComments($this->table, $id);
    }
 
}