<?php

include('../../connexion.php');

$date = $_POST['date'];
$heure_debut = $_POST['heure_debut'];
$boolean = 0;

$testHeure = $bdd->prepare('SELECT * FROM TACHE_UTILISATEUR WHERE TA_DATE = ? AND TA_OPTIMISE = ?');

$testHeure->execute(array($date, 0));

while($resultat = $testHeure->fetch()){
    $heureDeb  = $resultat['TA_HEUREDEBUT'];
    $heureFin  = $resultat['TA_HEUREFIN'];
    $heureDeb = strtotime($heureDeb);
    $heureFin = strtotime($heureFin);
    $heureDatetime = strtotime($heure_debut);
    if($heureDatetime>$heureDeb && $heureDatetime<$heureFin){
        echo 
            '<p style="color:red;margin-left:10%;width:80%;font-size:13px">Attention, vous réalisez déjà un tâche à cette heure, veuillez en sélectionner une nouvelle.<p>
            <script>
                document.getElementById(\'heure_fin\').disabled = true;
                document.getElementById(\'SubmitTache\').disabled = true;
            </script>';
        $boolean = 1;
        break;
    }
}

if($boolean != 1){
    $testHeureDeb = '';
    $req = $bdd->prepare('SELECT * FROM TACHE_UTILISATEUR WHERE TA_DATE = ? AND TA_HEUREDEBUT > ? AND TA_OPTIMISE = ?');

    $req->execute(array($date, $heure_debut, 0));

    while($info = $req->fetch()){
        $testHeureDeb  = $info['TA_HEUREDEBUT'];
        break;
    }

    if($testHeureDeb != ''){
        $max = substr($testHeureDeb, 0, -3);
    }
    else $max = '23:59';
    
    echo "
        <script>
            document.getElementById('SubmitTache').disabled = false;
            document.getElementById('heure_fin').disabled = false;
            jQuery('#heure_fin').datetimepicker({
                lang:'fr',
                datepicker:false,
                format:'H:i',
                value:'$heure_debut',
                minTime:'$heure_debut',
                maxTime:'$max',
                step:1,
                mask:true
            });
        </script>";
}


?>