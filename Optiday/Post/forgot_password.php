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

include('../../connexion.php');

$mail = $_POST['mail'];

$req = $bdd->prepare('SELECT UT_PRENOM, UT_PASS, UT_EMAIL FROM UTILISATEUR WHERE UT_EMAIL=?');
$req->execute(array($_POST['mail']));
$cf_mail = $req->fetch();
$cf_mail = $cf_mail['UT_EMAIL'];

if (empty($pseudonyme) || empty($mail) || empty($password) || empty($cf_password))
    $_SESSION['erreur_ins'] = 'Vous devez compléter tous les champs du formulaire.';

else if (!preg_match("/^[A-Za-z'çéèê à-]+$/", $pseudonyme))
    $_SESSION['erreur_ins'] = 'Votre pseudonyme ne peut pas contenir de caratère spéciaux.';

    else if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
    $_SESSION['erreur_ins'] = 'Votre adresse e-mail n\'est pas valide.';

    else if($password != $cf_password)
    $_SESSION['erreur_ins'] = 'Les mots de passe ne sont pas identique.';

    else if($cf_mail == $mail)
    $_SESSION['erreur_ins'] = 'L\'adresse mail est déjà utilisée.';

    else
{       
    // Génération aléatoire d'une clé
    $cle = md5(microtime(TRUE)*100000);

    $password = sha1($password);
    $maxId = $bdd->query("SELECT max(UT_ID) as ID FROM UTILISATEUR");
    $maxId = $maxId->fetch();
    $maxId = $maxId['ID'];
    $plusun = $maxId + 1;
    $req = $bdd->prepare('INSERT INTO UTILISATEUR VALUES(?,?,?,?,?,?)');
    $req->execute(array($plusun, $pseudonyme, $password, $mail, $cle, 0));

    // Préparation du mail contenant le lien d'activation
    $destinataire = $mail;
    $sujet = "Activer votre compte" ;
    $entete = "From: inscription@save-time.fr" ;

    // Le lien d'activation est composé du login(log) et de la clé(cle)
    $message = 'Bienvenue sur Save-time,

Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.

http://save-time.fr/Optiday/Post/activation.php?email='.urlencode($mail).'&cle='.urlencode($cle).'


---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';


    mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail

    $_SESSION['lien_validation'] = "Un lien de validation vient de vous être envoyé par email. Veuillez cliquer dessus afin de valider votre inscription.";

}

redirect('../');

?>