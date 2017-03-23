<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Commencer</title>
        <link rel="stylesheet" href="Font/font.css" type="text/css" media="all" />
        <link rel="stylesheet" href="Css/menu.css" type="text/css" media="all" />
        <script type="text/javascript" src="Js/jquery.min.js"></script>
        <script type="text/javascript" src="Js/jQueryRotate.js"></script>
    </head>

    <body onload="responsive(); " onresize="responsive()">
            <a href="Optiday" id="OptiDayNormal" style="display:block;">
                <div id="gauche" class="demiPage" onmouseover="mOver('Gauche')" onmouseout="mOut('Gauche')">
                    <div class="circle" id="circleGauche">
                    </div>
                    <h1 id="hOptiday">Opti-Day</h1>
                </div>
            </a>
            <a href="Optilife/html/accueil.php" id="OptiLifeNormal" style="display:block;">
                <div id="droite" class="demiPage" onmouseover="mOver('Droit')" onmouseout="mOut('Droit')">
                    <div class="circle" id="circleDroit">
                    </div>
                    <h1 id="hOptilife">Opti-Life</h1>
                </div>
            </a>
            <a href="Optiday" id="OptiDayPN" style="display:none; float: left; margin-right: -25%;">
                <img id="OptiDayPNImg" src="Images/Opti_Day.png">
            </a>
            <a href="Optilife/html/accueil.php" id="OptiLifePN" style="display:none; float: right; margin-left :-25%;">
                <img id="OptiLifePNImg" src="Images/Opti_Life.png">
            </a>
    </body>

    <script>
        function responsive()
        {
            var hauteur = $(window).height();
            var largeur = $(window).width();

            var divDroite = document.getElementById("droite");
            var divGauche = document.getElementById("gauche");

            var circleGauche = document.getElementById("circleGauche");
            var circleDroit = document.getElementById("circleDroit");

            var titreDroit = document.getElementById("hOptilife");
            var titreGauche = document.getElementById("hOptiday");

            var imgDay = document.getElementById('OptiDayPNImg');
            var imgLife = document.getElementById('OptiLifePNImg');

            divGauche.style.height = hauteur+"px";
            divGauche.style.width = (largeur/2)+"px";

            //imgDay.height = hauteur+"px";
            //imgDay.width = (largeur/2)+"px";

            divDroite.style.height = hauteur+"px";
            divDroite.style.width = (largeur/2)+"px";

            //imgLife.height = hauteur+"px";
            //imgLife.width = (largeur/2)+"px";

            circleGauche.style.width = (3*largeur/8)+"px";
            circleGauche.style.height = circleGauche.style.width;
            circleGauche.style.marginLeft = ((largeur/16)-8)+"px";
            circleGauche.style.marginTop = (((hauteur-circleGauche.offsetWidth)/2)-8)+"px";

            circleDroit.style.width = (3*largeur/8)+"px";
            circleDroit.style.height = circleDroit.style.width
            circleDroit.style.marginLeft = ((largeur/16)-8)+"px";
            circleDroit.style.marginTop = (((hauteur-circleDroit.offsetWidth)/2)-8)+"px";

            titreGauche.style.fontSize = (largeur/20)+"px";
            titreGauche.style.marginTop = ((hauteur-titreGauche.offsetHeight)/2)+"px";
            titreGauche.style.marginLeft = ((largeur-2*titreGauche.offsetWidth)/4)+"px";

            titreDroit.style.fontSize = (largeur/20)+"px";
            titreDroit.style.marginTop = ((hauteur-titreDroit.offsetHeight)/2)+"px";
            titreDroit.style.marginLeft = ((largeur-2*titreDroit.offsetWidth)/4)+"px";
        }

        function mOver(cote)
        {
           document.getElementById('circle'+cote).style.boxShadow = "0px 0px 20px #FFF, 0px 0px 20px #FFF inset";
        }

        function mOut(cote)
        {
           document.getElementById('circle'+cote).style.boxShadow = "0px 0px 20px rgba(34, 34, 34, 1), 0px 0px 20px rgba(34, 34, 34, 1) inset";
        }  

    </script>
    <script>
        var dateSeconde = new Date();
        var seconde = dateSeconde.getSeconds();
        var angle = 360/60*seconde;
        $(function(){
            setInterval(function bis(){
                $('.circle').animate({borderSpacing:'+=360'}, {
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
    <script type="text/javascript">
        $(window).load(function() {
            // Opera 8.0+
            var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

            // Firefox 1.0+
            var isFirefox = typeof InstallTrigger !== 'undefined';

            // Safari 3.0+ "[object HTMLElementConstructor]" 
            var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);

            // Internet Explorer 6-11
            var isIE = /*@cc_on!@*/false || !!document.documentMode;

            // Edge 20+
            var isEdge = !isIE && !!window.StyleMedia;

            // Chrome 1+
            var isChrome = !!window.chrome && !!window.chrome.webstore;

            // Blink engine detection
            var isBlink = (isChrome || isOpera) && !!window.CSS;

            if(isSafari){
                $('#OptiDayPN').css("display", "inline-block");
                $('#OptiLifePN').css("display", "inline-block");
                $('#OptiDayNormal').css("display", "none");
                $('#OptiLifeNormal').css("display", "none");
            }
        });
    </script>

</html>