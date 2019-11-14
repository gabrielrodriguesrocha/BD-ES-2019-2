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
    $paciente = $pacienteRepository->getByUsername($_GET['username']);
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
    <?php include 'template/patient_info.php' ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
        <input type="hidden" name="nome" value="<?php echo $_GET['nome']; ?>"/>
        <input type="submit" value="Confirmar exclusão"/>
    </form>
</body>
</html>