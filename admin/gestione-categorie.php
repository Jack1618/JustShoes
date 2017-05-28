<?php
  include_once("../config.php");
  include_once("../header.php");
  echo $_POST['nome'];
  if(isset($_POST['nome']) && $_POST['nome']!=""){
    $nome = $_POST['nome'];
    $sql_ins = "INSERT INTO Categoria (id_categoria, nome) VALUES (NULL, '".$nome."')";
    mysql_query($sql_ins) or die("Ops");
    unset($_POST['nome']);
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
      for($i = 0; $i<mysql_num_rows($query); $i++){
        echo mysql_num_rows($query);
        echo "<tr>";
        foreach ($ris as $key => $value) {



            echo "<td>".$ris["".$key]."</td>";


        }
        echo "</tr>";
      }
              "</table>".
            "</div>";
  }


?>
