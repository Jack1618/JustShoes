<?php
  include_once("../config.php");


  $id_scarpa = $_GET["id"];
  $scarpa = $mysqli->query("SELECT * FROM Scarpa WHERE id_scarpa = $id_scarpa")->fetch_array(MYSQLI_ASSOC);

  $scarpa["taglia"] = $_GET["taglia"];
  $scarpa["prezzo"] = $scarpa["prezzo"] - ($scarpa["prezzo"]/100) * $scarpa["sconto"];

  foreach ($_SESSION["carrello"] as $key => $articolo) {
    if($articolo["id_scarpa"] == $scarpa["id_scarpa"] && $articolo["taglia"] == $scarpa["taglia"]){
      $_SESSION["carrello"][$key]["quantita"]++;
      echo "<script type='text/javascript'>history.go(-1);</script>";
      EXIT;
    }
  }

  $scarpa["quantita"] = 1;
  array_push($_SESSION["carrello"],$scarpa);
  header("Location: catalogo.php");
  EXIT;
 ?>
