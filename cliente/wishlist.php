<?php
  $wishes = $mysqli->query("SELECT * FROM Wishlist JOIN Scarpa ON Wishlist.id_scarpa = Scarpa.id_scarpa WHERE id_utente = $_SESSION[id_utente] AND attivo = '1'");
?>
<div class="wishlist">
    <div class="wish-label">WISHLIST</div>
    <?php
    if($wishes){
      while($wish = $wishes->fetch_array(MYSQLI_ASSOC)){
        echo "<div class='wish-thumb'>
                <a href='./scarpa.php?id=$wish[id_scarpa]'>
                  <img class='wish-img' src='./img/scarpe/$wish[foto]'/>
                </a>
                <a href='./cliente/wishlist-delete.php?id=$wish[id_scarpa]'>
                  <img class='wish-delete'/ src='./img/wish-delete.png'>
                </a>
              </div>";
      }
    }
    ?>
</div>
