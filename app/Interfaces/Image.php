<?php

namespace App\Interfaces;


interface Image
{
    public function saveImage($dir, $file);
    public function validateSize($file);
    public function validateType($file);
}

?>