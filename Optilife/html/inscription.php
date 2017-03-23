<?php session_start();
 
include("../php/connexionBDD.php");

include("header.php");

include("inscription.html");

if(!empty($_POST["pseudo"]) && !empty($_POST["mail"])){

		if(!empty($_POST["mdp"]) && ! empty($_POST["mdpVerif"])){
		if($_POST["mdp"]== $_POST["mdpVerif"]){
				$pseudo = $_POST["pseudo"];
				$mdp = $_POST["mdp"];
				$mail = $_POST["mail"];

				$sql = "INSERT INTO `inscrit` (`USR_MAIL`, `USR_PSEUDO`, `USR_MDP`, `USR_ADMIN`) values ('".$mail."','".$pseudo."','".$mdp."', 0);";
				$stmt =  $bdd->exec($sql);
				header("location:accueil.php");
				exit();
			}
			else{
				echo "<script>alert(\"Les mots de passe ne sont pas identiques\")</script>"; 
			}
		
		}
		else{
			echo "<script>alert(\"Veuillez remplir tous les champs\")</script>"; 
		}
		

}
else{
		echo "<script>alert(\"Veuillez remplir tous les champs\")</script>"; 
	}
?>