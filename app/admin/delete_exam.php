<?php

session_start();


include('../util/splAndState.php');

$state->checkAccess(true);

$exameRepository = ExameRepository::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $exame = $exameRepository->getByNome($_POST['nome']);
    $exameRepository->delete($exame);
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
    <?php include 'template/exam_info.php' ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
        <input type="hidden" name="nome" value="<?php echo $_GET['nome']; ?>"/>
        <input type="submit" value="Confirmar exclusão"/>
    </form>
</body>
</html>