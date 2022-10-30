<?php


function myAutoLoader(string $className)
{
    require_once __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
}   

spl_autoload_register('myAutoLoader');