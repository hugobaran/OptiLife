

<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Opti-Life</title>

        <link rel="icon" type="image/png" href="../Images/optilife.png"/>
        
        <link rel="stylesheet" href="../Font/font.css">
        <link rel="stylesheet" href="../Optiday/Css/menu.css">
        <link rel="stylesheet" href="../Optiday/Css/bandeau.css">
        <link rel="stylesheet" href="../Optiday/Css/divers.css">

        <script type="text/javascript" src="../Optiday/Js/jquery.min.js"></script>
        <script type="text/javascript" src="../Optiday/Js/jquery.corner.js"></script>
        <script type="text/javascript" src="../Optiday/Js/jQueryRotate.js"></script>
        
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
            <div class="titre_appli">pti-Life<a href="http://aatchi.fr" class="byAA">  by Aatchi &amp; Aatchi</a></div>
        </div>

        <div class="login">
                    <div class="win-open connect" id="#login" style="cursor:pointer">Connexion</div>
                    <div class="win-open register" id="#register" style="cursor:pointer">Inscription</div>
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
</div>  
</div>
</body>
</html>