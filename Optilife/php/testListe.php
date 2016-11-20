<?php include('connexionBDD.php');

function Afficher($obj)
{
	echo "<pre><hr/>";
	print_r($obj);
	echo "</pre><hr/>";
}
?>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.chained.min.js"></script>

<form method="post">
<select name="region" id="region">
<option value="">Sélectionner une région</option>
<?php
// Appel des regions
$sql = "SELECT id, nom FROM liste_regions ORDER BY id";
$reponse = $bdd->query($sql);
Afficher($reponse);
	while ($donnees = $reponse->fetch())
	{
		$valeur = $donnees['id'];
		$lib = $donnees['nom'];
		echo $lib;
		echo "<option value='" . $valeur . "'>" .$lib . "</option>";
	}
	$reponse->closeCursor();
?>
</select>
<select name="departement" id="departement">
<option value="">Sélectionner un département</option>
<?php
// Appel des departements
$sql = "SELECT id, id_region, nom FROM liste_departements ORDER BY id";
$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$valeur = $donnees['id_region'];
		$lib = $donnees['nom'];
		echo "<option value=".$donnees['id']." class=".$donnees['id_region'].">".$donnees['nom']."</option>";
	}
	$reponse->closeCursor();
?>
</select>
</form>

<script type="text/javascript">$(function(){
    $("#departement").chained("#region");
});
</script>