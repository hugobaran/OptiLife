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

function creerListeActivite($bdd,$sql,$table, $form){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$theme = utf8_encode($donnees['THM_LIBELLE']);
		$act = utf8_encode($donnees['ACT_LIBELLE']);
		echo '<option class="'.$theme.'" value="' . $act . '" ' ;
		VerifSelect($form, $act);
		echo  ' >'.$act . '</option>';

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
		//Envoi du formulaire à la base de donnée
			if (!empty($_POST['classe_age'])) {
    			$array = $_POST['classe_age'];
			    foreach ($array as $age) {
					//on ajoute uniquement si ce n'est pas déja présent dans l'emploi du tps
					if(!chercherDejaPresent($bdd, $_POST["activite"], $_POST["frequence"], 1, $age)){
						echo "passage2";
						$actLib = chercherAct($bdd, $_POST["activite"]);
						$actLib = utf8_decode($actLib);
						$temps = $_POST["nbHeure"]*60 + ($_POST["nbMinutes"]);//transforme les données du form en donnée lisible par la base
						$sql = "INSERT INTO `pratiquer` (`ACT_NUM`, `FR_LIBELLE`, `CAT_NUM`, `EMP_NUM`, `PRA_NB_FOIS`, `PRA_DUREE`) VALUES ('".$actLib."', '".$_POST["frequence"]."', '".$age."', '"."1"."', '".$_POST["nbFois"]."', '".$temps."')";
			  			$stmt = $bdd->exec($sql);
						echo $sql;
			  			echo "<script> resetFields(); </script>";
						echo "<p id='formSend'>Tache Ajoutée</p>";
					}
					else {
						echo "<p id='erreur'>Cette activité existe déja avec cette frequence et cette classe d'age</p>";
						throw new PDOException('activtePres');
					}

			    }
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
		echo "<label for='".$valeur."' class='radio-inline'><input type='radio' name='frequence' id='".$valeur."' value='".$valeur."' ";
		//cocherRadio("frequence",$valeur);
		echo ">".$valeur."</label>";
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