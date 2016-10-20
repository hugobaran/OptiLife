<?php

function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
    }
    else
    {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

$tache = $_POST['tache'];
$date = $_POST['date'];
$heure_debut = $_POST['heure_debut'];
$heure_fin = $_POST['heure_fin'];
$ID_LIEU = $_POST['lieu'];

include('../../connexion.php');

if($_POST['tache'] == (-1)){
    redirect('../');
}

else{

    $req = $bdd->query("SELECT max(TA_ID) as ID FROM TACHE_UTILISATEUR");
    $TA_ID_incr = $req->fetch();
    $TA_ID_incr = $TA_ID_incr['ID'];
    $TA_ID_incr = $TA_ID_incr + 1;
    
    $interval = (strtotime($date_fin) - strtotime($date_debut))/60;

    
    $UT_ID = $_SESSION['id'];

    $req = $bdd->query("INSERT INTO TACHE_UTILISATEUR (`TA_ID`, `TA_ASSOCIE`, `CA_ID`, `LI_ID`, `UT_ID`, `TA_DATE`, `TA_HEUREDEBUT`, `TA_HEUREFIN`, `TA_OPTIMISE`) VALUES ('$TA_ID_incr', '$TA_ID_incr', '$tache', '$ID_LIEU', '$UT_ID', '$date', '$heure_debut', '$heure_fin', '0')");

    $req->execute();
    
    redirect('../');

}

?>