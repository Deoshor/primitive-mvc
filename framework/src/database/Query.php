<?php

namespace Framework\Src\Database;

use Exception;

class Query
{
    public $connection;
    public $where;

    public function __construct()
    {
        $this->connection = Database::getInstance()->connect();
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

    public function get($table): bool|array
    {   
        $query = pg_query($this->connection, "SELECT * FROM $table $this->where");
        if(!$query) {
            echo "<h3>Ой, что-то пошло не так!</h3>";
            throw new Exception('Нет такой сущности в БД');
        } else {
            return pg_fetch_assoc($query);
        }
    }

    public function getAll($table): bool|array
        {
            $query = pg_query($this->connection, "SELECT * FROM $table $this->where");
            if(!$query) {
                echo "<h3>Ой, что-то пошло не так!</h3>";
                throw new Exception('Нет такой сущности в БД');
            } else {
                return pg_fetch_all($query);
            }
        }

    public function getLastObject($table)
    {
        $query = pg_query($this->connection, "SELECT id FROM $table order by id desc");
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

    public function where($key, $value): Query
    {
        $this->where = "WHERE $key = '$value'";
        return $this;
    }

}