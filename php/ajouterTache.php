<?php


function creerListe($bdd,$sql,$table){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		echo '<option value="' . $donnees[$table] . '">' .  $donnees[$table] . '</option>';
	}
	$reponse->closeCursor();
}


function traiterAjout($bdd){
	if(isset($_POST["envoyer"])){
		if(!empty($_POST["theme"]) && !empty($_POST["activite"]) && !empty($_POST["frequence"]) && !empty($_POST["nbFois"]) && !empty($_POST["nbHeure"]) &&
		!empty($_POST["nbMinutes"]) && !empty($_POST["classe_age"]))
		/*if(!empty($_POST["theme"]))
		echo "theme"; 
		if(!empty($_POST["activite"]))
			echo "act";
		if(!empty($_POST["frequence"]))
			echo "frequ";
		if(!empty($_POST["nbFois"]))
			echo "nbfois"; 
		if(!empty($_POST["nbHeures"]))
			 echo "nbHeures";
		if(!empty($_POST["nbMinutes"]))
			echo "nbMinutes"; 
		if(!empty($_POST["classe_age"]))
			echo "classe age";*/
		{
		//Envoi du formulaire à la base de donnée
			if(($_POST["classe_age"] == "Etudiant"))
				$age = 1;
			else if(($_POST["classe_age"] == "Actif"))
				$age = 2;
			else
				$age = 3;
			$temps = $_POST["nbHeure"] + ($_POST["nbMinutes"]/60);//transforme les données du form en donnée lisible par la base
			$sql = "INSERT INTO `optilife`.`pratiquer` (`ACT_NUM`, `FR_LIBELLE`, `CAT_NUM`, `EMP_NUM`, `PRA_NB_FOIS`, `PRA_DUREE`) VALUES ('"."2"."', '".$_POST["frequence"]."', '".$age."', '"."1"."', '".$_POST["nbFois"]."', '".$temps."')";
  			echo $sql;
  			$stmt = $bdd->exec($sql);
			echo 'RES : ',$stmt ,'<br/>';

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
			VerifSelect("classe_age",$valeur);
			echo " >".$valeur."</option>";
		}
	}
}

function choixTheme($bdd){
	$tab = LireDonneesPDO1($bdd, 'SELECT * FROM `theme` ');
	foreach($tab as $ligne)
	{
		foreach($ligne as $cle =>$valeur)
		if($cle == "THM_LIBELLE"){
			echo "<option value='".$valeur."' ";
			VerifSelect("theme",$valeur);
			echo " >".$valeur."</option>";
		}
	}
}

function choixActivite(){
	
}
?>