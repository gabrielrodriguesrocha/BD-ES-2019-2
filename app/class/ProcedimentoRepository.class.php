<?php

// Repository pattern
class ProcedimentoRepository {
    private static $instance;
    private static $conn;
    private static $pacienteRepository;
    private static $exameRepository;
    private static $funcionarioRepository;
    private static $procedimentoStmt;
    private static $procedimentoSql = '';

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$procedimentoStmt = self::$conn->prepare(self::$procedimentoSql);
            self::$instance = new ProcedimentoRepository();
        }
        return self::$instance;
    }

    public static function getByUsername($username) {
        // Mock code
        if (empty($procedimentoSql)) {
            $paciente = new Paciente('user@site.com', 'João da Silva', '512.291.247-56', 'R. dos Bobos, 123', '11-09-1975', 'Masculino', 'user@site.com', null, null);
            $exame = new Exame(1, 'HCT', 100, null, null, '40.7 vol%');
            $funcionario = new Funcionario('admin@site.com', 'enfermeiro', 'José da Silva', '(326) 341-5663', '(521) 976-9767');
            $mockProcedimento1 = new Procedimento(123, new DateTime(), 'Sorocaba', $paciente, array($exame), $funcionario);
            return array($mockProcedimento1);
        }
    }

    public static function getByProtocolo($protocolo) {
        // Mock code
        if (empty($procedimentoSql)) {
            $paciente = new Paciente('user@site.com', 'João da Silva', '512.291.247-56', 'R. dos Bobos, 123', '11-09-1975', 'Masculino', 'user@site.com', null, null);
            $exame = new Exame(1, 'HCT', 100, null, null, '40.7 vol%');
            $funcionario = new Funcionario('admin@site.com', 'enfermeiro', 'José da Silva', '(326) 341-5663', '(521) 976-9767');
            $mockProcedimento1 = new Procedimento(123, new DateTime(), 'Sorocaba', $paciente, array($exame), $funcionario);
            return $mockProcedimento1;
        }
    }

    public static function create() {
        //
    }

    public static function insert($procedimento) {
        //
    }

    public static function update($procedimento) {
        //
    }

    public static function delete($procedimento) {
        //
    }
}
?>