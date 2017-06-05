<?php
  include_once("../config.php");
  include_once("../header.php");

  $id_scarpa = $_GET["id"];

  if((isset($_POST["num1"]) && $_POST["num1"] != NULL) &&
      (isset($_POST["num2"]) && $_POST["num2"] != NULL) &&
      (isset($_POST["num3"]) && $_POST["num3"] != NULL) &&
      (isset($_POST["num4"]) && $_POST["num4"] != NULL) &&
      (isset($_POST["num5"]) && $_POST["num5"] != NULL) &&
      (isset($_POST["num6"]) && $_POST["num6"] != NULL) &&
      (isset($_POST["num7"]) && $_POST["num7"] != NULL) &&
      (isset($_POST["num8"]) && $_POST["num8"] != NULL) &&
      (isset($_POST["num9"]) && $_POST["num9"] != NULL) &&
      (isset($_POST["num10"]) && $_POST["num10"] != NULL) &&
      (isset($_POST["num11"]) && $_POST["num11"] != NULL) &&
      (isset($_POST["num12"]) && $_POST["num12"] != NULL) &&
      (isset($_POST["num13"]) && $_POST["num13"] != NULL) &&
      (isset($_POST["num14"]) && $_POST["num14"] != NULL) &&
      (isset($_POST["num15"]) && $_POST["num15"] != NULL) &&
      (isset($_POST["num16"]) && $_POST["num16"] != NULL)) {
        $query = "INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num1'].",'1','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num2'].",'2','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num3'].",'3','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num4'].",'4','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num5'].",'5','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num7'].",'7','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num8'].",'8','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num9'].",'9','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num10'].",'10','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num11'].",'11','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num12'].",'12','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num13'].",'13','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num14'].",'14','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num15'].",'15','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        $query =  " INSERT INTO Stock_Scarpe (quantita, id_taglia, id_scarpa) VALUES (".$_POST['num16'].",'16','".$id_scarpa."');";
        mysql_query($query) or die(mysql_error());
        header("Location: gestione-scarpe.php");
        EXIT;
      }


  $query = mysql_query("SELECT * FROM Taglia");
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
              "<form id='quantita-scarpe' method='post' action='inserimento-scarpe.php?id=".$id_scarpa."'>";
          while($taglie = mysql_fetch_assoc($query)){
              echo  "<tr>".
                      "<td class='eu'>".$taglie['taglia_eu']."</td>".
                      "<td class='uk-m' style='display: none'>".$taglie['taglia_uk_m']."</td>".
                      "<td class='uk-f' style='display: none'>".$taglie['taglia_uk_f']."</td>".
                      "<td class='us-m' style='display: none'>".$taglie['taglia_us_m']."</td>".
                      "<td class='us-f' style='display: none'>".$taglie['taglia_us_f']."</td>".
                      "<td><input form='quantita-scarpe' type='number' name='num".$taglie['id_taglia']."' value='0'></input></td>".
                    "</tr>";
          }
        echo      "<td><button class='btn btn-default' onclick='inserisci()'>Inserisci</button></td>".
                "</form>".
              "</tbody>".
            "</table>".
          "</div>";



?>
<script type='text/javascript'>
  inserisci = function(){
    $("#quantita-scarpe").submit();
  }
</script>
