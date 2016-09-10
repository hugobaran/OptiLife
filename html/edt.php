<html>
  <head>
  		<meta charset="UTF-8"/>
  		<title>Emploi du temps</title>
		<link rel="stylesheet" href="../css/ajouter.css" type="text/css" />
  </head>
  <body>
	<?php include('header.html') ?>
	<div class="vie">
		<table class="representation">
			<td  class="sectionvie">Etudiant</td>
			<td class="sectionvie">Actif</td>
			<td class="sectionvie">Retraite</td>
		</table>
	</div>
	<div class="boutons">
		<input type="button" value="Ajouter" onclick="document.location.href='ajouter.php'"/>
		<input type="button" value="Modifier" onclick="document.location.href='modifier.php'"/>
		<input type="button" value="Supprimer" onclick="alert('Activité supprimée');"/>
	</div>
	<?php include('footer.html') ?>
  </body>
</html>