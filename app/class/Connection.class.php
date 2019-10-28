<?php

// Singleton pattern
class Connection {
    private static $conn;
    private static $pdo;
    private static $loginStmt;
    private static $dsn;
    private static $loginSql = 'SELECT username, password, employee FROM internal.users WHERE username = ?';

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$pdo)) {
            try {
                $dbuser = $_ENV['POSTGRES_USER'];
                $dbpass = $_ENV['POSTGRES_PASS'];
                $dsn = "pgsql:host=postgres;dbname=exams;user=$dbuser;password=$dbpass";
                self::$pdo = new PDO($dsn);
                self::$loginStmt = self::$pdo->prepare(self::$loginSql);
                self::$conn = new Connection();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$conn;
    }

    public static function fetchCredentials($username) {
        self::$loginStmt->execute([$username]);
        if (self::$loginStmt->rowCount() != 1)
            return FALSE;
        else
        return self::$loginStmt->fetch();
    }
}
?>