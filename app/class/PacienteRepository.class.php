<?php

// Repository pattern
class PacienteRepository {
    private static $instance;
    private static $conn;

    private static $pacientesSql = 'SELECT * FROM paciente ORDER BY ? LIMIT ? OFFSET ?';
    private static $pacientesStmt;

    private static $pacientesByUserSql = 'SELECT * FROM paciente WHERE username = ?';
    private static $pacientesByUserStmt;

    private static $pacientesByNomeSql = 'SELECT * FROM paciente WHERE nome = ?';
    private static $pacientesByNomeStmt;

    private static $pacientesByPasswordSql = 'SELECT * FROM paciente WHERE password = ?';
    private static $pacientesByPasswordStmt;

    private static $pacientesByCPFSql = 'SELECT * FROM paciente WHERE cpf = ?';
    private static $pacientesByCPFStmt;

    private static $pacientesByEnderecoSql = 'SELECT * FROM paciente WHERE endereco = ?';
    private static $pacientesByEnderecoStmt;

    private static $pacientesByNascimentoSql = 'SELECT * FROM paciente WHERE nascimento = ?';
    private static $pacientesByNascimentoStmt;

    private static $pacientesBySexoSql = 'SELECT * FROM paciente WHERE sexo = ?';
    private static $pacientesBySexoStmt;

    private static $pacientesByEmail1Sql = 'SELECT * FROM paciente WHERE email1 = ?';
    private static $pacientesByEmail1Stmt;

    private static $pacientesByEmail2Sql = 'SELECT * FROM paciente WHERE email2 = ?';
    private static $pacientesByEmail2Stmt;

    private static $pacientesByTelefone1Sql = 'SELECT * FROM paciente WHERE telefone1 = ?';
    private static $pacientesByTelefone1Stmt;

    private static $pacientesByTelefone2Sql = 'SELECT * FROM paciente WHERE telefone2 = ?';
    private static $pacientesByTelefone2Stmt;

    private static $pacientesByPassaporteSql = 'SELECT * FROM paciente WHERE passaporte = ?';
    private static $pacientesByPassaporteStmt;

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$pacientesStmt = self::$conn->prepare(self::$pacientesSql);
            self::$pacientesByUserStmt = self::$conn->prepare(self::$pacientesByUserSql);
            self::$pacientesByNomeStmt = self::$conn->prepare(self::$pacientesByNomeSql);
            self::$pacientesByPasswordStmt = self::$conn->prepare(self::$pacientesByPasswordSql);
            self::$pacientesByCPFStmt = self::$conn->prepare(self::$pacientesByCPFSql);
            self::$pacientesByEnderecoStmt = self::$conn->prepare(self::$pacientesByEnderecoSql);
            self::$pacientesByNascimentoStmt = self::$conn->prepare(self::$pacientesByNascimentoSql);
            self::$pacientesBySexoStmt = self::$conn->prepare(self::$pacientesBySexoSql);
            self::$pacientesByEmail1Stmt = self::$conn->prepare(self::$pacientesByEmail1Sql);
            self::$pacientesByEmail2Stmt = self::$conn->prepare(self::$pacientesByEmail2Sql);
            self::$pacientesByTelefone1Stmt = self::$conn->prepare(self::$pacientesByTelefone1Sql);
            self::$pacientesByTelefone2Stmt = self::$conn->prepare(self::$pacientesByTelefone2Sql);
            self::$pacientesByPassaporteStmt = self::$conn->prepare(self::$pacientesByPassaporteSql);
            self::$instance = new PacienteRepository();
        }
        return self::$instance;
    }

    public static function getbyNome($nome) {
        // Mock code
        if (empty(self::$pacientesByNomeSql)) {
            $mockPaciente = new Paciente('HCT', 0.5, null, null, null, null, null);
            return $mockPaciente;
        }

        self::$pacientesByNomeStmt->execute([$nome]);
        $paciente = self::$pacientesByNomeStmt->fetch();

        return self::create($paciente);

    }

    public static function getAll($limit, $offset, $orderBy = 'nome') {
        self::$pacientesStmt->execute([$orderBy, $limit, $offset]);
        $pacientes = array();
        foreach (self::$pacientesStmt->fetchAll() as &$paciente) {
            array_push($pacientes, self::create($paciente));
        }
        return $pacientes;
    }

    public static function create($paciente) {
        return new Paciente($paciente['username'], $paciente['nome'], $paciente['cpf'], $paciente['endereco'], $paciente['nascimento'], $paciente['sexo'], $paciente['email1'], $paciente['email2'], $paciente['passaporte']);
    }

    public static function delete($username) {
        $deletePacienteSql = 'DELETE FROM paciente WHERE paciente.username = ?';

        $deleteStmt = self::$conn->prepare($deletePacienteSql);

        //THIS HAS TO BE TRANSACTIONAL!
        self::$conn->beginTransaction();
        $deleteStmt->execute([$username]);
        self::$conn->commit();
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