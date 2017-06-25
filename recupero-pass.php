<?php
include_once("./config.php");
include_once("./header.php");

if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    header("Location: index.php");
    EXIT;
}

if(isset($_POST['email']) && $_POST['email'] != "") {
    $email = trim($_POST['email']);

    //SE ESISTE UN UTENTE CON QUESTA MAIL SIMULO LA PROCEDURA DI RECUPERO PASSWORD
    $stmt = $mysqli->prepare("SELECT *
                                 FROM Utente
                                 WHERE email = ?");
    $stmt->bind_param('s',$email);

    $stmt->execute();

    $utente = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);

    if($utente){

        $newPass = md5(str_shuffle($utente['password']));
        $message = "La tua nuova Password: \r\n$newPass\r\n";

        // In case any of our lines are larger than 70 characters, we should use wordwrap()
        $message = wordwrap($message, 70, "\r\n");
        // Send
        mail('giacomocalcara94@gmail.com', 'My Subject', $message);

        $newPass = md5($newPass.$SAFEWORD);

        $stmt = $mysqli->prepare("UPDATE  Utente
                                  SET password = ?
                                  WHERE id_utente = $utente[id_utente]");
        $stmt->bind_param('s',$newPass);

        if($stmt->execute()){
          echo "<script type='text/javascript'>alert('Ti abbiamo inviato una mail con una password temporanea!')</script>";
        }


    }
    //ALTRIMENTI INFORMO L'UTENTE DELLA NON RIUSCITA
    else {
        echo "<script type='text/javascript'>alert('Non ci risulta nessun utente registrato con questa mail!')</script>";
    }
}

?>


<!-- FORM PER INSERIMENTO DATI LOGIN -->
<div class="container" >
    <div >
        <h1 class="text-center">Accedi</h1>
        <form action="recupero-pass.php" method="POST">
            <div class="form-group">
              <label>Email:</label>
              <input type="email" value="" name="email" class="form-control"></input>
            </div>
              <div>
                <button class="btn btn-primary" type="submit" class="success button expanded">Recupera Password</button>
              </div>
            </div>
        </form>
    </div>
</div>
