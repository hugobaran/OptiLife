<?php
	include("../php/connexionBDD.php");
	include("../php/optiManuelleFonction.php");
?>

<html>
	<head>
		<meta charset="UTF-8"/>
		<script type="text/javascript" src="../js/jquery.chained.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/formulaireOptiManuelle.css">
	</head>
	<body>
		<form method="post" action= "../php/passerelle.php" enctype="application/x-www-form-urlencoded" name="optimiserActivite">

			<label>Activité :</label><p id="affichageActiviteOpti"></p>
			<input name="pratiqueOpti" id="pratiqueOpti" type="hidden" value=""/>

			<select name="activiteO" id="activiteO" style="visibility:hidden; width: 0; height: 0;">
				<option value=""></option>
				<?php 
					$sql = 'SELECT * FROM activite';
					creerListeActivites($bdd,$sql);
				?>
			</select>

			</br>
			<label>Classe d'age :</label><p id="affichageClasseAgeOpti"></p	>
			<input name="classe_age" id="classe_age" type="hidden"/>
			</br>

		    <div class="section">
		      	<label>Temps Initial:</label><p id="affichageTemps"></p>
				<input name="temps" id="temps" type="number" style="visibility:hidden;" value=""/>
		    </div>
		    <div class="section">
		     	<label>Temps Gagné :</label><p id="affichageTempsGagne"></p>
				<input name="tempsGagne" id="tempsGagne" type="number" style="visibility:hidden;" value=""/>
		    </div>
		    <div class="section">
		     	<label>Temps Final :</label><p id="affichageTempsOpti"></p>
				<input name="tempsOpti" id="tempsOpti" type="number" style="visibility:hidden;" value=""/>
		    </div>

			<label for="Opti">Gagner encore plus de temps :</label>
			<select name="Optimisation" id="Optimisation" class="form-control" data-show-subtext="true" onchange="listeOptiAjout();">
				<option data-type="null" data-subtext="0" value="">Selectionner une méthode d'optimisation</option>
				<?php  
					$sql = 'SELECT * FROM optimiser JOIN optimisations using(OPTI_NUM)';
					creerListeOptimisations($bdd,$sql);
				?>
			</select>

			<ul id="liste"></ul>

			</br>
			<input type="submit" disabled="disabled" class="btn btn-primary btn-lg btn-block" id="optimiserManuellement" name="optimiserManuellement" value="Optimiser">
		</form>
	</body>


	<script type="text/javascript">

	$(function(){
	    $("#Optimisation").chained("#activiteO");
	});


	function MAJTemps(){

		var cpt = 0;
		$("#tempsGagne").val(0);
		$("#tempsOpti").val($("#temps"));
		$("#affichageTempsGagne").text(0 + " minutes(s)");
		$("#affichageTempsOpti").text($("#temps").val() + " minutes(s)");


		$("li" ).each(function() {

			if(cpt!=0){
				var liType = $(this).attr('data-type');
				var liGagne = parseInt($(this).attr('data-subtext'),10);
				var tpsInitVal = parseInt($("#temps").val(),10);
				var tpsGagneVal = parseInt($("#tempsGagne").val(),10);
				var gagne = 0;

				if(liType = "temps"){
					gagne = tpsGagneVal + liGagne;
				}else if(liType = "pourcentage"){
					gagne = tpsGagneVal + liGagne;
				}else{
					gagne = tpsGagneVal;
				}

				alert("kek");

				var tpsFinal = tpsInitVal - gagne;

				$("#tempsGagne").val(gagne);
				$("#tempsOpti").val(tpsFinal);
				$("#affichageTempsGagne").text(gagne + " minutes(s)");
				$("#affichageTempsOpti").text(tpsFinal + " minutes(s)");
			}
			alert(cpt);
			cpt++;

		});

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


	function listeOptiEnlever(li){
		 $(li).remove();
		 MAJTemps();
	}


	function listeOptiAjout()
    {
      var ul = $("#liste");
      var select = $("#Optimisation");
      var optiName = $('#Optimisation option:selected').attr('data-name');
      var optiVal = $('#Optimisation option:selected').attr('data-subtext');
      var optiType = $('#Optimisation option:selected').attr('data-type');

      if (select.val() != "" && ul.find('input[value=' + select.val() + ']').length == 0)
        ul.append('<li id="listeOpti" data-name="'+optiName+'" data-subtext="'+optiVal+'" data-type="'+optiType+'" onclick="listeOptiEnlever(this);">' +
          '<input type="hidden" name="optimisation[]" value="' + 
          select.val() + '" /> <img id="imgSupp" src="../img/supprimer.png" />' +
          optiName + '</li>');

      MAJTemps();
    }

	</script>


</html>