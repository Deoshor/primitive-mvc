<?php

namespace Framework\Src;

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
            $columns[] = $key;
            $values[] = "'".$value."'";
        }
        $columns = implode(',', $columns);
        $columns = trim($columns);
        $values = implode(',', $values);
        $values = trim($values);
        pg_query($this->connection, "INSERT INTO $table ($columns) VALUES ($values)");
        $maxId = pg_query($this->connection, "SELECT max(id) FROM $table");
        $maxId = pg_fetch_assoc($maxId);
        return $this->whereId($table, $maxId['max']);
    }

    public function whereId($table, $id)
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
        $values = rtrim($values, ',');
        $query = pg_query($this->connection, "UPDATE $table SET $values WHERE id = $id");
        return pg_fetch_assoc($query);
    }

    public function login($table, $data)
    {

    }
}
?>