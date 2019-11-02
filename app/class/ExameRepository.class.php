<?php

// Repository pattern
class ExameRepository {
    private static $instance;
    private static $conn;
    private static $exameStmt;
    private static $exameSql = '';

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$exameStmt = self::$conn->prepare(self::$procedimentoSql);
            self::$instance = new ExameRepository();
        }
        return self::$instance;
    }

    public static function getByNome($nome) {
        // Mock code
        if (empty($exameSql)) {
            $mockExame = new Exame('HCT', 0.5, null, null);
            return $mockExame;
        }
    }
    public static function getByProcedimento($procedimento) {
        // Mock code
        if (empty($exameSql)) {
            $mockExame = new Exame('HCT', 0.5, null, null);
            return array($mockExame);
        }
    }

    public static function create() {
        //
    }

    public static function insert($exame) {
        //
    }

    public static function update($exame) {
        //
    }

    public static function delete($exame) {
        //
    }
}
?>