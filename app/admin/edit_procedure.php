<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$procedimentoRepository = ProcedimentoRepository::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $procedimento = new Procedimento($_POST['protocolo'], $_POST['dataHora'], $_POST['local'], $_POST['paciente'], $_POST['exames'], $_POST['funcionario'],  $_POST['resultado'], $_POST['valor']);
    $procedimentoRepository->insert($procedimento);
}
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
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <label>Protocolo: </label>
        <input type="text" name="protocolo" id="protocolo" value=""/><br/>
        <label>Data: </label>
        <input type="text" name="dataHora" id="dataHora" value=""/><br/>
        <label>Local:</label>
        <input type="text" name="local" id="local" value=""/><br/>
        <label>Paciente: </label>
        <input type="text" name="paciente" id="paciente" value=""/><br/>
        <label>Exames: </label>
        <input type="text" name="exames" id="exames" value=""/><br/>
        <label>Funcionario: </label>
        <input type="text" name="funcionario" id="funcionario" value=""/><br/>
        <label>Resultado: </label>
        <input type="text" name="resultado" id="resultado" value=""/><br/>
        <label>Valor: </label>
        <input type="text" name="valor" id="valor" value=""/><br/>

        <input type="submit" value="Salvar" />
    </form>
</body>
</html>