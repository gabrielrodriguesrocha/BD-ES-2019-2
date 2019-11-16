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

        list ($startYear, $startDay, $startMonth) = explode ('-', $startDateString);
        list ($endYear, $endDay, $endMonth) = explode ('-', $endDateString);

        $sql = "
        select (a.contagem/(c.pac+1)) as contagem from (select count(b.exame) contagem from procedimento p, procedimentoexame b 
            where p.protocolo = b.procedimento 
            and datahora >= '${startYear}-${startMonth}-${startDay}' 
            and datahora < '${endYear}-${endMonth}-${endDay}') as a, 
            (select count (distinct paciente) pac from procedimento 
                where datahora >= '${startYear}-${startMonth}-${startDay}' 
                and datahora <'${endYear}-${endMonth}-${endDay}') as c";

        $result = self::$conn->query($sql)->fetch();
        return $result['contagem'];


    }
}

?>