<?php

session_start();

include('util/splAndState.php');

$state->checkAccess(false);

$procedimentoRepository = ProcedimentoRepository::getInstance();

$userProcs = $procedimentoRepository->getByUsername($_SESSION['username']);

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
    <h4>Meus exames</h4>
    <table>
  <thead>
    <tr>
      <th>Protocolo</th>
      <th>Data/Hora</th>
      <th>Local</th>
      <th>Funcionário resp.</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($userProcs as &$proc): ?>
    <tr>
        <td><a href="<?php echo "user_procedure.php?protocolo=".$proc->getProtocolo(); ?>"><?php echo $proc->getProtocolo(); ?></a></td>
        <td><?php echo $proc->getDataHora()->format('Y-m-d H:i:s'); ?></td>
        <td><?php echo $proc->getLocal(); ?></td>
        <td><?php echo $proc->getFuncionario()->getNome(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</body>
</html>