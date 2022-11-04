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
        return $this->database->getObject($id, $this->table);
    }
    
    public function getComments($id)
    {
        $id = substr($id, 3);
        return $this->database->getComments($id, $this->table);
    }
 
}