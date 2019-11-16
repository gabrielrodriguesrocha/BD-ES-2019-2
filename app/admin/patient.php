<?php

session_start();

include('../util/splAndState.php');

$state->checkAccess(true);

$PacienteRepository = PacienteRepository::getInstance();

include('template/pagination_header.php');

if (isset($_GET['searchValue']))
  $pacientes = array($PacienteRepository->getByNome($_GET['searchValue']));
else
  $pacientes = $PacienteRepository->getAll($limit, $offset);

$pageCount = ceil (count($pacientes) / $limit);
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
    <title>Pacientes</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>Pacientes</h4>
    <h5><a href="edit_patient.php">Novo paciente</a></h5>
    <form>
      <input type="text" name="searchValue">
      
      <select id = "searchAttribute" name = "searchAttribute">
        <option value = "nome" name = "nome">Nome</option>
        <option value = "cpf" name = "CPF">CPF</option>
      </select>
     
      <input type="submit" value="Buscar" />
    </form>
    <table>
    <thead>
    <tr>
      <th>Username</th>
      <th>Nome</th>
      <th>CPF</th>
      <th>Endereço</th>
      <th>Nascimento</th>
      <th>Sexo</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($pacientes as &$paciente): ?>
    <tr>
        <td><a href="view_patient.php?username=<?php echo $paciente->getUsername(); ?>"><?php echo $paciente->getUsername(); ?></a></td>
        <td><?php echo $paciente->getNome(); ?></td>
        <td><?php echo $paciente->getCpf(); ?></td>
        <td><?php echo $paciente->getEndereco(); ?></td>
        <td><?php echo $paciente->getNascimento(); ?></td>
        <td><?php echo $paciente->getSexo(); ?></td>
        <td> <a href="edit_patient.php?username=<?php echo $paciente->getUsername()?>" style="text-decoration: none">✏️</a></td>
        <td> <a href="delete_patient.php?username=<?php echo $paciente->getUsername()?>" style="text-decoration: none">❌</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
    </table>
  <?php include 'template/pagination_footer.php' ?>
</body>
</html>