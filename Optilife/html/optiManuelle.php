<?php
	include("../php/connexionBDD.php");
	include("../php/optiManuelleFonction.php");
?>
<html>
	<head>
		<meta charset="UTF-8"/>
		<script type="text/javascript" src="../js/jquery.chained.min.js"></script>
	</head>
	<body>
		<form method="post" action= "../php/passerelle.php" enctype="application/x-www-form-urlencoded" name="optimiserActivite">
			<label>Activité :</label><p id="affichageActiviteOpti"></p>
			</br>
			<label>Classe d'age :</label><p id="affichageClasseAgeOpti"></p>
			<input name="classe_age" id="classe_age" type="hidden" value=<?php if(isset($_POST["classe_age"])) echo '"'.$_POST["classe_age"].'"'; ?>/>
			</br>
			<label>Temps :</label><p id="affichageTemps"></p>
			<input name="temps" id="temps" type="number" style="visibility:hidden;" value=""/>
			</br>
			<label>Temps Opti :</label><p id="affichageTempsOpti"></p>
			<input name="tempsOpti" id="tempsOpti" type="number" style="visibility:hidden;" value=""/>
			<select name="activiteO" id="activiteO" style="visibility:hidden;">
				<option value=""></option>
				<?php 
					$sql = 'SELECT * FROM activite';
					creerListeActivites($bdd,$sql);
				?>
			</select>
			<label for="Opti">Opti :</label>
			<select name="Opti" id="Opti" class="form-control" onchange="majTemps();">
				<option data-type="null" data-value="0" value="">Sélectionner une Opti</option>
				<?php  
					$sql = 'SELECT * FROM optimiser JOIN optimisations using(OPTI_NUM)';
					creerListeOptimisations($bdd,$sql);
				?>
			</select>
			</br>
			<input type="submit" class="btn btn-primary btn-lg btn-block" id="btn" name="optimiser" value="Optimiser">
		</form>
	</body>

	<script type="text/javascript">

	$(function(){
	    $("#Opti").chained("#activiteO");
	});


	function majTemps(){
		var typeDonnee = $('#Opti option:selected').attr('data-type');
		var gagne = $('#Opti option:selected').attr('data-value');
		var tpsInitial = $('#tempsOpti').val();
		if(typeDonnee == "temps"){
			var tpsFinal = tpsInitial - gagne;
		}else if(typeDonnee == "pourcentage"){
			var tpsFinal = tpsInitial - (tpsInitial*gagne);
		}else{
			var tpsFinal = tpsInitial;
		}
		$('#affichageTempsOpti').text(tpsFinal + " MINUTES");
    	
	}

	</script>


</html>