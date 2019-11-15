<?php

// Repository pattern
class ExameRepository {
    private static $instance;
    private static $conn;

    private static $examesSql = 'SELECT * FROM Exame ORDER BY ? LIMIT ? OFFSET ?';
    private static $examesStmt;

    private static $exameByNomeSql = 'SELECT * FROM Exame WHERE nome = ?';
    private static $exameByNomeStmt;

    private static $examesByProcedimentoSql = 'SELECT Exame.nome, Exame.valor FROM Exame JOIN ProcedimentoExame ON Exame.nome = ProcedimentoExame.exame WHERE ProcedimentoExame.procedimento = ?';
    private static $examesByProcedimentoStmt;

    private static $restricoesByExameSql = 'SELECT restricoes.restricao FROM restricoes WHERE restricoes.exame = ?';
    private static $restricoesByExameStmt;

    private static $competenciasByExameSql = 'SELECT competencias.competencia FROM competencias WHERE competencias.exame = ?';
    private static $competenciasByExameStmt;

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$exameByNomeStmt = self::$conn->prepare(self::$exameByNomeSql);
            self::$examesByProcedimentoStmt = self::$conn->prepare(self::$examesByProcedimentoSql);
            self::$restricoesByExameStmt = self::$conn->prepare(self::$restricoesByExameSql);
            self::$competenciasByExameStmt = self::$conn->prepare(self::$competenciasByExameSql);
            self::$examesStmt = self::$conn->prepare(self::$examesSql);
            self::$instance = new ExameRepository();
        }
        return self::$instance;
    }

    public static function getbyNome($nome) {
        // Mock code
        if (empty(self::$exameByNomeSql)) {
            $mockExame = new Exame('HCT', 0.5, null, null);
            return $mockExame;
        }

        self::$exameByNomeStmt->execute([$nome]);
        $exame = self::$exameByNomeStmt->fetch();

        return self::create($exame);

    }
    public static function getByProcedimento($procedimento) {
        // Mock code
        if (empty(self::$examesByProcedimentoSql)) {
            $mockExame = new Exame('HCT', 0.5, null, null);
            return array($mockExame);
        }
        if (is_object($procedimento)) {
            $procedimento = $procedimento->getProtocolo();
        }
        self::$examesByProcedimentoStmt->execute([$procedimento]);
        $exames = array();
        foreach (self::$examesByProcedimentoStmt->fetchAll() as &$exame) {
            array_push($exames, self::create($exame));
        }
        return $exames;
    }

    public static function getAll($limit, $offset, $orderBy = 'nome') {
        self::$examesStmt->execute([$orderBy, $limit, $offset]);
        $exames = array();
        foreach (self::$examesStmt->fetchAll() as &$exame) {
            array_push($exames, self::create($exame));
        }
        return $exames;
    }

    public static function create($exame, $getRestricoes = true, $getCompetencias = true) {
        $restricoes = null;
        $competencias = null;

        if ($getRestricoes) {
            self::$restricoesByExameStmt->execute([$exame['nome']]);
            $restricoes = self::$restricoesByExameStmt->fetchAll();
            $restricoes = array_map(function ($e) { return $e['restricao']; }, $restricoes);
        }

        if ($getCompetencias) {
            self::$competenciasByExameStmt->execute([$exame['nome']]);
            $competencias = self::$competenciasByExameStmt->fetchAll();
            $competencias = array_map(function ($e) { return $e['competencia']; }, $competencias);
        }

        return new Exame($exame['nome'], $exame['valor'], $restricoes, $competencias);
    }

    public static function insert($exame) {
        $insertExameSql = 'INSERT INTO Exame VALUES (?, ?)';
        $insertRestricoesSql = 'INSERT INTO Restricoes VALUES (?, ?)';
        $insertCompetenciasSql = 'INSERT INTO Competencias VALUES (?, ?)';

        $insertStmt = self::$conn->prepare($insertExameSql);
        $insertRestricoesStmt = self::$conn->prepare($insertRestricoesSql);
        $insertCompetenciasStmt = self::$conn->prepare($insertCompetenciasSql);

        //THIS HAS TO BE TRANSACTIONAL!
        self::$conn->beginTransaction();
        $insertStmt->execute([$exame->getNome(), $exame->getValor()]);
        foreach ($exame->getRestricoes() as &$restricao) {
            if (!empty($restricao))
                $insertRestricoesStmt->execute([$restricao, $exame->getNome()]);
        }
        foreach ($exame->getCompetencias() as &$competencia) {
            if (!empty($competencia))
                $insertCompetenciasStmt->execute([$competencia, $exame->getNome()]);
        }
        self::$conn->commit();
    }

    public static function update($exame) {
        self::delete($exame);
        self::insert($exame);
    }

    public static function delete($exame) {
        $deleteExameSql = 'DELETE FROM Exame WHERE Exame.nome = ?';
        $deleteRestricoesSql = 'DELETE FROM Restricoes WHERE Restricoes.exame = ?';
        $deleteCompetenciasSql = 'DELETE FROM Competencias WHERE Competencias.exame = ?';

        $deleteStmt = self::$conn->prepare($deleteExameSql);
        $deleteRestricoesStmt = self::$conn->prepare($deleteRestricoesSql);
        $deleteCompetenciasStmt = self::$conn->prepare($deleteCompetenciasSql);

        //THIS HAS TO BE TRANSACTIONAL!
        self::$conn->beginTransaction();
        $deleteRestricoesStmt->execute([$exame->getNome()]);
        $deleteCompetenciasStmt->execute([$exame->getNome()]);
        $deleteStmt->execute([$exame->getNome()]);
        self::$conn->commit();
    }
}
?>