<?php
  include_once("./config.php");
  include_once("./header.php");

  $fastFilter = NULL;

  if(isset($_POST["ricercaRapida"]) && $_POST["ricercaRapida"] != NULL)
    $fastFilter =  $_POST["ricercaRapida"];

  if($fastFilter != NULL){
    $sql = "SELECT id_scarpa, Scarpa.nome, prezzo, foto, Marca.nome AS 'marca'  FROM Scarpa JOIN Marca ON Scarpa.id_marca = Marca.id_marca".
    " WHERE Scarpa.nome LIKE '%".$fastFilter."%' OR Marca.nome LIKE '%".$fastFilter."%' ORDER BY id_scarpa";
  }
  else{
    $sql = "SELECT id_scarpa, Scarpa.nome, prezzo, foto, Marca.nome AS 'marca'  FROM Scarpa JOIN Marca ON Scarpa.id_marca = Marca.id_marca ORDER BY id_scarpa";
  }

  $scarpe = $mysqli->query($sql);

  echo '<div class="row container-fluid" style = "width: 100%; margin: 0; padding: 20px; margin-top: 60px;">';
  while($scarpa = $scarpe->fetch_array(MYSQLI_ASSOC)){
    echo '<div class="col-md-3 col-sm-6" style="cursor: pointer;" onclick="acquistaScarpa('.$scarpa['id_scarpa'].')">
              <div class="thumbnail thumb-scarpa">
                <img src="http://localhost/JustShoes/img/scarpe/'.$scarpa['foto'].'" alt="prova">
                <div class="caption">
                  <h4>'.$scarpa['marca'].'</h4><h3 style ="margin-top:0">'.$scarpa['nome'].'</h3>
                  <h4 style="text-align : right">'.$scarpa['prezzo'].' €</h4>
                  <p>
                      <a href="http://localhost/JustShoes/cliente/wishlist-add.php?option=wishlist&id='.$scarpa['id_scarpa'].'" class="btn btn-default btn-block" role="button">Aggiungi a Wishlist</a>
                      <a href="http://localhost/JustShoes/aggiungi-carrello.php?id='.$scarpa['id_scarpa'].'" class="btn btn-primary btn-block " role="button">Acquista</a>
                  </p>
                </div>
              </div>
            </div>';
  }
  echo '</div>';
  if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true){
		include_once("./cliente/wishlist.php");
	}
  if(isset($_GET["wladd"]) && $_GET["wladd"] == 1){
    echo "<script type='text/javascript'>alert('Aggiunto alla Wishlist!'); window.open('http://localhost/JustShoes/catalogo.php','_self');</script>";
  }
  elseif (isset($_GET["wladd"])) {
    echo "<script type='text/javascript'>alert('Elemento già presente nella Wishlist!'); window.open('http://localhost/JustShoes/catalogo.php','_self')</script>";
  }
?>
<script type=text/javascript>
  acquistaScarpa = function(id){
    window.open("http://localhost/JustShoes/scarpa.php?id="+id,"_self")
  }
</script>
