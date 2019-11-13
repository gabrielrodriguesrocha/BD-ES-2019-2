<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$procedimentoRepository = ProcedimentoRepository::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $procedimentoRepository->delete($_POST['protocolo']);
    header('location:/admin/procedure.php');
}
else {
    $procedimento = $procedimentoRepository->getByProtocolo($_GET['protocolo']);
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
    <h5>Protocolo:</h5>
    <p><?php echo $procedimento->getProtocolo(); ?></p>
    <h5>Data: </h5>
    <p><?php echo $procedimento->getDataHora() ?></p>
    <h5>Local:</h5>
    <p><?php echo $procedimento->getLocal(); ?></p>
    <h5>procedimento:</h5>
    <p><?php echo $procedimento->getPaciente(); ?></p>
    <h5>Exames:</h5>
    <p><?php echo $procedimento->getExames(); ?></p>
    <h5>Funcionario:</h5>
    <p><?php echo $procedimento->getFuncionario(); ?></p>
    <h5>Valor Total:</h5>
    <p><?php echo $procedimento->getValorTotal(); ?></p>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
        <input type="hidden" name="protocolo" value="<?php echo $_GET['protocolo']; ?>"/>
        <input type="submit" value="Confirmar exclusão"/>
    </form>
</body>
</html>