<?php


function traiterAjout(){
	if(isset($_POST["envoyer"])){
		if(!empty($_POST["theme"]) && !empty($_POST["Activite"]) && !empty($_POST["frequence"]) && !empty($_POST["nbFois"]) && !empty($_POST["nbHeures"]) &&
		!empty($_POST["nbMinutes"]) && !empty($_POST["classeAge"])){
		//Envoi du formulaire � la base de donn�e
			
			
			echo "<p id='formSend'>Tahce Ajouot�e</p>";
		}
		else
			echo "<p id='erreur'> Veuillez remplir tout les champs. </p>";
	}
}

function choixFrequence(){
	
}

function choixClasseAge(){
	
}

function choixTheme(){
	
}

function choixActivite(){
	
}

?>