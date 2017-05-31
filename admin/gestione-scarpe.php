<?php
  include_once("../config.php");
  include_once("../header.php");
  //INSERIMENTO SCARPA
  if(isset($_POST['nome']) && $_POST['nome']!=""){
    $codice = $_POST['codice'];
    $nome = $_POST['nome'];
    $prezzo = $_POST['prezzo'];
    $marca = $_POST['marca'];
    $foto = $_POST['foto'];
    $sql_ins = "INSERT INTO Scarpa (id_scarpa, codice, nome, prezzo, id_marca, foto) VALUES (NULL, '".$codice."','".$nome."','".$prezzo."', '".$marca."','ok.png')";
    mysql_query($sql_ins) or die("Ops");
    header("Location: gestione-scarpe.php");
    EXIT;
  }
  //RIMOZIONE SCARPA
  if(isset($_POST['id_scarpa']) && $_POST['id_scarpa']!=""){
    $id = $_POST['id_scarpa'];
    $sql_del = "DELETE FROM Scarpa WHERE Scarpa.id_scarpa = ".$id;
    mysql_query($sql_del) or die(mysql_error());
    header("Location: gestione-scarpe.php");
    EXIT;
  }
  //RICERCA SCARPA
  if(isset($_POST['ricerca_codice']) && $_POST['ricerca_codice']!=""){
    $codice = $_POST['ricerca_codice'];
    $sql_fetch = "SELECT * FROM Scarpa WHERE Scarpa.codice LIKE '%".$codice."%'";
    echo "auhasdikbndsaiuhasduihdsiauk";
  }
  else{
    $codice="";
    echo "vnmvbnmvbvnmbvnmbvmnvb";
    $sql_fetch ="SELECT * FROM Scarpa";
  }

?>
<div class="container">
  <h1 align="center">Inserimento Scarpa</h1>
  <form id="inserimento-scarpa" method="post" action="gestione-scarpe.php">
    <div class="form-group">
      <label for="codice">Codice</label>
      <input type="text" name="codice" class="form-control"></input>
    </div>
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" name="nome" class="form-control"></input>
    </div>
    <div class="form-group">
      <label for="prezzo">Prezzo</label>
      <input type="number" name="prezzo" class="form-control"></input>
    </div>
    <div class="form-group">
      <label>Marca
        <select name="marca" class="form-control">
          <?php
            $exec = mysql_query("SELECT * FROM Marca");
            while($marca = mysql_fetch_assoc($exec)) {
                echo "<option value='{$marca['id_marca']}'>{$marca['nome']}</option>";
            }
          ?>
        </select>
      </label>
    </div>
    <div class="form-group">
      <?php
        $exec = mysql_query("SELECT * FROM Categoria");
        while($categoria = mysql_fetch_assoc($exec)) {
          //  echo "<input class='form-check-input' type='checkbox' name='categorie[]' value='{$categoria['id_categoria']} style='{margin: 20px; display:block!important;}'>{$categoria['nome']}</input>";
            echo "<label class='checkbox-inline'><input type='checkbox' value={$categoria['id_categoria']}></input>{$categoria['nome']}</label>";
        }
      ?>
    </div>

    <div class="form-group">
      <label for="foto">Foto</label>
      <input type="text" name="foto" class="form-control"></input>
    </div>

    <button class="btn btn-default" onclick="submit()">Inserisci</button>
  </form>
</div>
<div class="container">
  <h1 align="center">Ricerca Codice Scarpa</h1>
  <form id="ricerca-scarpa" method="post" action="gestione-scarpe.php">
    <div class="form-group">
      <label for="codice">Codice</label>
      <input type="text" name="ricerca_codice" id="ricerca-codice" class="form-control"></input>
    </div>
    <button class="btn btn-default" onclick="search('')">Ricerca</button>
  </form>
</div>
<script type="text/javascript">
  submit = function(){
    $("#inserimento-scarpa").submit();
  }
  search = function(check){
    if(check == "reset")
      $("#ricerca-codice").val('');
    $("#ricerca-scarpa").submit();
  }
</script>
<form id="elimina_scarpa" method="post" action="gestione-scarpe.php" class="hidden" >
  <input type="text" name="id_scarpa" id="id_scarpa" class="hidden"></input>
</form>
<script type="text/javascript">
  elimina_scarpa = function(id){

    $("#id_scarpa").val(id);
    $("#elimina_scarpa").submit();
  }

  toggleTabella = function(){

    $("#mostra-txt").toggle();
    $("#nascondi-txt").toggle();
    $("#tabella-scarpe").toggle();
  }
  <?php
  if($codice!=="")
    echo "$(document).ready(function() {toggleTabella()})";
  ?>
</script>
<?php

$query = mysql_query($sql_fetch) or die("meh");
if(mysql_num_rows($query) > 0) { //Login completato
    $ris = mysql_fetch_assoc($query);
    echo  "<div class='container'><button class='btn btn-default' onclick='toggleTabella()'><span id='mostra-txt' >Mostra Tabella</span><span id='nascondi-txt' style='display: none'>Nascondi Tabella</span></button></div>".
          "<div class='container' id='tabella-scarpe' style='display: none'>".
          "<h2>Scarpe</h2>".
          "<table class='table'>".
          "<thead>".
            "<tr>";
    foreach ($ris as $key => $value) {
      if($key == "id_marca"){
        echo "<th>MARCA</th>";
      }
      else{
        echo "<th>".strtoupper($key)."</th>";
      }

    }
    echo "    </tr>".
            "</thead>".
            "";
    while($ris){

      echo "<tr>";
      foreach ($ris as $key => $value) {


          if($key == "id_marca"){
            $exec = mysql_query("SELECT nome FROM Marca WHERE id_marca=".$ris["".$key]);
            $marca = mysql_fetch_assoc($exec);
            $ris["".$key] = $marca["nome"];
          }
          echo "<td>".$ris["".$key]."</td>";



      }
      echo "<td><button class='btn btn-default' onclick='elimina_scarpa(".$ris["id_scarpa"].")'>Elimina</button></td>";
      echo "</tr>";
      $ris = mysql_fetch_assoc($query);
    }
            "</table>".
          "</div>";

  }
  if($codice != ""){
    echo "<button class='btn btn-default' onclick=search('reset')>Torna a Tabella Completa</button>";
  }


?>
