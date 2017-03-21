<?php session_start(); 
if(isset($_SESSION["EMP_NUM"])){
	header("location: ../html/main.php");
}
?>

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

			<h1 id="titreFormEDT">Personnalisez votre emploi du temps</h1>
			<hr width="100%">
			<form action="../php/creationEDT.php" method="post" id="formCreationEDT">
				<label>Quel est votre sexe ?</label></br>
				<label class="radio-inline">
			      <input type="radio" name="sexe">Homme
			    </label>
			    <label class="radio-inline">
			      <input type="radio" name="sexe">Femme
			    </label>
			    <label class="radio-inline">
			      <input type="radio" name="sexe">Autre
			    </label>
			    <br/><br/>
				<label for="age">Quel age avez vous ?</label>
				<input type="number" class="form-control" name="age" id="age" min="0" max="130">
				<br/>
				<label for="classeAgeEDT">Souhaitez vous commencer dans une classe d'age précise ?</label>
				<select name="classeAgeEDT" id="classeAgeEDT" class="form-control">
					<option id="optionCAEDT" value="0">Laisser l'application choisir</option>
					<option id="optionCAEDT" value="1">Etudes</option>
					<option id="optionCAEDT" value="2">Vie active</option>
					<option id="optionCAEDT" value="3">Retraite</option>
				</select>
				<br/><br/>
		    	<button type="submit" class="btn btn-success btn-lg btn-block" name="creationEDTSubmit" id="creationEDTSubmit">Créer un emploi du temps</button>
			</form>
	
		</div>
	
		<?php include("footer.html"); ?>
		
	</body>
</html>