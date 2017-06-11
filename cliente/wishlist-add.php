<?php
  include_once("../config.php");
  $option = $_GET["option"];
  $id_scarpa = $_GET["id"];
  if(isset($_SESSION["id_utente"])){
    $id_utente = $_SESSION["id_utente"];
  }
  else {
    header("Location: http://localhost/JustShoes/login.php?option=wishlist&id=".$id_scarpa);
    EXIT;
  }
  if($mysqli->query("INSERT INTO Wishlist (id_utente, id_scarpa) VALUES ('".$id_utente."','".$id_scarpa."')")){
    if($option == "wishlist"){
      header("Location: http://localhost/JustShoes/catalogo.php?wladd=1");
    }
    else{
      header("Location: http://localhost/JustShoes/scarpa.php?wladd=1&id=$id_scarpa");
    }
  }
  else {
    if($option == "wishlist"){
      header("Location: http://localhost/JustShoes/catalogo.php?wladd=0");
    }
    else{
      header("Location: http://localhost/JustShoes/scarpa.php?wladd=0&id=$id_scarpa");
    }
  }

  EXIT;
?>
