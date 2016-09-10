<!DOCTYPE html>
<html>

	<form methode="post" action="edt.php" name="ajoutTache">
		<label for="theme">Theme :</label>
		<select name="theme" id="theme">
			
		</select>
		<label for="classeAge">classe d'Age :</label>
		<select name="classeAge" id="classeAge">
			
		</select>
		<label for="Activite">Activite :</label>
		<select name="Activite" id="Activite">
			
		</select>
		<input type="radio" id="frequence" name="journalier"> <label for="journalier"> Journalier </label>		<input type="radio" id="frequence" name="journalier"> <label for="journalier"> Journalier </label>
		<input type="radio" id="frequence" name="hebdomadaire"> <label for="hebdomadaire"> hebdomadaire </label>
		<input type="radio" id="frequence" name="Mensuel"> <label for="Mensuel"> Mensuel </label>
		<input type="radio" id="frequence" name="Annuel"> <label for="Annuel"> Annuel </label>
		<label for="nbFois">nombre de fois : </label>
		<input type="number" id="nbFois" name="nbFois">
		<label for="nbHeure">Heure(s) : </label>
		<input type="number" id="nbHeure" name="nbHeure">
		<label for="nbMinutes">Minute(s) : </label>
		<input type="number" id="nbMinutes" name="nbMinutes">
		<input type="submit" id="envoyer" name="envoyer">
	</form>

</html>
