<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$ProcedimentoRepository = ProcedimentoRepository::getInstance();

include('template/pagination_header.php');

if (isset($_GET['searchValue'])) {
    if ($_GET['searchAttribute'] == 'protocolo') {
        $procedimentos = array($ProcedimentoRepository->getByProtocolo($_GET['searchValue']));
    }
    else {
        $procedimentos = array($ProcedimentoRepository->getByUsername($_GET['searchValue']));
    }
}
else
  $procedimentos = $ProcedimentoRepository->getAll($limit, $offset);

$pageCount = ceil (count($procedimentos) / $limit);
if ($currentPage > $pageCount) {
  $currentPage = $pageCount;
}

if ($currentPage < 1) {
  $currentpage = 1;
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
    <h4>Procedimentos</h4>
    <form>
      <input type="text" name="searchValue">
      
      <select id = "searchAttribute" name = "searchAttribute">
        <option value = "nome" name = "nome">Nome</option>
        <option value = "protocolo" name = "nome">Protocolo</option>
      </select>
     
      <input type="submit" value="Buscar" />
    </form>
    <table>
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Data</th>
                <th>Local</th>
                <th>Paciente</th>
                <th>Funcionario</th>
                <th>Valor Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($procedimentos as &$procedimento): ?>
            <tr>
                <td><a href="view_procedure.php?protocolo=<?php echo $procedimento->getProtocolo(); ?>"><?php echo $procedimento->getProtocolo(); ?></a></td>
                <td><?php echo $procedimento->getDataHora() ?></td>
                <td><?php echo $procedimento->getLocal() ?></td>
                <td><?php echo $procedimento->getPaciente() ?></td>
                <td><?php echo $procedimento->getFuncionario() ?></td>
                <td><?php echo $procedimento->getValorTotal() ?></td>
                <td> <a href="delete_procedure.php?protocolo=<?php echo $procedimento->getProtocolo()?>" style="text-decoration: none">❌</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  <?php include 'template/pagination_footer.php' ?>
</body>
</html>