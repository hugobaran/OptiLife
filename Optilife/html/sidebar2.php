<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Emploi du temps</title>
    
    <!-- Custom CSS -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/edt.css" type="text/css" />
    
    <!--integration JS-->
    <script type="text/javascript" src="../js/tableauVie.js"></script>
</head>

<body>
    <?php include('../php/fonctionsUtiles.php') ?>
    <?php include('header.php') ?>

    <div id="wrapper" toggleClass="">
      <!-- Sidebar -->
      <div id="sidebar-wrapper" >
        <ul class="sidebar-nav">
          <li class="sidebar-brand">
            <a href="#">
              Statistiques
            </a>
          </li>
        </ul>
      </div>
      <!-- /#sidebar-wrapper --	>


      <!-- Page Content -->
      <div id="page-content-wrapper">
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Afficher les statistiques</a></br>
        <?php include('edt.php') ?>
      </div>
      <!-- /#page-content-wrapper -->
    </div>

    <?php include('footer.html') ?>
    
</body>


 <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
 </script>

</html>