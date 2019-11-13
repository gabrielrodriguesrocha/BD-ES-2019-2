<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$pacienteRepository = PacienteRepository::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pacienteRepository->delete($_POST['nome']);
    header('location:/admin/patient.php');
}
else {
    $paciente = $pacienteRepository->getByNome($_GET['nome']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pacientes</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>Paciente</h4>
    <h5>Username:</h5>
    <p><?php echo $paciente->getUsername(); ?></p>
    <h5>Nome: </h5>
    <p><?php echo $paciente->getNome() ?></p>
    <h5>CPF:</h5>
    <p><?php echo $paciente->getSenha(); ?></p>
    <h5>Endereço:</h5>
    <p><?php echo $paciente->getEndereco(); ?></p>
    <h5>Nascimento:</h5>
    <p><?php echo $paciente->getNascimento(); ?></p>
    <h5>Sexo:</h5>
    <p><?php echo $paciente->getSexo(); ?></p>
    <h5>E-mail 1:</h5>
    <p><?php echo $paciente->getEmail1(); ?></p>
    <h5>E-mail 2:</h5>
    <p><?php echo $paciente->getEmail2(); ?></p>
    <h5>Passaporte:</h5>
    <p><?php echo $paciente->getPassaporte(); ?></p>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
        <input type="hidden" name="nome" value="<?php echo $_GET['nome']; ?>"/>
        <input type="submit" value="Confirmar exclusão"/>
    </form>
</body>
</html>