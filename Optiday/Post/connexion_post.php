<?php
    session_start();

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
    $password = $_POST['passe'];
    $password = sha1($password);

    $req = $bdd->prepare('SELECT * FROM UTILISATEUR WHERE UT_EMAIL=? AND UT_PASS=?');
    $req->execute(array($mail,$password));
    $info_base = $req->fetch();

    if($info_base['UT_ACTIF'] == 1){
        $pseudo_base = $info_base['UT_PRENOM'];
        $mail_base = $info_base['UT_EMAIL'];
        $passe_base = $info_base['UT_PASS'];
        $id_base = $info_base['UT_ID'];

        $_SESSION['pseudo'] = $pseudo_base;
        $_SESSION['id'] = $id_base;

        if(isset($_POST['remember'])){
            $_SESSION['remember'] = 1;
        }
    }
    else if($info_base['UT_ACTIF'] == 0){
        $_SESSION['message_nonvalide'] = 'Votre compte n\'a pas encore été validé, veuillez cliquer sur le lien reçu par email.';
    }
    else if(empty($info_base['UT_EMAIL'])){
        $_SESSION['erreur_co'] = 'Le compte n\existe pas.';
    }

        redirect('../');
        
?>