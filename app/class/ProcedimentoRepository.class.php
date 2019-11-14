<?php

// Repository pattern
class ProcedimentoRepository {
    private static $instance;
    private static $conn;
    private static $pacienteRepository;
    private static $exameRepository;
    private static $funcionarioRepository;

    private static $procedimentoStmt;
    private static $procedimentoSql = 'SELECT * FROM procedimento ORDER BY ? LIMIT ? OFFSET ?';

    private static $procedimentosByUsernameStmt;
    private static $procedimentosByUsernameSql = 'SELECT * FROM procedimento, procedimentoexame, funcionarioprocedimento, paciente WHERE paciente.username = ? AND procedimento.protocolo = procedimentoexame.procedimento AND funcionarioprocedimento.procedimento = procdimento.protocolo AND paciente.username = procedimento.paciente';

    private static $procedimentosByProtocoloStmt;
    private static $procedimentosByProtocoloSql = 'SELECT * FROM procedimento, procedimentoexame, funcionarioprocedimento, paciente WHERE paciente.protocolo = ? AND procedimento.protocolo = procedimentoexame.procedimento AND funcionarioprocedimento.procedimento = procdimento.protocolo AND paciente.username = procedimento.paciente';

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$procedimentoStmt = self::$conn->prepare(self::$procedimentoSql);
            self::$procedimentosByUsernameStmt = self::$conn->prepare(self::$procedimentosByUsernameSql);
            self::$instance = new ProcedimentoRepository();
        }
        return self::$instance;
    }

    public static function getByUsername($username) {
        // Mock code
        if (empty($procedimentoSql)) {
            $paciente = new Paciente('user@site.com', 'João da Silva', '12345','512.291.247-56', 'R. dos Bobos, 123', '11-09-1975', 'Masculino', 'user@site.com', null, '11998765426',null,null);
            $exame = new Exame('HCT', 100, null, null);
            $funcionario = new Funcionario('admin@site.com', 'enfermeiro', 'José da Silva', '12345', '(326) 341-5663', '(521) 976-9767');
            $mockProcedimento1 = new Procedimento(123, new DateTime(), 'Sorocaba', $paciente, $exame, $funcionario,NULL);
            return $mockProcedimento1;
        }

        self::$procedimentosByUsernameStmt->execute([$username]);
        $procedimentos = array();
        foreach (self::$procedimenosByUsernameStmt->fetchAll() as &$procedimento) {
            array_push($procedimentos, self::create($procedimento));
        }

        return self::create($procedimento);
    }

    public static function getByProtocolo($protocolo) {
        // Mock code
        if (empty($procedimentoSql)) {
            $paciente = new Paciente('user@site.com', 'João da Silva', '12345','512.291.247-56', 'R. dos Bobos, 123', '11-09-1975', 'Masculino', 'user@site.com', null, '11998765426',null,null);
            $exame = new Exame('HCT', 100, null, null);
            $funcionario = new Funcionario('admin@site.com', 'enfermeiro', 'José da Silva', '12345', '(326) 341-5663', '(521) 976-9767');
            $mockProcedimento1 = new Procedimento(123, new DateTime(), 'Sorocaba', $paciente, $exame, $funcionario,NULL);
            return $mockProcedimento1;
        }

        self::$procedimentosByProtocoloStmt->execute([$protocolo]);
        $procedimentos = array();
        foreach (self::$procedimenosByProtocoloStmt->fetchAll() as &$procedimento) {
            array_push($procedimentos, self::create($procedimento));
        }

        return self::create($procedimento);
    }

    public static function getAll($limit, $offset, $orderBy = 'nome') {
        self::$procedimentoStmt->execute([$orderBy, $limit, $offset]);
        $procedimentos = array();
        foreach (self::$procedimentoStmt->fetchAll() as &$procedimento) {
            array_push($procedimento, self::create($procedimento));
        }
        return$procedimentos;
    }

    public static function create($procedimento) {
        return new Procedimento($procedimento['protocolo'], $procedimento['dataHora'], $procedimento['local'], $procedimento['paciente'], $procedimento['exames'], $procedimento['funcionario'], $procedimento['resultado']);
    }

    public static function delete($procedimento) {
        $deleteProcedimentoSql = 'DELETE FROM procedimento WHERE procedimento.protocolo = ?';

        $deleteStmt = self::$conn->prepare($deleteProcedimentoSql);

        $deleteStmt->execute([$username]);
    }
}
?>