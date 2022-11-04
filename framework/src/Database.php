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
    }

    public function get($table)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table");
        return pg_fetch_all($query);
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
            dd($data);
            $columns[] = $key;
            $values[] = "'".$value."'";
        }
        $columns = implode(',', $columns);
        $columns = trim($columns);
        $values = implode(',', $values);
        $values = trim($values);
        dd($values);
        pg_query($this->connection, "INSERT INTO $table ($columns) VALUES ($values)");
        $maxId = pg_query($this->connection, "SELECT max(id) FROM $table");
        $maxId = pg_fetch_assoc($maxId);
        return $this->getObject($table, $maxId['max']);
    }

    public function getObject($id, $table)
    {   
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE id = $id");
        return pg_fetch_all($query);
    }

    public function update($table, $id, $data)
    {
        $values = '';
        foreach($data[0] as $key => $value){
            $values .= " $key = '$value',";
        }
        dd($values);
        $values = rtrim($values, ',');
        $query = pg_query($this->connection, "UPDATE $table SET $values WHERE id = $id");
        return pg_fetch_assoc($query);
    }

    public function login($table, $data)
    {

    }

    public function getArticles($id, $table)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE article2topic = $id");
        return pg_fetch_all($query);
    }
    
    public function getComments($id, $table)
    {
        $query = pg_query($this->connection, "SELECT * FROM $table WHERE comment2article = $id");
        return pg_fetch_all($query);
    }
        
}
?>