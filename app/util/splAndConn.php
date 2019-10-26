<?php

function MyAutoload($className) {
    $extension =  spl_autoload_extensions();
    require_once ('class/' . $className . $extension);
}

spl_autoload_extensions('.class.php'); // quais extensões iremos considerar
spl_autoload_register('MyAutoload');

$conn = Connection::getInstance();
?>