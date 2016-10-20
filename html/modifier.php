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
			<input name="EXfrequence" id="EXfrequence" type="hidden" value=<?php if(isset($_POST["frequence"])) echo '"'.$_POST["frequence"].'"'; ?>/>

			<label for="activite">Activité :</label><?php if(isset($_POST["activite"])) echo $_POST["activite"]; ?>
			<input name="activite" id="activite" type="hidden" value=<?php if(isset($_POST["activite"])) echo '"'.$_POST["activite"].'"'; ?>/>
			</br>	</br>
			<label for="classe_age">Classe d'age :</label><?php if(isset($_POST["classe_age"])) echo $_POST["classe_age"]; ?>
			<input name="classe_age" id="classe_age" type="hidden" value=<?php if(isset($_POST["classe_age"])) echo '"'.$_POST["classe_age"].'"'; ?>/>
			</br>	</br>
			<label for="frequence">Frequence :</label>		
			<?php 
				choixFrequence($bdd);
			?>		
			</br>	</br>
			<label for="nbFois">Nombre de fois : </label>
			<input type="number" id="nbFois" name="nbFois"  min="1" max="1000" value=<?php verifierRempli("nbFois"); ?> />
			</br>	</br>
			<label for="nbHeure">Heure(s) : </label>
			<input type="number" id="nbHeure" name="nbHeure"  min="0" value=<?php verifierRempli("nbHeure"); ?> />
			<label for="nbMinutes">Minute(s) : </label>
			<input type="number" id="nbMinutes" name="nbMinutes"  min="1" max="59" value=<?php verifierRempli("nbMinutes"); ?> />
			</br>	</br>
			<input type="submit" id="btn" name="modifier" value="envoyer"/>
		</form>
	</body>
</html>


<?php

modifierTache($bdd);


?>