<?php
include("../php/connexionBDD.php");
require_once("../php/fonctionsUtiles.php");
@session_start(); 
echo "usr_num : ".$_SESSION["usrNum"]."</br>";
//echo "usr_date : ".$_SESSION["usrDate"]."</br>";

$sql1 = "SELECT * FROM `emploidutemps` WHERE `USR_NUM_VISITEUR` LIKE '".$_SESSION["usrNum"]."' ";
$tab = LireDonneesPDO1($bdd, $sql1);
$_SESSION["EMP_NUM"] = $tab[0]["EMP_NUM"];
//echo $tab[0]["EMP_NUM"];
echo $_SESSION["EMP_NUM"] ;
header("location: ../html/main.php");
//echo $_SESSION["EMP_NUM"];
?>