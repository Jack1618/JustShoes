<?php
	include_once("./config.php");
	include_once("./header.php");
	include_once("./footer.php");
?>


<?php
	if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true){
		include_once("./cliente/wishlist.php");
		echo "<b></b><h2>Benvenuto, ".$_SESSION['email'].".</h2>";
	}
	
?>

