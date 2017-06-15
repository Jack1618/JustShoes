<script src="http://localhost/JustShoes/lib/jQuery/jquery-3.2.1.js"></script>
<link href="http://localhost/JustShoes/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
<script src="http://localhost/JustShoes/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="http://localhost/JustShoes/lib/javascript/paging.js"></script>
<link href="/JustShoes/lib/css/main.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://localhost/JustShoes/lib/javascript/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="http://localhost/JustShoes/lib/css/bootstrap-multiselect.css" type="text/css"/>

<?php
	$HOST = "localhost";
	$USER = "root";
	$PASS = "root";
	$DB   = "JustShoes";
	$SAFEWORD = "JuS75h03$";

	$var = 4;

	$con = mysql_connect($HOST, $USER, $PASS) or die("Connessione a mysql non riuscita\n");
	$db = mysql_select_db($DB, $con) or die("Impossibile selezionare il database\n");
	$mysqli = new mysqli("localhost", "root", "root", "JustShoes");


	//Session started
	session_start();

	if(!isset($_SESSION['admin'])){
		$_SESSION['admin'] = false;
	}
?>
<script type="text/javascript"></script>
