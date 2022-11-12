<?php

namespace App\Services;

use App\Interfaces\Image;

class ImageService implements Image
{
    public function saveImage($dir, $file)
    {
        move_uploaded_file($file, 'C:\Users\user\Documents\php\oop\storage\\'. $dir . '\\' .$file);
    }

    public function validateSize($file)
    {
        $max_size_image = 3145728;

        $valid = false;
        foreach ($file['article_files']['size'] as $value) {
            if ($value <= $max_size_image) {
                $valid = true;
            } else {
                $valid = false;
            }
        }

        if ($valid == false) {
            $alert = 'Размер одного из файлов больше, чем 3 MB';
            require_once 'resources/views/alert.php';
        } else {
            return true;
        }
    }

    public function validateType($file)
    {
        $types_image = ['image/jpeg', 'image/png'];

        $valid = false;
        foreach ($file['article_files']['type'] as $value) {
            if ($value == $types_image[0] || $value == $types_image[1]) {
                $valid = true;
            } else {
                $valid = false;
            }
        }

        if ($valid == false) {
            $alert = 'Фотографию можно загрузить либо в ".jpeg", либо ".png" формате';
            require_once 'resources/views/alert.php';
        } else {
            return true;
        }

    }
}
