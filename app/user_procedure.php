<?php

session_start();

include('util/splAndState.php');

$state->checkAccess(false);

$procedimentoRepository = ProcedimentoRepository::getInstance();

$currProc = $procedimentoRepository->getByProtocolo($_GET['protocolo']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Protocolo <?php echo $_GET['protocolo'] ?></title>
</head>
<body>
    <h4><a href="user.php">Voltar</a></h4>
    <h4>Procedimento de protocolo <?php echo $_GET['protocolo'] ?></h4>
    <ul>
        <li>Data/Hora: <?php echo $currProc->getDataHora()->format('Y-m-d H:i:s'); ?></li>
        <li>Local: <?php echo $currProc->getLocal(); ?></li>
        <li>Funcionário: <?php echo $currProc->getFuncionario()->getNome(); ?></li>
    </ul>
    <table>
    Exames:
  <thead>
    <tr>
      <th>Nome</th>
      <th>Valor</th>
      <th>Resultado</th>
      <th>Restrições</th>
      <th>Competências</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($currProc->getExames() as &$exame): ?>
    <tr>
        <td><?php echo $exame->getNome(); ?></td>
        <td><?php echo $exame->getValor() ?></td>
        <td><?php echo $exame->getResultado() ?></td>
        <td>
            <ul>
            <?php if ($exame->getRestricoes())
              foreach($exame->getRestricoes() as &$restricao): ?>
                <li><?php echo $restricao ?></li>
            <?php endforeach; ?>
            </ul>
        </td>
        <td>
            <ul>
            <?php if ($exame->getCompetencias())
              foreach($exame->getCompetencias() as &$competencia): ?>
                <li><?php echo $competencia ?></li>
            <?php endforeach; ?>
            </ul>
        </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</body>
</html>