

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Opti-Life</title>

        <link rel="icon" type="image/png" href="../../Images/optilife.png"/>
        
        <!-- CSS -->
        <link rel="stylesheet" href="../../Font/font.css" type="text/css" media="all">
        <link rel="stylesheet" href="../css/bandeau.css" type="text/css">
        <link rel="stylesheet" href="../css/utilities.css" type="text/css" />
        <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css"/>


        <!-- JS -->

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap/bootstrap.min.js"></script>
   
        <script type="text/javascript" src="../../Js/jquery.corner.js"></script>
        <script type="text/javascript" src="../../Js/jQueryRotate.js"></script>

    </head>

    <header>

        <div class="header">

            <div class="width-24">
                <div class="horloge">    
                    <div class="logo" id="logo"></div>
                    <div class="heure" id="heure"></div>
                        
                </div>

                <div class="appli_name">
                    <div class="titre_appli">pti-Life<a href="http://aatchi.fr" class="byAA">  by Aatchi &amp; Aatchi</a></div>
                </div>
				
				<?php if(!isset($_SESSION["usrPseudo"])) { ?>
                <div class="login">
                    <div class="win-open connect" id="#login" style="cursor:pointer"><a href="connexion.php">Connexion</a></div>
                    <div class="win-open register" id="#register" style="cursor:pointer">Inscription</div>
                </div>
				<?php } else {?>
				<div class="login">
                    <div class="win-open connect" id="#compte" style="cursor:pointer"><a href="../php/compte.php">Compte</a></div>
                    <div class="win-open register" id="#signout" style="cursor:pointer">Deconnexion</div>
                </div>
				<?php }?>
            </div>


        </div> 
        <div class="menu">
            <div class="icon_return">    
                <a href="../.."><img src="../img/return_menu.png" class="img_return" border="0"></a>
            </div>
            <div class="return_site">
                <a href="../..">Retour au menu</a>
            </div>
        </div> 

    </header>

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

</html>