<?php session_start(); ?>

<?php include("../php/genererSession.php"); ?>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>OptiLife</title>
		<link rel="stylesheet"  href="../css/accueil.css" type="text/CSS"/>
		<link rel="stylesheet" href="../css/utilities.css" type="text/css" />
		<!--<link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css" />-->
	

	</head>
	<body>

		<?php include("header.php"); ?>
		
		<div class="boutonsGroup">
			<input class="bouton" type=button value="Commencer un projet" onclick="document.location.href='../php/genererSession.php'"/>
		</div>
		
 		<div class="container">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#presentation">Home</a></li>
				<li><a data-toggle="tab" href="#tuto">tutoriel</a></li>
			</ul>

			<div class="tab-content">
				<div id="presentation" class="tab-pane fade in active">
					<h3>Presentation</h3>
					<p>Presentation</p>
				</div>
				<div id="tuto" class="tab-pane fade">
					<h3>Tutoriel</h3>
					<p>Tutoriel</p>
				</div> 
			</div>
		</div>
	
		<?php include("footer.html"); ?>
		
	</body>
</html>