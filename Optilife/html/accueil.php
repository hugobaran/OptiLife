<html>
	<head>
		<meta charset="UTF-8"/>
		<title>OptiLife</title>
		<link rel="stylesheet"  href="../css/accueil.css" type="text/CSS"/>
		<link rel="stylesheet" href="../css/utilities.css" type="text/css" />
		<!--<link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css" />-->
	

	</head>
	<body>

	<div class="page"> <!--debut page-->
    	<div class="contenu">

			<?php include("header.html"); ?>
		
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


			<div class="boutongroup">
				<input class="bouton" type=button value="Commencer un projet" onclick="document.location.href='edt.php'"/>
				<?php include("connectacc.php"); ?>
			</div>
	</div>

	<?php include("footer.html"); ?>
	</div>
	</table>
	</body>
</html>