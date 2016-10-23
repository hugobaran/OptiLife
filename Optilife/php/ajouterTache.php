<?php


function creerListe($bdd,$sql,$table, $form){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$valeur = utf8_encode($donnees[$table]);
		echo '<option value="' . $valeur . '" ' ;
		VerifSelect($form, $valeur);
		echo  ' >'.$valeur . '</option>';
	}
	$reponse->closeCursor();
}

function chercherAct($bdd, $lib){
			$lib = utf8_decode($lib);
			$sql1 = "SELECT * FROM `activite` WHERE `ACT_LIBELLE` LIKE '".$lib."' ";
			$tab = LireDonneesPDO1($bdd, $sql1);
			return $tab[0]["ACT_NUM"];
}

function chercherDejaPresent($bdd, $act, $freq, $emp, $age){
	$act = chercherAct($bdd, $act);
	$sql1 = "SELECT * FROM `pratiquer` WHERE `ACT_NUM` = ".$act." AND `FR_LIBELLE` LIKE '".$freq."' AND `CAT_NUM` = ".$age." AND `EMP_NUM` = ".$emp." ";
	$tab = @LireDonneesPDO3($bdd, $sql1);
	if(empty($tab))
		return false;
	else
		return true;
}


function traiterAjout($bdd){
		if(!empty($_POST["activite"]) && !empty($_POST["frequence"]) && !empty($_POST["nbFois"]) && isset($_POST["nbHeure"]) &&
		isset($_POST["nbMinutes"]) && !empty($_POST["classe_age"])){
		//Envoi du formulaire � la base de donn�e
			echo "passage1";
			if(($_POST["classe_age"] == "Etudiant") || $_POST["classe_age"] == 1)
				$age = 1;
			else if(($_POST["classe_age"] == "Actif") || $_POST["classe_age"] == 2)
				$age = 2;
			else
				$age = 3;
			//on ajoute uniquement si ce n'est pas d�ja pr�sent dans l'emploi du tps
			if(!chercherDejaPresent($bdd, $_POST["activite"], $_POST["frequence"], 1, $age)){
				echo "passage2";
				$actLib = chercherAct($bdd, $_POST["activite"]);
				$actLib = utf8_decode($actLib);
				$temps = $_POST["nbHeure"] + ($_POST["nbMinutes"]/60);//transforme les donn�es du form en donn�e lisible par la base
				$sql = "INSERT INTO `pratiquer` (`ACT_NUM`, `FR_LIBELLE`, `CAT_NUM`, `EMP_NUM`, `PRA_NB_FOIS`, `PRA_DUREE`) VALUES ('".$actLib."', '".$_POST["frequence"]."', '".$age."', '"."1"."', '".$_POST["nbFois"]."', '".$temps."')";
	  			$stmt = $bdd->exec($sql);
				echo $sql;
	  			echo "<script> resetFields(); </script>";
				echo "<p id='formSend'>Tache Ajout�e</p>";
			}
			else {
				echo "<p id='erreur'>Cette activit� existe d�ja avec cette frequence et cette classe d'age</p>";
				throw new PDOException('activtePres');
			}
		}
		else{
			echo "<p id='erreur'> Veuillez remplir tout les champs. </p>";
			throw new PDOException('incomplet');
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
			$valeur = utf8_encode($valeur);
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
			$valeur = utf8_encode($valeur);
			echo "<option value='".$valeur."' ";
			VerifSelect("theme",$valeur);
			echo " >".$valeur."</option>";
		}
	}
}

function choixActivite(){
	
}
?>