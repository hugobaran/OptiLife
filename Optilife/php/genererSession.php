<?php 
 @session_start();
include("../php/connexionBDD.php");
 echo "usr_num : ".$_SESSION["usrNum"]."</br>";
 echo "usr_date : ".$_SESSION["usrDate"]."</br>";
if(empty($_SESSION["usrNum"])){
	
	$nb=uniqid();
	
	$_SESSION["usrNum"] = $nb;
	$_SESSION["usrDate"] = date("Y-m-d");
	$sql = "INSERT INTO visiteur (USR_NUM, USR_DATE) VALUES ('".$_SESSION["usrNum"]."','".$_SESSION["usrDate"]."')";
	$stmt = $bdd->exec($sql);
	 echo "usr_num : ".$_SESSION["usrNum"]."</br>";
 echo "usr_date : ".$_SESSION["usrDate"]."</br>";
	//header("location: ../html/main.php");
}


?>