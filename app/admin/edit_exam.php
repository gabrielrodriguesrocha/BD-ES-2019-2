<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$exameRepository = ExameRepository::getInstance();

if (isset($_GET['nome']))
    $exame = $exameRepository->getByNome($_GET['nome']);
else
    $exame = new Exame('', '', array(), array());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$_POST['nome'])
        $errorMsg = "Nome é obrigatório!";
    else if (!$_POST['valor'])
        $errorMsg = "Valor é obrigatório!";
    else {
        $restricoes = explode(";", $_POST['restricoes']);
        $competencias = explode(";", $_POST['competencias']);
        $exame = new Exame($_POST['nome'], $_POST['valor'], $restricoes, $competencias);
        if ($_POST['update']) {
            $exameRepository->update($exame);
        }
        else {
            $exameRepository->insert($exame);
        }
        header('location:edit_exam.php?nome='.$exame->getNome());
    }
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
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <label>Nome: </label>
        <input type="text" name="nome" id="nome" value="<?php echo $exame->getNome();?>" <?php if (isset($_GET['nome'])) echo 'disabled' ?>/><br/>
        <label>Valor:</label>
        <input type="number" step="any" name="valor" id="valor" value="<?php echo $exame->getValor();?>"/><br/>
        <label>Restrições:</label>
        <input type="text" name="restricoes" id="restricoes" value="<?php foreach ($exame->getRestricoes() as &$restricao) { echo $restricao.';'; } ?>"/><br/>
        <label>Competências:</label>
        <input type="text" name="competencias" id="competencias" value="<?php foreach ($exame->getCompetencias() as &$competencia) { echo $competencia.';'; } ?>"/><br/>
        <input type="hidden" name="update" value="<?php echo isset($_GET['nome']); ?>"/>
        <?php if (isset($errorMsg)) { echo "<span style='color:red;'>${errorMsg}</span><br>"; } ?>
        <input type="submit" value="Salvar" />
    </form>
</body>
</html>