<?php

namespace App\Services;

use App\Interfaces\Image;

class UserStorageService implements Image
{
    public function saveImage($file)
    {
        move_uploaded_file($file, 'C:\Users\user\Documents\php\oop\storage\users\\'.$file);
    }
}

?>