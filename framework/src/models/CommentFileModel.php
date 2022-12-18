<?php

namespace framework\src\models;

use Exception;
use Framework\Src\Database\Query;

class CommentFileModel
{
    public $database;

    public function __construct()
    {
        $this->database = new Query();
    }

    public function getCommentFilesById()
    {
        return $this->database->getAll($this->table);
    }

    public function createCommentFile($comment_id, $data): bool|\PgSql\Result
    {
        $file_data['file2comment'] = $comment_id;
        $file_data['comment_filename'] = $data;
        return $this->database->createObject($this->table, $file_data);
    }

    public function deleteCommentFiles($comment_id): void
    {
        $images = $this->where('file2comment', $comment_id)->getFiles();
        $dir = substr(__DIR__, 0, -13) . 'storage\comment\\';
        foreach ($images as $item) {
            //Удаляем файл из хранилища
            if ($item != "") {
                try {
                    unlink($dir . $item['comment_filename']);
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
            }
            // Удаляем файл из БД
            $this->database->deleteObject($this->table, $item['id']);
        }
    }

    public function getFiles(): array
    {
        return $this->database->getAll($this->table);
    }

    public function where($key, $value)
    {
        $this->database = $this->database->where($key, $value);
        return $this;
    }
}