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
</head> 
<header>
	<?php include("header.html"); ?>
</header>
<body>
	<form method="post" action= "<?php $_SERVER['PHP_SELF'] ?>" enctype="application/x-www-form-urlencoded" name="ajoutTache">
		<label for="theme">Theme :</label>
		<select name="theme" id="theme">
		<?php 
			$sql = 'SELECT THM_LIBELLE FROM THEME';
			creerListe($bdd,$sql,'THM_LIBELLE');
		?>
		</select>
		</br>	</br>
		<label for="theme">Activité :</label>
		<select name="activite" id="activite">
		<?php 
			$sql = 'SELECT ACT_LIBELLE FROM ACTIVITE';
			creerListe($bdd,$sql,'ACT_LIBELLE');
		?>
		</select>
		</br>	</br>
		<label for="theme">Classe d'age :</label>
		<select name="classe_age" id="classe_age">
		<?php 
			$sql = 'SELECT CAT_LIBELLE FROM CLASSE_D_AGE';
			creerListe($bdd,$sql,'CAT_LIBELLE');
		?>
		</select>
		</br>	</br>
		<label for="theme">Frequence :</label>
		<select name="frequence" id="frequence">
		<?php 
			$sql = 'SELECT FR_LIBELLE FROM FREQUENCE';
			creerListe($bdd,$sql,'FR_LIBELLE');
		?>
		</select>
		</br>	</br>
		<label for="nbFois">Nombre de fois : </label>
		<input type="number" id="nbFois" name="nbFois" value=<?php verifierRempli("nbFois"); ?> >
		</br>	</br>
		<label for="nbHeure">Heure(s) : </label>
		<input type="number" id="nbHeure" name="nbHeure" value=<?php verifierRempli("nbHeure"); ?> >
		</br>	</br>
		<label for="nbMinutes">Minute(s) : </label>
		<input type="number" id="nbMinutes" name="nbMinutes" value=<?php verifierRempli("nbMinutes"); ?> >
		</br>	</br>
		<input type="submit" id="envoyer" name="envoyer">
	</form>
</body>
<footer>
	<?php include("footer.html"); ?>
</footer>
</html>