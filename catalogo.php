<?php
  include_once("./config.php");
  include_once("./header.php");
  $scarpe = $mysqli->query("SELECT id_scarpa, Scarpa.nome, prezzo, foto, Marca.nome AS 'marca'  FROM Scarpa JOIN Marca ON Scarpa.id_marca = Marca.id_marca ORDER BY id_scarpa");
  echo '<div class="row" style = "width: 100%; margin: 0;">';
  while($scarpa = $scarpe->fetch_array(MYSQLI_ASSOC)){
    echo '<div class="col-md-3">
              <div class="thumbnail">
                <img src="http://localhost/JustShoes/img/scarpe/'.$scarpa['foto'].'" alt="prova">
                <div class="caption">
                  <h4>'.$scarpa['marca'].'</h4><h3 style ="margin-top:0">'.$scarpa['nome'].'</h3>
                  <h4 style="text-align : right">'.$scarpa['prezzo'].' €</h4>
                  <p>
                      <a href="http://localhost/JustShoes/scarpa.php" class="btn btn-default btn-block" role="button">Mostra</a>
                      <a href="http://localhost/JustShoes/aggiungi-carrello.php?id="'.$scarpa['id_scarpa'].' class="btn btn-primary btn-block " role="button">Aggiungi al Carrello</a>
                  </p>
                </div>
              </div>
            </div>';
  }
  echo '</div>';
?>
