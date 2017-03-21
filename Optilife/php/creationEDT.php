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
		$numEDT = 1;
		echo $num;
		if($tab[0]["count(*)"] == 0){
			$sql = "INSERT INTO `emploidutemps` (`EMP_NUM`, `CAT_NUM`, `USR_NUM_VISITEUR`, `USR_NUM_INSCRIT`) VALUES (".$numEDT.", '".$num."', '".$_SESSION["usrNum"]."', NULL)";
			$bdd ->exec($sql);
		}else{
			$sql = "select max(emp_num)+1 as max from emploidutemps";
			$tab = LireDonneesPDO1($bdd, $sql);
			$numEDT = $tab[0]['max'];
			$sql = "INSERT INTO `emploidutemps` (`EMP_NUM`, `CAT_NUM`, `USR_NUM_VISITEUR`, `USR_NUM_INSCRIT`) VALUES (".$numEDT.", '".$num."', '".$_SESSION["usrNum"]."', NULL)";
			$bdd ->exec($sql);
		}
	$_SESSION["EMP_NUM"] = $numEDT;
	}
}
header("location: ../html/main.php");

?>