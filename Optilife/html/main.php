<!DOCTYPE html>
<html lang="fr">
<?php
@session_start(); 
if(!isset($_SESSION["EMP_NUM"])){//pdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdppdpdpdpdpdpdpdpdpdpdpdppdpdpdppdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdpdppd
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



    <div id="statistiques" class="collapse">

            <div id="pannel-stat" class="panel panel-warning">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div class="accordion-toggle" data-toggle="collapse" data-target="#collapse1">
                            <b>Informations générales</b>
                        </div>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="table-responsive">
                        <?php afficherTempsOptimisationsStatistiques($bdd);?>
                    </div>
                </div>
            </div>


            <div id="pannel-stat" class="panel panel-warning">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div class="accordion-toggle" data-toggle="collapse" data-target="#collapse2">
                            <b>Liste des optimisations</b>
                        </div>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="table-responsive">
                        <?php afficherListesOptimisationsStatistiques2($bdd)?>
                    </div>
                </div>
            </div>

    </div>

      <div id="content" >
        <?php include('edt.php') ?>
      </div>

    <?php include('footer.html') ?>
    
</body>


 <script type="text/javascript">


 </script>

</html>