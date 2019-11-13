<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$pacienteRepository = pacienteRepository::getInstance();

if (isset($_GET['username']))
    $paciente = $pacienteRepository->getByUsername($_GET['nome']);
else
    $paciente = new Paciente('', '', '', '', '', '', '', '', '', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente = $pacienteRepository->create($_POST);
    if ($_POST['update']) {
        $pacienteRepository->update($paciente);
    }
    else {
        $pacienteRepository->insert($paciente);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pacientes</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>paciente</h4>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <label>Username: </label>
        <input type="text" name="username" id="username" value="<?php echo $paciente->getUsername();?>"/><br/>
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $paciente->getNome();?>"/><br/>
        <label>Password:</label>
        <input type="text" name="password" id="password" value="<?php echo $paciente->getPassword();?>"/><br/>
        <label>Endereço:</label>
        <input type="text" name="endereco" id="endereco" value="<?php echo $paciente->getEndereco();?>"/><br/>
        <label>Nascimento:</label>
        <input type="date" name="nascimento" id="nascimento" value="<?php echo $paciente->getNascimento();?>"/><br/>
        <label>Sexo:</label>
        <input type="text" name="sexo" id="sexo" value="<?php echo $paciente->getSexo();?>"/><br/>
        <label>Email principal:</label>
        <input type="text" name="email1" id="email2" value="<?php echo $paciente->getEmail1();?>"/><br/>
        <label>Email secundário:</label>
        <input type="text" name="email2" id="email2" value="<?php echo $paciente->getEmail2();?>"/><br/>
        <label>Passaporte:</label>
        <input type="text" name="passaporte" id="passaporte" value="<?php echo $paciente->getPassaporte();?>"/><br/>
        <input type="hidden" name="update" value="<?php echo isset($_GET['username']); ?>"/>
        <input type="submit" value="Salvar" />
    </form>
</body>
</html>