<?php
  include_once("../config.php");
  include_once("../header.php");

  //PROTEZIONE ADMIN
  if($_SESSION['admin'] == false){
    header("Location: ../index.php");
    EXIT;
  }

  $id_scarpa = $_GET["id"];

  //INSERIMENTO QUANTITA SCARPE IN STOCK
  if(isset($_POST["submitted"]) && $_POST["submitted"] == "1"){

    $stmt = $mysqli->prepare("DELETE FROM Stock_Scarpe
                              WHERE id_scarpa = ?");
    $stmt->bind_param("s",$id_scarpa);
    if($stmt->execute()){
      $taglie = $mysqli->query("SELECT *
                               FROM Taglia
                               ORDER BY taglia_eu DESC");
      while($taglia = $taglie->fetch_array(MYSQLI_ASSOC)){
        $id = $taglia["id_taglia"];
        $quantita = (isset($_POST["qt$id"]) && $_POST["qt$id"] != "") ?
                    $_POST["qt$id"] : "0";
        //PREPARO STATEMENT PER EVITARE CARATTERI SPECIALI E INJECTIONS
        $stmt = $mysqli->prepare("INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa)
                                  VALUES (?,?,?)");
        $stmt->bind_param("iss",$quantita,$id,$id_scarpa);
        $stmt->execute();

      }
      header("Location: gestione-scarpe.php");
      EXIT;
    }
    else{
      echo "Impossibile aggiornare quantita scarpe!";
    }
  }

  //COSTRUZIONE TABELLA FORM PER QUANTITA IN STOCK
  if($taglie = $mysqli->query("SELECT *
                               FROM Taglia")){

    echo  "<div class='container'>".
            "<h2>Inserimento Scarpe per Taglia</h2>".
            "<table class='table'>".
              "<thead>".
                "<tr>".
                  "<th>TAGLIA</th>".
                  "<th>QUANTITA'</th>".
                "</tr>".
              "</thead>".
              "<tbody>".
                "<form id='quantita-scarpe' method='post' action='inserimento-scarpe.php?id=$id_scarpa'>";
        while($taglia = $taglie->fetch_array(MYSQLI_ASSOC)){
            echo  "<tr>".
                    "<td>$taglia[taglia_eu]</td>".

                    "<td><input form='quantita-scarpe' type='number' name='qt$taglia[id_taglia]' value=";
                    $stmt = $mysqli->prepare("SELECT quantita
                                              FROM Stock_Scarpe
                                              JOIN Scarpa ON Scarpa.id_scarpa = Stock_Scarpe.id_scarpa
                                              WHERE id_taglia = ?
                                              AND Stock_Scarpe.id_scarpa = ?");

                    $stmt->bind_param("ss", $taglia["id_taglia"], $id_scarpa);
                    $stmt->execute();
                    if($taglia_scarpa = $stmt->get_result()->fetch_array(MYSQLI_ASSOC)){

                      echo "'$taglia_scarpa[quantita]'";
                    }
                    else {
                      echo "'0'";
                    }
                    echo "></input></td>".
                  "</tr>";
        }
        echo      " <td><input type='text' name='submitted' value='1' hidden></input></td>
                    <td><button class='btn btn-default' onclick='inserisci()'>Inserisci</button></td>".
                "</form>".
              "</tbody>".
            "</table>".
          "</div>";
  }




?>
<script type='text/javascript'>
  inserisci = function(){
    $("#quantita-scarpe").submit();
  }
</script>
