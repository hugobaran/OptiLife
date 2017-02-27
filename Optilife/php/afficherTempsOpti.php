<?php
require_once("../php/connexionBDD.php");
require_once("../php/fonctionsUtiles.php");

function edtVide($bdd, $cat){
	$emp = 1;
	$sql = "SELECT count(*) FROM `pratiquer` WHERE `CAT_NUM` = ".$cat." AND `EMP_NUM` = '".$_SESSION["EMP_NUM"]."' AND `OPTIMISER` = 1 ";
	$tab = lireDonneesPDO1($bdd, $sql);
	if($tab[0]['count(*)'] == 0)
		return true;
	else
		return false;
}

function tempsOptiCat($dure, $cat){
	$age = 18;
	$limiteEtu = 25;
	$limiteAct = 62;
	$limiteMort = 81;
	if($cat == 1)
		$dure = $dure*($limiteEtu - $age);
	if($cat == 2)	
		$dure = $dure*($limiteAct - $limiteEtu);
	if($cat == 3)
		$dure = $dure*($limiteMort - $limiteAct);
	return $dure;
}

function tempsGagneUnAn($tps, $lib, $nbFois){
	if($lib == "Annuel")
		$tps = ($tps*$nbFois);
	if($lib == "Hebdomadaire")
		$tps = (($tps*$nbFois)*52);
	if($lib == "Journalier")
		$tps = (($tps*$nbFois)*365);
	if($lib == "Mensuel")
		$tps = (($tps*$nbFois)*12);
	if($lib == "Trimestriel")
		$tps = (($tps*$nbFois)*3);
	return $tps;
}

//Fonctions Optimisation Automatique 
function tempsOptiAutoPratiqueUnAn($bdd, $act){
	if(!estOpti($bdd, $act))
		return 0;
	$emp = 1;
	$sql = "SELECT * FROM `pratiquer` WHERE `PRA_NUM` = ".$act." AND `EMP_NUM` = ".$_SESSION["EMP_NUM"]." ";
	$tab = lireDonneesPDO1($bdd, $sql);
	$tps = $tab[0]['PRA_DUREE'] - tempsMini($bdd, $tab[0]['ACT_NUM']);
	$tps = tempsGagneUnAn($tps,$tab[0]['FR_LIBELLE'], $tab[0]['PRA_NBFOIS']);
	return $tps;
}

function tempsOptiAutoPratiqueVie($bdd, $act, $cat){
	$dure = tempsOptiAutoPratiqueUnAn($bdd, $act);
	$dure = tempsOptiCat($dure, $cat);
	return $dure;
}

function tempsOptiAutoTotalVie($bdd){
	$som = 0;
	$sql = "SELECT * FROM `pratiquer` WHERE `EMP_NUM` = ".$_SESSION["EMP_NUM"]." AND `OPTIMISER` = 1 ";
	$tab = @lireDonneesPDO1($bdd, $sql);
	for($i = 0; $i < count($tab); $i++){
		$som = $som + tempsOptiAutoPratiqueVie($bdd, $tab[$i]['PRA_NUM'], $tab[$i]['CAT_NUM']);
	}
	return $som;
}
//Fin fonction optimisation automatique

//Fonctions Optimisation Manuelle 

/*
	Donne le temps gagné pour une optimisation sur une pratique
**/
function tempsOptiManuelle1OptiUnAn($bdd, $freq, $nbFois, $opti, $act,  $dureePratique){
	$tps = 0;
	$sql2 = "SELECT * FROM optimiser WHERE ACT_NUM = " . $act . " and OPTI_NUM = " . $opti;
	$reponse2 = $bdd->query($sql2);
	while ($donnees2 = $reponse2->fetch()){
		if(is_null($donnees2['OP_TPS_GAGNE']))
			$dure = $dureePratique*$donnees2['OP_POURCENTAGE'];
		else
			$dure = $donnees2['OP_TPS_GAGNE'];
		$tps = $tps + tempsGagneUnAn($dure,$freq, $nbFois);
	}
	return $tps;
}
function tempsOptiManuelle1PratiqueUnAn($bdd, $act){
	$emp = $_SESSION["EMP_NUM"];;
	$tps = 0;
	$sql = "SELECT * FROM est_optimise JOIN pratiquer USING(EMP_NUM, PRA_NUM) WHERE EMP_NUM = " . $emp . " AND PRA_NUM = " . $act;
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch()){
		$tps = $tps + tempsOptiManuelle1OptiUnAn($bdd, $donnees['FR_LIBELLE'], $donnees['PRA_NBFOIS'],  $donnees['OPTI_NUM'], $donnees['ACT_NUM'], $donnees['PRA_DUREE']);
	}
	return $tps;
}

function tempsOptiManuelle1PratiqueVie($bdd, $act, $cat){
	$dure = tempsOptiManuelle1PratiqueUnAn($bdd, $act);
	$dure = tempsOptiCat($dure, $cat);
	return $dure;
}

function tempsOptiManuelle1TotalVie($bdd){
	$som = 0;
	$sql = "SELECT * FROM `pratiquer` WHERE `EMP_NUM` = ".$_SESSION["EMP_NUM"];
	$tab = @lireDonneesPDO1($bdd, $sql);//C'est dégueux mais je m'en bats les couilles
	for($i = 0; $i < count($tab); $i++){
		$som = $som + tempsOptiManuelle1PratiqueVie($bdd, $tab[$i]['PRA_NUM'], $tab[$i]['CAT_NUM']);
	}
	return $som;
}
//La deuxieme façon d'optimiser manuellement
function tempsOptiManuelle2PratiqueUnAn($bdd, $act){
	return 0;//Pas encore implementé
}

function tempsOptiManuelle2PratiqueVie($bdd, $act, $cat){
	$dure = tempsOptiManuelle2PratiqueUnAn($bdd, $act);
	$dure = tempsOptiCat($dure, $cat);
	return $dure;
}

function tempsOptiManuelle2TotalVie($bdd){
	$som = 0;
	$sql = "SELECT * FROM `pratiquer` WHERE `EMP_NUM` = ".$_SESSION["EMP_NUM"];
	$tab = @lireDonneesPDO1($bdd, $sql);
	for($i = 0; $i < count($tab); $i++){
		$som = $som + tempsOptiManuelle2PratiqueVie($bdd, $tab[$i]['PRA_NUM'], $tab[$i]['CAT_NUM']);
	}
	return $som;
}
//Fin fonctions Optimisation Manuelle
function MiseEnFormTemps1($dure){
	$minute = (int)(($dure%60));
	$dure = $dure - $minute;
	$heure = (int)((($dure)/60)%24);
	$dure = $dure - ($heure*60);
	$jour = (int)((($dure)/1400)%31);
	$dure = $dure - ($jour*1400);
	$mois = (int)((($dure)/44640)%12);
	$dure = $dure - ($mois*44640);
	$annee = (int)((($dure)/525600));
	return $annee." année(s) ".$mois." mois ".$jour." jour(s) ".$heure." heure(s) ".$minute." minute(s)";
}
function MiseEnFormTemps2($dure){
	if($dure == 0)
		return "0 minute";
	$minute = (int)(($dure%60));
	$dure = $dure - $minute;
	$heure = (int)((($dure)/60)%24);
	$dure = $dure - ($heure*60);
	$jour = (int)((($dure)/1400)%31);
	$dure = $dure - ($jour*1400);
	$mois = (int)((($dure)/44640)%12);
	$dure = $dure - ($mois*44640);
	$annee = (int)((($dure)/525600));
	$res = "";
	if($annee > 0)
		$res = $res . $annee." année(s) ";
	if($mois > 0)
		$res = $res . $mois." mois ";
	if($jour > 0)
		$res = $res . $jour." jour(s) ";
	if($heure > 0)
		$res = $res . $heure." heure(s) ";
	if($minute > 0)
		$res = $res . $minute." minute(s)";
	return $res;
}
function afficherTempsOpti($bdd){
	$dure = tempsOptiManuelle1TotalVie($bdd);
	$dure = $dure + tempsOptiManuelle2TotalVie($bdd);
	$dure = $dure  + tempsOptiAutoTotalVie($bdd);
	echo "<div id='tpsGagneTotal' >Temps total gagné </br><b>".MiseEnFormTemps1($dure)."</b></div>";
}


function afficherListesOptimisationsStatistiques($bdd){
	$sql = "SELECT * FROM est_optimise JOIN pratiquer USING(PRA_NUM, EMP_NUM) JOIN activite USING(ACT_NUM) WHERE EMP_NUM = " . $_SESSION["EMP_NUM"];
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch()){
		$tpsAuto =tempsOptiAutoPratiqueVie($bdd, $donnees['PRA_NUM'], $donnees['CAT_NUM']);
		$tpsManu =tempsOptiManuelle1PratiqueVie($bdd, $donnees['PRA_NUM'], $donnees['CAT_NUM']);
		$tpsTotal = $tpsAuto + $tpsManu;
		echo "<tr><td>".$donnees['PRA_NUM']."</td><td>".utf8_encode($donnees['ACT_LIBELLE'])."</td>";
		echo "<td>".MiseEnFormTemps2($tpsTotal)."</td><td>".MiseEnFormTemps2($tpsAuto)."</td><td>".MiseEnFormTemps2($tpsManu)."</td></tr>";
		$sql2 = "SELECT * FROM `pratiquer` join est_optimise using(PRA_NUM, EMP_NUM) join optimisations using(OPTI_NUM) WHERE EMP_NUM = ".$_SESSION["EMP_NUM"] ." and PRA_NUM = ".$donnees['PRA_NUM'];
		//On créé un tableau dans le tableau pour afficher toute les optimisations
		echo '<tr><td colspan=5><table class="table tabOpti">';
		echo "<th>Optimisation</th><th>TempsGagné</th>";
		$reponse2 = $bdd->query($sql2);
		while ($donnees2 = $reponse2->fetch()){//Boucle qui parcours toute les optimisations
			$optimisation = utf8_encode($donnees2['OPTI_LIBELLE']);
			$tps = tempsOptiManuelle1OptiUnAn($bdd, $donnees['FR_LIBELLE'], $donnees['PRA_NBFOIS'], $donnees2['OPTI_NUM'], $donnees2['ACT_NUM'],  $donnees['PRA_DUREE']);
			$tps = tempsOptiCat($tps, $donnees['CAT_NUM']);
			echo "<tr><td>".$optimisation."</td><td>". MiseEnFormTemps2($tps)."</td></tr>";
		}
		echo "</table></tr>";
	}

}

function afficherTempsOptimisationsStatistiques($bdd){
	echo "<table class='table tabOpti'>";
	echo "<tr><th>Période</th><th>Temps total activités</th><th>Temps Total Optimisé</th>";
	echo "<tr><td>Toute la vie</td><td>" . MiseEnFormTemps2(tempsTotalActivite($bdd)) . " </td><td>".MiseEnFormTemps2(tempsOptiParCat($bdd, 0))."</td></tr>";
	echo "<tr><td>Etudiant</td><td>" . MiseEnFormTemps2(tempsTotalActiviteCat($bdd, 1)) . " </td><td>".MiseEnFormTemps2(tempsOptiParCat($bdd, 1))."</td></tr>";
	echo "<tr><td>Actif</td><td>" . MiseEnFormTemps2(tempsTotalActiviteCat($bdd, 2)) . " </td><td>".MiseEnFormTemps2(tempsOptiParCat($bdd, 2))."</td></tr>";
	echo "<tr><td>Retraité</td><td>" . MiseEnFormTemps2(tempsTotalActiviteCat($bdd, 3)) . " </td><td>".MiseEnFormTemps2(tempsOptiParCat($bdd, 3))."</td></tr>";
	echo "</table>";
}

function tempsTotalActivite($bdd){
	$tps = 0;
	$sql = "SELECT * from pratiquer where EMP_NUM = " .  $_SESSION["EMP_NUM"];
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch()){
		$tps  = $tps + tempsOptiCat(tempsGagneUnAn($donnees['PRA_DUREE_OPTI'], $donnees['FR_LIBELLE'], $donnees['PRA_NBFOIS']),  $donnees['CAT_NUM']);
	}
	return $tps;
}

function tempsTotalActiviteCat($bdd, $cat){
	$tps = 0;
	$sql = "SELECT * from pratiquer where EMP_NUM = " .  $_SESSION["EMP_NUM"] . " and CAT_NUM = ". $cat;
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch()){
		$tps  = $tps + tempsOptiCat(tempsGagneUnAn($donnees['PRA_DUREE_OPTI'], $donnees['FR_LIBELLE'], $donnees['PRA_NBFOIS']),  $donnees['CAT_NUM']);
	}
	return $tps;
}

function tempsOptiParCat($bdd, $cat){
	$som = 0;
	if($cat == 0)
		$sql = "SELECT * FROM `pratiquer` WHERE `EMP_NUM` = ".$_SESSION["EMP_NUM"];
	else
		$sql = "SELECT * FROM `pratiquer` WHERE `EMP_NUM` = ".$_SESSION["EMP_NUM"] . " and CAT_NUM = " . $cat;
	$tab = @lireDonneesPDO1($bdd, $sql);//C'est dégueux mais je m'en bats les couilles
	for($i = 0; $i < count($tab); $i++){
		$som = $som + tempsOptiAutoPratiqueVie($bdd, $tab[$i]['PRA_NUM'], $tab[$i]['CAT_NUM']);
		$som = $som + tempsOptiManuelle1PratiqueVie($bdd, $tab[$i]['PRA_NUM'], $tab[$i]['CAT_NUM']);
		$som = $som + tempsOptiManuelle2PratiqueVie($bdd, $tab[$i]['PRA_NUM'], $tab[$i]['CAT_NUM']);
	}
	return $som;
}


?>