<?php
	include("../php/connexionBDD.php");
	include("../php/optiManuelleFonction.php");
?>

<html>
	<head>
		<meta charset="UTF-8"/>
		<script type="text/javascript" src="../js/jquery.chained.min.js"></script>
		<script type="text/javascript" src="../js/jquery.steps.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-select.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/formulaireOptiManuelle.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.min.css">
	</head>
	<body>
		<form method="post" action= "../php/passerelle.php" enctype="application/x-www-form-urlencoded" name="optimiserActivite" id="optimiserActivite" novalidate>

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
					<input name="temps" id="temps" type="number" style="visibility:hidden; height: 0px" value=""/>
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
				<select name="Optimisation" id="Optimisation" class="form-control " onchange="listeOptiAjout();">
					<option data-type="null" data-subtext="0" value="">Selectionner une méthode d'optimisation</option>
					<?php  
						$sql = 'SELECT * FROM optimiser JOIN optimisations using(OPTI_NUM) where (OPTI_NUM, ACT_NUM, OP_TPS_GAGNE, OP_POURCENTAGE, OPTI_LIBELLE) not in( SELECT OPTI_NUM, pratiquer.ACT_NUM, OP_TPS_GAGNE, OP_POURCENTAGE, OPTI_LIBELLE FROM est_optimise JOIN optimisations using(OPTI_NUM) join optimiser USING(OPTI_NUM) join pratiquer USING(PRA_NUM) WHERE pratiquer.ACT_NUM = optimiser.ACT_NUM AND pratiquer.EMP_NUM = ' .$_SESSION["EMP_NUM"] .')';
						creerListeOptimisations($bdd,$sql);
					?>
				</select>

				<ul id="liste"></ul>

				<select name="Optimisation2" id="Optimisation2" class="form-control" style="display:none;" onchange="//MAJListe();">
					<?php  
						$sql = "SELECT OPTI_NUM, pratiquer.ACT_NUM, OP_TPS_GAGNE, OP_POURCENTAGE, OPTI_LIBELLE FROM est_optimise JOIN optimisations using(OPTI_NUM) join optimiser USING(OPTI_NUM) join pratiquer USING(PRA_NUM) WHERE pratiquer.ACT_NUM = optimiser.ACT_NUM AND est_optimise.EMP_NUM = " . $_SESSION["EMP_NUM"];
						creerListeOptimisations($bdd,$sql);
					?>
				</select>

				</br>
				<input type="submit" class="btn btn-primary btn-lg btn-block" id="optimiserManuellement" name="optimiserManuellement" value="Optimiser">
		</form>
	</body>


	<script type="text/javascript">

	$(function(){
	    $("#Optimisation").chained("#activiteO");
	    $("#Optimisation2").chained("#activiteO");
	    MAJListe();
	});

	function MAJListe(){

		resetListe();

		var ul = $("#liste");

		$('#Optimisation').prop('disabled', false);

		$("#Optimisation2 option").each(function(){
   			var optiName = $(this).attr('data-name');
      		var optiVal = $(this).attr('data-subtext');
      		var optiType = $(this).attr('data-type');
      		
      		if (ul.find('input[value=' + $(this).val() + ']').length == 0){
	      		ul.append('<li id="listeOpti" data-name="'+optiName+'" data-subtext="'+optiVal+'" data-type="'+optiType+'" onclick="listeOptiEnlever(this);">' +
	          		'<input type="hidden" name="optimisation[]" value="' + 
	          		$(this).val() + '" /> <img id="imgSupp" src="../img/supprimer.png" />' +
	          		optiName + '</li>');
      		}

		});
		MAJTemps();
	}

	function resetListe(){
		$("#listeOpti" ).each(function() {
			$(this).remove();
		});
	}

	function MAJTemps(){

		var cpt = 0;
		$("#tempsGagne").val(0);
		$("#tempsOpti").val($("#temps").val());
		$("#affichageTempsGagne").text(formaterTemps(0));
		$("#affichageTempsOpti").text(formaterTemps($("#temps").val()));


		$("#Optimisation2 option").each(function() {

			var liType = $(this).attr('data-type');
			var liGagne = parseFloat($(this).attr('data-subtext'),10);
			var tpsInitVal = parseFloat($("#temps").val(),10);
			var tpsPratiqueVal = parseFloat($("#tempsPratique").val(),10);
			var tpsGagneVal = parseFloat($("#tempsGagne").val(),10);
			var gagne = 0;

			if(liType == "temps"){
				gagne = tpsGagneVal + liGagne;
			}else if(liType == "pourcentage"){
				gagne = tpsGagneVal + (tpsInitVal*liGagne);
			}else{
				gagne = tpsGagneVal;
			}

			var tpsFinal = tpsInitVal - gagne;

			$("#tempsGagne").val(gagne);
			$("#tempsOpti").val(tpsFinal);
			$("#affichageTempsGagne").text(formaterTemps(gagne));
			$("#affichageTempsOpti").text(formaterTemps(tpsFinal));
			cpt++;
		});
			
    	
	}


	function listeOptiEnlever(li){

		var select = $('#Optimisation');
		var valeur = $(li).find('input').val();
		var option = $('#Optimisation2 option[value='+valeur+']');

		var optiName = option.attr('data-name');
	    var optiVal = option.attr('data-subtext');
	    var optiType = option.attr('data-type');
	    var optiAct = option.attr('class');
	    var optiNum = option.val();

     	if(optiType == "temps"){
     		var newOption = '<option data-name="'+optiName+'" data-type="temps" data-subtext="'+optiVal+'" class="'+optiAct+'" value="' +optiNum+ '">'+optiName+ ' | -' +optiVal;
      		newOption += ' MIN';
      	}else if(optiType == "pourcentage"){
      		var newOption = '<option data-name="'+optiName+'" data-type="pourcentage" data-subtext="'+optiVal+'" class="'+optiAct+'" value="' +optiNum+ '">'+optiName+ ' | -' +optiVal*100;
      		newOption += ' %';
     	}

		select.append(newOption);
		option.remove();
		$(li).remove();
		MAJListe();
	}


	function listeOptiAjout(){

	    var ul = $("#liste");
	    var select = $("#Optimisation2");
	    var option = $('#Optimisation option:selected');
	    var tpsOpti = $('#tempsOpti').val();

	    var optiName = option.attr('data-name');
	    var optiVal = option.attr('data-subtext');
	    var optiType = option.attr('data-type');
	    var optiAct = option.attr('class');
	    var optiNum = option.val();
	    var flag = false;

	    if(optiType != "null"){

	      if(optiType == "temps"){
	      	if(tpsOpti - optiVal >= 0){
	      		var newOption = '<option data-name="'+optiName+'" data-type="temps" data-subtext="'+optiVal+'" class="'+optiAct+'" value="' +optiNum+ '">'+optiName+ ' | -' +optiVal;
	      	    newOption += ' MIN';
	      	    flag = true;
	        }else{
	        	alert("Durée trop faible, supprimez des optimisations ou augmentez la durée de votre activité");
	        }
	      }else if(optiType == "pourcentage"){
	      	var newOption = '<option data-name="'+optiName+'" data-type="pourcentage" data-subtext="'+optiVal+'" class="'+optiAct+'" value="' +optiNum+ '">'+optiName+ ' | -' +optiVal;
	      	newOption += ' %';
	      	flag = true;
	      }
	      if(flag){
		      select.append(newOption);
		      option.remove();
		      MAJListe();
		   }
		}
    }

	</script>


</html>