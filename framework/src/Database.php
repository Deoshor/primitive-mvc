<?php

namespace Framework\Src;

include('config.php');
use Exception;

class Database
{
    public $connection;
    

    public function __construct()
    {
        $dbhost = DBHOST;
        $dbport = DBPORT;
        $dbname = DBNAME;
        $dbuser = DBUSER;
        $dbpass = DBPWD;

        $this->connection = pg_connect(
            "host='$dbhost' port=$dbport dbname=$dbname user=$dbuser password=$dbpass");
        if($this->connection == false){
            throw new Exception('Нет подключения к базе данных');
        }
        session_start();
    }

    public function getAllDataFromTable($table)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table ORDER BY id");
        if(!$query) {
            echo "<h3>Ой, что-то пошло не так!</h3>";
            throw new Exception('Нет такой таблицы в БД');
        } else {
            return pg_fetch_all($query);
        }
    }

    public function getObjectById($table, $id): bool|array
    {   
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE id = $id");
        if(!$query) {
            echo "<h3>Ой, что-то пошло не так!</h3>";
            throw new Exception('Нет такой сущности в БД');
        } else {
            return pg_fetch_assoc($query);
        }
    }

    public function getLastObject($table)
    {
        $query = pg_query($this->connection, "SELECT id FROM $table order by id desc");
        return pg_fetch_assoc($query);
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
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE article2topic = $id ORDER BY id");
        if(!$query) {
            echo "<h3>Ой, что-то пошло не так!</h3>";
            throw new Exception('Нет такой сущности в БД');
        } else {
            return pg_fetch_all($query);
        }
    }
    
    public function getComments($table, $id)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE comment2article = $id ORDER BY last_update_date");
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
        $query = pg_query($this->connection, "SELECT id,name,lastname FROM $table WHERE email = '$email'");
        return pg_fetch_assoc($query);
    }

    public function getUserIdFromEmail($table, $email)
    {
        $query = pg_query($this->connection, "SELECT id FROM $table WHERE email = '$email'");
        return pg_fetch_assoc($query);
    }
    

    public function createObject($table, $data)
    {   
        $columns = [];
        $values = [];

        foreach($data as $key => $value){
            if ($key == 'password') {
                $columns[] = $key;
                $values[] = "'". password_hash($value,  PASSWORD_DEFAULT) ."'";
                break;
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

    public function updateObject($table, $id, $data): bool|\PgSql\Result
    {
        $values = '';
        foreach($data as $key => $value){
            $values .= " $key = '$value',";
        }
        
        $values = rtrim($values, ',');
        return pg_query($this->connection, "UPDATE $table SET $values WHERE id = $id");
    }

    public function deleteObject($table, $id): bool|\PgSql\Result
    {
        return pg_query($this->connection, "DELETE FROM $table WHERE id = $id;");
    }

    public function getFiles($table, $id, $from)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE $from = $id");
        return pg_fetch_all($query);
    }

    public function getArticleFilesById($table, $id)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE file2article = $id");
        return pg_fetch_all($query);
    }

    public function getCommentFilesById($table, $id)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE file2comment = $id");
        return pg_fetch_all($query);
    }

    public function createTable($sql)
    {
        $query = pg_query($this->connection, $sql);
        return pg_fetch_assoc($query);
    }

    public function insertIntoTables($sql)
    {
        $query = pg_query($this->connection, $sql);
        return pg_fetch_assoc($query);
    }

}