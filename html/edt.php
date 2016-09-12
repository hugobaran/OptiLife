<html>
  <head>
  		<meta charset="UTF-8"/>
  		<title>Emploi du temps</title>
		<link rel="stylesheet" href="../css/edt.css" type="text/css" />
  </head>
  <body>
	<?php include('header.html') ?>
	<div class="vie">
		<table class="representation">
			<td  class="sectionvie"><a href="#etudiant">Etudiant</a></td>
			<td class="sectionvie"><a href="#actif">Actif</a></td>
			<td class="sectionvie"><a href="#retraite">Retraite</a></td>
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