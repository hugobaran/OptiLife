<?php session_start(); ?>

<?php include("../php/genererSession.php"); ?>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>OptiLife</title>
		<link rel="stylesheet"  href="../css/accueil.css" type="text/CSS"/>
		<link rel="stylesheet" href="../css/utilities.css" type="text/css" />
	

	</head>
	<body>

		<div class="demo">
			<?php include("header.php"); ?>

			<h1 id="titreFormEDT">Liste des emplois du temps sauvegardés</h1>
			<hr width="100%">
			<?php 

				$sql = "SELECT * FROM emploidutemps WHERE USR_NUM_INSCRIT = " . $_SESSION["usrNum"] . " ORDER BY EMP_NUM DESC";
				$reponse = $bdd->query($sql);
        		if($reponse->rowCount() == 0){
        			echo "Aucun emploi du temps à charger";
        		}else{
        			$cpt = 1;
        			echo "<ol>";
        			while ($donnees = $reponse->fetch()){
        				echo "<li><a href='../php/chargerEDT.php?edt=".$donnees['EMP_NUM']."'>". $donnees['EMP_DATE'] ."</a></li>";
        			}
        			echo "</ol>";
        		}

			?>
	
		</div>
	
		<?php include("footer.html"); ?>
		
	</body>
</html>