<?php

// Repository pattern
class PacienteRepository {
    private static $instance;
    private static $conn;

    private static $pacientesSql = 'SELECT * FROM Paciente ORDER BY ? LIMIT ? OFFSET ?';
    private static $pacientesStmt;

    private static $pacienteByUsernameSql = 'SELECT * FROM Paciente WHERE username = ?';
    private static $pacienteByUsernameStmt;

    private static $pacientesByNomeSql = 'SELECT * FROM Paciente WHERE nome = ?';
    private static $pacientesByNomeStmt;

    private static $pacientesByPasswordSql = 'SELECT * FROM Paciente WHERE password = ?';
    private static $pacientesByPasswordStmt;

    private static $pacienteByCPFSql = 'SELECT * FROM Paciente WHERE cpf = ?';
    private static $pacienteByCPFStmt;

    private static $pacientesByEnderecoSql = 'SELECT * FROM Paciente WHERE endereco = ?';
    private static $pacientesByEnderecoStmt;

    private static $pacientesByNascimentoSql = 'SELECT * FROM Paciente WHERE nascimento = ?';
    private static $pacientesByNascimentoStmt;

    private static $pacientesBySexoSql = 'SELECT * FROM Paciente WHERE sexo = ?';
    private static $pacientesBySexoStmt;

    private static $pacientesByEmail1Sql = 'SELECT * FROM Paciente WHERE email1 = ?';
    private static $pacientesByEmail1Stmt;

    private static $pacientesByEmail2Sql = 'SELECT * FROM Paciente WHERE email2 = ?';
    private static $pacientesByEmail2Stmt;

    private static $pacientesByTelefone1Sql = 'SELECT * FROM Paciente WHERE telefone1 = ?';
    private static $pacientesByTelefone1Stmt;

    private static $pacientesByTelefone2Sql = 'SELECT * FROM Paciente WHERE telefone2 = ?';
    private static $pacientesByTelefone2Stmt;

    private static $pacientesByPassaporteSql = 'SELECT * FROM Paciente WHERE passaporte = ?';
    private static $pacientesByPassaporteStmt;

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$pacientesStmt = self::$conn->prepare(self::$pacientesSql);
            self::$pacienteByUsernameStmt = self::$conn->prepare(self::$pacienteByUsernameSql);
            self::$pacientesByNomeStmt = self::$conn->prepare(self::$pacientesByNomeSql);
            self::$pacientesByPasswordStmt = self::$conn->prepare(self::$pacientesByPasswordSql);
            self::$pacienteByCPFStmt = self::$conn->prepare(self::$pacienteByCPFSql);
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
        $pacientes = array();
        foreach (self::$pacientesByNomeStmt->fetchAll() as &$paciente) {
            array_push($pacientes, self::create($paciente));
        }

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

    public static function getByUsername($username) {
        self::$pacienteByUsernameStmt->execute([$username]);
        $paciente = self::$pacienteByUsernameStmt->fetch();
        return self::create($paciente);
    }

    public static function create($paciente) {
        return new Paciente($paciente['username'], $paciente['nome'], $paciente['password'],$paciente['cpf'], $paciente['endereco'], $paciente['nascimento'], $paciente['sexo'], $paciente['email1'], $paciente['email2'], $paciente['telefone1'], $paciente['telefone2'], $paciente['passaporte']);
    }

    public static function delete($username) {
        $deletePacienteSql = "DELETE FROM funcionarioprocedimento USING procedimento WHERE funcionarioprocedimento.procedimento = procedimento.protocolo AND procedimento.paciente = ?;";
        $deleteStmt = self::$conn->prepare($deletePacienteSql);
        $deleteStmt->execute([$username]);

        $deletePacienteSql = "DELETE FROM procedimentoexame USING procedimento WHERE procedimentoexame.procedimento = procedimento.protocolo AND procedimento.paciente = ?;";
        $deleteStmt = self::$conn->prepare($deletePacienteSql);
        $deleteStmt->execute([$username]);

        $deletePacienteSql = "DELETE FROM procedimento WHERE paciente = ?;";
        $deleteStmt = self::$conn->prepare($deletePacienteSql);
        $deleteStmt->execute([$username]);

        $deletePacienteSql = "DELETE FROM Paciente WHERE username = ?";
        $deleteStmt = self::$conn->prepare($deletePacienteSql);
        $deleteStmt->execute([$username]);
    }

    public static function insert($paciente) {
        $insertPacienteSql = 'INSERT INTO Paciente VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $insertStmt = self::$conn->prepare($insertPacienteSql);

        $insertStmt->execute([$paciente->getUsername(), $paciente->getNome(), $paciente->getPassword(),$paciente->getCpf(), $paciente->getEndereco(), $paciente->getNascimento(), $paciente->getSexo(), $paciente->getEmail1(), $paciente->getEmail2(), $paciente->getTelefone1(), $paciente->getTelefone2(), $paciente->getPassaporte()]);
    }

    public static function update($paciente) {
        $updatePacienteSql = 'UPDATE Paciente SET nome = ?, password = ?, cpf = ?, endereco = ?, nascimento = ?, sexo = ?, email1 = ?, email2 = ?, telefone1 = ?, telefone2 = ?, passaporte = ? WHERE username = ?';

        $updateStmt = self::$conn->prepare($updatePacienteSql);

        $updateStmt->execute([$paciente->getNome(), $paciente->getPassword(),$paciente->getCpf(), $paciente->getEndereco(), $paciente->getNascimento(), $paciente->getSexo(), $paciente->getEmail1(), $paciente->getEmail2(), $paciente->getTelefone1(), $paciente->getTelefone2(), $paciente->getPassaporte(), $paciente->getUsername()]);
    }

    public static function validate($paciente, $update = false) {
        $obligatory = ['username', 'nome', 'cpf', 'password', 'endereco', 'nascimento', 'sexo', 'email1', 'telefone1'];
        foreach ($obligatory as &$field) {
            if (!$paciente[$field])
                throw new Exception(ucfirst($field)." é obrigatório!");
        }
        if (!$update) {
            self::checkIfDoesntExist($paciente['username']);
        }
    }

    public static function checkIfExists($username) {
        $checkSql = "SELECT COUNT (*) FROM paciente WHERE username = ?;";
        $checkStmt = self::$conn->prepare($checkSql);
        $checkStmt->execute([$username]);
        $count = $checkStmt->fetch()['count'];
        if (!$count){
            throw new Exception("Paciente informado não existe!");
        }
        return true;
    }

    public static function checkIfDoesntExist($username) {
        $checkSql = "SELECT COUNT (*) FROM paciente WHERE username = ?";
        $checkStmt = self::$conn->prepare($checkSql);
        $checkStmt->execute([$username]);
        $count = $checkStmt->fetch()['count'];
        if ($count) {
            throw new Exception("Paciente com username informado já existe!");
        }
        return true;
    }
}
?>