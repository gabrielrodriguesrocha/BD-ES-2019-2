<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$pacienteRepository = PacienteRepository::getInstance();

$paciente = $pacienteRepository->getByUsername($_GET['username']);
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
    <?php include 'template/patient_info.php' ?>
</body>
</html>