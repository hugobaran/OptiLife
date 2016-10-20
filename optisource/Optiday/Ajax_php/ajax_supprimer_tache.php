<?php

include('../../connexion.php');

$ta_id = $_POST['ta_id'];

$bdd->exec('DELETE FROM TACHE_UTILISATEUR WHERE TA_ASSOCIE= '.$ta_id);

?>