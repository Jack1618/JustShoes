<?php
  include_once("../config.php");
  include_once("../header.php");
  //PROTEZIONE ADMIN
  if(isset($_SESSION['admin']) && $_SESSION['admin'] == false){
    header("Location: localhost://JustShoes/index.php");
    EXIT;
  }
  //INSERIMENTO CATEGORIA
  if(isset($_POST['nome']) && $_POST['nome']!=""){
    $nome = $_POST['nome'];
    $sql_ins = "INSERT INTO Categoria (id_categoria, nome) VALUES (NULL, '".$nome."')";
    mysql_query($sql_ins) or die("Ops");
    header("Location: gestione-categorie.php");
    EXIT;
  }
  //RIMOZIONE CATEGORIA
  if(isset($_POST['id_cat']) && $_POST['id_cat']!=""){
    $id = $_POST['id_cat'];
    $sql_del = "DELETE FROM Categoria WHERE Categoria.id_categoria = ".$id;
    mysql_query($sql_del) or die(mysql_error());
    header("Location: gestione-categorie.php");
    EXIT;
  }

?>
<h1>Inserimento Categoria</h1>
<form id="inserimento-categoria" method="post" action="gestione-categorie.php">
  <label for="nome">Nome</label>
  <input type="text" name="nome"></input>
  <button class="btn btn-default" onclick="submit()">Inserisci</button>
</form>
<script type="text/javascript">
  submit = function(){
    $("#inserimento-categoria").submit();
  }
</script>
<?php
  $sql_fetch = "SELECT * FROM Categoria";
  $query = mysql_query($sql_fetch) or die("meh");
  if(mysql_num_rows($query) > 0) { //Login completato
      $ris = mysql_fetch_assoc($query);
      echo "<div class='container'>".
            "<h2>Categorie</h2>".
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
        echo "<td><button class='btn btn-default' onclick='elimina_categoria(".$ris["id_categoria"].")'>Elimina</button></td>";
        echo "</tr>";
        $ris = mysql_fetch_assoc($query);
      }
              "</table>".
            "</div>";
  }


?>
<form id="elimina_categoria" method="post" action="gestione-categorie.php" class="hidden" >
  <input type="text" name="id_cat" id="id_cat" class="hidden"></input>
</form>
<script type="text/javascript">
  elimina_categoria = function(id){

    $("#id_cat").val(id);
    $("#elimina_categoria").submit();
  }
</script>
