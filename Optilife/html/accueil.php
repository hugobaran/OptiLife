<?php session_start();?>

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
				<input class="bouton" type=button value="Commencer un projet" onclick="document.location.href='main.php'"/>
				
			</div>
		
 			<div class="acc">
				<section id="optiacc" class="demoTime">
					<div id="demoWrap">
						<div id="present">
							<div id="tuto">
								<div id="background">
									<ul>
	                        			<li><a href="#present"><span>Présentation</span></a></li>
	                        			<li><a href="#tuto"><span>Tutoriel</span></a></li>
	                            	</ul>
	                    			<div id="fleche"></div>
									<div id="textes">
	                        			<p>Plus qu'a mettre la présentation</p>
								
	                        			<p>Mettre le tutoriel</p>
	                           		</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

	
		<?php include("footer.html"); ?>
		
	</body>
</html>