<?php

session_start();

include('util/splAndState.php');

$state->checkAccess(false);

$procedimentoRepository = ProcedimentoRepository::getInstance();

$userProcs = $procedimentoRepository->getByPaciente($_SESSION['username']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meus exames</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <table>
  <thead>
    <tr>
      <th>Protocolo</th>
      <th>Data/Hora</th>
      <th>Local</th>
      <th>Funcionários resp.</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($userProcs as &$proc): ?>
    <tr>
        <td><a href="<?php echo "user_procedure.php?protocolo=".$proc->getProtocolo(); ?>"><?php echo $proc->getProtocolo(); ?></a></td>
        <td><?php echo $proc->getDataHora(); ?></td>
        <td><?php echo $proc->getLocal(); ?></td>
        <td><?php foreach ($proc->getFuncionarios() as &$funcionario) { echo $funcionario->getNome(); }?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</body>
</html>