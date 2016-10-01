<html>
  <head>
        <meta charset="UTF-8"/>
        <title>Emploi du temps</title>
        <script type="text/javascript" src="../js/tableauVie.js"></script>
        <link rel="stylesheet" href="../css/edt.css" type="text/css" />
        <link rel="stylesheet" href="../css/utilities.css" type="text/css" />
  </head>
  <body>
     <?php include('header.html') ?>
     <?php include('../php/tableauVie.php') ?>
    <div class="boutons">
        <input type="button" value="Ajouter" id="btn" onclick="document.location.href='ajouter.php'"/>
        <input type="button" value="Modifier" id="btn" onclick="document.location.href='modifier.php'"/>
        <input type="button" value="Supprimer" id="btn" onclick="alert('Activité supprimée');"/>
    </div>
  </body>
  <?php include('footer.html') ?>
</html>