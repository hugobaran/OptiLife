<?php

include('../../connexion.php');

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

// Récupération des variables nécessaires à l'activation
$email = $_GET['email'];
$cle = $_GET['cle'];

// Récupération de la clé correspondant au $login dans la base de données
$stmt = $bdd->prepare("SELECT UT_CLE, UT_ACTIF FROM UTILISATEUR WHERE UT_EMAIL = ? ");
$stmt->execute(array($email));

$row = $stmt->fetch();

$clebdd = $row['UT_CLE'];	// Récupération de la clé
$actif = $row['UT_ACTIF']; // $actif contiendra alors 0 ou 1

$req = $bdd->prepare('SELECT * FROM UTILISATEUR WHERE UT_EMAIL=?');
$req->execute(array($email));
$info_base = $req->fetch();

$pseudo_base = $info_base['UT_PRENOM'];
$id_base = $info_base['UT_ID'];

// On teste la valeur de la variable $actif récupéré dans la BDD
if($actif == '1') // Si le compte est déjà actif on prévient
{
    $message =  "Votre compte est déjà actif. Vous allez être directement connecté. Bonne visite !";
    
    if(!empty($pseudo_base)){
        $_SESSION['pseudo'] = $pseudo_base;
        $_SESSION['id'] = $id_base;
    }
}
else // Si ce n'est pas le cas on passe aux comparaisons
{
    if($cle == $clebdd) // On compare nos deux clés	
    {
        // Si elles correspondent on active le compte !	
        $message = "Votre compte a bien été activé. Vous allez être directement connecté. Bonne visite !";

        // La requête qui va passer notre champ actif de 0 à 1
        $stmt = $bdd->prepare("UPDATE UTILISATEUR SET UT_ACTIF = 1 WHERE UT_EMAIL = ? ");
        $stmt->execute(array($email));

        if(!empty($pseudo_base)){
            $_SESSION['pseudo'] = $pseudo_base;
            $_SESSION['id'] = $id_base;
        }
    }
    else // Si les deux clés sont différentes on provoque une erreur...
    {
        $message = "Erreur ! Votre compte ne peut être activé...";
    }
}

$_SESSION['message_validation'] = $message;

redirect('../');


?>