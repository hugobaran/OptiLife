<?php
require_once("../php/connexionBDD.php");
require_once("../php/fonctionsUtiles.php");

function tempsOptiUnAn($bdd, $cat){
	$som = 0;
	$emp = 1;
	$sql = "SELECT * FROM `pratiquer` WHERE `CAT_NUM` = ".$cat." AND `EMP_NUM` = ".$emp." AND `OPTIMISER` = 1 ";
	$tab = lireDonneesPDO1($bdd, $sql);
	/*print_r($tab);
	AfficherDonnee2($tab);*/
	for($i = 0; $i < count($tab); $i++){
		if(estOpti($bdd, $tab[$i]['ACT_NUM'], $tab[$i]['FR_LIBELLE'], $cat, $emp)){
			if($tab[$i]['FR_LIBELLE'] == "Annuel")
				$som = $som + (($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $cat, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NB_FOIS']);
			if($tab[$i]['FR_LIBELLE'] == "Hebdomadaire")
				$som = $som + ((($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $cat, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NB_FOIS'])*52);
			if($tab[$i]['FR_LIBELLE'] == "Journalier")
				$som = $som + ((($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $cat, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NB_FOIS'])*365);
			if($tab[$i]['FR_LIBELLE'] == "Mensuel")
				$som = $som + ((($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $cat, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NB_FOIS'])*12);
			if($tab[$i]['FR_LIBELLE'] == "Trimestriel")
				$som = $som + ((($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $cat, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NB_FOIS'])*3);			
		}
	}
	return $som;
}

function tempsOptiVie($bdd){
	$dure = 0;
	$age = 18;
	$limiteEtu = 25;
	$limiteAct = 62;
	$limiteMort = 81;
	$dureEtu = tempsOptiUnAn($bdd, 1);
	$dureEtu = $dureEtu*($limiteEtu - $age);
	$dureAct = tempsOptiUnAn($bdd, 2);
	$dureAct = $dureAct*($limiteAct - $limiteEtu);
	$dureRet = tempsOptiUnAn($bdd, 3);
	$dureRet = $dureRet*($limiteMort - $limiteAct);
	return $dureRet + $dureAct + $dureEtu;
}

function afficherTempsOpti($bdd){
	$dure = tempsOptiVie($bdd);
	$minute = (int)(($dure%60));
	$heure = (int)((($dure)/60)%24);
	$jour = (int)((($dure)/3600)%31);
	$mois = (int)((($dure)/111600)%12);
	$annee = (int)((($dure)/1314000));
	echo "Vous avez gagnés </br>".$annee." année(s) ".$mois." mois ".$jour." jour(s) ".$heure." heure(s) ".$minute." minute(s)";
}

?>