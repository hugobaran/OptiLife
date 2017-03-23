<?php

include("../php/connexionBDD.php");
require_once("../php/fonctionsUtiles.php");
@session_start(); 
echo "usr_num : ".$_SESSION["usrNum"]."</br>";

//echo $tab[0]["EMP_NUM"];
//echo $_SESSION["EMP_NUM"] ;
//echo $_SESSION["EMP_NUM"];
if(isset($_POST['creationEDTSubmit'])){
	if(!empty($_POST['age'])){
		$sql = "select count(*) from emploidutemps";
		$tab = LireDonneesPDO1($bdd, $sql);
		if($_POST['age'] <= 25){
			$num = 1;
			$_SESSION["ca"] = 1;
		}else if($_POST['age'] > 25 && $_POST['age'] < 65){
			$num = 2;
			$_SESSION["ca"] = 2;
		}else{
			$num = 3;
			$_SESSION["ca"] = 3;
		}
		if(isset($_SESSION["usrPseudo"])){
			$sql = "INSERT INTO `emploidutemps` (`CAT_NUM`, `USR_NUM_INSCRIT`, `EMP_DATE`, `EMP_AGE`) VALUES ('".$num."', '".$_SESSION["usrNum"]."', sysdate(), '". $_POST['age'] ."' )";
			$bdd ->exec($sql);
			$sql = "SELECT EMP_NUM FROM emploidutemps WHERE USR_NUM_INSCRIT = '" . $_SESSION["usrNum"]. "' ORDER BY EMP_NUM DESC";
			$tab = LireDonneesPDO1($bdd, $sql);
			$_SESSION["EMP_NUM"] = $tab[0]["EMP_NUM"];
		}else{
			if(isset($_SESSION["EMP_NUM"])){
				$sql2 = "DELETE FROM emploidutemps WHERE EMP_NUM = ". $_SESSION["EMP_NUM"];
				echo $sql2;
				$bdd ->exec($sql2);
			}
			$sql = "INSERT INTO `emploidutemps` (`CAT_NUM`, `USR_NUM_VISITEUR`, `USR_NUM_INSCRIT`, `EMP_DATE`, `EMP_AGE`) VALUES ('".$num."', '".$_SESSION["usrNum"]."', NULL, sysdate(), '". $_POST['age'] ."' )";
			$bdd ->exec($sql);
			$sql = "SELECT EMP_NUM FROM emploidutemps WHERE USR_NUM_VISITEUR = '" . $_SESSION["usrNum"]. "'";
			$tab = LireDonneesPDO1($bdd, $sql);
			$_SESSION["EMP_NUM"] = $tab[0]["EMP_NUM"];
			echo $_SESSION['ca'];
		}
		$_SESSION["age"] = $_POST['age'];
	}
}
header("location: ../html/main.php");

?>