<?php 

namespace Framework\Src;

use App\Interfaces\Image;
use Exception;

class UserModel
{
    public $database;
    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAllDataFromTable()
    {
        return $this->database->getAllDataFromTable($this->table);
    }

    public function getUser($id)
    {  
        return $this->database->getObjectById($this->table, $id);
    }

    public function getUserData($data)
    {  
        $email = $data['email'];
        return $this->database->getUserDataFromEmail($this->table, $email);
    }

    public function createUser($data)
    {
        return $this->database->create($this->table, $data);
    }

    public function updateUser($id, $data)
    {
        return $this->database->update($this->table, $id, $data);
    }

    public function existsTable($table)
    {
        return pg_query($this->database->connection, "SELECT * FROM  $table");
    }

    public function setTable($table)
    {
        if (!$this->existsTable($table)){
            throw new Exception('Таблицы ' . "$table" . 'не существует в базе данных');
        }
        $this->table = $table;
    }

    public function file($file, Image $image)
    {
        $image->saveImage($file);
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
        if (!preg_match_all("[0-9A-Za-z]{3}", $currentPassword)){
            return 'Ошибка валидации';
        } else {
            return $currentPassword;
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

}
?>