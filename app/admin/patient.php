<?php

session_start();

include('../util/splAndState.php');

$state->checkAccess(true);
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
    <table>
    
    </table>
</body>
</html>