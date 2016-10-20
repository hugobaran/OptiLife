<?php

include('../../connexion.php');

$lieu = $_POST['lieu'];

if($lieu != -1){
    echo '
        <script>document.getElementById(\'date\').disabled = false;</script>';
}

?>