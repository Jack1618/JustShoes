<?php
  include_once("../config.php");
  include_once("../header.php");
  //PROTEZIONE ADMIN
  if(isset($_SESSION['admin']) && $_SESSION['admin'] == false){
    header("Location: ../index.php");
    EXIT;
  }
  //INSERIMENTO SCARPA
  if(isset($_POST['nome']) && $_POST['nome']!=""){
    $codice = $_POST['codice'];
    $nome = $_POST['nome'];
    $prezzo = $_POST['prezzo'];
    $sconto = $_POST['sconto'];
    $marca = $_POST['marca'];
    $foto = $_POST['foto'];
    $sql_ins = "INSERT INTO Scarpa (id_scarpa, codice, nome, prezzo, sconto, id_marca, foto) VALUES (NULL, '".$codice."','".$nome."','".$prezzo."', '".$sconto."', '".$marca."','ok.png')";
    mysql_query($sql_ins) or die("Ops");
    $id_scarpa = mysql_insert_id();
    $categorie = $_POST['categorie'];
    foreach ($categorie as $key => $value) {
      $sql_ins_cat = "INSERT INTO Scarpa_Categoria (id_scarpa, id_categoria) VALUES ('".$id_scarpa."', '".$value."')";
      mysql_query($sql_ins_cat) or die("Ops");
    }
    header("Location: inserimento-scarpe.php?id=".$id_scarpa);
    EXIT;
  }
  //RIMOZIONE SCARPA
  if(isset($_POST['id_scarpa']) && $_POST['id_scarpa']!=""){
    $id = $_POST['id_scarpa'];
    $attivo = $_POST["attivo"];
    $sql = "UPDATE Scarpa SET attivo=$attivo WHERE Scarpa.id_scarpa = $id";
    $mysqli->query($sql);
    header("Location: gestione-scarpe.php");
    EXIT;
  }
  //RICERCA SCARPA
  if(isset($_POST['ricerca_codice']) && $_POST['ricerca_codice']!=""){
    $codice = $_POST['ricerca_codice'];
    $sql_fetch = "SELECT * FROM Scarpa WHERE Scarpa.codice LIKE '%".$codice."%'";
  }
  else{
    $codice="";
    $sql_fetch ="SELECT * FROM Scarpa";
  }

?>
<div class="container">
  <h1 align="center">Inserimento Modello Scarpa</h1>
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
      <input id="prezzoInput" type="text" name="prezzo" class="form-control input-control"></input>
    </div>
    <div class="form-group">
     <div class="form-group">
      <label for="sconto">Sconto %</label>
      <input id="scontoInput" type="text" name="sconto" class="form-control input-control"></input>
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
            echo "<label class='checkbox-inline'><input type='checkbox' name='categorie[]' value={$categoria['id_categoria']}></input>{$categoria['nome']}</label>";
        }
      ?>
    </div>

    <div class="form-group">
      <label for="foto">Foto</label>
      <input type="text" name="foto" class="form-control"></input>
    </div>

    <button id="submitBtn" class="btn btn-default" onclick="submit()">Inserisci</button>
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

  var btnDisabled = [];

  submit = function(){
    $("#inserimento-scarpa").submit();
  }
  search = function(check){
    if(check == "reset")
      $("#ricerca-codice").val('');
    $("#ricerca-scarpa").submit();
  }

  $(".input-control").change(function(){


    if($("#scontoInput").val() < 0 || $("#scontoInput").val() > 100){
      alert("La percentuale dev'essere un valore compreso tra 0 e 100!");
      $("#submitBtn").attr("disabled", "true");
    }


    else if(isNaN($("#prezzoInput").val())){
      alert("Inserire un valore numerico!");
      $("#submitBtn").attr("disabled", "true");

    }
    else{
      $("#submitBtn").removeAttr("disabled");
    }

  });

</script>
<form id="elimina_scarpa" method="post" action="gestione-scarpe.php" class="hidden" >
  <input type="text" name="id_scarpa" id="id_scarpa" class="hidden"></input>
  <input type="text" name="attivo" id="attivo" class="hidden"></input>
</form>
<script type="text/javascript">
  elimina_scarpa = function(id,attivo){
    $("#attivo").val(attivo);
    $("#id_scarpa").val(id);
    $("#elimina_scarpa").submit();
  }

  toggleTabella = function(){

    $("#mostra-txt").toggle();
    $("#nascondi-txt").toggle();
    $("#tabella-scarpe").toggle();
  }

  mostraDettagli = function(id){
    $("#r1" + id).toggle();
    $("#r2" + id).toggle();
  }

  modificaScarpa = function(id){
    window.open("http://localhost/JustShoes/admin/modifica-scarpe.php?id="+id,'_self');
  }

  modificaQta = function(id){
    window.open("http://localhost/JustShoes/admin/inserimento-scarpe.php?id="+id,'_self');
  }

  <?php
  if($codice!=="")
    echo "$(document).ready(function() {toggleTabella()})";
  ?>
</script>
<?php

$query = mysql_query($sql_fetch) or die("meh");
if(mysql_num_rows($query) > 0) { //Login completato
    $scarpa = mysql_fetch_assoc($query);
    echo  "<div class='container'><button class='btn btn-default' onclick='toggleTabella()'><span id='mostra-txt' >Mostra Tabella</span><span id='nascondi-txt' style='display: none'>Nascondi Tabella</span></button></div>".
          "<div class='container' id='tabella-scarpe' style='display: none'>".
          "<h2>Scarpe</h2>".
          "<table class='table table-striped'>".
          "<thead>".
            "<tr>";
    foreach ($scarpa as $key => $value) {
      if($key == "id_marca"){
        echo "<th>MARCA</th>";
      }
      elseif ($key != "attivo" && $key != "descrizione"){
        echo "<th>".strtoupper($key)."</th>";
      }

    }
    echo "    </tr>".
            "</thead>".
            "";
    while($scarpa){

      echo "<tr>";
      foreach ($scarpa as $key => $value) {


          if($key == "id_marca"){
            $exec = mysql_query("SELECT nome FROM Marca WHERE id_marca=".$scarpa["".$key]);
            $marca = mysql_fetch_assoc($exec);
            $scarpa["".$key] = $marca["nome"];
          }
          if ($key != "attivo" && $key != "descrizione") {
            echo "<td>".$scarpa["".$key]."</td>";
          }

      }
      if($scarpa['attivo'] == 1){
        echo "<td><button class='btn btn-default' onclick='elimina_scarpa(".$scarpa["id_scarpa"].",0)'>Escludi</button></td>";
      }
      else{
        echo "<td><button class='btn btn-default' onclick='elimina_scarpa(".$scarpa["id_scarpa"].",1)'>Includi</button></td>";
      }
      echo "<td><button class='btn btn-default' onclick='mostraDettagli(".$scarpa["id_scarpa"].")'>Dettagli</button></td>";
      echo "</tr>";
      echo "<tr id='r1".$scarpa["id_scarpa"]."' style='display : none'>";
      $sql_categorie = mysql_query("SELECT nome FROM Scarpa_Categoria JOIN Categoria ON Scarpa_Categoria.id_categoria = Categoria.id_categoria WHERE id_scarpa = ".$scarpa["id_scarpa"]) or die;
      while($categoria = mysql_fetch_assoc($sql_categorie)){
        echo "<td>".$categoria["nome"]."</td>";
      }
      echo "</tr>";
      echo "<tr  style='display : none' id='r2".$scarpa["id_scarpa"]."'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><button class='btn btn-default' onclick='modificaScarpa(".$scarpa["id_scarpa"].")'>Modifica Scarpa</button></td><td><button class='btn btn-default' onclick='modificaQta(".$scarpa["id_scarpa"].")'>Modifica Q.ta</button></td></tr>";
      $scarpa = mysql_fetch_assoc($query);
    }
            "</table>".
          "</div>";

  }
  if($codice != ""){
    echo "<button class='btn btn-default' onclick=search('reset')>Torna a Tabella Completa</button>";
  }


?>
