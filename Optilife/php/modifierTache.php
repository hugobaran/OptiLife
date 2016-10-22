<?php

function modifierTache($bdd){
	if(isset($_POST["modifier"])){
		echo "bien ds la fonction";
		//if(!chercherDejaPresent($bdd, $_POST["activite"], $_POST["frequence"], 1, $age)){//Fonctionne pas, la tache est déja présente
				//Suppression de l'ancienne activité
				echo $_POST["activite"]."</br>";
				echo $_POST["EXfrequence"]."</br>";
				echo $_POST["classe_age"]."</br>";
				echo $_POST["frequence"]."</br>";
				echo $_POST["nbFois"]."</br>";
				echo $_POST["nbHeure"]."</br>";
				echo $_POST["nbMinutes"]."</br>";
				$act_num = chercherAct($bdd, $_POST['activite']);
				$fr_lib = $_POST['EXfrequence'];
				$cat_num = $_POST['classe_age'];
				$sql = 'DELETE FROM `pratiquer` WHERE `ACT_NUM` = '.$act_num.' AND `pratiquer`.`FR_LIBELLE` = "'.$fr_lib.'" AND `pratiquer`.`CAT_NUM` = '.$cat_num.' AND `pratiquer`.`EMP_NUM` = 1 ';
	   			echo $sql;
	   			$bdd->exec($sql);
			traiterAjout($bdd);
		//}
		//else{
		//	echo "<p id='erreur'>Cette activité existe déja avec cette frequence et cette classe d'age</p>";
		//}

	}

}

?>