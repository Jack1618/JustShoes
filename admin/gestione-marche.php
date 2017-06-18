<?php
  include_once("../config.php");
  include_once("../header.php");
  //PROTEZIONE ADMIN
  if(isset($_SESSION['admin']) && $_SESSION['admin'] == false){
    header("Location: ../index.php");
    EXIT;
  }
  //INSERIMENTO MARCA
  if(isset($_POST['nome']) && $_POST['nome']!=""){
    $nome = $_POST['nome'];
    $sql_ins = "INSERT INTO Marca (id_marca, nome) VALUES (NULL, '".$nome."')";
    mysql_query($sql_ins) or die("Ops");
    header("Location: gestione-marche.php");
    EXIT;
  }
  //RIMOZIONE MARCA
  if(isset($_POST['id_marca']) && $_POST['id_marca']!=""){
    $id = $_POST['id_marca'];
    $sql_del = "DELETE FROM Marca WHERE Marca.id_marca = ".$id;
    mysql_query($sql_del) or die(mysql_error());
    header("Location: gestione-marche.php");
    EXIT;
  }

?>
<h1>Inserimento Marca</h1>
<form id="inserimento-marca" method="post" action="gestione-marche.php">
  <label for="nome">Nome</label>
  <input type="text" name="nome"></input>
  <button class="btn btn-default" onclick="submit()">Inserisci</button>
</form>
<script type="text/javascript">
  submit = function(){
    $("#inserimento-marca").submit();
  }
</script>
<?php
  $sql_fetch = "SELECT * FROM Marca";
  $query = mysql_query($sql_fetch) or die("meh");
  if(mysql_num_rows($query) > 0) { //Login completato
      $ris = mysql_fetch_assoc($query);
      echo "<div class='container'>".
            "<h2>Marche</h2>".
            "<table class='table'>".
            "<thead>".
              "<tr>";
      foreach ($ris as $key => $value) {
        echo "<th>".strtoupper($key)."</th>";
      }
      echo "    </tr>".
              "</thead>".
              "";
      while($ris){

        echo "<tr>";
        foreach ($ris as $key => $value) {



            echo "<td>".$ris["".$key]."</td>";


        }
        echo "<td><button class='btn btn-default' onclick='elimina_marca(".$ris["id_marca"].")'>Elimina</button></td>";
        echo "</tr>";
        $ris = mysql_fetch_assoc($query);
      }
              "</table>".
            "</div>";
  }


?>
<form id="elimina_marca" method="post" action="gestione-marche.php" class="hidden" >
  <input type="text" name="id_marca" id="id_marca" class="hidden"></input>
</form>
<script type="text/javascript">
  elimina_marca = function(id){

    $("#id_marca").val(id);
    $("#elimina_marca").submit();
  }
</script>
