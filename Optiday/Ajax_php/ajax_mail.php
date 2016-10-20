<?php

include('../../connexion.php');

$pseudo = $_POST['pseudo'];
$mail = $_POST['mail'];
$mdp = $_POST['mdp'];
$cf_mdp = $_POST['cf_mdp'];

$req = $bdd->prepare('SELECT * FROM UTILISATEUR WHERE UT_EMAIL=?');

$req->execute(array($mail));

$info = $req->fetch();

$mail_base = $info['UT_EMAIL'];

if(!empty($mail_base) || !filter_var($mail, FILTER_VALIDATE_EMAIL)){
    echo '
        <script>
            var input = document.getElementById("ins_mail");
            input.style.backgroundImage = \'linear-gradient(rgba(255, 0, 0, 0.19), rgba(255, 0, 0, 0.07))\';
            input.style.border = \'1px solid rgba(255, 0, 0, 0.61)\';
        </script>';
}

else{
    echo '
        <script>
            var input = document.getElementById("ins_mail");
            input.style.backgroundImage = \'linear-gradient(rgba(4, 196, 12, 0.19), rgba(4, 196, 12, 0.08))\';
            input.style.border = \'1px solid rgba(4, 196, 12, 0.4)\';
        </script>';
}

if(filter_var($mail, FILTER_VALIDATE_EMAIL) && $mdp == $cf_mdp && !empty($mdp) && !empty($pseudo) && !empty($mail) && empty($mail_base)){
    echo '
        <script>
            $(\'#submit\').show(); 
            $(\'#submit\').html(\'<input type="submit" value="Valider" name="submit"/>\');
        </script>';
}

else{
    echo '
        <script>
            $(\'#submit\').show(); 
            $(\'#submit\').html(\'\');
        </script>';
}

?>