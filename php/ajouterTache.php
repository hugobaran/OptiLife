<?php


function creerListe($bdd,$sql,$table){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		echo '<option value="' . $donnees[$table] . '">' .  $donnees[$table] . '</option>';
	}
	$reponse->closeCursor();
}


function traiterAjout(){
	if(isset($_POST["envoyer"])){
		if(!empty($_POST["theme"]) && !empty($_POST["Activite"]) && !empty($_POST["frequence"]) && !empty($_POST["nbFois"]) && !empty($_POST["nbHeures"]) &&
		!empty($_POST["nbMinutes"]) && !empty($_POST["classeAge"])){
		//Envoi du formulaire à la base de donnée
			
			
			echo "<p id='formSend'>Tache Ajoutée</p>";
		}
		else
			echo "<p id='erreur'> Veuillez remplir tout les champs. </p>";
	}
}

function choixFrequence($bdd){
	$tab = LireDonneesPDO1($bdd, 'SELECT * FROM `frequence` ');
	foreach($tab as $ligne)
	{
		foreach($ligne as $cle =>$valeur)
		echo "<input type='radio' name='frequence' id='frequence' value='".$valeur."' ";
		cocherRadio("frequence",$valeur);
		echo ">"."<label for='".$valeur."'>".$valeur."</label>";
	}
}

function choixClasseAge($bdd){
	$tab = LireDonneesPDO1($bdd, 'SELECT * FROM `classe_d_age` ');
		foreach($tab as $ligne)
	{
		foreach($ligne as $cle =>$valeur)
		if($cle == "CAT_LIBELLE"){
			echo "<option value='".$valeur."' ";
			VerifSelect("classeAge",$valeur);
			echo " >".$valeur."</option>";
		}
	}
}

function choixTheme($bdd){
	

	$reponse = $bdd->query('SELECT ACT_LIBELLE FROM ACTIVITE');
	while ($donnees = $reponse->fetch())
	{
	echo $donnees['ACT_LIBELLE'];
	echo "<option value='".$donnees['ACT_LIBELLE']."' ";
	echo " >".$donnees['ACT_LIBELLE']."</option>";
	}

$reponse->closeCursor();




	/*$tab = LireDonneesPDO1($bdd, 'SELECT * FROM `theme` ');
		foreach($tab as $ligne)
	{
		foreach($ligne as $cle =>$valeur)
		if($cle == "THM_LIBELLE"){
			echo "<option value='".$valeur."' ";
			VerifSelect("theme",$valeur);
			echo " >".$valeur."</option>";
		}
	}*/
}

function choixActivite(){
	
}
?>