<?php
require_once("../php/connexionBDD.php");
require_once("../php/fonctionsUtiles.php");

function edtVide($bdd, $cat){
	$emp = 1;
	$sql = "SELECT count(*) FROM `pratiquer` WHERE `CAT_NUM` = ".$cat." AND `EMP_NUM` = ".$emp." AND `OPTIMISER` = 1 ";
	$tab = lireDonneesPDO1($bdd, $sql);
	if($tab[0]['count(*)'] == 0)
		return true;
	else
		return false;
}

function tempsOptiPratique($bdd, $act, $freq, $cat){
	if(!estOpti($bdd, $act, $freq, $cat,1))
		return 0;
	$emp = 1;
	$sql = "SELECT * FROM `pratiquer` WHERE `ACT_NUM` = ".$act." AND `FR_LIBELLE` LIKE '".$freq."' AND `CAT_NUM` =  ".$cat." AND `EMP_NUM` = ".$emp." ";
	$tab = lireDonneesPDO1($bdd, $sql);
	$som = 0;
	if($freq == "Annuel")
		$som = $som + (($tab[0]['PRA_DUREE'] - tempsMini($bdd, $tab[0]['ACT_NUM']))*$tab[0]['PRA_NBFOIS']);
	if($freq == "Hebdomadaire")
		$som = $som + ((($tab[0]['PRA_DUREE'] - tempsMini($bdd, $tab[0]['ACT_NUM']))*$tab[0]['PRA_NBFOIS'])*52);
	if($freq == "Journalier")
		$som = $som + ((($tab[0]['PRA_DUREE'] - tempsMini($bdd, $tab[0]['ACT_NUM']))*$tab[0]['PRA_NBFOIS'])*365);
	if($freq == "Mensuel")
		$som = $som + ((($tab[0]['PRA_DUREE'] - tempsMini($bdd, $tab[0]['ACT_NUM']))*$tab[0]['PRA_NBFOIS'])*12);
	if($freq == "Trimestriel")
		$som = $som + ((($tab[0]['PRA_DUREE'] - tempsMini($bdd, $tab[0]['ACT_NUM']))*$tab[0]['PRA_NBFOIS'])*3);
	return $som;
}

function tempsOptiUnAn($bdd, $cat){
	if(edtVide($bdd, $cat)){
		return 0;
	}
	$som = 0;
	$emp = 1;
	$sql = "SELECT * FROM `pratiquer` WHERE `CAT_NUM` = ".$cat." AND `EMP_NUM` = ".$emp." AND `OPTIMISER` = 1 ";
	$tab = lireDonneesPDO1($bdd, $sql);
	/*print_r($tab);
	AfficherDonnee2($tab);*/
	for($i = 0; $i < count($tab); $i++){
		if(estOpti($bdd, $tab[$i]['ACT_NUM'], $tab[$i]['FR_LIBELLE'], $cat, $emp)){
			if($tab[$i]['FR_LIBELLE'] == "Annuel")
				$som = $som + (($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NBFOIS']);
			if($tab[$i]['FR_LIBELLE'] == "Hebdomadaire")
				$som = $som + ((($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NBFOIS'])*52);
			if($tab[$i]['FR_LIBELLE'] == "Journalier")
				$som = $som + ((($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NBFOIS'])*365);
			if($tab[$i]['FR_LIBELLE'] == "Mensuel")
				$som = $som + ((($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NBFOIS'])*12);
			if($tab[$i]['FR_LIBELLE'] == "Trimestriel")
				$som = $som + ((($tab[$i]['PRA_DUREE'] - tempsMini($bdd, $tab[$i]['ACT_NUM']))*$tab[$i]['PRA_NBFOIS'])*3);			
		}
	}
	return $som;
}

function tempsOptiVieTotal($bdd){
	$dure = 0;
	$age = 18;
	$limiteEtu = 25;
	$limiteAct = 62;
	$limiteMort = 81;
	$dureEtu = tempsOptiUnAn($bdd, 1);
	$dureEtu += tempsOptiManuelleTotal($bdd,1);
	$dureEtu = $dureEtu*($limiteEtu - $age);
	$dureAct = tempsOptiUnAn($bdd, 2);
	$dureAct += tempsOptiManuelleTotal($bdd,2);
	$dureAct = $dureAct*($limiteAct - $limiteEtu);
	$dureRet = tempsOptiUnAn($bdd, 3);
	$dureRet += tempsOptiManuelleTotal($bdd,3);
	$dureRet = $dureRet*($limiteMort - $limiteAct);
	return $dureRet + $dureAct + $dureEtu;
}

function tempsOptiManuelleTotal($bdd, $ca){
	$dure = 0;
	$emp = 1;
	$som = 0;
	$sql = "SELECT * FROM est_optimise JOIN pratiquer USING(PRA_NUM) WHERE pratiquer.EMP_NUM = " . $emp . " AND CAT_NUM = " . $ca;
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch()){
		$dureePratique = $donnees['PRA_DUREE'];
		$act = $donnees['ACT_NUM'];
		$sql2 = "SELECT * FROM optimiser WHERE ACT_NUM = " . $act;
		$reponse2 = $bdd->query($sql2);
		while ($donnees2 = $reponse2->fetch()){
			if(is_null($donnees2['OP_TPS_GAGNE']))
				$dure = $dureePratique*$donnees2['OP_POURCENTAGE'];
			else
				$dure = $donnees2['OP_TPS_GAGNE'];

			if($donnees['FR_LIBELLE'] == "Annuel")
				$som = $som + ($dure*$donnees['PRA_NBFOIS']);
			if($donnees['FR_LIBELLE'] == "Hebdomadaire")
				$som = $som + ($dure*$donnees['PRA_NBFOIS']*52);
			if($donnees['FR_LIBELLE'] == "Journalier")
				$som = $som + ($dure*$donnees['PRA_NBFOIS']*365);
			if($donnees['FR_LIBELLE'] == "Mensuel")
				$som = $som + ($dure*$donnees['PRA_NBFOIS']*12);
			if($donnees['FR_LIBELLE'] == "Trimestriel")
				$som = $som + ($dure*$donnees['PRA_NBFOIS']*3);
		}
	}
	return $som;
}

function tempsOptiCat($bdd, $dure, $cat){
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

function afficherTempsOpti($bdd){
	$dure = tempsOptiVieTotal($bdd);
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