<?php session_start();
 
include("../php/connexionBDD.php");

include("header.php");
include("connexion.html");

if(!empty($_POST["pseudo"])){
	if(!empty($_POST["mdp"])){
		$pseudo = $_POST["pseudo"];
		$mdp = $_POST["mdp"];
		
		$sql = "SELECT count(*) as nb FROM `inscrit` WHERE `USR_PSEUDO` = '".$pseudo."' AND `USR_MDP` = '".$mdp."';";
		$stmt =  $bdd->query($sql);
		$i=0;
		foreach($stmt as $row){
		if($i ==0){
			$nb= $row['nb'];
			$i++;
			}
		}
		if($nb>0){
			$_SESSION["usrPseudo"]=$pseudo;
		}

	}
	else{ }
}

// traitement du formulaire

?>