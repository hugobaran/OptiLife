<?php include('connexionBDD.php');?>

<!DOCTYPE html>
<html>
 <head>
<meta charset="UTF-8">
<title>Ajout d'une activité</title>	
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.chained.min.js"></script>
<link rel="stylesheet" href="../css/formulaire.css" type="text/css" />
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

<form method="post">
<select name="region" id="theme">
<option value="">Sélectionnez un thème</option>
<?php
// Appel des regions
$sql = "SELECT THM_LIBELLE FROM THEME ORDER BY THM_NUM";
$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$lib = utf8_encode($donnees['THM_LIBELLE']);
		echo "<option value='" . $lib . "'>" .$lib . "</option>";
	}
	$reponse->closeCursor();
?>
</select>
<select name="departement" id="activite">
<option value="">Sélectionnez une activité</option>
<?php
// Appel des departements
$sql = "SELECT THM_NUM, THM_LIBELLE, ACT_LIBELLE FROM THEME JOIN ACTIVITE USING(THM_NUM)";
$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$valeur = utf8_encode($donnees['THM_LIBELLE']);
		$lib = utf8_encode($donnees['ACT_LIBELLE']);
		echo "<option value=".$lib." class=".$valeur.">".$lib."</option>";
	}
	$reponse->closeCursor();
?>
</select>
</form>

<script type="text/javascript">$(function(){
    $("#activite").chained("#theme");
});
</script>

</body>
</html>