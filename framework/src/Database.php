<?php

namespace Framework\Src;

use Exception;

class Database
{
    public $connection;

    public function __construct()
    {
        $this->connection = pg_connect("host='127.0.0.1' port=5432 dbname=postgres user=postgres password=root");
        if($this->connection == false){
            throw new Exception('Нет подключения к базе данных');
        }
        session_start();
    }

    public function getAllDataFromTable($table)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table");
        if(!$query) {
            echo "<h3>Ой, что-то пошло не так!</h3>";
            throw new Exception('Нет такой таблицы в БД');
        } else {
            return pg_fetch_all($query);
        }
    }

    public function getObjectById($table, $id)
    {   
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE id = $id");
        if(!$query) {
            echo "<h3>Ой, что-то пошло не так!</h3>";
            throw new Exception('Нет такой сущности в БД');
        } else {
            return pg_fetch_assoc($query);
        }
    }

    public function getPassword($table, $email) 
    {
        $query = pg_query($this->connection, "SELECT password FROM $table WHERE email = '$email'");
        if(!$query) {
            echo "<h3>Ой, что-то пошло не так!</h3>";
            throw new Exception('Пароль не был получен, проверь БД');
        } else {
            return pg_fetch_assoc($query);
        }
    }

    public function getArticles($table, $id)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE article2topic = $id");
        if(!$query) {
            echo "<h3>Ой, что-то пошло не так!</h3>";
            throw new Exception('Нет такой сущности в БД');
        } else {
            return pg_fetch_all($query);
        }
    }
    
    public function getComments($table, $id)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE comment2article = $id");
        if(!$query) {
            echo "<h3>Ой, что-то пошло не так!</h3>";
            throw new Exception('Нет такой сущности в БД');
        } else {
            return pg_fetch_all($query);
        }
    }

    public function isExistsUser($table, $email)
    {
        return pg_query($this->connection, "SELECT * FROM $table WHERE email = '$email'");
    }

    public function getUserDataFromEmail($table, $email)
    {
        $query = pg_query($this->connection, "SELECT name,lastname FROM $table WHERE email = '$email'");
        return pg_fetch_assoc($query);
    }

    public function getUserIdFromEmail($table, $email)
    {
        $query = pg_query($this->connection, "SELECT id FROM $table WHERE email = '$email'");
        return pg_fetch_assoc($query);
    }
    

    public function create($table, $data)
    {   
        $columns = [];
        $values = [];
        
        foreach($data as $key => $value){
            if($key == 'password') {
                $columns[] = $key;
                $values[] = "'". password_hash($value,  PASSWORD_DEFAULT) ."'";
                break;
            }
            if($key == 'article_file') {
                foreach($values as $item) {
                    dd($item);
                    $columns[] = $key;
                    $values[] = $item;
                    break;
                }
                
            }
            $columns[] = $key;
            $values[] = "'".$value."'";
        }
        $columns = implode(',', $columns);
        $columns = trim($columns);
        $values = implode(',', $values);
        $values = trim($values);
        return pg_query($this->connection, "INSERT INTO $table ($columns) VALUES ($values)");
    }

    public function update($table, $id, $data)
    {
        $values = '';
        foreach($data[0] as $key => $value){
            $values .= " $key = '$value',";
        }
        $values = rtrim($values, ',');
        $query = pg_query($this->connection, "UPDATE $table SET $values WHERE id = $id");
        return pg_fetch_assoc($query);
    }

}
?>