<?php

namespace App\Interfaces;


interface Image
{
    public function validateSize($from, $file);
    public function validateType($from, $file);
}

?>