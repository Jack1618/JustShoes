<?php
  include_once("../config.php");
  include_once("../header.php");

    if($_SESSION['admin'] == true){
    header("Location: ../index.php");
    EXIT;
  }

  if(!isset($_SESSION['logged']) && $_SESSION['logged'] == false) {
    header("Location: ../index.php");
    EXIT;
  }

  $sql = "SELECT 
			Acquisto.id_acquisto, Acquisto.id_utente, Acquisto.data, Acquisto.id_indirizzo, Acquisto.totale,
			Dettagli_Acquisto.id_scarpa, Dettagli_Acquisto.id_taglia, Dettagli_Acquisto.quantita,
			Indirizzo.nome AS 'indirizzo_nome', Indirizzo.via, Indirizzo.CAP, Indirizzo.citta,
			Scarpa.nome AS 'scarpa_nome', Scarpa.prezzo, Scarpa.foto, Scarpa.id_marca, 
			Marca.nome AS 'marca_nome',
			Taglia.taglia_eu, Taglia.taglia_uk_m, Taglia.taglia_uk_f, Taglia.taglia_us_m, Taglia.taglia_us_f

			FROM Acquisto

			JOIN Dettagli_Acquisto
			ON Acquisto.id_acquisto = Dettagli_Acquisto.id_acquisto

			JOIN Indirizzo 
			ON Acquisto.id_indirizzo = Indirizzo.id_indirizzo

			JOIN Scarpa 
			ON Dettagli_Acquisto.id_scarpa =  Scarpa.id_scarpa

			JOIN Marca 
			ON Scarpa.id_marca = Marca.id_marca

			JOIN Taglia 
			ON Dettagli_Acquisto.id_taglia = Taglia.id_taglia
			WHERE Acquisto.id_utente = ".$_SESSION['id_utente']." ";
  
  $acquisti = $mysqli->query($sql);

  if($acquisti->num_rows == 0){
  	echo "<h2>Nessuno acquisto ancora effettuato!</h2>";
  }

  else{

  	$idAcquistoPrec = 0;
  	echo '<div class="container">';	
  	echo '	<div class="list-group">';

  	while($acquisto = $acquisti->fetch_array(MYSQLI_ASSOC)) {

  		if($idAcquistoPrec != $acquisto["id_acquisto"]){
  			echo "<br></br>";
  			echo "	<li class='list-group-item active'>";
  			echo "<h5>Acquisto effettuato in data <b>$acquisto[data]</b></h5>";
  			echo "<h5>Articoli spediti a <b>$acquisto[indirizzo_nome]</b> presso $acquisto[via], $acquisto[CAP], $acquisto[citta]</h5>";
  			echo "<h5>Prezzo totale:  € $acquisto[totale]</h5>";
  			echo "</li>";

  		}

  		echo "	<li class='list-group-item'>
          <span class='badge' style='margin-top: 1px;'><img style='width: 50px; height: 50px; margin:-10px;' src='http://localhost/JustShoes/img/scarpe/$acquisto[foto]'/></span>
          <h4 class='list-group-item-heading'><b>$acquisto[marca_nome]</b> - $acquisto[scarpa_nome] - <span style='font-size: 14px'>
          Taglia: EU $acquisto[taglia_eu] / UK_M $acquisto[taglia_uk_m] / UK_F $acquisto[taglia_uk_f] / US_M $acquisto[taglia_us_m] / US_F $acquisto[taglia_us_f]<span></h4>
          <p class='list-group-item-text'>
            Prezzo: <b>$acquisto[prezzo] €</b> -
            Quantita: <b>$acquisto[quantita]</b>
          </p>
        </li>";

        $idAcquistoPrec = $acquisto["id_acquisto"];	
    }

    echo "	</div>";
	echo "</div>";

  }

?>