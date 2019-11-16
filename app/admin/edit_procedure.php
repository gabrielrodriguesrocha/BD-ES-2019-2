<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$procedimentoRepository = ProcedimentoRepository::getInstance();

if (!isset($_GET['protocolo'])) {
    $procedimento = new Procedimento(null, null, null, null, null, null, null);
} else {
    $procedimento = $procedimentoRepository->getByProtocolo($_GET['protocolo']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $funcionarios = explode(";", $_POST['funcionarios']);
        $exames = explode(";", $_POST['exames']);
        $procedimentoRepository->validate($_POST, $funcionarios, $exames, $_POST['update']);
        $procedimento = $procedimentoRepository->create($_POST, true, false, false);
        if ($_POST['update']) {
            $procedimentoRepository->update($procedimento, $exames, $funcionarios);
        }
        else {
            $procedimentoRepository->insert($procedimento, $exames, $funcionarios);
        }
        header('location:edit_procedure.php?protocolo='.$procedimento->getProtocolo());
    }
    catch (Exception $e) {
        $errorMsg = $e->getMessage();
    }
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
        <label>Protocolo*: </label>
        <input type="text" name="protocolo" id="protocolo" value="<?php echo $procedimento->getProtocolo(); ?>" <?php if (isset($_GET['protocolo'])) echo 'readonly="readonly"' ?>/><br/>
        <label>Data*: </label>
        <input type="text" name="datahora" id="datahora" value="<?php echo $procedimento->getDataHora(); ?>"/><br/>
        <label>Local*:</label>
        <input type="text" name="local" id="local" value="<?php echo $procedimento->getLocal(); ?>"/><br/>
        <label>Paciente*: </label>
        <input type="text" name="paciente" id="paciente" value="<?php echo $procedimento->getPaciente() ? $procedimento->getPaciente()->getUsername() : null; ?>"/><br/>
        <label>Exames*: </label>
        <input type="text" name="exames" id="exames" value="<?php if ($procedimento->getExames()) {foreach ($procedimento->getExames() as &$exame) { echo $exame->getNome().';'; } } ?>"/><br/>
        <label>Funcionários*: </label>
        <input type="text" name="funcionarios" id="funcionarios" value="<?php if ($procedimento->getFuncionarios()) {foreach ($procedimento->getFuncionarios() as &$funcionario) { echo $funcionario->getUsername().';'; } } ?>"/><br/>
        <label>Resultado*: </label>
        <input type="text" name="resultado" id="resultado" value="<?php echo $procedimento->getResultado(); ?>"/><br/>
        <input type="hidden" name="update" value="<?php echo isset($_GET['protocolo']); ?>"/>
        <?php if (isset($errorMsg)) { echo "<span style='color:red;'>${errorMsg}</span><br>"; } ?>
        <input type="submit" value="Salvar" />
    </form>
</body>
</html>