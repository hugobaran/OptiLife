<?php 
include("../php/connexionBDD.php");

if(!isset ($_SESSION["usrNum"])){
	$_SESSION["usrNum"] = 15;//uniqid ("opti");
	$_SESSION["usrDate"] = date("Y-m-d");
	$sql = "INSERT INTO visiteur (USR_NUM, USR_DATE) VALUES ('".$_SESSION["usrNum"]."','".$_SESSION["usrDate"]."')";
	$stmt = $bdd->exec($sql);
	
}


?>