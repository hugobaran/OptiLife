<?php
	include("../php/connexionBDD.php");
	include("../php/modifierTache.php");
?>
<html>
	<head>
		<meta charset="UTF-8"/>
	</head>
	<body>
		<form method="post" action= "../php/passerelle.php" enctype="application/x-www-form-urlencoded" name="modifierTache">
			<label>Activité :</label><p id="affichageActivite"></p>
			<input name="activite" id="activite" type="hidden" value=<?php if(isset($_POST["activite"])) echo '"'.$_POST["activite"].'"'; ?>/>
			<input name="pratique" id="pratique" type="hidden" value=<?php if(isset($_POST["pratique"])) echo '"'.$_POST["pratique"].'"'; ?>/>
			</br>
			<label>Classe d'age :</label><p id="affichageClasseAge"></p>
			<input name="classe_age" id="classe_age" type="hidden" value=<?php if(isset($_POST["classe_age"])) echo '"'.$_POST["classe_age"].'"'; ?>/>
			</br>
			<label>Frequence :</label></br>
			<?php 
				choixFrequence($bdd);
			?>
			<input name="EXfrequence" id="EXfrequence" type="hidden" value=<?php if(isset($_POST["frequence"])) echo '"'.$_POST["frequence"].'"'; ?>/>
		</br>	</br>
			<div class="row">
			<div class="col-xs-4">
				<label for="nbFois">Nombre de fois : </label>
				<input type="number" class="form-control" id="nbFois" name="nbFois"  min="1" max="1000" value=<?php verifierRempli("nbFois"); ?> >
			</div>
			<div class="col-xs-4">
				<label for="nbHeure">Heure(s) : </label>
				<input type="number" class="form-control" id="nbHeure" name="nbHeure"  min="0" value=<?php verifierRempli("nbHeure"); ?> >
			</div>
			<div class="col-xs-4">
				<label for="nbMinutes">Minute(s) : </label>
				<input type="number" class="form-control" id="nbMinutes" name="nbMinutes"  min="0" max="59" value=<?php verifierRempli("nbMinutes"); ?> >
			</div>
		</div>
			</br>	</br>
			<input type="submit" class="btn btn-primary btn-lg btn-block" id="btn" name="modifier" value="Modifier">
		</form>
	</body>
</html>


<?php

modifierTache($bdd);


?>