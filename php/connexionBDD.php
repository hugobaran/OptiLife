<?php 
	try{
		$bdd = new PDO('mysql:localhost;charset=utf8', 'root', '');
	}
	catch(Exception $e){
		die('Erreur : '.$e->getMessage());
	}

	// TEST COMMIT HUGO 
?>