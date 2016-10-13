<?php

    include("connexionBDD.php");

    function supprimerActivite($bdd){
    try
    {
        // Création d'une requête préparée
        $requete = $bdd->prepare(
            'DELETE FROM PRATIQUER WHERE ACT_NUM= 102'
        );
 
        // Protection des paramètres par l'objet PDO
        //$requete->bindParam(':id', $actnum, PDO::PARAM_INT);
 
        $requete->execute();
        alert("OK");
        exit;
    }
    catch (PDOException $bdd)
    {
        $aListeErreurs[] = 'Une erreur est survenue et a empêché la suppression du message';
    }
    }

    ?>
