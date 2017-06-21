<?php
  include_once("../config.php");
  $key = $_GET["key"];
  unset($_SESSION["carrello"][$key]);
  header("Location: carrello.php");
  EXIT;
 ?>
