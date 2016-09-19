<!DOCTYPE html>
<html>
 <head>
<meta charset="UTF-8">
</head> 
	<?php 
	include("../php/fonctionsUtiles.php");
	include("../php/ajouterTache.php");
	// include("../php/connexionBDD.php");
	?>
	<form method="post" action= "<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="ajoutTache">
		<label for="theme">Theme :</label>
		<select name="theme" id="theme">
			<?php choixTheme($bdd); ?>
		</select>
		<label for="classeAge">classe d'Age :</label>
		<select name="classeAge" id="classeAge">
			<?php choixClasseAge($bdd); ?>
		</select>
		<label for="Activite">Activite :</label>
		<select name="Activite" id="Activite">
			
		</select>
		<?php choixFrequence($bdd); ?>
		<label for="nbFois">nombre de fois : </label>
		<input type="number" id="nbFois" name="nbFois" value=<?php verifierRempli("nbFois"); ?> >
		<label for="nbHeure">Heure(s) : </label>
		<input type="number" id="nbHeure" name="nbHeure" value=<?php verifierRempli("nbHeure"); ?> >
		<label for="nbMinutes">Minute(s) : </label>
		<input type="number" id="nbMinutes" name="nbMinutes" value=<?php verifierRempli("nbMinutes"); ?> >
		<input type="submit" id="envoyer" name="envoyer">
	</form>

	<?php
	//$tab = LireDonneesPDO1($bdd, 'SELECT * FROM `frequence` ');
	 //print_r($tab);
	traiterAjout();
	?>
</html>
