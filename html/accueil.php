<html>
	<head>
		<meta charset="UTF-8"/>
		<title>OptiLife</title>
		<link rel="stylesheet"  href="../css/accueil.css" type="text/CSS"/>
	

	</head>
	<body>
	
		<?php include("header.html"); ?>
		<div class="presenter">
			<p>OptiLife est un site de gestion d'emploi du temps et d'optimisation de son temps.</p>
		</div>
		<div class="acc">
			<table class="tabacc" border=1px><tr><td id="tutoriel">TUTORIEL</td><td id="explication">PROJET OptiLife</td></tr> </table>
			<input id="btn" type=button value="Commencer un projet" onclick="document.location.href='edt.php'"/>
		
			<?php include("connectacc.php"); ?>
		
		</div>
		<?php include("footer.html"); ?>
	</table>
	</body>
</html>