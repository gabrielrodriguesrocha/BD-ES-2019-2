<?php

// Repository pattern
class FuncionarioRepository {
    private static $instance;
    private static $conn;
    private static $funcionarioStmt;
    private static $funcionarioSql = '';

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$funcionarioStmt = self::$conn->prepare(self::$procedimentoSql);
            self::$instance = new FuncionarioRepository();
        }
        return self::$instance;
    }

    public static function getByUsername($username) {
        // Mock code
        if (empty($funcionarioSql)) {
            $mockFuncionario = new Funcionario('admin@site.com', 'enfermeiro', 'José da Silva', '(326) 341-5663', '(521) 976-9767');
            return array($mockFuncionario);
        }
    }
}
?>