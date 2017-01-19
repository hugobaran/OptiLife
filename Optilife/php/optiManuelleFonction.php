<?php

function creerListeActivites($bdd,$sql){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$actLib = utf8_encode($donnees['ACT_LIBELLE']);
		$act = $donnees['ACT_NUM'];
		echo '<option class="'.$$act.'" value="' . $act . '" ' ;
		echo  ' >'.$actLib . '</option>';

	}
	$reponse->closeCursor();
}

function creerListeOptimisations($bdd,$sql){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$optiLib = utf8_encode($donnees['OPTI_LIBELLE']);
		$opti = $donnees['OPTI_NUM'];
		$act = $donnees['ACT_NUM'];
		if(is_null($donnees['OP_POURCENTAGE'])){
			echo '<option data-type="temps" data-value="'.$donnees['OP_TPS_GAGNE'].'" class="'.$act.'" value="' . $opti . '">'.$optiLib . ' | ';
			echo '-' . $donnees['OP_TPS_GAGNE'] .  ' MIN';
		}else{
			$prc = $donnees['OP_POURCENTAGE']*100;
			echo '<option data-type="pourcentage" data-value="'.$donnees['OP_POURCENTAGE'].'" class="'.$act.'" value="' . $opti . '">'.$optiLib . ' | ';
			echo '-' . $prc .  ' %';
		}
		echo '</option>';
	}
	$reponse->closeCursor();
}

function ajouterOptimisationManuelle($bdd){
	if(isset($_POST['pratiqueOpti']) && isset($_POST['Optimisation'])){
		$pratique = $_POST['pratiqueOpti'];
		$optimisation = $_POST['Optimisation'];
		$emp = 1;
		$sql = "SELECT * FROM EST_OPTIMISE where EMP_NUM = ".$emp." and PRA_NUM = ".$pratique." and OPTI_NUM = ".$optimisation;
		$reponse = $bdd->query($sql);
    	$valeur = $reponse->fetchAll();
    	if (count($valeur) == 0){
			$sql2 = "INSERT INTO EST_OPTIMISE (`EMP_NUM`,`PRA_NUM`, `OPTI_NUM`) VALUES (".$emp.", ".$pratique.", ".$optimisation.")";
			echo $sql;
			$bdd->exec($sql2);
		}else{
			echo "<p id='erreur'> Optimisation existante </p>";
			throw new PDOException('OptiExistante');
		}
	}else{
		echo "<p id='erreur'> Optimisation non réussie </p>";
		throw new PDOException('inconnu');
	}
}



?>