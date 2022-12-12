<?php 

namespace framework\src\models;

use Exception;
use Framework\Src\Database\Query;

class UserModel
{
    public $database;
    public $where;
    public function __construct()
    {
        $this->database = new Query();
    }

    public function getAllDataFromTable()
    {
        return $this->database->getAllDataFromTable($this->table);
    }

    public function getUser($id)
    {  
        return $this->database->get($this->table, $id);
    }

    public function getUserData($data)
    {  
        $email = $data['email'];
        return $this->database->getUserDataFromEmail($this->table, $email);
    }

    public function getUserId($data)
    {  
        $email = $data['email'];
        return $this->database->getUserIdFromEmail($this->table, $email);
    }

    public function createUser($data)
    {
        return $this->database->createObject($this->table, $data);
    }

    public function updateUser($id, $data)
    {
        return $this->database->updateObject($this->table, $id, $data);
    }

    public function login($data)
    {
        if ($this->isExistsUser($data)) {
            $email = $data['email'];
            $currentPassword = $data['password'];
            $savedPassword = $this->getPassword($email);
            return $this->comparePassword($currentPassword, $savedPassword);
        }
    }

    public function isExistsUser($data)
    {
        $email = $data['email'];
        return $this->database->isExistsUser($this->table, $email);
    }

    public function validatePassword($data)
    {
        $currentPassword = $data['password'];
        
        if (preg_match_all("\^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,100}$", $currentPassword)) {
            $alert = 'Пароль должен состоять из минимум из 6 символов: только латинские буквы и цифры';
            require_once 'resources/views/alert.php';
        } else {
            return true;
        }
    }

    private function getPassword($email) 
    {
        return $this->database->getPassword($this->table, $email);
    }

    private function comparePassword($currentPassword, $savedPassword)
    {   
        if(password_verify($currentPassword, $savedPassword['password'])) {
            return true;
        }
    }

    public function get()
    {
        return $this->database->get($this->table);
    }

    public function where($key, $value)
    {
        $this->database = $this->database->get($this->table, $key, $value);
        return $this;
    }

}