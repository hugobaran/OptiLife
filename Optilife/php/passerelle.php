<?php
 	@session_start(); 
	include("../php/connexionBDD.php");
	include("../php/fonctionsUtiles.php");
	include("../php/ajouterTache.php");
	include("../php/modifierTache.php");
	include("../php/optiManuelleFonction.php");
	include("../php/changerActiviteFonction.php");

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
				echo $e->getMessage();
				echo $raison;
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
			if(isset($_POST['suppPra'])){
				try{
					//$act_num = chercherAct($bdd,$_POST['activite']);
					$pra_num = $_POST['suppPra'];
					$sql = "DROP TRIGGER trigger_pratiquer_opti_manuelle_delete";
		   			$bdd->exec($sql);
					$sql = 'DELETE FROM `pratiquer` WHERE PRA_NUM = '.$pra_num .' AND `pratiquer`.`EMP_NUM` = '.$_SESSION["EMP_NUM"];
		   			echo $sql;
		   			$bdd->exec($sql);
		   			$sql = 'UPDATE pratiquer SET PRA_NUM = PRA_NUM-1 WHERE PRA_NUM > '.$_POST['suppPra'].' and emp_num = '.$_SESSION["EMP_NUM"];
		   			$bdd->exec($sql);
		   			$sql = "CREATE TRIGGER `trigger_pratiquer_opti_manuelle_delete` BEFORE DELETE ON `est_optimise` FOR EACH ROW BEGIN DECLARE act bigint(4); DECLARE tps decimal(10,2); DECLARE prc float; SELECT act_num into act from pratiquer where pra_num = old.pra_num and emp_num = old.emp_num; SELECT op_tps_gagne into tps from optimiser where act_num = act and opti_num = old.opti_num; SELECT op_pourcentage into prc from optimiser where act_num = act and opti_num = old.opti_num; IF tps is not null THEN update pratiquer set PRA_DUREE_OPTI = PRA_DUREE_OPTI + tps where pra_num = old.pra_num and emp_num = old.emp_num; ELSE update pratiquer set PRA_DUREE_OPTI = PRA_DUREE_OPTI+(PRA_DUREE_OPTI*prc) where pra_num = old.pra_num and emp_num = old.emp_num; END IF; END";
		   			$bdd->exec($sql);
		   			header("location: ../html/main.php?action=supp");
					exit();
				}catch(PDOException $e){
					echo $e->getMessage();
					header("location: ../html/main.php?action=echec");
					exit();
				}
			}else{
				header("location: ../html/main.php?action=echec&raison=praInconnue");
				exit();
			}
		}else if(isset($_POST['optimiserManuellement'])){
			try{
				ajouterOptimisationManuelle2($bdd);
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
		}else if(isset($_POST['echangerActivite'])){
			try{
				echangerActivite($bdd);
				header("location: ../html/main.php?action=echangeActivite");
				exit();
			}catch(PDOException $e){
				$raison="";
				switch ($e->getMessage()) {
					case 'ActiviteExistante':
						$raison = "&raison=ActiviteExistante";
						break;
					case 'ActiviteNope':
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
	

?>