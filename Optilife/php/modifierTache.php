<?php

function modifierTache($bdd){
	if(isset($_POST["modifier"])){
		//if(!chercherDejaPresent($bdd, $_POST["activite"], $_POST["frequence"], 1, $age)){//Fonctionne pas, la tache est déja présente
				//Suppression de l'ancienne activité
		if(($_POST["EXfrequence"] != $_POST["frequence"] && !chercherDejaPresent($bdd, $_POST["activite"], $_POST["frequence"], 1, $_POST['classe_age'])) || $_POST["EXfrequence"] == $_POST["frequence"]){
				echo $_POST["activite"]."</br>";
				echo $_POST["frequence"]."</br>";
				echo $_POST["classe_age"]."</br>";
				echo $_POST["frequence"]."</br>";
				echo $_POST["nbFois"]."</br>";
				echo $_POST["nbHeure"]."</br>";
				echo $_POST["nbMinutes"]."</br>";
				$act_num = $_POST['activite'];
				$fr_lib = $_POST['frequence'];
				$cat_num = $_POST['classe_age'];
				$nbfois = $_POST["nbFois"];
				$temps = $_POST["nbHeure"]*60 + ($_POST["nbMinutes"]);
				$sql = "UPDATE pratiquer SET FR_LIBELLE = '" . $fr_lib . "', PRA_NBFOIS = '" . $nbfois . "' , PRA_DUREE = '" . $temps . "' , OPTIMISER = '0' WHERE ACT_NUM = '" . $act_num . "' AND CAT_NUM = '" . $cat_num . "' AND EMP_NUM = '1'";
	   			$bdd->exec($sql);
		}
		else{
			echo "<p id='erreur'>Cette activité existe déja avec cette frequence et cette classe d'age</p>";
			throw new PDOException('activtePres');
		}

	}

}

?>