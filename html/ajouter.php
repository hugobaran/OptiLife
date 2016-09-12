<!DOCTYPE html>
<html>
	<?php 
	include("../php/fonctionsUtiles.php");
	include("../php/ajouterTache.php");
	connexionBase(); 
	?>
	<form method="post" action= "<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="ajoutTache">
		<label for="theme">Theme :</label>
		<select name="theme" id="theme">
			
		</select>
		<label for="classeAge">classe d'Age :</label>
		<select name="classeAge" id="classeAge">
			
		</select>
		<label for="Activite">Activite :</label>
		<select name="Activite" id="Activite">
			
		</select>
		<input type="radio" name="frequence" id="journalier" value="journalier" <?php cocherRadio("frequence","journalier"); ?> > <label for="journalier"> Journalier </label>
		<input type="radio" name="frequence" id="hebdomadaire"  value="hebdomadaire" <?php cocherRadio("frequence", "hebdomadaire"); ?> > <label for="hebdomadaire"> hebdomadaire </label>
		<input type="radio" name="frequence" id="Mensuel"  value="Mensuel" <?php cocherRadio("frequence","Mensuel"); ?> > <label for="Mensuel"> Mensuel </label>
		<input type="radio" name="frequence" id="Annuel"  value="Annuel" <?php cocherRadio("frequence", "Annuel"); ?> <label for="Annuel"> Annuel </label>
		<label for="nbFois">nombre de fois : </label>
		<input type="number" id="nbFois" name="nbFois" value=<?php verifierRempli("nbFois"); ?> >
		<label for="nbHeure">Heure(s) : </label>
		<input type="number" id="nbHeure" name="nbHeure" value=<?php verifierRempli("nbHeure"); ?> >
		<label for="nbMinutes">Minute(s) : </label>
		<input type="number" id="nbMinutes" name="nbMinutes" value=<?php verifierRempli("nbMinutes"); ?> >
		<input type="submit" id="envoyer" name="envoyer">
	</form>

	<?php
	traiterAjout();
	?>
</html>
