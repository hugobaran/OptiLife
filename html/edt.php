<html>
  <head>
        <meta charset="UTF-8"/>
        <title>Emploi du temps</title>
         <script type="text/javascript">
                function change_onglet(name)
                {      
                        document.getElementById('onglet_etudiant').style.display='none';
                        document.getElementById('onglet_actif').style.display='none';
                        document.getElementById('onglet_retraite').style.display='none';
                        document.getElementById('contenu_onglet_'+name).style.display = 'block';
                        anc_onglet = name;
                }

                function afficher_onglet(){
                    document.getElementById('onglet_etudiant').style.display='inline-block';
                    document.getElementById('onglet_actif').style.display='inline-block';
                    document.getElementById('onglet_retraite').style.display='inline-block';
                    document.getElementById('contenu_onglet_etudiant').style.display = 'none';
                    document.getElementById('contenu_onglet_actif').style.display = 'none';
                    document.getElementById('contenu_onglet_retraite').style.display = 'none';
                }
        </script>
        <link rel="stylesheet" href="../css/edt.css" type="text/css" />
        <link rel="stylesheet" href="../css/utilities.css" type="text/css" />
  </head>
  <body>
     <?php include('header.html') ?>
     <div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet" id="onglet_etudiant" onclick="javascript:change_onglet('etudiant');">Etudiant</span>
            <span class="onglet" id="onglet_actif" onclick="javascript:change_onglet('actif');">Actif</span>
            <span class="onglet" id="onglet_retraite" onclick="javascript:change_onglet('retraite');">Retraite</span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_etudiant">
                <img src="../img/retour.gif" class="retour" onclick="javascript:afficher_onglet();"/>
                <h1>Liste d'activité de la classe d'age : Etudiant</h1>
            </div>
            <div class="contenu_onglet" id="contenu_onglet_actif">
               <img src="../img/retour.gif" class="retour" onclick="javascript:afficher_onglet();"/>
                <h1>Liste d'activité de la classe d'age : Actif</h1>
            </div>
            <div  class="contenu_onglet" id="contenu_onglet_retraite">
                <img src="../img/retour.gif" class="retour" onclick="javascript:afficher_onglet();"/>
                <h1>Liste d'activité de la classe d'age : Retraité</h1>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        afficher_onglet();
    </script>
    <div class="boutons">
        <input type="button" value="Ajouter" id="btn" onclick="document.location.href='ajouter.php'"/>
        <input type="button" value="Modifier" id="btn" onclick="document.location.href='modifier.php'"/>
        <input type="button" value="Supprimer" id="btn" onclick="alert('Activité supprimée');"/>
    </div>
  </body>
  <?php include('footer.html') ?>
</html>