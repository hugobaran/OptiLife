<?php

	include("../php/connexionBDD.php");
	include("../php/fonctionsUtiles.php");
	include("../php/ajouterTache.php");
	include("../php/modifierTache.php");
	include("../php/optiManuelleFonction.php");

		if(isset($_POST["ajouter"])){
			try{
				traiterAjout($bdd);
				header("location: ../html/main.php?action=ajout");
				exit();
			}catch(PDOException $e){
				$raison="";
				switch ($e->getMessage()) {
					case 'activiteTemps':
						$raison = "&raison=temps";
						break;
					case 'activtePres':
						$raison = "&raison=dejaPresent";
						break;
					case 'incomplet':
						$raison = "&raison=incomplet";
						break;	
					default:
						header("location: ../html/main.php?action=echec".$raison);
						exit();
						break;
				}
				header("location: ../html/main.php?action=echec".$raison);
				exit();
			}
		}else if(isset($_POST["modifier"])){
			try{	
				modifierTache($bdd);
				header("location: ../html/main.php?action=modif");
				exit();
			}catch(PDOException $e){
				header("location: ../html/main.php?action=echec");
				exit();
			}
		}else if(isset($_POST["supprimer"])){
			if(isset($_POST['activite']) && isset($_POST['frequence']) && isset($_POST['classeAge'])){
				try{
					//$act_num = chercherAct($bdd,$_POST['activite']);
					$act_num = $_POST['activite'];
					$fr_lib = $_POST['frequence'];
					$cat_num = $_POST['classeAge'];
					$sql = 'DELETE FROM `pratiquer` WHERE `ACT_NUM` = '.$act_num.' AND `pratiquer`.`FR_LIBELLE` = "'.$fr_lib.'" AND `pratiquer`.`CAT_NUM` = '.$cat_num.' AND `pratiquer`.`EMP_NUM` = 1';
		   			echo $sql;
		   			$bdd->exec($sql);
		   			header("location: ../html/main.php?action=supp");
					exit();
				}catch(PDOException $e){
					header("location: ../html/main.php?action=echec");
					exit();
				}
			}
		}else if(isset($_POST['optimiserManuellement'])){
			try{
				ajouterOptimisationManuelle($bdd);
				header("location: ../html/main.php?action=optiManuelle");
				exit();
			}catch(PDOException $e){
				$raison="";
				switch ($e->getMessage()) {
					case 'OptiExistante':
						$raison = "&raison=OptiExistante";
						break;
					case 'OptiNope':
						$raison = "&raison=inconnu";
						break;	
					default:
						header("location: ../html/main.php?action=echec".$raison);
						exit();
						break;
					}
				header("location: ../html/main.php?action=echec");
				exit();
			}
		}else{
			header("location: ../html/main.php?action=echec");
			exit();
		}


	header('Location: ../html/edt.php');
  	exit();
	

?>