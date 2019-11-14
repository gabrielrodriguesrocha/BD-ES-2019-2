<?php

function getDados ($opc) {
  
    $mes = "";
    switch($opc){
        case 1:
            $mes = "pr.datahora>='2019-01-01 00:00:00' and pr.datahora<'2019-02-01 00:00:00'";
        break;
        case 2:
            $mes = "pr.datahora>='2019-02-01 00:00:00' and pr.datahora<'2019-03-01 00:00:00'";
        break;
        case 3:
            $mes = "pr.datahora>='2019-03-01 00:00:00' and pr.datahora<'2019-04-01 00:00:00'";
        break;
        case 4:
            $mes = "pr.datahora>='2019-04-01 00:00:00' and pr.datahora<'2019-05-01 00:00:00'";
        break;
        case 5:
            $mes = "pr.datahora>='2019-05-01 00:00:00' and pr.datahora<'2019-06-01 00:00:00'";
        break;
        case 6:
            $mes = "pr.datahora>='2019-06-01 00:00:00' and pr.datahora<'2019-07-01 00:00:00'";
        break;
        case 7:
            $mes = "pr.datahora>='2019-07-01 00:00:00' and pr.datahora<'2019-08-01 00:00:00'";
        break;
        case 8:
            $mes = "pr.datahora>='2019-08-01 00:00:00' and pr.datahora<'2019-09-01 00:00:00'";
        break;
        case 9:
            $mes = "pr.datahora>='2019-09-01 00:00:00' and pr.datahora<'2019-10-01 00:00:00'";
        break;
        case 10:
            $mes = "pr.datahora>='2019-10-01 00:00:00' and pr.datahora<'2019-11-01 00:00:00'";
        break;
        case 11:
            $mes = "pr.datahora>='2019-11-01 00:00:00' and pr.datahora<'2019-12-01 00:00:00'";
        break;
        case 12:
            $mes = "pr.datahora>='2019-12-01 00:00:00' and pr.datahora<'2020-01-01 00:00:00'";
        break;

    }


    $conn = pg_connect("host=postgres dbname=labd user=postgres password=123456");

    //not in
    $result = pg_query($conn, "select nome from exame where nome not in (
    select exame as nome  from procedimentoexame pe, procedimento pr where pr.protocolo = pe.procedimento and ".$mes." group by exame
    )");
    if  (!$result) {
    echo "query did not execute";
    }
    if (pg_num_rows($result) == 0) {
    echo "0 records";
    }
    $resulta = array();
    $i=0;
    while ($row = pg_fetch_array($result)) {
    $resulta[$i]["Nome"] = $row['nome'];
    $resulta[$i]["Contagem"] = 0;
    $i=$i+1;
    }
    //in
    $result = pg_query($conn, "select exame as nome, count(exame) as contagem  from procedimentoexame pe, procedimento pr where pr.protocolo = pe.procedimento and ".$mes." group by exame");
    if  (!$result) {
    echo "query did not execute";
    }
    //if (pg_num_rows($result) == 0) {
   // echo "0 recordsss";
    //}

    while ($row = pg_fetch_array($result)) {
    $resulta[$i]["Nome"] = $row['nome'];
    $resulta[$i]["Contagem"] = $row['contagem'];
    $i=$i+1;
    }

    array_multisort( array_column($resulta, "Nome"), SORT_ASC, $resulta );
    //ar_dump($resulta);
    //echo $resulta;
    return $resulta;
}

?>