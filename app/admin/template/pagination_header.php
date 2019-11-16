<?php
if (isset($_GET['limit'])) {
  $limit = $_GET['limit'];
}
else {
  $limit = 20;
}

if (isset($_GET['currentPage'])) {
  $currentPage = $_GET['currentPage'];
} else {
  $currentPage = 1;
}

$offset = ($currentPage - 1) * $limit;
?>