<?php

include('../../connexion.php');

$UT_ID = $_SESSION['id'];

$date = $_POST['date'];

if(empty($date)) $date = date('Y-m-d');

echo '
<style>
    #tab_methode{border-collapse:collapse;}
    #tab_methode td, #tab_methode th{padding:15px;border:1px solid black;}
    #tab_methode thead{background-color:#3477be;color:white;}
    #affiche_methode{overflow: scroll;}
    [type="radio"]:not(:checked),[type="radio"]:checked {position: absolute;left: -9999px;}
    [type="radio"]:not(:checked) + label,[type="radio"]:checked + label {position: relative;padding-left: 75px;cursor: pointer;}
    [type="radio"]:not(:checked) + label:before,
    [type="radio"]:checked + label:before,
    [type="radio"]:not(:checked) + label:after,
    [type="radio"]:checked + label:after {content: \'\';position: absolute;}
    [type="radio"]:not(:checked) + label:before,
    [type="radio"]:checked + label:before {left:0; top: -3px;width: 65px; height: 30px;background: #DDDDDD;border-radius: 15px;-webkit-transition: background-color .2s;-moz-transition: background-color .2s;-ms-transition: background-color .2s;transition: background-color .2s;}
    [type="radio"]:not(:checked) + label:after,[type="radio"]:checked + label:after {width: 20px; height: 20px;-webkit-transition: all .2s;-moz-transition: all .2s;-ms-transition: all .2s;transition: all .2s;border-radius: 50%;background: #7F8C9A;top: 2px; left: 5px;}
    [type="radio"]:checked + label:before {background:#34495E;}
    [type="radio"]:checked + label:after {background: #3477be;top: 2px; left: 40px;}
    [type="radio"]:checked + label .ui,[type="radio"]:not(:checked) + label .ui:before,[type="radio"]:checked + label .ui:after {position: absolute;left: 6px;width: 65px;border-radius: 15px;font-size: 14px;font-weight: bold;line-height: 22px;-webkit-transition: all .2s;-moz-transition: all .2s;-ms-transition: all .2s;transition: all .2s;}
    [type="radio"]:not(:checked) + label .ui:before {content: "no";left: 32px;}
    [type="radio"]:checked + label .ui:after {content: "yes";color: #3477be;}
    [type="radio"]:focus + label:before {border: 1px dashed #777;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;-ms-box-sizing: border-box;box-sizing: border-box;margin-top: -1px;}
</style>';

$res = $bdd->query('
    SELECT CA_LIBELLE, TA_ID, CA_ID, TA_HEUREDEBUT, TA_HEUREFIN FROM TACHE_UTILISATEUR 
    JOIN CATALOGUE USING(CA_ID)
    WHERE CA_ID IN (SELECT CA_ID FROM FACON) AND TA_DATE="'.$date.'" AND UT_ID='.$UT_ID.' AND TA_OPTIMISE = 0');

echo '<table id="tab_methode">';

echo '<thead><tr><th>Nom de la tâche</th><th>Horaire de la tâche</th><th>Méthode associée</th><th>Nouvelle durée</th></tr></thead>';

echo '<tbody>';

$check = 0;
while($row = $res->fetch()){
    $i = 0;
    $req1 = $bdd->query('
        SELECT MET_LIBELLE, MET_DUREE FROM FACON
        JOIN MANIERE_DE_FAIRE USING(MET_ID)
        WHERE CA_ID='.$row[CA_ID]);
    
    while($donnee1 = $req1->fetch()){
        $i = $i+1;
    }
    
    echo '<tr>';
    echo '<td rowspan="'.$i.'">'.$row[CA_LIBELLE].'</td>';
    echo '<td rowspan="'.$i.'">'.$row[TA_HEUREDEBUT].' à '.$row[TA_HEUREFIN].'</td>';
    
    $req2 = $bdd->query('
        SELECT MET_LIBELLE, MET_DUREE FROM FACON
        JOIN MANIERE_DE_FAIRE USING(MET_ID)
        WHERE CA_ID='.$row[CA_ID]);
    
    while($donnee2 = $req2->fetch()){
        echo '<td>'.$donnee2[MET_LIBELLE].'</td>';
        echo '<td>'.$donnee2[MET_DUREE].' min</td>';
        echo '<td><input type="radio" name="'.$row[TA_ID].'" id="'.$check.'"><label for="'.$check.'"></label></td>';
        echo '</tr>';
        $check = $check+1;
    }
}

echo '</tbody></table>';

?>


