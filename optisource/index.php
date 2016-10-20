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

    <body onload="responsive()" onresize="responsive()">
        <a href="Optiday">
            <div id="gauche" class="demiPage" onmouseover="mOver('Gauche')" onmouseout="mOut('Gauche')">
                <div class="circle" id="circleGauche">
                </div>
                <h1 id="hOptiday">Optiday</h1>
            </div>
        </a>
        <a href="../html/accueil.php">
            <div id="droite" class="demiPage" onmouseover="mOver('Droit')" onmouseout="mOut('Droit')">
                <div class="circle" id="circleDroit">
                </div>
                <h1 id="hOptilife">Optilife</h1>
            </div>
        </a>
    </body>

    <script>
        function responsive()
        {
            var hauteur = window.innerHeight;
            var largeur = window.innerWidth;

            var divDroite = document.getElementById("droite");
            var divGauche = document.getElementById("gauche");

            var circleGauche = document.getElementById("circleGauche");
            var circleDroit = document.getElementById("circleDroit");

            var titreDroit = document.getElementById("hOptilife");
            var titreGauche = document.getElementById("hOptiday");

            divGauche.style.height = hauteur+"px";
            divGauche.style.width = (largeur/2)+"px";

            divDroite.style.height = hauteur+"px";
            divDroite.style.width = (largeur/2)+"px";

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

</html>