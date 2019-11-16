<?php

session_start();

include('../util/splAndState.php');

$state->checkAccess(true);

$funcionarioRepository = FuncionarioRepository::getInstance();

include('template/pagination_header.php');

if (isset($_GET['searchValue'])) {
    if ($_GET['searchAttribute'] == 'nome')
        $funcionarios = $funcionarioRepository->getByNome($_GET['searchValue']);
    else if ($_GET['searchAttribute'] == 'cargo')
        $funcionarios = $funcionarioRepository->getByCargo($_GET['searchValue']);
    else if ($_GET['searchAttribute'] == 'username')
        $funcionarios = array($funcionarioRepository->getByUsername($_GET['searchValue']));
}
else {
    $funcionarios = $funcionarioRepository->getAll($limit, $offset);
}

$pageCount = ceil (count($funcionarios) / $limit);
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
    <title>Funcionários</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>Funcionários</h4>
    <form>
      <input type="text" name="searchValue">
      
      <select id = "searchAttribute" name = "searchAttribute">
        <option value = "nome" name = "nome">Nome</option>
        <option value = "cargo" name = "cargo">Cargo</option>
        <option value = "username" name = "username">Username</option>
      </select>
     
      <input type="submit" value="Buscar" />
    </form>
    <table>
    <thead>
    <tr>
      <th>Username</th>
      <th>Nome</th>
      <th>Cargo</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($funcionarios as &$funcionario): ?>
    <tr>
        <td><a href="view_employee.php?username=<?php echo $funcionario->getUsername(); ?>"><?php echo $funcionario->getUsername(); ?></a></td>
        <td><?php echo $funcionario->getNome(); ?></td>
        <td><?php echo $funcionario->getCargo(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
    </table>
    <?php include 'template/pagination_footer.php' ?>
</body>
</html>