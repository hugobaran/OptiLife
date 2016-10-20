<?php
require_once("../AlgOpti/cJournee.php");

echo "<a href='../'><input type=\"button\" value=\"Retour Optiday\"></a>";

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

$date = date('Y-m-d');

if(!empty($_POST['hide_date']))
{
    $date = date("Y-m-d", strtotime($_POST['hide_date']));
}


$day = new Journee($_SESSION['id'], $date);//Utilisateur, journée
$day->optimiser();

$req = $bdd->query('select MIN(TA_HEUREDEBUT) as min, MAX(TA_HEUREFIN) as max from TACHE_UTILISATEUR where UT_ID = '.$_SESSION['id'].' AND TA_OPTIMISE = 0 AND TA_DATE = "'.$date.'"');
$req->execute();

$donnee = $req->fetch();

$min_no = $donnee['min'];
$max_no = $donnee['max'];

$req = $bdd->query('select MIN(TA_HEUREDEBUT) as min, MAX(TA_HEUREFIN) as max from TACHE_UTILISATEUR where UT_ID = '.$_SESSION['id'].' AND TA_OPTIMISE = 1 AND TA_DATE = "'.$date.'"');
$req->execute();

$donnee = $req->fetch();

$min_o = $donnee['min'];
$max_o = $donnee['max'];

$total_no = strtotime($max_no) - strtotime($min_no);
$total_o = strtotime($max_o) - strtotime($min_o);

$total = $total_no - $total_o;

$heures=intval($total / 3600);
$minutes=intval(($total % 3600) / 60);

$_SESSION["gain"] = $heures.' H '.$minutes.' min';

echo "<a href='../'><input type=\"button\" value=\"Retour Optiday\"></a>";

redirect('../');
?>
