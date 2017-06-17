<?php
  include_once("./config.php");
  $key = $_GET["key"];
  echo var_dump($_SESSION["carrello"][$key]);
  if($_SESSION["carrello"][$key]["quantita"] > 1)
    $_SESSION["carrello"][$key]["quantita"]--;
  header("Location: carrello.php");
  EXIT;
 ?>
