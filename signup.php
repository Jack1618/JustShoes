<?php
  include_once("./config.php");
  include_once("./header.php");

  if(isset($_POST["email"]) && isset($_POST["password"])){
    $email = trim($_POST["email"]);
    $password = md5(trim($_POST["password"]).$SAFEWORD);
    $gruppo_applicativo = "1";
    $sql = "INSERT INTO Utente (id_utente, email, password, id_gruppo_applicativo,id_carta) ".
           "VALUES(NULL,'".$email."','".$password."',".$gruppo_applicativo.", NULL)";
           
    //echo $sql;
    mysql_query($sql) or die ("Inserimento in DB non riuscito");
  }

?>
<form method="post" id="signup">
  <div>
    <label for="email">Email</label>
    <input type="email" name="email"></input>
  </div>
  <div>
    <label for="password">Password</label>
    <input type="password" name="password" id="pwd"></input>
  </div>
  <div>
    <label for="r-password">Ripeti Password</label>
    <input type="password" name="r-password" id="r-pwd"></input>
  </div>
  <div>
    <button onclick="checkPwd()">Registrati</button>
  </div>
</form>
<script type="text/javascript">
  checkPwd = function(){
    if($("#pwd").val().trim() !== $("#r-pwd").val().trim()){
      alert("Le Password non corrispondono");
    }
    else {
      $("signup").submit();
      Window.go("./signup.php");
    }
  }
</script>
