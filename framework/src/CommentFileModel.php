<?php

namespace Framework\Src;

use Framework\Src\Database;
use Exception;

class CommentFileModel
{
    public $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getCommentFilesById($id)
    {
        return $this->database->getCommentFilesById($this->table, $id);
    }
}