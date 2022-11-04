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

    public function get()
    {
        return $this->database->get($this->table);
    }

    public function create($data)
    {
        return $this->database->create($this->table, $data);
    }

    public function update($id, $data)
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

    public function login($table, $data)
    {
        if(!$this->existsUser($table, $data)) {
            echo "User does not exist";
        } else {
            $email = $data['email'];
            $currentPassword = $data['password'];
            $savedPassword = $this->getPassword($table, $email);
            return $this->comparePassword($currentPassword, $savedPassword);
        }
    }

    public function existsUser($table, $data)
    {
        $email = $data['email'];
        return pg_query($this->database->connection, "SELECT * FROM $table WHERE email = '$email'");
    }

    public function getPassword($table, $email) 
    {
        $query = pg_query($this->database->connection, "SELECT password FROM $table WHERE email = '$email'");
        return pg_fetch_assoc($query);
    }

    public function comparePassword($currentPassword, $savedPassword)
    {   
        if(password_verify($currentPassword, $savedPassword['password'])) {
            return true;
        }
    }
    
    public function getUser($id)
    {  
        return $this->database->getObject($id, $this->table);
    }

}
?>