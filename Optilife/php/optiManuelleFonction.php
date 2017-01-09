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
			$prc = $donnees['OP_POURCENTAGE'];
			echo '<option data-type="pourcentage" data-value="'.$donnees['OP_POURCENTAGE'].'" class="'.$act.'" value="' . $opti . '">'.$optiLib . ' | ';
			echo '-' . $prc .  ' %';
		}
		echo '</option>';
	}
	$reponse->closeCursor();
}



?>