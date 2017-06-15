<?php
include_once("./config.php");
include_once("./header.php");


if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    header("Location: index.php");
    EXIT;
}

if(isset($_GET["option"])){
  $option = $_GET["option"];
}
if(isset($_GET["id"])){
  $id = $_GET["id"];

}

if(isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['password']) && $_POST['password'] != "") {
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']).$SAFEWORD);

    $sql = "SELECT * FROM Utente WHERE email = '$email' AND password = '$password'";
    $query = mysql_query($sql) or die("Impossibile effettuare il login\n");
    if(mysql_num_rows($query) > 0) { //Login completato
        $ris = mysql_fetch_assoc($query);
        $_SESSION['errore'] = false;
        $_SESSION['logged'] = true;
        $_SESSION['id_utente'] = $ris['id_utente'];
        $_SESSION['email'] = $ris['email'];
        if($ris['id_gruppo_applicativo'] === "1"){
          $_SESSION['admin'] = true;
          header('Location: http://localhost/JustShoes/admin/gestione-scarpe.php');
          EXIT;
        }
        else{
          $_SESSION['admin'] = false;

        }
        if($option == "default"){
          header("Location: http://localhost/JustShoes/index.php");
        }
        if($option == "wishlist"){
          header("Location: http://localhost/JustShoes/cliente/wishlist-add.php?id=".$_GET["id"]);
        }
        if($option == "acquisto"){
          header("Location: http://localhost/JustShoes/cliente/add-wishlist.php?id=".$_GET["id"]);
        }
        EXIT;
    } else {
        $_POST = array();
        echo "<script type='text/javascript'>alert('Email e/o Password errati!')</script>";
    }
}
?>


<div >
    <div >
        <h1 class="text-center">Accedi</h1>
        <form action=<?php echo "'login.php?option=".$option."&id=".$_GET["id"]."'";?> method="POST">
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
