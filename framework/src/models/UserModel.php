<?php 

namespace framework\src\models;

use Exception;
use Framework\Src\Database\Query;

class UserModel
{
    public $database;
    public function __construct()
    {
        $this->database = new Query();
    }

    public function getAllDataFromTable()
    {
        return $this->database->getAllDataFromTable($this->table);
    }

    public function getUser()
    {  
        return $this->database->get($this->table);
    }

    public function createUser($data)
    {
        return $this->database->createObject($this->table, $data);
    }

    public function updateUser($id, $data)
    {
        return $this->database->updateObject($this->table, $id, $data);
    }

    public function get()
    {
        return $this->database->get($this->table);
    }

    public function where($key, $value)
    {
        $this->database = $this->database->where($key, $value);
        return $this;
    }
}