
<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=optilife', 'root', '');
    $bdd->exec("SET CHARACTER SET utf8");
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

session_start();

?>