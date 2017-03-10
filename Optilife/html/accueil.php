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
	
			<div class="boutonsGroup">
				<input class="bouton" type=button value="Commencer une nouvelle optimisation" onclick="document.location.href='../php/creationEDT.php'"/>
			</div>
			<br/>
	 		<div class="container">
				<ul class="nav nav-pills nav-justified red">
					<li class="active"><a data-toggle="tab" href="#presentation">Présentation</a></li>
					<li><a data-toggle="tab" href="#tuto">Tutoriel</a></li>
				</ul>

				<div class="tab-content">
					<div id="presentation" class="tab-pane fade in active">
						<h3>Presentation</h3>
						<p>OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie. OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.OPTI-LIFE c'est une application un peu bizarre pour optimiser sa vie.</p>
					</div>
					<div id="tuto" class="tab-pane fade">
						<h3>Tutoriel</h3>
						<p>Pour utiliser Opti-Life il faut un pc et une envie de suicide. Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide.Pour utiliser Opti-Life il faut un pc et une envie de suicide. </p>
					</div> 
				</div>
			</div>
		</div>
	
		<?php include("footer.html"); ?>
		
	</body>
</html>