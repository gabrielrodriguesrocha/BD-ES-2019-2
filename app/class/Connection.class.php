<?php
$dbuser = $_ENV['POSTGRES_USER'];
$dbpass = $_ENV['POSTGRES_PASS'];

// Singleton pattern
class Connection {
    private static $pdo;

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO("pgsql:host=postgres;dbname=exams", $dbuser, $dbpass);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$pdo;
    }
}
?>