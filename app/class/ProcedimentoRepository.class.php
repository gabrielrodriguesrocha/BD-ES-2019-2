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

    private static $procedimentosByPacienteStmt;
    private static $procedimentosByPacienteSql = 'SELECT * FROM procedimento WHERE paciente = ?';

    private static $procedimentoByProtocoloStmt;
    private static $procedimentoByProtocoloSql = 'SELECT * FROM procedimento WHERE procedimento.protocolo = ?';

    private function __construct() {}

    public static function getInstance(){
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$funcionarioRepository = FuncionarioRepository::getInstance();
            self::$exameRepository = ExameRepository::getInstance();
            self::$pacienteRepository = PacienteRepository::getInstance();
            self::$procedimentoStmt = self::$conn->prepare(self::$procedimentoSql);
            self::$procedimentosByPacienteStmt = self::$conn->prepare(self::$procedimentosByPacienteSql);
            self::$procedimentoByProtocoloStmt = self::$conn->prepare(self::$procedimentoByProtocoloSql);
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

        self::$procedimentoByProtocoloStmt->execute([$protocolo]);
        $procedimento = self::$procedimentoByProtocoloStmt->fetch();
        return self::create($procedimento);
    }

    public static function getAll($limit, $offset, $orderBy = 'paciente') {
        self::$procedimentoStmt->execute([$orderBy, $limit, $offset]);
        $procedimentos = array();
        foreach (self::$procedimentoStmt->fetchAll() as &$procedimento) {
            array_push($procedimentos, self::create($procedimento));
        }
        return $procedimentos;
    }

    public static function create($procedimento, $getPaciente = true, $getExames = true, $getFuncionarios = true) {
        if($getExames) {
            $exames = self::$exameRepository->getByProcedimento($procedimento['protocolo']);
        }
        if($getPaciente) {
            $paciente = self::$pacienteRepository->getByUsername($procedimento['paciente']);
        }
        if($getFuncionarios) {
            $funcionarios = self::$funcionarioRepository->getByProcedimento($procedimento['protocolo']);
        }

        if (!isset($procedimento['valor'])) {
            $procedimento['valor'] = 0;
        }

        return new Procedimento($procedimento['protocolo'], $procedimento['datahora'], $procedimento['local'], $paciente, $exames, $funcionarios, $procedimento['resultado'], $procedimento['valor']);
    }

    public static function delete($protocolo) {
        $deleteProcedimentoFuncionarioSql = 'DELETE FROM funcionarioprocedimento WHERE procedimento = ?';
        $deleteProcedimentoExameSql = 'DELETE FROM procedimentoexame WHERE procedimento = ?';
        $deleteProcedimentoSql = 'DELETE FROM procedimento WHERE protocolo = ?';

        $deleteStmt = self::$conn->prepare($deleteProcedimentoSql);
        $deleteExStmt = self::$conn->prepare($deleteProcedimentoExameSql);
        $deleteFuStmt = self::$conn->prepare($deleteProcedimentoFuncionarioSql);

        self::$conn->beginTransaction();
        $deleteExStmt->execute([$protocolo]);
        $deleteFuStmt->execute([$protocolo]);
        $deleteStmt->execute([$protocolo]);
        self::$conn->commit();
    }

    public static function insert($procedimento, $exames, $funcionarios) {
        $insertAuxSql = "INSERT INTO procedimentoexame VALUES (?, ?)";
        $insertAuxStmt = self::$conn->prepare($insertAuxSql);
        foreach ($exames as &$exame) {
            $insertAuxStmt->execute([$procedimento->getProtocolo(), $exame]);
        }

        $insertAuxSql = "INSERT INTO funcionarioprocedimento VALUES (?, ?)";
        $insertAuxStmt = self::$conn->prepare($insertAuxSql);
        foreach ($funcionarios as &$funcionario) {
            $insertAuxStmt->execute([$procedimento->getProtocolo(), $funcionario]);
        }


        $insertProcedimentoSql = 'INSERT INTO procedimento VALUES (?, ?, ?, ?, ?)';
        $insertStmt = self::$conn->prepare($insertProcedimentoSql);
        $insertStmt->execute([$procedimento->getProtocolo(), $procedimento->getPaciente()->getUsername(), $procedimento->getDataHora(),$procedimento->getLocal(), $procedimento->getResultado()]);
    }

    public static function update($procedimento, $exames, $funcionarios) {
        self::$conn->beginTransaction();
        self::delete($procedimento->getProtocolo());
        self::insert($procedimento, $exames, $funcionarios);
        self::$conn->commit();
    }

    public static function validate($procedimento, $funcionarios, $exames) {
        $obligatory = ['protocolo', 'datahora', 'local', 'paciente', 'resultado'];
        foreach ($obligatory as &$field) {
            if (!$procedimento[$field])
                throw new Exception(ucfirst($field)." é obrigatório!");
        }
        self::$pacienteRepository->checkIfExists($procedimento['paciente']);
        self::$funcionarioRepository->checkIfExists($funcionarios);
        self::$exameRepository->checkIfExists($exames);
    }
}
?>