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
		echo  ' data-temps="'. $actTemps .'">'.$actLib . ' NAT : ' . $nature . '</option>';

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



?>