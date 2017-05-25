<?php
include_once("./config.php");
include_once("./header.php");


if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    header("Location: index.php");
    EXIT;
}

if(isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['password']) && $_POST['password'] != "") {
    $email = htmlspecialchars(mysql_escape_string(trim($_POST['email'])));
    $password = htmlspecialchars(mysql_escape_string(trim($_POST['password'])));

    $sql = "SELECT * FROM Utente WHERE email = '$email' AND password = '$password'";
    $query = mysql_query($sql) or die("Impossibile effettuare il login\n");
    if(mysql_num_rows($query) > 0) { //Login completato
        $ris = mysql_fetch_assoc($query);
        echo var_dump($ris);
        //$_SESSION['error'] = false;
        //$_SESSION['logged'] = true;
        //$_SESSION['nameComplete'] = $ris['name']." ".$ris['surname'];
        //$_SESSION['id'] = $ris['id'];
        //$_SESSION['admin'] = $ris['admin'];
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
        <h1 class="text-center">Login</h1>
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
  $(".close-button").click(function() {
      $(".avvisoErrore").hide();
  });
</script>
</body>
</html>
