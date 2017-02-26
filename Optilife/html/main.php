<!DOCTYPE html>
<html lang="fr">
<?php
@session_start(); 
if(!isset($_SESSION["EMP_NUM"])){
  header("location: ../html/accueil.php");
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Emploi du temps</title>
    
    <!-- Custom CSS -->
    <link href="../css/sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/edt.css" type="text/css" />
    
    <!--integration JS-->
    <script type="text/javascript" src="../js/tableauVie.js"></script>
</head>

<body>
    <?php 
    	include('../php/fonctionsUtiles.php');
        require_once('../php/afficherTempsOpti.php');
     ?>
    <?php include('header.php') ?>

    <div id="Page" style="height:100%">
	    <div id="wrapper" toggleClass="" style="height:100%" >
	      <!-- Sidebar -->
	      <div id="sidebar-wrapper" >
	        <ul class="sidebar-nav">
	          <li class="sidebar-brand">
                <h4><b>Informations générales</b></h4>
                <div class="table-responsive listeOpti">
                   <?php afficherTempsOptimisationsStatistiques($bdd);?>
               </div>
                <h4><b>Liste des optimisations</b></h4>
                <div class="table-responsive listeOpti">
                    <table class="table tabOpti">
                        <tr><th>Numero Activité</th><th>Activité</th><th>Temps Total Gagné</th><th>Temps par Optimisation Automatique Gagné</th><th>Temps par Optimisation Manuel Gagné</th></tr>
	           	        <?php afficherListesOptimisationsStatistiques($bdd)?>
                    </table>
                </div>
	          </li>
	        </ul>
	      </div>
	      <!-- /#sidebar-wrapper --	>


	      <!-- Page Content -->
	      <div id="page-content-wrapper" >
	        <?php include('edt.php') ?>
	      </div>
	      <!-- /#page-content-wrapper -->
	    </div>
    </div>
    <?php //include('footer.html') ?>
    
</body>


 <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
 </script>
    <?php include('footer.html') ?>

</html>