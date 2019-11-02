<?php

// Repository pattern
class PacienteRepository {
    private static $instance;
    private static $conn;
    private static $pacienteStmt;
    private static $pacienteSql = '';

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$pacienteStmt = self::$conn->prepare(self::$procedimentoSql);
            self::$instance = new PacienteRepository();
        }
        return self::$instance;
    }

    public static function getByUsername($username) {
        // Mock code
        if (empty($pacienteSql)) {
            $mockPaciente = new Paciente('user@site.com', 'João da Silva', '512.291.247-56', 'R. dos Bobos, 123', '11-09-1975', 'Masculino', 'user@site.com', null, null);
            return array($mockPaciente);
        }
    }
}
?>