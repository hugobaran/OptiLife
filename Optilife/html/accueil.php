<?php session_start(); ?>

<?php include("../php/genererSession.php"); ?>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>OptiLife</title>
		
		<link rel="stylesheet" href="../css/utilities.css" type="text/css" />
	

	</head>
	<body>

		<div class="demo">
			<?php include("header.php"); ?>
	
			<div class="boutonsGroup">
				<?php
					if(!isset($_SESSION["EMP_NUM"]))
						echo '<input class="bouton" type=button value="Commencer une nouvelle optimisation" onclick="document.location.href=\'creationEDT.php\'"/>';
					else{
						echo '<input class="bouton" type=button value="Continuer l\'optimisation actuelle" onclick="document.location.href=\'main.php\'"/>';
						echo '<input class="bouton" type=button value="Commencer une nouvelle optimisation" onclick="document.location.href=\'creationEDT.php\'"/>';
						if(isset($_SESSION["usrPseudo"])){
							echo '<input class="bouton" type=button value="Charger une optimisation" onclick="document.location.href=\'charger.php\'"/>';
						}
					}
				?>
			</div>
			<br/>
	 		<div class="container">
				<ul class="nav nav-pills nav-justified red">
					<li class="active"><a data-toggle="tab" href="#presentation">Présentation</a></li>
					<li><a data-toggle="tab" href="#tuto">Tutoriel</a></li>
				</ul>

				<div class="tab-content">
					<div id="presentation" class="tab-pane fade in active">
						<h3>Presentation d'Opti-Life</h3>
						<p>Aatchi&Aatchi est fier de vous présenter OPTI-LIFE, l'application vous permettant de gagner du temps dans votre vie.</p>
						<p>L'application va vous permettre de créer et personnaliser votre emploi du temps en le remplissant d'activités que vous réalisez dans votre vie.
						Ensuite Opti-Life vous assistera pour vous permettre de trouvez des manières de gagner du temps dans vos pratique tout au long de votre vie.</p>
						<p>Vous pouvez suivre en temps réel vos résultats d'optimisation de votre emploi du temps afin de vous rendre compte de comment vous pouvez gagner du temps dans votre vie.
						<p>Laissez vous donc tenter par Opti-Life, et découvrez divers manières de gagner du temps au quotidien ! </p>
					</div>
					<div id="tuto" class="tab-pane fade">
						<h3>Tutoriel d'utilisation</h3>
						<p></p>
					</div> 
				</div>
			</div>
		</div>
	
		<?php include("footer.html"); ?>
		
	</body>
</html>