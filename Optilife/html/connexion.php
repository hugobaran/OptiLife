<?php session_start();
 
include("../php/connexionBDD.php");

include("header.php");

if(!isset($_POST["pseudo"])){
	include("connexion.html");
}else{
	if(!empty($_POST["pseudo"]) && !empty($_POST["mdp"])){
		$pseudo = $_POST["pseudo"];
		$mdp = $_POST["mdp"];
		$sql = "SELECT `USR_NUM`,`USR_ADMIN` FROM `inscrit` WHERE `USR_PSEUDO` = '".$pseudo."' AND `USR_MDP` = '".$mdp."'";
		$reponse = $bdd->query($sql);
        if($reponse->rowCount() == 0){
        	header("connexion.html");
        }else{
        	while ($donnees = $reponse->fetch()){
        		$num = $donnees['USR_NUM'];
        		$admin = $donnees['USR_ADMIN'];
        		if(isset($_SESSION['EMP_NUM'])){
					$sql = "UPDATE emploidutemps SET USR_NUM_VISITEUR = NULL, USR_NUM_INSCRIT = '" . $num . "' WHERE USR_NUM_VISITEUR = '" . $_SESSION["usrNum"] ."'";
					$bdd->exec($sql);
				}
        		$_SESSION["usrNum"]=$num; 
				$_SESSION["usrPseudo"]=$pseudo;
				$_SESSION["usrAdmin"]=$admin; 
				header('location:accueil.php');
        	}
        }
	} 
}



?>

