<?php

// Repository pattern
class FuncionarioRepository {
    private static $instance;
    private static $conn;
    private static $funcionariosStmt;
    private static $funcionariosSql = 'SELECT * FROM Funcionario ORDER BY ? LIMIT ? OFFSET ?';

    private static $funcionariosByNomeSql = 'SELECT * FROM Funcionario WHERE nome = ?';
    private static $funcionariosByNomeStmt;

    private static $funcionariosByCargoSql = 'SELECT * FROM Funcionario WHERE cargo = ?';
    private static $funcionariosByCargoStmt;

    private static $funcionariosByProcedimentoSql = 'SELECT username, cargo, nome, password, telefone1, telefone2 FROM Funcionario JOIN funcionarioprocedimento ON funcionarioprocedimento.funcionario = Funcionario.username WHERE funcionarioprocedimento.procedimento = ?';
    private static $funcionariosByProcedimentoStmt;

    private static $funcionarioByUsernameSql = 'SELECT * FROM Funcionario WHERE username = ?';
    private static $funcionarioByUsernameStmt;

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$funcionariosStmt = self::$conn->prepare(self::$funcionariosSql);
            self::$funcionariosByNomeStmt = self::$conn->prepare(self::$funcionariosByNomeSql);
            self::$funcionariosByCargoStmt = self::$conn->prepare(self::$funcionariosByCargoSql);
            self::$funcionarioByUsernameStmt = self::$conn->prepare(self::$funcionarioByUsernameSql);
            self::$funcionariosByProcedimentoStmt = self::$conn->prepare(self::$funcionariosByProcedimentoSql);
            self::$instance = new FuncionarioRepository();
        }
        return self::$instance;
    }

    public static function getByNome($nome) {
        self::$funcionariosByNomeStmt->execute([$nome]);
        $funcionarios = array();
        foreach (self::$funcionariosByNomeStmt->fetchAll() as &$funcionario) {
            array_push($funcionarios, self::create($funcionario));
        }
        return $funcionarios;
    }

    public static function getByCargo($cargo) {
        self::$funcionariosByCargoStmt->execute([$cargo]);
        $funcionarios = array();
        foreach (self::$funcionariosByCargoStmt->fetchAll() as &$funcionario) {
            array_push($funcionarios, self::create($funcionario));
        }
        return $funcionarios;
    }

    public static function getByUsername($username) {
        self::$funcionarioByUsernameStmt->execute([$username]);
        $funcionario = self::$funcionarioByUsernameStmt->fetch();

        return self::create($funcionario);
    }

    public static function getAll($limit, $offset, $orderBy = 'nome') {
        self::$funcionariosStmt->execute([$orderBy, $limit, $offset]);
        $funcionarios = array();
        foreach (self::$funcionariosStmt->fetchAll() as &$funcionario) {
            array_push($funcionarios, self::create($funcionario));
        }
        return $funcionarios;
    }

    public static function getByProcedimento($protocolo) {
        self::$funcionariosByProcedimentoStmt->execute([$protocolo]);
        $funcionarios = array();
        foreach (self::$funcionariosByProcedimentoStmt->fetchAll() as &$funcionario) {
            array_push($funcionarios, self::create($funcionario));
        }
        return $funcionarios;
    }

    public static function create($funcionario) {
        return new Funcionario($funcionario['username'], $funcionario['cargo'], $funcionario['nome'], $funcionario['password'], $funcionario['telefone1'], $funcionario['telefone2']);
    }

    public static function checkIfExists($usernames) {
        $questionMarks = str_repeat("?,", count($usernames)-1) . "?";
        $checkSql = "SELECT COUNT (*) FROM funcionario WHERE username IN (${questionMarks});";
        $checkStmt = self::$conn->prepare($checkSql);
        $checkStmt->execute($usernames);
        $count = $checkStmt->fetch()['count'];
        if ($count != count($usernames)) {
            throw new Exception("Algum dos funcionários informados não existe!");
        }
    }
}
?>