<?php
include_once("./config.php");
include_once("./header.php");


//if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
  //  header("Location: index.php");
    //EXIT;
//}

if(isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['password']) && $_POST['password'] != "") {
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']).$SAFEWORD);

    $sql = "SELECT * FROM Utente WHERE email = '$email' AND password = '$password'";
    $query = mysql_query($sql) or die("Impossibile effettuare il login\n");
    if(mysql_num_rows($query) > 0) { //Login completato
        $ris = mysql_fetch_assoc($query);
        $_SESSION['errore'] = false;
        $_SESSION['logged'] = true;
        $_SESSION['id'] = $ris['id_utente'];
        $_SESSION['email'] = $ris['email'];
        if($ris['id_gruppo_applicativo'] === "1"){
          $_SESSION['admin'] = true;
        }
        else{
          $_SESSION['admin'] = false;
        }
        header("Location: index.php");
        EXIT;
    } else {
        $_SESSION['error'] = true;
        $_SESSION['error']['message'] = "Email e/o Password non corretti!";
        $_SESSION['logged'] = false;
        header("Location: login.php");
        EXIT;
    }
}
if(isset($_SESSION['error']) && $_SESSION['error'] == true) {?>
<div >
    <div >
        <div class="callout alert">
            <h5>Errore durante l'autenticazione!</h5>
            <p><?php echo $_SESSION['error']['message']; $_SESSION['error'] = false; ?></p>
            <button class="close-button" aria-label="Chiudi" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
<?php } ?>

<div >
    <div >
        <h1 class="text-center">Accedi</h1>
        <form action="login.php" method="POST">
            <div >
                <div >
                    <label>Email:
                        <input type="email" value="prova@example.com" name="email">
                    </label>
                </div>
                <div >
                    <label>Password:
                        <input type="password" name="password" value="prova">
                    </label>
                </div>
                <div >
                    <button type="submit" class="success button expanded">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include_once("./footer.php");
?>
<script type="text/javascript">
console.log("ciao");
  $(".close-button").click(function() {
      $(".avvisoErrore").hide();
  });
</script>
