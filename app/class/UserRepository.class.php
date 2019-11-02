<?php

// Repository pattern
class UserRepository {
    private static $instance;
    private static $conn;
    private static $loginStmt;
    private static $loginSql = 'SELECT username, password, employee FROM internal.users WHERE username = ?';

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$loginStmt = self::$conn->prepare(self::$loginSql);
            self::$instance = new UserRepository();
        }
        return self::$instance;
    }

    public static function getByUsername($username) {
        self::$loginStmt->execute([$username]);
        if (self::$loginStmt->rowCount() != 1)
            return FALSE;
        else
            return self::$loginStmt->fetch();
    }
}
?>