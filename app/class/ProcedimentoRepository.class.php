<?php

// Repository pattern
class ProcedimentoRepository {
    private static $instance;
    private static $conn;
    private static $pacienteRepository;
    private static $exameRepository;
    private static $funcionarioRepository;

    private static $procedimentoStmt;
    private static $procedimentoSql = 'SELECT * FROM exame, procedimento, procedimentoexame, funcionarioprocedimento, paciente WHERE procedimento.protocolo = procedimentoexame.procedimento AND funcionarioprocedimento.procedimento = procedimento.protocolo AND paciente.username = procedimento.paciente AND exame.nome = procedimentoexame.exame ORDER BY ? LIMIT ? OFFSET ?';

    private static $procedimentosByPacienteStmt;
    private static $procedimentosByPacienteSql = 'SELECT * FROM exame, procedimento, procedimentoexame, funcionarioprocedimento, paciente WHERE paciente = ? AND procedimento.protocolo = procedimentoexame.procedimento AND funcionarioprocedimento.procedimento = procedimento.protocolo AND paciente.username = procedimento.paciente AND exame.nome = procedimentoexame.exame';

    private static $procedimentosByProtocoloStmt;
    private static $procedimentosByProtocoloSql = 'SELECT * FROM exame, procedimento, procedimentoexame, funcionarioprocedimento, paciente WHERE procedimento.protocolo = ? AND procedimento.protocolo = procedimentoexame.procedimento AND funcionarioprocedimento.procedimento = procedimento.protocolo AND paciente.username = procedimento.paciente AND exame.nome = procedimentoexame.exame';

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$procedimentoStmt = self::$conn->prepare(self::$procedimentoSql);
            self::$procedimentosByPacienteStmt = self::$conn->prepare(self::$procedimentosByPacienteSql);
            self::$procedimentosByProtocoloStmt = self::$conn->prepare(self::$procedimentosByProtocoloSql);
            self::$instance = new ProcedimentoRepository();
        }
        return self::$instance;
    }

    public static function getByPaciente($paciente) {
        // Mock code
        // if (empty($procedimentoSql)) {
        //     $paciente = new Paciente('user@site.com', 'João da Silva', '12345','512.291.247-56', 'R. dos Bobos, 123', '11-09-1975', 'Masculino', 'user@site.com', null, null, null, null);
        //     $exame = new Exame('HCT', 100, null, null);
        //     $funcionario = new Funcionario('admin@site.com', 'enfermeiro', 'José da Silva', '12345', '(326) 341-5663', '(521) 976-9767');
        //     $mockProcedimento1 = new Procedimento(123, new DateTime(), 'Sorocaba', $paciente, $exame, $funcionario, 'Resultado teste');
        //     return $mockProcedimento1;
        // }

        self::$procedimentosByPacienteStmt->execute([$paciente]);
        $procedimentos = array();
        foreach (self::$procedimentosByPacienteStmt->fetchAll() as &$procedimento) {
            array_push($procedimentos, self::create($procedimento));
        }

        return $procedimentos;
    }

    public static function getByProtocolo($protocolo) {
        // Mock code
        // if (empty($procedimentoSql)) {
        //     $paciente = new Paciente('user@site.com', 'João da Silva', '12345','512.291.247-56', 'R. dos Bobos, 123', '11-09-1975', 'Masculino', 'user@site.com', null, null, null, null);
        //     $exame = new Exame('HCT', 100, null, null);
        //     $funcionario = new Funcionario('admin@site.com', 'enfermeiro', 'José da Silva', '12345', '(326) 341-5663', '(521) 976-9767');
        //     $mockProcedimento1 = new Procedimento(123, new DateTime(), 'Sorocaba', $paciente, $exame, $funcionario, 'Resultado teste');
        //     return $mockProcedimento1;
        // }

        self::$procedimentosByProtocoloStmt->execute([$protocolo]);
        $procedimentos = array();
        foreach (self::$procedimentosByProtocoloStmt->fetchAll() as &$procedimento) {
            array_push($procedimentos, self::create($procedimento));
        }

        return $procedimentos; 
    }

    public static function getAll($limit, $offset, $orderBy = 'paciente') {
        self::$procedimentoStmt->execute([$orderBy, $limit, $offset]);
        $procedimentos = array();
        foreach (self::$procedimentoStmt->fetchAll() as &$procedimento) {
            array_push($procedimentos, self::create($procedimento));
        }
        return $procedimentos;
    }

    public static function create($procedimento) {
        return new Procedimento($procedimento['protocolo'], $procedimento['datahora'], $procedimento['local'], $procedimento['paciente'], $procedimento['exame'], $procedimento['funcionario'], $procedimento['resultado'], $procedimento['valor']);
    }

    public static function delete($protocolo) {
        $deleteProcedimentoSql = 'DELETE FROM funcionarioprocedimento WHERE procedimento = ?; DELETE FROM procedimentoexame WHERE procedimento = ?; DELETE FROM procedimento WHERE protocolo = ?;';

        $deleteStmt = self::$conn->prepare($deleteProcedimentoSql);

        $deleteStmt->execute([$procedimento->getProtocolo(), $procedimento->getProtocolo(), $procedimento->getProtocolo()]);
    }

    public static function insert($procedimento) {
        
        $insertAuxSql = "INSERT INTO paciente VALUES (?, ?, ?, null, null, '10-10-2019', null, ?, null, ?, null, null)";
        $insertAuxStmt = self::$conn->prepare($insertAuxSql);
        $insertAuxStmt->execute([$procedimento->getPaciente(), $procedimento->getPaciente(), $procedimento->getPaciente(), $procedimento->getPaciente(), $procedimento->getPaciente()]);
        
        $insertAuxSql = "INSERT INTO exame VALUES (?, ?)";
        $insertAuxStmt = self::$conn->prepare($insertAuxSql);
        $insertAuxStmt->execute([$procedimento->getExames(), $procedimento->getValorTotal()]);
        
        $insertAuxSql = "INSERT INTO procedimentoexame VALUES (?, ?)";
        $insertAuxStmt = self::$conn->prepare($insertAuxSql);
        $insertAuxStmt->execute([$procedimento->getProtocolo(), $procedimento->getExames()]);

        $insertAuxSql = "INSERT INTO funcionario VALUES (?, ?, ?, ?, '11234567', null)";
        $insertAuxStmt = self::$conn->prepare($insertAuxSql);
        $insertAuxStmt->execute([$procedimento->getFuncionario(), $procedimento->getFuncionario(), $procedimento->getFuncionario(), $procedimento->getFuncionario()]);
        
        $insertAuxSql = "INSERT INTO funcionarioprocedimento VALUES (?, ?)";
        $insertAuxStmt = self::$conn->prepare($insertAuxSql);
        $insertAuxStmt->execute([$procedimento->getFuncionario(), $procedimento->getProtocolo()]);
        

        $insertProcedimentoSql = 'INSERT INTO procedimento VALUES (?, ?, ?, ?, ?)';
        $insertStmt = self::$conn->prepare($insertProcedimentoSql);
        $insertStmt->execute([$procedimento->getProtocolo(), $procedimento->getPaciente(), $procedimento->getDataHora(),$procedimento->getLocal(), $procedimento->getResultado()]);
    }
}
?>