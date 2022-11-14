<?php

namespace Framework\Src;

use Framework\Src\Database;
use Exception;

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

    public function createComment($data)
    {
        return $this->database->createObject($this->table, $data);
    }

    public function updateComment($id, $data, $images)
    {
        if (!empty($images)) {
            foreach ($images as $image) {
                array_push($data['comment_files'], $image);
            }
        }
        return $this->database->updateObject($this->table, $id, $data);
    }

    public function deleteComment($id)
    {
        $images = $this->getImages($id, 'comment_files');
        if (isset($images)) {
            $dir = substr(__DIR__, 0, -13) . 'storage\comments\\';
            $data_images = [];
            foreach ($images as $image) {
                $data_images = explode(',', $image);
            }
            foreach ($data_images as $item) {
                if ($item != "") {
                    try {
                        unlink($dir . $item);
                    } catch (Exception $e) {
                        echo $e->getMessage(), "\n";
                    }
                } 
            }
        }
        return $this->database->deleteObject($this->table, $id);
    }

    public function getImages($id, $from)
    {
        return $this->database->getImages($this->table, $id, $from);
    }
}