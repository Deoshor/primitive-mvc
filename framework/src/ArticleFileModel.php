<?php

namespace Framework\Src;

use Framework\Src\Database;
use Exception;

class ArticleFileModel
{
    public $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function getArticleFilesById($id)
    {
        return $this->database->getArticleFilesById($this->table, $id);
    }
}