<?php
try
{

	$bdd = new PDO('mysql:host=localhost;dbname=optilife2', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

?>