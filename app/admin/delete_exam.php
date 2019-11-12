<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$exameRepository = ExameRepository::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $exameRepository->delete($_POST['nome']);
    header('location:/admin/exam.php');
}
else {
    $exame = $exameRepository->getByNome($_GET['nome']);
}
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
    <h5>Nome:</h5>
    <p><?php echo $exame->getNome(); ?></p>
    <h5>Valor: </h5>
    <p><?php echo $exame->getValor() ?></p>
    <h5>Restrições: </h5>
    <?php if ($exame->getRestricoes())
        foreach($exame->getRestricoes() as &$restricao): ?>
            <p><?php echo $restricao ?></p>
    <?php endforeach; ?>
    <h5>Competências: </h5>
    <?php if ($exame->getCompetencias())
        foreach($exame->getCompetencias() as &$competencia): ?>
            <p><?php echo $competencia ?></p>
    <?php endforeach; ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
        <input type="hidden" name="nome" value="<?php echo $_GET['nome']; ?>"/>
        <input type="submit" value="Confirmar exclusão"/>
    </form>
</body>
</html>