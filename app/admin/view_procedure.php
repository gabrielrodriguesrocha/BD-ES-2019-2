<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$procedimentoRepository = ProcedimentoRepository::getInstance();

$procedimentos = $procedimentoRepository->getByProtocolo($_GET['protocolo']);

$procedimento = $procedimentos[0];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Procedimentos</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>Procedimento</h4>
    <?php include 'template/procedure_info.php' ?>
</body>
</html>