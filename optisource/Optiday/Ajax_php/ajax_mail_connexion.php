<?php

include('../../connexion.php');

$mail = $_POST['mail'];
$mdp = $_POST['mdp'];

$req = $bdd->prepare('SELECT * FROM UTILISATEUR WHERE UT_EMAIL=?');

$req->execute(array($mail));

$info = $req->fetch();

$mail_base = $info['UT_EMAIL'];
$mdp_base = $info['UT_PASS'];


if($mail_base == $mail && $mdp_base == sha1($mdp)) 
    echo '<script>
    var input_mail = document.getElementById("mail_connexion");
    var input_mdp = document.getElementById("mdp_connexion");
    input_mail.style.backgroundImage = \'linear-gradient(rgba(4, 196, 0, 0.19), rgba(4, 196, 0, 0.08))\';
    input_mail.style.border = \'1px solid rgba(4, 196, 0, 0.61)\';
    input_mdp.style.backgroundImage = \'linear-gradient(rgba(4, 196, 0, 0.19), rgba(4, 196, 0, 0.08))\';
    input_mdp.style.border = \'1px solid rgba(4, 196, 0, 0.61)\';
    </script>';

else if ($mail_base != $mail && $mdp_base != sha1($mdp) || !empty($mdp))
    echo '<script>
    var input_mail = document.getElementById("mail_connexion");
    var input_mdp = document.getElementById("mdp_connexion");
    input_mail.style.backgroundImage = \'linear-gradient(rgba(255, 0, 0, 0.19), rgba(255, 0, 0, 0.07))\';
    input_mail.style.border = \'1px solid rgba(255, 0, 0, 0.61)\';
    input_mdp.style.backgroundImage = \'linear-gradient(rgba(255, 0, 0, 0.19), rgba(255, 0, 0, 0.07))\';
    input_mdp.style.border = \'1px solid rgba(255, 0, 0, 0.61)\';
    </script>';

if($mail_base == $mail && $mdp_base == sha1($mdp)){
    echo '<script>
    $(\'#submit_connexion\').show(); $(\'#submit_connexion\').html(\'<input type="submit" value="Connexion">\');
    </script>';
}

else 
    echo '<script>
    $(\'#submit_connexion\').show(); $(\'#submit_connexion\').html(\'\');
    </script>';
?>