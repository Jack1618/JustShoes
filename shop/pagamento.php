<?php
  include_once("../config.php");
  include_once("../header.php");
  $carta = $_GET["card"];
  $indirizzo = $_GET["ind"];
  $data = date("Y-m-d H:i:s");
  $totale = $_SESSION["totale"];
  $id_utente = $_SESSION["id_utente"];
  $stmt = $mysqli->prepare("INSERT INTO Acquisto (id_acquisto, data, totale, id_indirizzo, id_utente)
                            VALUES(NULL, ?, ?, ?, ?)");
  $stmt->bind_param('ssss',$data, $totale, $indirizzo, $id_utente);

  $stmt->execute();


  $id_acquisto = $mysqli->insert_id;
  $carrello = $_SESSION["carrello"];
  foreach ($carrello as $key => $articolo) {
  $stmt = $mysqli->prepare("INSERT INTO Dettagli_Acquisto (id_acquisto, id_scarpa, id_taglia, quantita, prezzo)
                            VALUES (?,?,?,?,?)");
  $stmt->bind_param('sssss', $id_acquisto, $articolo["id_scarpa"], $articolo["taglia"], $articolo["quantita"], $articolo["prezzo"]);
  $stmt->execute();

  $quantita = $mysqli->query("SELECT quantita
                              FROM Stock_Scarpe
                              WHERE id_scarpa = $articolo[id_scarpa]
                              AND id_taglia = $articolo[taglia]")
                              ->fetch_array(MYSQLI_ASSOC)["quantita"];
  $quantita -= $articolo["quantita"];
  $mysqli->query("UPDATE Stock_Scarpe
                  SET quantita = $quantita
                  WHERE id_scarpa = $articolo[id_scarpa]
                  AND id_taglia = $articolo[taglia]");

  }


  $_SESSION["carrello"] = array();
?>

<div class="container">
  <h1>Pagamento Riuscito!</h1>
  <a href="http://localhost/JustShoes/index.php" class="btn btn-primary">Torna alla Home</a>
</div>
