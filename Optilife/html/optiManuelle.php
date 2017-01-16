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
			<input name="pratiqueOpti" id="pratiqueOpti" type="hidden" value=""/>
			</br>
			<label>Classe d'age :</label><p id="affichageClasseAgeOpti"></p	>
			<input name="classe_age" id="classe_age" type="hidden"/>

			<table>
				<td>
					<label>Temps Initual:</label><p id="affichageTemps"></p>
					<input name="temps" id="temps" type="number" style="visibility:hidden;" value=""/>
				</td>
				<td>
					<label>Temps Final :</label><p id="affichageTempsOpti"></p>
					<input name="tempsOpti" id="tempsOpti" type="number" style="visibility:hidden;" value=""/>
				</td>
			</table>
			<select name="activiteO" id="activiteO" style="visibility:hidden;">
				<option value=""></option>
				<?php 
					$sql = 'SELECT * FROM activite';
					creerListeActivites($bdd,$sql);
				?>
			</select>
			<label for="Opti">Opti :</label>
			<select name="Optimisation" id="Optimisation" class="form-control" onchange="majFormulaire();">
				<option data-type="null" data-value="0" value="">Sélectionner une Opti</option>
				<?php  
					$sql = 'SELECT * FROM optimiser JOIN optimisations using(OPTI_NUM)';
					creerListeOptimisations($bdd,$sql);
				?>
			</select>
			</br>
			<input type="submit" disabled="disabled" class="btn btn-primary btn-lg btn-block" id="optimiserManuellement" name="optimiserManuellement" value="Optimiser">
		</form>
	</body>

	<script type="text/javascript">

	$(function(){
	    $("#Optimisation").chained("#activiteO");
	});


	function majFormulaire(){

		var typeDonnee = $('#Optimisation option:selected').attr('data-type');
		var gagne = $('#Optimisation option:selected').attr('data-value');
		var tpsInitial = $('#tempsOpti').val();
		if(typeDonnee == "temps"){
			var tpsFinal = tpsInitial - gagne;
		}else if(typeDonnee == "pourcentage"){
			var tpsFinal = tpsInitial - (tpsInitial*gagne);
		}else{
			var tpsFinal = tpsInitial;
		}
		$('#affichageTempsOpti').text(tpsFinal + " minutes");

		var opti=false;

		if(document.getElementById('Optimisation').value!=''){
			opti = true;
		}
		
		if (opti){
			document.getElementById('optimiserManuellement').title='';
			document.getElementById('optimiserManuellement').disabled='';
		} else {
			document.getElementById('optimiserManuellement').title='Selectionnez une optimisation';
			document.getElementById('optimiserManuellement').disabled='disabled';
		}
    	
	}

	</script>


</html>