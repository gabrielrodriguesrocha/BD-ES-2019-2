<?php

session_start();

include('../util/splAndState.php');

$state->checkAccess(true);

$exameRepository = ExameRepository::getInstance();

include('template/pagination_header.php');

if (isset($_GET['searchValue']) and $_GET['searchAttribute'] == 'nome')
  $exames = array($exameRepository->getByNome($_GET['searchValue']));
else
  $exames = $exameRepository->getAll($limit, $offset);

$pageCount = ceil (count($exames) / $limit);
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
    <title>Exames</title>
</head>
<body>
    <?php include 'template/header.php' ?>
    <h4>Exames</h4>
    <h5><a href="edit_exam.php">Novo exame</a></h5>
    <form>
      <input type="text" name="searchValue">
      
      <select id = "searchAttribute" name = "searchAttribute">
      <option value = "selecione" name = "selecione">Selecione</option>
        <option value = "nome" name = "nome">Nome</option>
        <option value = "valor" name = "valor">Valor</option>
      </select>
     
      <input type="submit" value="Buscar" />
    </form>
    <table>
    <thead>
    <tr>
      <th>Nome</th>
      <th>Valor</th>
      <th>Restrições</th>
      <th>Competências</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($exames as &$exame): ?>
    <tr>
        <td><a href="view_exam.php?nome=<?php echo $exame->getNome(); ?>"><?php echo $exame->getNome(); ?></a></td>
        <td><?php echo $exame->getValor() ?></td>
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
        <td> <a href="edit_exam.php?nome=<?php echo $exame->getNome()?>" style="text-decoration: none">✏️</a></td>
        <td> <a href="delete_exam.php?nome=<?php echo $exame->getNome()?>" style="text-decoration: none">❌</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
    </table>
  <?php include 'template/pagination_footer.php' ?>
</body>
</html>