<?php

namespace Framework\Src\Database;

require_once('config.php');

class Database
{
    private static $instance;
    private $connection;
    private string $dbhost = DBHOST;
    private int $dbport = DBPORT;
    private string $dbname = DBNAME;
    private string $dbuser = DBUSER;
    private string $dbpass = DBPWD;

    public static function getInstance(): self
    {
        return self::$instance == null
            ? self::$instance = new self
            : self::$instance;
    }

    public function connect(): bool|\PgSql\Connection
    {
        return $this->connection == null
            ? $this->connection = pg_connect(
                "host=$this->dbhost 
                port=$this->dbport 
                dbname=$this->dbname 
                user=$this->dbuser 
                password=$this->dbpass")
            : $this->connection;
    }
}