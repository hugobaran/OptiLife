<?php 
include("../php/connexionBDD.php");

if(!isset ($_SESSION["usrNum"])){
	
	$sql = "SELECT max(USR_NUM)+1 as nb FROM `visiteur`;";
		$stmt =  $bdd->query($sql);
		$i=0;
		foreach($stmt as $row){
		if($i ==0){
			$nb= $row['nb'];
			$i++;
			}
		}
	
	$_SESSION["usrNum"] = $nb;
	$_SESSION["usrDate"] = date("Y-m-d");
	$sql = "INSERT INTO visiteur (USR_NUM, USR_DATE) VALUES ('".$_SESSION["usrNum"]."','".$_SESSION["usrDate"]."')";
	$stmt = $bdd->exec($sql);
	
}


?>