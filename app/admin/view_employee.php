<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$funcionarioRepository = FuncionarioRepository::getInstance();

$funcionario = $funcionarioRepository->getByUsername($_GET['username']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Funcionários</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>Funcionário</h4>
    <h5>Username:</h5>
    <?php include 'template/employee_info.php' ?>
</body>
</html>