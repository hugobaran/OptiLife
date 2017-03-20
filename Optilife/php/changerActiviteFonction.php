<?php

function creerListeActiviteNature($bdd,$sql){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$nature = utf8_encode($donnees['NAT_LIBELLE']);
		$actLib = utf8_encode($donnees['ACT_LIBELLE']);
		$actTemps = $donnees['ACT_TEMPS'];
		$act = $donnees['ACT_NUM'];
		echo '<option class="'.$nature.'" value="'. $act .'"';
		echo  ' data-temps="'. $actTemps .'">'.$actLib.'</option>';

	}
	$reponse->closeCursor();
}

function creerListeNature($bdd,$sql){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$nature = utf8_encode($donnees['NAT_LIBELLE']);
		echo '<option value="'. $nature .'">'.$nature.'</option>';

	}
	$reponse->closeCursor();
}

function echangerActivite($bdd){
	$pra = $_POST['pratiqueChange'];
	$ca = $_POST['CAChange'];
	$act = $_POST['activiteChange'];
	$sql = 'SELECT * FROM activite WHERE ACT_NUM = ' . $act;
	$reponse = $bdd->query($sql);
	while($donnees = $reponse->fetch()){
		$sql2 = 'DELETE FROM est_optimise WHERE PRA_NUM = ' . $pra . ' AND EMP_NUM = ' . $_SESSION["EMP_NUM"];
		$bdd->exec($sql2);
		$act_tps = $donnees['ACT_TEMPS'];
		if($act_tps != 0){
			$sql2 = 'UPDATE pratiquer SET ACT_NUM = ' . $act . ', PRA_DUREE_OPTI = ' . $act_tps . ', OPTIMISER = 1 WHERE PRA_NUM = ' . $pra . ' AND EMP_NUM = ' . $_SESSION["EMP_NUM"];
			echo $sql2;
			$bdd->exec($sql2);
		}else{
			$sql2 = 'UPDATE pratiquer SET ACT_NUM = ' . $act . ', OPTIMISER = 1 WHERE PRA_NUM = ' . $pra . ' AND EMP_NUM = ' . $_SESSION["EMP_NUM"];
			echo $sql2;
			$bdd->exec($sql2);
		}
	}
}


?>