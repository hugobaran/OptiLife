<?php session_start(); ?>

<?php include("../php/genererSession.php"); ?>

<?php 

	if(isset($_GET['edt'])){
		$_SESSION['EMP_NUM'] = $_GET['edt'];
		header("location: ../html/main.php");
		exit();
	}else{
		header("location: ../html/changer.php");
		exit();
	}

?>