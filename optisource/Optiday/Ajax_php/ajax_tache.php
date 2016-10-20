<?php

include('../../connexion.php');

$tache = $_POST['tache'];

if(!empty($tache) && $tache != -1){
    echo '
        <script>document.getElementById(\'lieu\').disabled = false;</script>';
}

?>