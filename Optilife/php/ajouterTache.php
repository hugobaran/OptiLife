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
		$sdomaine = utf8_encode($donnees['SD_LIBELLE']);
		$actLib = utf8_encode($donnees['ACT_LIBELLE']);
		$act = $donnees['ACT_NUM'];
		echo '<option class="'.$sdomaine.'" value="' . $act . '" ' ;
		VerifSelect($form, $act);
		echo  ' >'.$actLib . '</option>';

	}
	$reponse->closeCursor();
}

function creerListeSousDomaine($bdd,$sql,$table){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$domaine = utf8_encode($donnees['DOM_LIBELLE']);
		$sdLib = utf8_encode($donnees['SD_LIBELLE']);
		echo '<option class="'.$domaine.'" value="' . $sdLib . '" ' ;
		//VerifSelect($form, $act);
		echo  ' >'.$sdLib . '</option>';

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
	//$act = chercherAct($bdd, $act);
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
    			$act = $_POST["activite"];
    			$heures = $_POST["nbHeure"];
    			$minutes = $_POST["nbMinutes"];
    			$frequence = $_POST["frequence"];
    			$nbfois = $_POST["nbFois"];
    			$temps = $heures*60 + ($minutes);//transforme les données du form en donnée lisible par la base
			    foreach ($array as $age) {
					//on ajoute uniquement si ce n'est pas déja présent dans l'emploi du tps
					if(!chercherDejaPresent($bdd, $act, $frequence, 1, $age)){
						//verification que le temps soit cohérent
						if(verifierTemps($frequence, $temps, $nbfois)){
							$sql = "INSERT INTO `pratiquer` (`ACT_NUM`, `FR_LIBELLE`, `CAT_NUM`, `EMP_NUM`, `PRA_NBFOIS`, `PRA_DUREE`, `PRA_DUREE_OPTI`) VALUES ('".$act."', '".$frequence."', '".$age."', '"."1"."', '".$nbfois."', '".$temps."', '".$temps."')";
				  			$stmt = $bdd->exec($sql);
							echo $sql;
				  			echo "<script> resetFields(); </script>";
							echo "<p id='formSend'>Tache Ajoutée</p>";
						}else {
							echo "<p id='erreur'>Le temps n'est pas cohérent</p>";
							throw new PDOException('activiteTemps');
						}
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
	$tab = LireDonneesPDO1($bdd, 'SELECT * FROM `frequence` order by FR_NUM ');
	foreach($tab as $ligne)
	{
		echo "<label for='".$ligne['FR_LIBELLE']."' class='radio-inline'><input type='radio' onclick='affiche_bouton()' name='frequence' id='".$ligne['FR_LIBELLE']."' value='".$ligne['FR_LIBELLE']."' ";
		//cocherRadio("frequence",$valeur);
		echo ">".$ligne['FR_LIBELLE']."</label>";
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

function choixDomaine($bdd){
	$tab = LireDonneesPDO1($bdd, 'SELECT * FROM `domaine` ');
	foreach($tab as $ligne)
	{
		foreach($ligne as $cle =>$valeur)
		if($cle == "DOM_LIBELLE"){
			$valeur = utf8_encode($valeur);
			echo "<option value='".$valeur."' ";
			VerifSelect("domaine",$valeur);
			echo " >".$valeur."</option>";
		}
	}
}

function choixSousDomaine($bdd){
	$tab = LireDonneesPDO1($bdd, 'SELECT * FROM `sous_domaine` ');
	foreach($tab as $ligne)
	{
		foreach($ligne as $cle =>$valeur)
		if($cle == "SD_LIBELLE"){
			$valeur = utf8_encode($valeur);
			echo "<option value='".$valeur."' ";
			//VerifSelect("domaine",$valeur);
			echo " >".$valeur."</option>";
		}
	}
}

function verifierTemps($frequence, $duree, $nbfois){
	$duree = $duree/60;
	switch ($frequence) {
		case 'Journalier':
			if($nbfois*$duree < 24)
				return true;
			else
				return false;
			break;
		case 'Hebdomadaire':
			if($nbfois*$duree < 168)
				return true;
			else
				return false;
			break;
		case 'Mensuel':
			if($nbfois*$duree < 744)
				return true;
			else
				return false;
			break;
		case 'Trimestriel':
			if($nbfois*$duree < 2232)
				return true;
			else
				return false;
			break;
		case 'Annuel':
			if($nbfois*$duree < 8928)
				return true;
			else
				return false;
			break;
		default:
			return false;
			break;
	}
}


?>