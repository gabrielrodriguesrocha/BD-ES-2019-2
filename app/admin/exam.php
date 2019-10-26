<?php

include('../util/checkAccess.php');

function MyAutoload($className) {
    $extension =  spl_autoload_extensions();
    require_once ('../class/' . $className . $extension);
}

spl_autoload_extensions('.class.php'); // quais extensões iremos considerar
spl_autoload_register('MyAutoload');

$conn = Connection::getInstance();

checkAccess(true);
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
    <table>
    
    </table>
</body>
</html>