<?php
  include_once("./config.php");
  include_once("./header.php");


  $fastFilter = NULL;
  if(isset($_POST["ricercaRapida"]) && $_POST["ricercaRapida"] != NULL){
    $fastFilter =  $_POST["ricercaRapida"];
    $sql = "SELECT id_scarpa, Scarpa.nome, prezzo, sconto, foto, Marca.nome AS 'marca'  FROM Scarpa JOIN Marca ON Scarpa.id_marca = Marca.id_marca".
    " WHERE attivo='1' AND (Scarpa.nome LIKE '%".$fastFilter."%' OR Marca.nome LIKE '%".$fastFilter."%')  ORDER BY id_scarpa";
  }
  else{
    $sql = "SELECT id_scarpa, Scarpa.nome, prezzo, sconto, foto, Marca.nome AS 'marca'  FROM Scarpa JOIN Marca ON Scarpa.id_marca = Marca.id_marca WHERE attivo='1' ORDER BY id_scarpa";
  }

  echo '<div class="container">
          <h3 align="center">Scegli categorie:
          <select form="ricerca" name="categorie[]" id="categorie" multiple="multiple" class="multiselect"></h3>';
  $categorie = $mysqli->query("SELECT * FROM Categoria");
  $prev_cat = array();
  if(isset($_POST["categorie"])){
    $prev_cat = $_POST["categorie"];
  }
  while($categoria = $categorie->fetch_array(MYSQLI_ASSOC)){
    echo "<script>console.log(".array_search(".cat$categoria[id_categoria]",$prev_cat).")</script>";
    if(array_search(".cat$categoria[id_categoria]",$prev_cat) !== false){
      echo "<option value='.cat$categoria[id_categoria]' selected>$categoria[nome]</option>";
    }
    else {
      echo "<option value='.cat$categoria[id_categoria]'>$categoria[nome]</option>";
    }
  }
  echo '</select>
        </div>';

  $scarpe = $mysqli->query($sql);

  echo "<div class='row container-fluid' style='width: 100%; margin: 0; padding: 20px; margin-top: 60px;'>";
  while($scarpa = $scarpe->fetch_array(MYSQLI_ASSOC)){
    $categorie_scarpa = $mysqli->query("SELECT id_categoria FROM Scarpa_Categoria WHERE id_scarpa=$scarpa[id_scarpa]");
    $categorie_class = "";
    while($categoria_scarpa = $categorie_scarpa->fetch_array(MYSQLI_ASSOC)){
      $categorie_class .= "cat$categoria_scarpa[id_categoria] ";
    }
    echo "<div class='col-md-3 col-sm-6 thumb $categorie_class style='cursor: pointer;' onclick='acquistaScarpa($scarpa[id_scarpa])'>";

    echo    "<div class='thumbnail thumb-scarpa'>
                <img src='http://localhost/JustShoes/img/scarpe/$scarpa[foto]' alt='prova'>
                <div class='caption'>
                  <h4>$scarpa[marca]</h4><h3 style ='margin-top:0'>$scarpa[nome]</h3>
                  <h4 style='text-align : right'>";

                  if($scarpa['sconto'] > 0){

                    echo "<span style = 'font-size: 14px;'><del>$scarpa[prezzo] €
                     </del> </span>"
                    .($scarpa['prezzo'] - ($scarpa['prezzo']/100 * $scarpa['sconto'])).

                    " € </h4>";
                  }
                  else{
                    echo $scarpa['prezzo']." €</h4>";
                  }

     echo             "<p>
                      <a href='http://localhost/JustShoes/cliente/wishlist-add.php?option=wishlist&id=$scarpa[id_scarpa]' class='btn btn-default btn-block' role='button'>Aggiungi a Wishlist</a>
                      <a href='http://localhost/JustShoes/scarpa.php?id=$scarpa[id_scarpa]' class='btn btn-primary btn-block' role='button'>Acquista</a>
                  </p>
                </div>
              </div>
            </div>";
  }
  echo "</div>";
  
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


    $(document).ready(function() {
        $('#categorie').multiselect();
        filtraCat();
    });

    filtraCat = function(){
      console.log($('#categorie').val())
      let categorie = $('#categorie').val();
      if(categorie.length == 0){
        $(".thumb").show();
      }
      else{
        categorie = categorie.reduce(function(a, b){
          return a + b;
        })
        console.log(categorie);
        $(".thumb").hide();
        $(categorie).show();

      }

    }

    $("#categorie").change(filtraCat);



</script>
