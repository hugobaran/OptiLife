<?php

	include("../php/connexionBDD.php");
	include("../php/fonctionsUtiles.php");
	include("../php/ajouterTache.php");
	include("../php/modifierTache.php");

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
			if(isset($_POST['suppPra'])){
				try{
					//$act_num = chercherAct($bdd,$_POST['activite']);
					$pra_num = $_POST['suppPra'];
					$sql = 'DELETE FROM `pratiquer` WHERE PRA_NUM = '.$pra_num .' AND `pratiquer`.`EMP_NUM` = 1';
		   			echo $sql;
		   			$bdd->exec($sql);
		   			$sql = 'UPDATE pratiquer SET PRA_NUM = PRA_NUM-1 WHERE PRA_NUM > '.$_POST['suppPra'].' and emp_num = 1';
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
		}else{
			header("location: ../html/main.php?action=echec");
			exit();
		}
	

?>