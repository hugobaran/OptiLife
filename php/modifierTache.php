<?php

function modifierTache($bdd){
	if(isset($_POST["ajouter"])){

		if(!chercherDejaPresent($bdd, $_POST["activite"], $_POST["frequence"], 1, $age)){//Fonctionne pas, la tache est déja présente
			//Suppression de l'ancienne activité
			if(isset($POST['EXactivite']) && isset($_POST['EXfrequence']) && isset($_POST['EXclasseAge'])){
				$act_num = chercherAct($_POST['EXactivite']);
				$fr_lib = $_POST['EXfrequence'];
				$cat_num = $_POST['EXclasseAge'];
				$sql = 'DELETE FROM `optilife`.`pratiquer` WHERE `ACT_NUM` = '.$act_num.' AND `pratiquer`.`FR_LIBELLE` = "'.$fr_lib.'" AND `pratiquer`.`CAT_NUM` = '.$cat_num.' AND `pratiquer`.`EMP_NUM` = 1 ';
	   			 $bdd->exec($sql);
   			}
			traiterAjout($bdd);
		}
		else{
			echo "<p id='erreur'>Cette activité existe déja avec cette frequence et cette classe d'age</p>";
		}

	}

}

?>