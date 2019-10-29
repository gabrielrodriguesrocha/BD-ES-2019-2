<?php

session_start();

include('../util/splAndState.php');

$state->checkAccess(true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>Registros:</h4>
    <ul>
        <li><a href="exam.php">Exames</a></li>
        <li><a href="employee.php">Funcionários</a></li>
        <li><a href="patient.php">Pacientes</a></li>
        <li><a href="procedure.php">Procedimentos</a></li>
    </ul>

    <h4>Relatórios:</h4>
    <ul>
        <li><a href="monthly_report.php">Relatório mensal</a></li>
        <li><a href="periodic_report.php">Relatório periódico</a></li>
    </ul>
</body>
</html>