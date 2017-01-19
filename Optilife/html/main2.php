<?php  session_start();  ?>
<html lang="fr">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Emploi du temps</title>
  </head>

  <?php include('../php/fonctionsUtiles.php') ?>

  <body>

    <div id="header">
      <?php include('header.php') ?>
    </div>
    <div id="content">
      <?php include('edt.php') ?>
    </div>
    <div id="footer">
      <?php include('footer.html') ?>
    </div>

</body>


</html>