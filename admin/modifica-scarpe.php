<?php
  include_once("../config.php");
  include_once("../header.php");
  //PROTEZIONE ADMIN
  if(isset($_SESSION['admin']) && $_SESSION['admin'] == false){
    header("Location: localhost://JustShoes/index.php");
    EXIT;
  }
  //INSERIMENTO SCARPA
  $id_scarpa = $_GET["id"];

  if(isset($_POST['nome']) && $_POST['nome']!=""){
    $codice = $_POST['codice'];
    $nome = $_POST['nome'];
    $prezzo = $_POST['prezzo'];
    $marca = $_POST['marca'];
    $foto = $_POST['foto'];

    $sql_ins = "UPDATE Scarpa SET id_scarpa = '".$id_scarpa."', codice = '".$codice."', nome = '".$nome."', prezzo = '".$prezzo."', id_marca = '".$marca."', foto = '".$foto."' WHERE id_scarpa = ".$id_scarpa;

    $mysqli->query($sql_ins) or die(mysql_error());


    $categorie = $_POST['categorie'];
    $sql_del_cat = "DELETE FROM Scarpa_Categoria WHERE id_scarpa = ".$id_scarpa;
    $mysqli->query($sql_del_cat) or die(mysql_error());
    foreach ($categorie as $key => $value) {

      $sql_ins_cat = "INSERT INTO Scarpa_Categoria (id_scarpa, id_categoria) VALUES ('".$id_scarpa."', '".$value."')";
      $mysqli->query($sql_ins_cat) or die(mysql_error());
    }
    header("Location: gestione-scarpe.php");
    EXIT;
  }


  $query = mysql_query("SELECT * FROM Scarpa WHERE id_scarpa = ".$id_scarpa);
  $scarpa = mysql_fetch_assoc($query);
?>
<div class="container">
  <h1 align="center">Inserimento Modello Scarpa</h1>
  <form id="inserimento-scarpa" method="post" action=<?php echo "'modifica-scarpe.php?id=".$id_scarpa."'"; ?>>
    <div class="form-group">
      <label for="codice">Codice</label>
      <input type="text" name="codice" class="form-control" value=<?php echo '"'.$scarpa["codice"].'"'; ?>></input>
    </div>
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" name="nome" class="form-control" value=<?php echo '"'.$scarpa["nome"].'"'; ?>></input>
    </div>
    <div class="form-group">
      <label for="prezzo">Prezzo</label>
      <input type="text" name="prezzo" class="form-control" value=<?php echo '"'.$scarpa["prezzo"].'"'; ?>></input>
    </div>
    <div class="form-group">
      <label>Marca
        <select name="marca" class="form-control">
          <?php
            $exec = mysql_query("SELECT * FROM Marca");
            while($marca = mysql_fetch_assoc($exec)) {
              if($scarpa["id_marca"] == $marca["id_marca"]){
                echo "<option value='{$marca['id_marca']}' checked>{$marca['nome']}</option>";
              }
              else {
                echo "<option value='{$marca['id_marca']}' >{$marca['nome']}</option>";
              }
            }
          ?>
        </select>
      </label>
    </div>
    <div class="form-group">
      <?php
        $categorie_si = mysql_query("SELECT Categoria.id_categoria, nome FROM Scarpa_Categoria JOIN Categoria ON Scarpa_Categoria.id_categoria = Categoria.id_categoria WHERE id_scarpa = ".$scarpa["id_scarpa"]);

        while($categoria = mysql_fetch_assoc($categorie_si)) {
            echo "<label class='checkbox-inline'><input type='checkbox' name='categorie[]' value={$categoria['id_categoria']} checked></input>{$categoria['nome']}</label>";
        }

        $categorie_no = mysql_query("SELECT id_categoria, nome FROM Categoria WHERE id_categoria NOT IN (SELECT id_categoria FROM Scarpa_Categoria WHERE id_scarpa =".$scarpa["id_scarpa"]." )");
        while($categoria = mysql_fetch_assoc($categorie_no)) {
            echo "<label class='checkbox-inline'><input type='checkbox' name='categorie[]' value={$categoria['id_categoria']}></input>{$categoria['nome']}</label>";
        }
      ?>
    </div>

    <div class="form-group">
      <label for="foto">Foto</label>
      <input type="text" name="foto" class="form-control"  value=<?php echo '"'.$scarpa["foto"].'"'; ?>></input>
    </div>

    <button class="btn btn-default" onclick="submit()">Inserisci</button>
  </form>
</div>

<script type='text/javascript'>
  submit = function(){
    $("#inserimento-scarpa").submit();
  }
</script>
