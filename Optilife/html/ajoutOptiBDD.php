<?php
	include("../php/connexionBDD.php");

function creerListeActivite($bdd,$sql,$table, $form){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$actLib = utf8_encode($donnees['ACT_LIBELLE']);
		$act = $donnees['ACT_NUM'];
		echo '<option value="' . $act . '" ' ;
		echo  ' >' . $act . ' | ' .$actLib . '</option>';

	}
	$reponse->closeCursor();
}


function creerListeOpti($bdd,$sql){
	$reponse = $bdd->query($sql);
	while ($donnees = $reponse->fetch())
	{
		$lib = utf8_encode($donnees['OPTI_LIBELLE']);
		$num = $donnees['OPTI_NUM'];
		echo '<option value="' . $num . '" ' ;
		echo  ' >'.$lib . '</option>';

	}
	$reponse->closeCursor();
}



if(isset($_POST['ajouter'])){
	if(!empty($_POST["activite"]) && !empty($_POST["opti"]) && (isset($_POST["tps"]) || isset($_POST["prc"]) ) ) {
		$act = $_POST["activite"];
		$opti = $_POST["opti"];
		if(!empty($_POST["tps"])){
			$tps = $_POST["tps"];
			$sql = "INSERT INTO `optimiser` (`ACT_NUM`, `OPTI_NUM`, `OP_TPS_GAGNE`) VALUES ('".$act."', '".$opti."', '".$tps."')";
			$stmt = $bdd->exec($sql);
		}else {
			$prc = $_POST["prc"];
			$sql = "INSERT INTO `optimiser` (`ACT_NUM`, `OPTI_NUM`, `OP_POURCENTAGE`) VALUES ('".$act."', '".$opti."', '".$prc."')";
			$stmt = $bdd->exec($sql);
		}
		echo $sql;
		echo 'AJOUTE ! ';
					
	}
}

?>
<!DOCTYPE html>
<html>
 <head>
<meta charset="UTF-8">
<title>Ajout Oppott</title>	

</head> 

<body>
	<form method="post" action= "" enctype="application/x-www-form-urlencoded" name="ajout" id="ajout">
		<label for="activite">Activité :</label>
		<select name="activite" id="activite" class="form-control">
		<option value="">Sélectionner une activité</option>
		<?php  
			$sql = 'SELECT * FROM activite order by ACT_NUM';
			creerListeActivite($bdd,$sql,'ACT_LIBELLE', 'activite');
		?>
		</select>
		</br></br>
		<label for="opti">Opti :</label>
		<select name="opti" id="opti" class="form-control">
		<?php  
			$sql = 'SELECT * FROM optimisations order by OPTI_LIBELLE';
			creerListeOpti($bdd,$sql);
		?>
		</select>
		</br></br>
		<label for="tps">tps </label>
		<input type="number" class="form-control" step="any" id="tps" name="tps" >
		</br></br>
		<label for="prc">prc </label>
		<input type="number" class="form-control" step="any" id="prc" name="prc" >
		</br></br>
		<input type="submit" id="ajouter" name="ajouter" value="Ajouter">
	</form>

</html>