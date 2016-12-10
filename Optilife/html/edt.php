<html lang="fr">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>edt</title>
        <!--integration CSS-->
        <link rel="stylesheet" href="../css/edt.css" type="text/css" />
  </head>

  <body onload="preparer();">
        <?php include('../php/notifications.php')  ?>
        <?php 
          require_once('../php/afficherTempsOpti.php');
          afficherTempsOpti($bdd); 
        ?>

        <form  class="boutonsGroup" method="post" action= "../php/optiAuto.php" enctype="application/x-www-form-urlencoded" name="optimiser">
          <input type="submit" class="bouton" value="Optimiser" name="optimiser" id="optimiser"/>
        </form>

        <?php include('../php/tableauVie.php') ?>

        <?php include('Modals.php') ?>

      <div class="boutonsGroup"> <!--debut boutons-->
        <button type="button" class="bouton" id="btnAdd" href="#ajouter">Ajouter</button>
        <button type="button" class="bouton"" id="btnModif" href="#modifier" disabled>Modifier</button>
        <button type="button" class="bouton" id="btnSupp" href="#supprimer" disabled>Supprimer</button>
      </div> <!--fin boutons-->
  </body>

  <script type="text/javascript">
    $("#notif").fadeTo(2000, 500).slideUp(500, function(){
      $("#notif").slideUp(500);
  });
  </script>
  <script type="text/javascript" src="../js/edt.js"></script>
  <script type="text/javascript" src="../js/tableauVie.js"></script>

</html>