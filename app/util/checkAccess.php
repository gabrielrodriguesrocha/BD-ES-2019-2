<?php

session_start();

function CheckAccess($employee) {
  $employeeRestriction = $employee ? $_SESSION['employee'] === true : true;
  $result = (isset($_SESSION['username']) &&
             isset($_SESSION['password']) &&
             $employeeRestriction);
  if (!$result)
  {
    header("location:../index.php");
    die();
  }
}
?>