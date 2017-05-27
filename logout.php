

<?php
include_once("./config.php");
include_once("./header.php");
  $_SESSION['logged'] = false;
  echo $_SESSION['logged'];
  header("Location: index.php");
  EXIT;
?>
