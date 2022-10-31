<?php 

namespace Framework\Src;

use App\Interfaces\Image;

class Model
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
}

?>