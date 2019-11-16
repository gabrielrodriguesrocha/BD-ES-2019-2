<?php

class MonthlyReportService {
    private static $instance;
    private static $conn;

    private function __construct() {}

    public static function getInstance(){
        self::$conn = Connection::getInstance();
        if (!isset(self::$instance)) {
            self::$conn = Connection::getInstance();
            self::$instance = new MonthlyReportService();
        }
        return self::$instance;
    }

    public static function getDados ($opc) {
        $curDate = new DateTime();

        $startYear = $curDate->format('Y');
        $endYear = $opc == 12 ? $startYear + 1 : $startYear; // year edge case treatment

        $startMonth = $opc;
        $endMonth = $opc == 12 ? 1 : $opc + 1; // month edge case treatment

        $startDate = new DateTime("${startYear}-${startMonth}-01");
        $endDate = new DateTime("${endYear}-${endMonth}-01");

        $startDateString = $startDate->format('Y-m-d H:i:s');
        $endDateString = $endDate->format('Y-m-d H:i:s');

        $mes = "pr.datahora >= '".$startDateString."' and pr.datahora<'".$endDateString."'";

        //not in
        $result = self::$conn->query("select nome from exame where nome not in (
        select exame as nome  from procedimentoexame pe, procedimento pr where pr.protocolo = pe.procedimento and ".$mes." group by exame
        )");
        if  (!$result) {
        echo "query did not execute";
        }
        if ($result->rowCount() == 0) {
        echo "0 records";
        }
        $resulta = array();
        $i=0;
        while ($row = $result->fetch()) {
        $resulta[$i]["Nome"] = $row['nome'];
        $resulta[$i]["Contagem"] = 0;
        $i=$i+1;
        }
        //in
        $result = self::$conn->query("select exame as nome, count(exame) as contagem  from procedimentoexame pe, procedimento pr where pr.protocolo = pe.procedimento and ".$mes." group by exame");
        if  (!$result) {
        echo "query did not execute";
        }
        //if (pg_num_rows($result) == 0) {
       // echo "0 recordsss";
        //}

        while ($row = $result->fetch()) {
        $resulta[$i]["Nome"] = $row['nome'];
        $resulta[$i]["Contagem"] = $row['contagem'];
        $i=$i+1;
        }

        array_multisort( array_column($resulta, "Nome"), SORT_ASC, $resulta );
        //ar_dump($resulta);
        //echo $resulta;
        return $resulta;
    }
}

?>