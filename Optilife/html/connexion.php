<?php session_start();
 
include("../php/connexionBDD.php");

include("header.php");

if(!isset($_POST["pseudo"])){
include("connexion.html");
}

if(!empty($_POST["pseudo"])){
	if(!empty($_POST["mdp"])){
		$pseudo = $_POST["pseudo"];
		$mdp = $_POST["mdp"];
		
		$sql = "SELECT count(*) as nb, `USR_NUM` as num,`USR_ADMIN` as adm FROM `inscrit` WHERE `USR_PSEUDO` = '".$pseudo."' AND `USR_MDP` = '".$mdp."';";
		$stmt =  $bdd->query($sql);
		$i=0;
		foreach($stmt as $row){
		if($i ==0){
			$nb= $row['nb'];
			$admin= $row['adm'];
			$num= $row['num'];
			$i++;
			}
			
		}
		if($nb>0){
			$_SESSION["usrNum"]=$num; 
			$_SESSION["usrPseudo"]=$pseudo;
			$_SESSION["usrAdmin"]=$admin; 
			header('location:accueil.php');
		}

	}
	else{ }
} 

?>

