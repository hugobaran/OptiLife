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
				$pra_num = $_POST['pratique'];
				$act_num = $_POST['activite'];
				$fr_lib = $_POST['frequence'];
				$cat_num = $_POST['classe_age'];
				$nbfois = $_POST["nbFois"];
				$temps = $_POST["nbHeure"]*60 + ($_POST["nbMinutes"]);
				$sql = "UPDATE PRATIQUER SET FR_LIBELLE = '" . $fr_lib . "', PRA_NBFOIS = '" . $nbfois . "' , PRA_DUREE = '" . $temps . "' , OPTIMISER = '0' WHERE ACT_NUM = '" . $act_num . "' AND CAT_NUM = '" . $cat_num . "' AND EMP_NUM = ".$_SESSION["EMP_NUM"];
	   			$bdd->exec($sql);
	   			$sql = "SELECT * FROM est_optimise WHERE PRA_NUM = '" . $pra_num . "' AND EMP_NUM = ".$_SESSION["EMP_NUM"];
	   			$reponse = $bdd->query($sql);
				while ($donnees = $reponse->fetch()){
					$sql2 = "SELECT OP_TPS_GAGNE, OP_POURCENTAGE, ACT_NUM, OPTI_NUM FROM optimiser WHERE ACT_NUM = '" .$act_num. "' AND OPTI_NUM = '" .$donnees['OPTI_NUM'] ."'";
					$reponse2 = $bdd->query($sql2);
					$donnees2 = $reponse2->fetch(PDO::FETCH_ASSOC);
					if(is_null($donnees2['OP_POURCENTAGE'])){
						$tps = $donnees2['OP_TPS_GAGNE'];
						echo "TEMPS : " . $tps;
						$sql3 = "UPDATE pratiquer SET PRA_DUREE_OPTI = PRA_DUREE_OPTI - " . $tps . " WHERE PRA_NUM = " . $pra_num . " and emp_num = ". $_SESSION["EMP_NUM"];
						$bdd->exec($sql3);
					}
				}
		}else{
			echo "<p id='erreur'>Cette activité existe déja avec cette frequence et cette classe d'age</p>";
			throw new PDOException('activtePres');
		}

	}

}

?>