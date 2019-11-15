<?php

class PeriodicReportService {
    private static $instance;
    private static $conn;

    private function __construct() {}

    public static function getInstance(){
        self::$conn = Connection::getInstance();
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$instance = new PeriodicReportService();
        }
        return self::$instance;
    }

    public static function getDados ($startDateString, $endDateString) {

        $sql = "
        select (a.contagem/(c.pac+1)) from (select count(b.exame) contagem from procedimento p, procedimentoexame b 
            where p.protocolo = b.procedimento 
            and datahora >= '${startDateString}' 
            and datahora <'${endDateString}') as a, 
            (select count (distinct paciente) pac from procedimento 
                where datahora >= '${startDateString}' 
                and datahora <'${endDateString}') as c";
    }
}

?>