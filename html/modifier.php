<?php

// on récupère la variable transmise par la méthode GET :
if(isset($_GET['mavariablePHP'])){
$mavariablePHP = $_GET['mavariablePHP']; 
// on fait ce qu'on veux en PHP ensuite avec la variable ! :
echo "ceci est ma variable javascript dans du code PHP : ".$mavariablePHP;
}else
echo "rien";

?>