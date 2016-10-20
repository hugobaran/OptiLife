<?php
	include("../php/connexionBDD.php");
	include("../php/fonctionsUtiles.php");
	include("../php/ajouterTache.php");
?>
<!DOCTYPE html>
<html>
 <head>
<meta charset="UTF-8">
<title>Ajout d'une activité</title>	
<link rel="stylesheet" href="../css/utilities.css" type="text/css" />
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
		<select name="theme" id="theme">
		<?php 
			choixTheme($bdd);
		?>
		</select>
		</br>	</br>
		<label for="activite">Activité :</label>
		<select name="activite" id="activite">
		<?php 
			$sql = 'SELECT ACT_LIBELLE FROM ACTIVITE';
			creerListe($bdd,$sql,'ACT_LIBELLE', 'activite');
		?>
		</select>
		</br>	</br>
		<label for="classe_age">Classe d'age :</label>
		<select name="classe_age" id="classe_age">
		<?php 
			choixClasseAge($bdd);
		?>
		</select>
		</br>	</br>
		<label for="frequence">Frequence :</label>
		
		<?php 
			choixFrequence($bdd);
		?>
		
		</br>	</br>
		<label for="nbFois">Nombre de fois : </label>
		<input type="number" id="nbFois" name="nbFois"  min="1" max="1000" value=<?php verifierRempli("nbFois"); ?> >
		</br>	</br>
		<label for="nbHeure">Heure(s) : </label>
		<input type="number" id="nbHeure" name="nbHeure"  min="0" value=<?php verifierRempli("nbHeure"); ?> >
		<label for="nbMinutes">Minute(s) : </label>
		<input type="number" id="nbMinutes" name="nbMinutes"  min="0" max="59" value=<?php verifierRempli("nbMinutes"); ?> >
		</br>	</br>
		<input type="submit" id="btn" name="ajouter" value="envoyer">
	</form>
</body>
</html>