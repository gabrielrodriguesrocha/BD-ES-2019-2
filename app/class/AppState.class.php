<?php

// Facade pattern
class AppState {
    private static $state;
    private static $conn;

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$pdo)) {
            try {
                self::$state = new AppState();
                self::$conn = Connection::getInstance();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$state;
    }

    public static function attemptLogin($username, $password) {

        if (!$username || !$password) { // Empty username or password
            $loginError = 'É necessário fornecer usuário e senha';
        }
        else {
            $pHash = hash('sha256', $password);
            $record = self::$conn->fetchCredentials($username, $pHash);
            if (!$record ||
                !($record['username'] === $username) ||
                !($record['password'] === $pHash)) { // Wrong user or pass
                $loginError = 'Usuário ou senha incorretos';
            }
            else {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $pHash;
                $_SESSION['employee'] = $record['employee'];
                if ($_SESSION['employee'])
                    header('location:admin/');
                else
                    header('location:user.php');
            }
        }

        return($loginError);
    }

    public static function attemptLogout() {
        session_start();
        session_destroy();
        header('location:/');
    }

    function checkAccess($employee) {
        $employeeRestriction = $employee ? $_SESSION['employee'] === true : true;
        $result = (isset($_SESSION['username']) &&
                   isset($_SESSION['password']) &&
                   $employeeRestriction);
                
        if (!$result && $employee)
        {
            if ($employee)
                header("location: ../index.php");
            else
                header("location: index.php");
          die();
        }
    }
}
?>