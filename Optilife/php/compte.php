<?php session_start();
	include("../html/header.php");
	
	echo "Bienvenue sur votre compte cher ".$_SESSION["usrPseudo"];
	if($_SESSION["usrAdmin"]==1){
		include("../html/ajoutOptiBDD.php");
	}


?>