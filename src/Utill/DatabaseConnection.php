<?php
namespace Src\Utill;

class DatabaseConnection {

    private $dbConnection = null;

    public function __construct()
    {
        $host = 'localhost';
        $port = '8888';
        $db   = 'CurrencyFair';
        $user = 'root';
        $pass = 'root';

        try {
            $this->dbConnection = new \PDO(
                "mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db",
                $user,
                $pass
            );
            $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            exit($e->getMessage());

        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}