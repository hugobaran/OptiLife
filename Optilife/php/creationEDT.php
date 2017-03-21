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
		echo $num;
		if($tab[0]["count(*)"] == 0){
			$sql = "INSERT INTO `emploidutemps` (`EMP_NUM`, `CAT_NUM`, `USR_NUM_VISITEUR`, `USR_NUM_INSCRIT`) VALUES (1, '".$num."', '".$_SESSION["usrNum"]."', NULL)";
			$bdd ->exec($sql);
		}else{
			$sql = "select max(emp_num)+1 as max from emploidutemps";
			$tab = LireDonneesPDO1($bdd, $sql);
			$sql = "INSERT INTO `emploidutemps` (`EMP_NUM`, `CAT_NUM`, `USR_NUM_VISITEUR`, `USR_NUM_INSCRIT`) VALUES (".$tab[0]['max'].", '".$num."', '".$_SESSION["usrNum"]."', NULL)";
			$bdd ->exec($sql);
		}
	$sql1 = "SELECT * FROM `emploidutemps` WHERE `USR_NUM_VISITEUR` LIKE '".$_SESSION["usrNum"]."' ";
	$tab = LireDonneesPDO1($bdd, $sql1);
	$_SESSION["EMP_NUM"] = $tab[0]["EMP_NUM"];
	}
}
header("location: ../html/main.php");

?>