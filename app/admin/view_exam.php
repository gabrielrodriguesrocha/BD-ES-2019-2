<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$exameRepository = ExameRepository::getInstance();

$exame = $exameRepository->getByNome($_GET['nome']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exames</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>Exame</h4>
    <?php include 'template/exam_info.php' ?>
    <hr/>
    <a href="edit_exam.php?nome=<?php echo $exame->getNome()?>">✏️ Editar<a/>
    <br/><br/>
    <a href="delete_exam.php?nome=<?php echo $exame->getNome()?>">❌ Excluir</a>
</body>
</html>