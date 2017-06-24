<?php
  include_once("../config.php");
  $stmt = $mysqli->prepare("DELETE FROM Wishlist
                  WHERE id_utente = $_SESSION[id_utente]
                  AND id_scarpa = ?");

  $stmt->bind_param('s',$_GET["id"]);
  $stmt->execute();
  echo "<script type='text/javascript'>history.go(-1);</script>";
  EXIT;
?>
