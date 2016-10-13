<?php

	include("../php/connexionBDD.php");
	include("../php/fonctionsUtiles.php");
	include("../php/ajouterTache.php");


		if(isset($_POST["ajouter"])){
			traiterAjout($bdd);
		}else if(isset($_POST["modifier"])){
			echo "MODIFIER";
		}else if(isset($_POST["supprimer"])){
			echo "ici";
			if(isset($_POST['activite']) && isset($_POST['frequence']) && isset($_POST['classeAge'])){
			echo "la";
			$act_num = chercherAct($bdd,$_POST['activite']);
			$fr_lib = $_POST['frequence'];
			$cat_num = $_POST['classeAge'];
			echo "sas";
			$sql = 'DELETE FROM `optilife`.`pratiquer` WHERE `ACT_NUM` = '.$act_num.' AND `pratiquer`.`FR_LIBELLE` = "'.$fr_lib.'" AND `pratiquer`.`CAT_NUM` = '.$cat_num.' AND `pratiquer`.`EMP_NUM` = 1 ';
   			echo $sql;
   			 $bdd->exec($sql);
			}
		}else{
			echo "rien";
		}


	header('Location: ../html/edt.php');
  	exit();
	

?>