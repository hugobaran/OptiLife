<?php
	include("../php/connexionBDD.php");
	include("../php/changerActiviteFonction.php");
?>
<!DOCTYPE html>
<html>
 <head>
<meta charset="UTF-8">
<title>Echange d'une activité</title>	

<script type="text/javascript" src="../js/formulaireAjout.js"></script>
<script type="text/javascript" src="../js/jquery.chained.min.js"></script>


</head> 

<body>
	<form method="post" action= "../php/passerelle.php" enctype="application/x-www-form-urlencoded" name="echangeActivite" id="formChange">
		<label>Activité Initiale :</label><p id="affichageActiviteChange"></p>
		<input name="pratiqueChange" id="pratiqueChange" type="hidden" value=""/>

		<select name="ChangerActNature" id="ChangerActNature" class="form-control" hidden>
		
		</select>

		<label for="activiteChange">Nouvelle activité :</label>
		<select name="activiteChange" id="activiteChange" class="form-control">
		<option value="" data-temps="null">Sélectionner une activité</option>
		<?php  
			$sql = 'SELECT * FROM activite JOIN sous_domaine USING(SD_NUM) JOIN nature USING(SD_NUM) WHERE nature.NAT_NUM = activite.NAT_NUM AND nature.SD_NUM = activite.SD_NUM';
			creerListeActiviteNature($bdd,$sql);
		?>
		</select>
		</br>
	</br>
		<input type="submit" disabled="disabled" class="btn btn-success btn-lg btn-block" id="ajouter" name="ajouter" value="Ajouter" title="Remplissez tous les champs">
	</form>
</body>

<script type="text/javascript">

$(function(){
    $("#activiteChanger").chained("#ChangerActNature");
});
</script>

</html>