<?php

namespace framework\src\models;

use Exception;
use Framework\Src\Database\Query;

class ArticleFileModel
{
    public $database;

    public function __construct()
    {
        $this->database = new Query;
    }

    public function getArticleFilesById($id): array
    {
        return $this->database->getArticleFilesById($this->table, $id);
    }

    public function createArticleFile($article_id, $data): bool|\PgSql\Result
    {
        $file_data['file2article'] = $article_id;
        $file_data['article_filename'] = $data;
        return $this->database->createObject($this->table, $file_data);
    }

    public function deleteArticleFiles($article_id): void
    {
        $images = $this->getFiles($article_id, 'file2article');
        $dir = substr(__DIR__, 0, -13) . 'storage\articles\\';
        foreach ($images as $item) {
            //Удаляем файл из хранилища
            if ($item != "") {
                try {
                    unlink($dir . $item['article_filename']);
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
            }
            // Удаляем файл из БД
            $this->database->deleteObject($this->table, $item['id']);
        }
    }

    public function getFiles($id, $from): array
    {
        return $this->database->getFiles($this->table, $id, $from);
    }
}