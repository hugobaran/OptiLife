<html>
  <head>
  		<meta charset="UTF-8"/>
  		<title>Emploi du temps</title>
  		 <script type="text/javascript">
                function change_onglet(name)
                {
                        document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
                        document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
                        document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
                        document.getElementById('contenu_onglet_'+name).style.display = 'block';
                        anc_onglet = name;
                }
        </script>
		<link rel="stylesheet" href="../css/edt.css" type="text/css" />
		<link rel="stylesheet" href="../css/utilities.css" type="text/css" />
  </head>
  <body>
	<?php include('header.html') ?>
	 <div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet_0 onglet" id="onglet_etudiant" onclick="javascript:change_onglet('etudiant');">Etudiant</span>
            <span class="onglet_0 onglet" id="onglet_actif" onclick="javascript:change_onglet('actif');">Actif</span>
            <span class="onglet_0 onglet" id="onglet_retraite" onclick="javascript:change_onglet('retraite');">Retraite</span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_etudiant">
                <h1>Liste d'activité de la class d'age : Etudiant</h1>
            </div>
            <div class="contenu_onglet" id="contenu_onglet_actif">
                <h1>Liste d'activité de la class d'age : Actif</h1>
            </div>
            <div class="contenu_onglet" id="contenu_onglet_retraite">
                <h1>Liste d'activité de la class d'age : Retraité</h1>
        </div>
    </div>
    <script type="text/javascript">
                var anc_onglet = 'etudiant';
                change_onglet(anc_onglet);
    </script>
	<div class="boutons">
		<input type="button" value="Ajouter" id="btn" onclick="document.location.href='ajouter.php'"/>
		<input type="button" value="Modifier" id="btn" onclick="document.location.href='modifier.php'"/>
		<input type="button" value="Supprimer" id="btn" onclick="alert('Activité supprimée');"/>
	</div>
	<?php include('footer.html') ?>
  </body>
</html>

