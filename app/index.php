<?php
$dbuser = $_ENV['POSTGRES_USER'];
$dbpass = $_ENV['POSTGRES_PASS'];
try {
    $pdo = new PDO("pgsql:host=postgres;dbname=exams", $dbuser, $dbpass);
} catch(PDOException $e) {
    echo $e->getMessage();
}
