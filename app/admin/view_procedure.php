<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$procedimentoRepository = ProcedimentoRepository::getInstance();

$procedimento = $procedimentoRepository->getByProtocolo($_GET['protocolo']);
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
    <hr/>
    <a href="edit_procedure.php?protocolo=<?php echo $procedimento->getProtocolo()?>">✏️ Editar<a/>
    <br/><br/>
    <a href="delete_procedure.php?protocolo=<?php echo $procedimento->getProtocolo()?>">❌ Excluir</a>
</body>
</html>