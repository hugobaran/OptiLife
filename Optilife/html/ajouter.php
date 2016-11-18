<?php
	include("../php/connexionBDD.php");
	include("../php/ajouterTache.php");
?>
<!DOCTYPE html>
<html>
 <head>
<meta charset="UTF-8">
<title>Ajout d'une activité</title>	
<script type="text/javascript" src="../js/jquery.chained.min.js"></script>
</head> 
<script>
	function resetFields(){
		document.getElementById('theme').selectedIndex=0;
		document.getElementById('activite').selectedIndex=0;
		document.getElementById('classe_age').selectedIndex=0;
		document.getElementById('nbFois').value="";
		document.getElementById('nbHeure').value="";
		document.getElementById('nbMinutes').value="";
		document.getElementById('frequence').selectedIndex=0;//marche pas, faut trouver un truc qui selectionne un bouton radio
}

</script>
<body>
	<form method="post" action= "../php/passerelle.php" enctype="application/x-www-form-urlencoded" name="ajoutTache">
		<label for="theme">Theme :</label>
		<select name="theme" id="theme" class="form-control">
		<option value="">Sélectionner un thème</option>
		<?php 
			choixTheme($bdd);
		?>
		</select>
		</br>
		<label for="activite">Activité :</label>
		<select name="activite" id="activite" class="form-control">
		<option value="">Sélectionner une activité</option>
		<?php 
			$sql = 'SELECT THM_LIBELLE, ACT_LIBELLE FROM activite JOIN THEME USING(THM_NUM)';
			creerListeActivite($bdd,$sql,'ACT_LIBELLE', 'activite');
		?>
		</select>
		</br>

			<label>Classe d'age : </label></br>
			<label for="caEtudiant" class="checkbox-inline"><input type="checkbox" id="caEtudiant" name="classe_age[]" value="1"/>Etudiant</label>
		    <label for="caActif" class="checkbox-inline"><input type="checkbox" id="caActif" name="classe_age[]" value="2"/>Actif </label>
		    <label for="caRetraite" class="checkbox-inline"><input type="checkbox" id="caRetraite" name="classe_age[]" value="3"/>Retraité </label>
			<!--<label for="caVie">Toute la vie </label><input type="checkbox" id="caVie" name="classe_age[]" value="4"/>-->
			</br></br>
			<label>Frequence :</label></br>
			<?php 
				choixFrequence($bdd);
			?>

		
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
		<input type="submit" class="btn btn-primary btn-lg btn-block" id="btn" name="ajouter" value="Envoyer">
	</form>
</body>

<script type="text/javascript">$(function(){
    $("#activite").chained("#theme");
});
</script>

</html>