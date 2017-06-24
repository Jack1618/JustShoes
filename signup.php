<?php
  include_once("./config.php");
  include_once("./header.php");

  if(isset($_POST["email"]) && isset($_POST["password"])){
    $email = trim($_POST["email"]);
    $password = md5(trim($_POST["password"]).$SAFEWORD);
    //IMPOSTO L'UTENTE COME CLIENTE
    $gruppo_applicativo = "2";
    $sql = "INSERT INTO Utente (id_utente, email, password, id_gruppo_applicativo, attivo)
            VALUES (NULL,?, ?, '$gruppo_applicativo', 1)";
    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param('ss',$email,$password);

    if($stmt->execute()){
      $id_utente = $mysqli->insert_id;
      $_SESSION['logged'] = true;
      $_SESSION['id_utente'] = $id_utente;
      $_SESSION['email'] = $email;
      $_SESSION['admin'] = false;
    }
    else echo "<script>alert('Email gia\' in uso!');</script>";



    header("Location: index.php");
    EXIT;
  }

?>
<!-- FORM PER INSERIMENTO DATI REGISTRAZIONE -->
<div class="container">
  <h1 align="center">Registrati</h1>
<form method="post" id="signup" action="signup.php">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control"></input>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="pwd" class="form-control"></input>
  </div>
  <div class="form-group">
    <label for="r-password">Ripeti Password</label>
    <input type="password" name="r-password" id="r-pwd" class="form-control"></input>
  </div>

</form>
<div>
  <button class="btn btn-primary" onclick="checkPwd()">Registrati</button>
</div>
</div>

<script type="text/javascript">
  checkPwd = function(){
    if($("#pwd").val().trim() !== $("#r-pwd").val().trim()){
      alert("Le Password non corrispondono");
    }
    else {
      $("#signup").submit();
      //Window.go("./signup.php");
    }
  }
</script>
