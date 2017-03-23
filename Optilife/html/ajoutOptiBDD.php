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

        <link rel="stylesheet" href="../css/bootstrap.min.css"/>


        <!-- JS -->

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap/bootstrap.min.js"></script>
   
        <script type="text/javascript" src="../../Js/jquery.corner.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


</head> 

<body>
	<form method="post" action= "" enctype="application/x-www-form-urlencoded" name="ajout" id="ajout">
		<label for="activite">Activité :</label>
		<select name="activite" id="activite" class="form-control selectKek" >
		<option value="">Sélectionner une activité</option>
		<?php  
			$sql = 'SELECT * FROM activite order by ACT_NUM';
			creerListeActivite($bdd,$sql,'ACT_LIBELLE', 'activite');
		?>
		</select>
		</br></br>
		<label for="opti">Opti :</label>
		<select name="opti" id="opti" class="form-control selectKek" >
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

	<script type="text/javascript">
		$(document).ready(function() {
  $(".selectKek").select2();
});
	</script>

</html>