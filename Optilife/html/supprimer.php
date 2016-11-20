<?php
	include("../php/connexionBDD.php");
?>
<html>
	<head>
		<meta charset="UTF-8"/>
	</head>
	<body>
		<form method="POST" action= "../php/passerelle.php" enctype="application/x-www-form-urlencoded" name="supprimerActivite">
            <input type="hidden" id="suppActivite" name="activite" value=""/>
            <input type="hidden" id="suppFrequence" name="frequence" value=""/>  
            <input type="hidden" id="suppCA" name="classeAge" value=""/>
            <label>Activité :</label><p id="affichageActiviteS"></p>
            </br>
            <label>Classe d'age :</label><p id="affichageClasseAgeS"></p>
            </br>
            <label>Voulez vous supprimer cette activite ?</label>
            </br>
            <div class="row">
            <div class="col-xs-6">
            	<input type="submit" class="btn btn-danger btn-lg btn-block" name="supprimer" value="supprimer"/>
            </div>
            <div class="col-xs-6">
            	<button type="button" class="btn btn-default btn-lg btn-block" data-dismiss="modal">Annuler</button>
            </div>
            </div>
          </form>
	</body>
</html>