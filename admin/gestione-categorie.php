<?php
  include_once("../config.php");
  include_once("../header.php");

  if(isset($_POST['nome']) && $_POST['nome']!=""){
    $nome = $_POST['nome'];
    $sql_ins = "INSERT INTO Categoria (id_categoria, nome) VALUES (NULL, '".$nome."')";
    mysql_query($sql_ins) or die("Ops");
  }
?>
<h1>Inserimento Categoria</h1>
<form id="inserimento-categoria" method="post">
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
      $ris = mysql_fetch_array($query);
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
      foreach ($ris as $key) {

        echo "<tr>";
        foreach($key as $value){
          echo "<td>".$value."</td>";
        }
        echo "</tr>";
      }
              "</table>".
            "</div>";
  }


?>
