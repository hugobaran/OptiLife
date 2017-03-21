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
		}else if($_POST['age'] > 25 && $_POST['age'] < 65){
			$num = 2;
		}else{
			$num = 3;
		}
		if(isset($_SESSION["EMP_NUM"])){
			$sql2 = "DELETE FROM emploidutemps WHERE EMP_NUM = ". $_SESSION["EMP_NUM"];
			echo $sql2;
			$bdd ->exec($sql2);
		}
		$sql = "INSERT INTO `emploidutemps` (`CAT_NUM`, `USR_NUM_VISITEUR`, `USR_NUM_INSCRIT`, `EMP_DATE`) VALUES ('".$num."', '".$_SESSION["usrNum"]."', NULL, sysdate())";
		$bdd ->exec($sql);
		$sql = "SELECT EMP_NUM FROM emploidutemps WHERE USR_NUM_VISITEUR = '" . $_SESSION["usrNum"]. "'";
		$tab = LireDonneesPDO1($bdd, $sql);
		$_SESSION["EMP_NUM"] = $tab[0]["EMP_NUM"];
		echo $numEDT;
	}
}
header("location: ../html/main.php");

?>