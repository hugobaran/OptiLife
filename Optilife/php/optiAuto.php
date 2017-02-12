<?php
@session_start();
include("../php/connexionBDD.php");
if(isset($_POST["optimiser"])){


	//boucle qui met à jour l'act pr l'opt
	$sql = "UPDATE `pratiquer` SET `OPTIMISER` = '1' WHERE `EMP_NUM` = ".$_SESSION["EMP_NUM"];
	$stmt = $bdd->exec($sql);
	echo "ici";
	header('Location: ../html/main.php?action=opti');
  	exit();
}



?>