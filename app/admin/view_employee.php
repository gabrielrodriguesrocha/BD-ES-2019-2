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
    <p><?php echo $funcionario->getUsername(); ?></p>
    <h5>Nome: </h5>
    <p><?php echo $funcionario->getNome(); ?></p>
    <h5>Cargo: </h5>
    <p><?php echo $funcionario->getCargo(); ?></p>
    <h5>Telefones: </h5>
    <p><?php echo $funcionario->getTelefone1(); ?></p>
    <p><?php echo $funcionario->getTelefone2(); ?></p>
</body>
</html>