<?php 
	try{
		$bdd = new PDO('mysql:host=spartacus.iutc3.unicaen.fr;dbname=julien_chevron;charset=utf8', 'julien_chevron', 'tiiselai');
	}
	catch(Exception $e){
		die('Erreur : '.$e->getMessage());
	}
?>