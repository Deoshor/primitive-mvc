<?php

namespace App\Interfaces;


interface Image
{
    public function saveImage($dir, $file);
    public function validateSize($from, $file);
    public function validateType($from, $file);
}

?>