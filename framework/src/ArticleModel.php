<?php

namespace Framework\Src;

use Framework\Src\Database;
use Exception;

class ArticleModel
{
    public $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function getArticles($id)
    {
        $id = substr($id, 3);
        return $this->database->getArticles($this->table, $id);
    }

    public function getArticle($id)
    {   
        $id = substr($id, 3);
        return $this->database->getObjectById($this->table, $id);
    }

    public function createArticle($data)
    {
        return $this->database->createObject($this->table, $data);
    }

    public function getArticleById($data)
    {
        return $this->database->getObjectById($this->table, $data);
    }
    
    public function updateArticle($id, $data, $images)
    {
        foreach ($images as $image) {
            array_push($data['article_files'], $image);
        }
        return $this->database->updateObject($this->table, $id, $data);
    }

    public function deleteArticle($id)
    {
        $images = $this->getImages($id);
        if (isset($images)) {
            $dir = substr(__DIR__, 0, -13) . 'storage\articles\\';
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

    public function getImages($id)
    {
        return $this->database->getImages($this->table, $id);
    }

}