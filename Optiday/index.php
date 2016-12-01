<?php

    include('../connexion.php');

    $_SESSION['site'] = 'Optiday';

?>

<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Optiday</title>

        <link rel="icon" type="image/png" href="Images/icone_navigateur.png"/>
        
        <link rel="stylesheet" href="../Font/font.css">
        <link rel="stylesheet" href="Css/application.css">
        <link rel="stylesheet" href="Css/menu.css">
        <link rel="stylesheet" href="Css/bandeau.css">
        <link rel="stylesheet" href="Css/divers.css">
       
        <link rel="stylesheet" href="../ToolDesign/ToolDesign.css">
        
        <link rel="stylesheet" type="text/css" href="Timeline-2.7.0/timeline-theme.css">
        <link rel="stylesheet" type="text/css" href="Timeline-2.7.0/theme/excite-bike.css"> 

        <script type="text/javascript" src="Timeline-2.7.0/lib/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="Timeline-2.7.0/lib/jquery-ui.js"></script>
        
        <script type="text/javascript" src="Timeline-2.7.0/temp/timeline.js"></script>
        <script type="text/javascript" src="Timeline-2.7.0/timeline-locales.js"></script>
        
        <script type="text/javascript" src="Js/jsapi.js"></script>
	    <script type="text/javascript" src="Js/jquery.min.js"></script>
        <script type="text/javascript" src="Js/jquery.corner.js"></script>
        <script type="text/javascript" src="Js/jQueryRotate.js"></script>
       
        <script><?php include('Js/timeline_non_optimise.js'); ?></script>
        <script><?php include('Js/timeline_optimise.js'); ?></script>    <!-- Script pour les timelines -->
        
        <script type="text/javascript" src="../Datetime/datetimepicker-master/jquery.datetimepicker.js"></script>
        <link type="text/css" href="../Datetime/datetimepicker-master/jquery.datetimepicker.css" rel="stylesheet">
        
        <script type="text/javascript" src="Js/filtre_formulaire.js"></script>
        <script type="text/javascript" src="Ajax/formulaire_validation.js"></script>
        <script type="text/javascript" src="Ajax/supprimer_tache.js"></script>
        <script type="text/javascript" src="Ajax/formulaire_tache.js"></script>
        <script type="text/javascript" src="Ajax/methode.js"></script>
        
        <script>
            var dateSeconde = new Date();
            var seconde = dateSeconde.getSeconds();
            var angle = 360/60*seconde;
            $('.logo').corner("90px");
            $(function(){
                setInterval(function bis(){
                    $('.logo').animate({borderSpacing:'+=360'}, {
                        step: function(now,fx) {
                            $(this).css('-webkit-transform','rotate('+now+'deg)'); 
                            $(this).css('-moz-transform','rotate('+now+'deg)');
                            $(this).css('transform','rotate('+now+'deg)');
                            $(this).css('-ms-transform','rotate('+now+'deg)');
                            $(this).css('-o-transform','rotate('+now+'deg)');
                        }, duration:60000, easing:'linear'    
                    });		
                }, 10);		
            });
        </script>
        
        <style>
            body,.ui-widget,.ui-widget input,.ui-widget select,.ui-widget textarea,.ui-widget button,.ui-widget-header,.ui-widget-content,.ui-widget-header .ui-widget-header,.ui-widget-content .ui-widget-content {
                font-family: Arial, "Trebuchet MS", Verdana, sans-serif !important;
                font-size: 12px !important;
            }
            #bienvenue{
                color: white;
                margin-right:20px;
                font-size:15px;
             }
        </style>

    </head>

<body onload="AjaxMethode();">

<div id="body">

<?php include('Php/modal.php'); ?>

<div class="header">

    <div class="width-24">
        <div class="horloge">    
            <div class="logo" id="logo"></div>
            <div class="heure" id="heure"></div>
                <script>
                    function rafraichir(){
                        var text = '';
                        var date = new Date();
                        if ( date.getHours() <= 9 ) var heure = '0'+date.getHours();
                        else var heure = date.getHours();
                        if ( date.getMinutes() <= 9 ) var minutes = '0'+date.getMinutes();
                        else var minutes = date.getMinutes();
                        text +=  heure+':'+minutes;
                        document.getElementById('heure').innerHTML = text;
                    }
                    
                    document.write('<div id="heure"></div>');
                    setInterval('rafraichir()',1000);
                    
                </script>
        </div>

        <div class="appli_name">
            <div class="titre_appli">ptiday<a href="http://aatchi.fr" class="byAA">  by Aatchi &amp; Aatchi</a></div>
        </div>
        
        <div class="logoAide win-open" id="#pop" style="cursor:pointer"><img src="Images/icone_aide.png" border="0"></div>

        <div class="login">
            <?php
                if(empty($_SESSION['pseudo'])) echo '
                    <div class="win-open connect" id="#login" style="cursor:pointer">Connexion</div>
                    <div class="win-open register" id="#register" style="cursor:pointer">Inscription</div>';
                if(!empty($_SESSION['pseudo'])) echo '
                    <a class="disconnect" id="disconnect" href="Php/deconnection.php"><div>Déconnexion</div></a>';
            ?>
        </div>

    </div>

</div>     

<div class="menu">
    <div class="icon_return">    
        <a href="http://www.save-time.fr"><img src="Images/icone_retour.png" border="0"></a>
    </div>
    <div class="return_site">
        <a href="http://www.save-time.fr">Retour au menu</a>
    </div>
    <div class="prof_pref">
        <?php
            if(!empty($_SESSION['pseudo'])) 
            {
                $heure = date('H');
                
                if($heure < 17 && $heure > 05) echo "<span id='bienvenue'>Bonjour ".$_SESSION['pseudo']."</span>";
                else echo "<span id='bienvenue'>Bonsoir ".$_SESSION['pseudo']."</span>";
            }
        ?>
    </div>

</div>

<!-- -------------------------------------->

<div class="application">

    <div id="menuBarre">
        <div id="dayLeft">
            <input type="button" id="setStartDate" class="Calend" value="Aller à la date du :" onclick="setTime();">
            <input type="text" id="startDate" class="Calend" name="date">
            <script type="text/javascript">
                jQuery('#startDate').datetimepicker({
                        lang:'fr',
                        timepicker:false,
                        format:'Y/m/d'
                    });
            </script>
        </div>
        <div id="ajouter_tache">
            <?php if(!empty($_SESSION['pseudo'])){?>
            <input type="button" class="win-open changeDay" value="Ajouter une tâche" id="#ins_tache">
            <?php } ?>
        </div>
        <div id="dayRight">
            <input type="button" id="delTime" class="changeDay" value="<<< Jour précédent" onclick="delTime();AjaxMethode();">
            <input type="button" id="addTime" class="changeDay" value="Jour suivant >>>" onclick="addTime();AjaxMethode();">
        </div>
    </div>

    <div id="timeline_no_optimize"></div>

    <div id="bouton_optimize">
        <div id="bouton_optimize_ss_method">
            <?php
                if(!empty($_SESSION['id'])){
                    echo '
                    <form action="Php/fonction_optimize.php" method="post">
                        <input type="hidden" id="hide_date" name="hide_date">
                        <input type="submit" name="Opti" value="OPTIMISER le planning">
                    </form>';
                }
                else echo '<input type="button" value="OPTIMISER le planning">';
            ?>
        </div>
        <div id="bouton_optimize_method">
            <?php
                if(!empty($_SESSION['id'])){
                    echo '
                        <input type="button" class="win-open" id="#method_tache" value="OPTIMISER le planning avec méthode">';
                }
                else echo '<input type="button" value="OPTIMISER le planning avec méthode">';
            ?>
        </div>
    </div>

    <div id="timeline_optimize" lang="fr"></div>

</div>

</div>
   
<p style="text-align:center;font-weight:bold">Optiday - contact@savetime.fr - Version 2014
    <?php 
        if($_SESSION['id']==1) {
            echo ' - <a id="administration" href="../Panneau_administration/">Administration</a>';}
        else if(!empty($_SESSION['id']) && $_SESSION['id']!=1){
            echo ' - <span class="win-open" id="#propos" style="cursor:pointer;color:#4889cb">À propos</span>';}
    
    ?> 

</p>
       


<?php 
    if(!empty($_SESSION['gain'])) echo "<script>OpenWindows('gain');</script>"; unset($_SESSION['gain']);
    if(!empty($_SESSION['message_validation'])) echo "<script>OpenWindows('message_validation');</script>"; unset($_SESSION['message_validation']);
    if(!empty($_SESSION['lien_validation'])) echo "<script>OpenWindows('lien_validation');</script>"; unset($_SESSION['lien_validation']);
    if(!empty($_SESSION['message_nonvalide'])) echo "<script>OpenWindows('message_nonvalide');</script>"; unset($_SESSION['message_nonvalide']);
?>

    <script src="../ToolDesign/ToolDesign.js"></script>

</body>

</html>