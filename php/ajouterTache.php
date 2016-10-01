<?php


function creerListe($bdd,$sql,$table){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		echo '<option value="' . $donnees[$table] . '">' .  $donnees[$table] . '</option>';
	}
	$reponse->closeCursor();
}

function chercherAct($bdd, $lib){
			$sql1 = "SELECT * FROM `activite` WHERE `ACT_LIBELLE` LIKE '".$lib."' ";
			$tab = LireDonneesPDO1($bdd, $sql1);
			return $tab[0]["ACT_NUM"];
}

function chercherDejaPresent($bdd, $act, $freq, $emp, $age){
	$act = chercherAct($bdd, $act);
	$sql1 = "SELECT * FROM `pratiquer` WHERE `ACT_NUM` = ".$act." AND `FR_LIBELLE` LIKE '".$freq."' AND `CAT_NUM` = ".$age." AND `EMP_NUM` = ".$emp." ";
	$tab = @LireDonneesPDO1($bdd, $sql1);
	if(empty($tab))
		return false;
	else
		return true;
}


function traiterAjout($bdd){
	if(isset($_POST["envoyer"])){
		if(!empty($_POST["theme"]) && !empty($_POST["activite"]) && !empty($_POST["frequence"]) && !empty($_POST["nbFois"]) && !empty($_POST["nbHeure"]) &&
		!empty($_POST["nbMinutes"]) && !empty($_POST["classe_age"])){
		//Envoi du formulaire � la base de donn�e
			if(($_POST["classe_age"] == "Etudiant"))
				$age = 1;
			else if(($_POST["classe_age"] == "Actif"))
				$age = 2;
			else
				$age = 3;
			//on ajoute uniquement si ce n'est pas d�ja pr�sent dans l'emploi du tps
			if(!chercherDejaPresent($bdd, $_POST["activite"], $_POST["frequence"], 1, $age)){

				$actLib = chercherAct($bdd, $_POST["activite"]);
				
				$temps = $_POST["nbHeure"] + ($_POST["nbMinutes"]/60);//transforme les donn�es du form en donn�e lisible par la base
				$sql = "INSERT INTO `optilife`.`pratiquer` (`ACT_NUM`, `FR_LIBELLE`, `CAT_NUM`, `EMP_NUM`, `PRA_NB_FOIS`, `PRA_DUREE`) VALUES ('".$actLib."', '".$_POST["frequence"]."', '".$age."', '"."1"."', '".$_POST["nbFois"]."', '".$temps."')";
	  			$stmt = $bdd->exec($sql);
				
	  			echo "<script> resetFields(); </script>";
				echo "<p id='formSend'>Tache Ajout�e</p>";
			}
			else
				echo "<p id='erreur'>Cette activit� existe d�ja avec cette frequence et cette classe d'age</p>";
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