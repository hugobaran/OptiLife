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
function tempsOptiManuelle1PratiqueUnAn($bdd, $act){
	$emp = $_SESSION["EMP_NUM"];;
	$tps = 0;
	$sql = "SELECT * FROM est_optimise JOIN pratiquer USING(EMP_NUM, PRA_NUM) WHERE EMP_NUM = " . $emp . " AND PRA_NUM = " . $act;
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch()){
		$dureePratique = $donnees['PRA_DUREE'];
		$act = $donnees['ACT_NUM'];
		$sql2 = "SELECT * FROM optimiser WHERE ACT_NUM = " . $donnees['ACT_NUM'] . " and OPTI_NUM = " . $donnees['OPTI_NUM'];
		$reponse2 = $bdd->query($sql2);
		while ($donnees2 = $reponse2->fetch()){
			if(is_null($donnees2['OP_TPS_GAGNE']))
				$dure = $dureePratique*$donnees2['OP_POURCENTAGE'];
			else
				$dure = $donnees2['OP_TPS_GAGNE'];
			$tps = $tps + tempsGagneUnAn($dure,$donnees['FR_LIBELLE'], $donnees['PRA_NBFOIS']);
		}
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
	$tab = @lireDonneesPDO1($bdd, $sql);
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

function afficherTempsOpti($bdd){
	$dure = tempsOptiManuelle1TotalVie($bdd);
	$dure = $dure + tempsOptiManuelle2TotalVie($bdd);
	$dure = $dure  + tempsOptiAutoTotalVie($bdd);
	$minute = (int)(($dure%60));
	$heure = (int)((($dure)/60)%24);
	$jour = (int)((($dure)/3600)%31);
	$mois = (int)((($dure)/111600)%12);
	$annee = (int)((($dure)/1314000));
	echo "<div id='tpsGagneTotal' >Temps total gagné </br><b>".$annee." année(s) ".$mois." mois ".$jour." jour(s) ".$heure." heure(s) ".$minute." minute(s)</b></div>";
}

function afficherListesOptimisationsStatistiques($bdd){
	$emp = 1;
	$sql = "SELECT * FROM est_optimise JOIN pratiquer USING(PRA_NUM) WHERE pratiquer.EMP_NUM = " . $emp;
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch()){
		$act = $donnees['ACT_NUM'];
		$opti = $donnees['OPTI_NUM'];
		$sql2 = "SELECT * FROM optimiser JOIN activite USING(ACT_NUM) JOIN optimisations USING(OPTI_NUM) WHERE ACT_NUM = " . $act. " AND OPTI_NUM = " . $opti;
		$reponse2 = $bdd->query($sql2);
		while ($donnees2 = $reponse2->fetch()){
			$activite = utf8_encode($donnees2['ACT_LIBELLE']);
			$optimisation = utf8_encode($donnees2['OPTI_LIBELLE']);

			echo "<tr><td>".$activite."</td><td>".$optimisation."</td></tr>";
		}
	}

}

function afficherTempsOptimisationsStatistiques($bdd){
	echo "En cours de réalisation";
}




?>