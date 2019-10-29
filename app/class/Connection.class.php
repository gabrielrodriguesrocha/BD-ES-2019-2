<?php

// Singleton pattern
class Connection {
    private static $pdo;
    private static $dsn;

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$pdo)) {
            try {
                $dbuser = $_ENV['POSTGRES_USER'];
                $dbpass = $_ENV['POSTGRES_PASS'];
                $db = $_ENV['POSTGRES_DB'];
                $dsn = "pgsql:host=postgres;dbname=$db;user=$dbuser;password=$dbpass";
                self::$pdo = new PDO($dsn);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$pdo;
    }
}
?>