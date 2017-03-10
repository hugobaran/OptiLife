<?php
	include("../php/connexionBDD.php");
	include("../php/ajouterTache.php");
?>
<!DOCTYPE html>
<html>
 <head>
<meta charset="UTF-8">
<title>Ajout d'une activité</title>	

<script type="text/javascript" src="../js/formulaireAjout.js"></script>
<script type="text/javascript" src="../js/jquery.chained.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-toggle.min.js"></script>
<link href="../css/bootstrap-toggle.min.css" rel="stylesheet">



</head> 
<script>
	function resetFields(){
		document.getElementById('domaine').selectedIndex=0;
		document.getElementById('activite').selectedIndex=0;
		document.getElementById('classe_age').selectedIndex=0;
		document.getElementById('nbFois').value="";
		document.getElementById('nbHeure').value="";
		document.getElementById('nbMinutes').value="";
		document.getElementById('frequence').selectedIndex=0;//marche pas, faut trouver un truc qui selectionne un bouton radio
}

</script>
<body>
	<form method="post" action= "../php/passerelle.php" enctype="application/x-www-form-urlencoded" name="ajoutActivite" id="formAjout">
		<label for="domaine">Domaine :</label>
		<select name="domaine" id="domaine" class="form-control" onchange="affiche_bouton()">
		<option value="">Sélectionner un domaine</option>
		<?php 
			choixDomaine($bdd);
		?>
		</select>
		</br>
		<label for="sousdomaine">Sous Domaine :</label>
		<select name="sousdomaine" id="sousdomaine" class="form-control" onchange="affiche_bouton()">
		<option value="">Sélectionner un sous-domaine</option>
		<?php  
			$sql = 'SELECT * FROM sous_domaine JOIN domaine USING(DOM_NUM)';
			creerListeSousDomaine($bdd,$sql,'SD_LIBELLE');
		?>
		</select>
		</br>
		<label for="activite">Activité :</label>
		<select name="activite" id="activite" class="form-control" onchange="affiche_bouton();">
		<option value="" data-temps="null">Sélectionner une activité</option>
		<?php  
			$sql = 'SELECT * FROM activite JOIN sous_domaine USING(SD_NUM)';
			creerListeActivite($bdd,$sql,'ACT_LIBELLE', 'activite');
		?>
		</select>
		</br>

			<label>Classe d'age : </label></br>
			<label for="caEtudes" class="checkbox-inline"><input type="checkbox" id="caEtudes" name="classe_age[]" onclick="affiche_bouton()" value="1"/>Etudes</label>
		    <label for="caVieActive" class="checkbox-inline"><input type="checkbox" id="caVieActive" name="classe_age[]" onclick="affiche_bouton()" value="2"/>Vie Active </label>
		    <label for="caRetraite" class="checkbox-inline"><input type="checkbox" id="caRetraite" name="classe_age[]" onclick="affiche_bouton()" value="3"/>Retraite </label>
			<!--<label for="caVie">Toute la vie </label><input type="checkbox" id="caVie" name="classe_age[]" value="4"/>-->
			</br></br>
			<label>Frequence :</label></br>
			<?php 
				choixFrequence($bdd);
			?>

		
		</br>	</br>
		<div class="row">
			<div class="col-xs-3">
				<label for="nbFois">Nombre de fois : </label>
				<input type="number" class="form-control" id="nbFois" name="nbFois"  min="1" max="1000" onclick="affiche_bouton()" onchange="affiche_bouton()" value=<?php verifierRempli("nbFois"); ?> >
			</div>
			<div class="col-xs-3">
				<label for="TempsPerso">Durée : </label>
				<input id="TempsPerso" type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100" data-height="30"  data-on="Personnel" data-off="Défaut" onchange="  tempsPerso();">
			</div>
			<div class="col-xs-3">
				<label for="nbHeure">Heure(s) : </label>
				<input type="number" class="form-control" id="nbHeure" name="nbHeure"  min="0" onclick="affiche_bouton()" onchange="affiche_bouton()" value=<?php verifierRempli("nbHeure"); ?> >
			</div>
			<div class="col-xs-3">
				<label for="nbMinutes">Minute(s) : </label>
				<input type="number" class="form-control" id="nbMinutes" name="nbMinutes"  min="0" max="59" onclick="affiche_bouton()" onchange="affiche_bouton()" value=<?php verifierRempli("nbMinutes"); ?> >
			</div>
		</div>
		</br>	</br>
		<input type="submit" disabled="disabled" class="btn btn-success btn-lg btn-block" id="ajouter" name="ajouter" value="Ajouter" title="Remplissez tous les champs" onclick="envoi();">
	</form>
</body>

<script type="text/javascript">

$(function(){
    $("#sousdomaine").chained("#domaine");
});

$(function(){
    $("#activite").chained("#sousdomaine");
});

function MAJbutton(){
	var option = $('#activite option:selected');
	var temps = option.attr('data-temps');
	if(temps == 'null' || temps == 0){
		$('#TempsPerso').bootstrapToggle('on');
	  	$('#TempsPerso').bootstrapToggle('disable');
	}
	else
		$('#TempsPerso').bootstrapToggle('enable');
	tempsPerso();

}

function envoi(){
	$('#nbHeure').prop('disabled', false);
	$('#nbMinutes').prop('disabled', false);
}

function tempsPerso(){
	var option = $('#activite option:selected');
	var temps = option.attr('data-temps');
	$('#nbHeure').prop('disabled', false);
	$('#nbMinutes').prop('disabled', false);
	if(!$('#TempsPerso').is(':checked')){
	  	if(temps == 'null' || temps == 0){
	  		$('#nbHeure').val(0);
	  		$('#nbMinutes').val(0);
	  	}else{
	  		var heures = parseInt(temps/60,10);
		  	var minutes = parseInt(((temps/60)-heures)*60,10);
		  	$('#nbHeure').val(heures);
		  	$('#nbHeure').prop('disabled', true);
		  	$('#nbMinutes').val(minutes);
		  	$('#nbMinutes').prop('disabled', true);
	  	}
  	}
}

</script>

</html>