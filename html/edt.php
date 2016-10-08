<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Emploi du temps</title>
        <!--integration JS et AJAX-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="../js/tableauVie.js"></script>
        <script type="text/javascript" src="../js/bootstrap/bootstrap.min.js"></script>
        <!--integration CSS-->
        <link rel="stylesheet" href="../css/edt.css" type="text/css" />
        <link rel="stylesheet" href="../css/utilities.css" type="text/css" />
        <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css" />
  </head>

  <body>

     <?php include('header.html') ?>
     <?php include('../php/tableauVie.php') ?>

  <div class="container">
    <div class="boutons">
        <button type="button" class="btn btn-info btn-lg" id="myBtn">Ajouter(modal)</button>
        <input type="button" value="Ajouter(page)" id="btn" onclick="document.location.href='ajouter.php'"/>
        <input type="button" value="Modifier" id="btn" onclick="document.location.href='modifier.php'"/>
        <input type="button" value="Supprimer" id="btn" onclick="alert('Activité supprimée');"/>
    </div> 


    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ajouter une activité</h4>
        </div>
        <div class="modal-body">
          <?php
            include("ajouter.php");
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>


  </div> 


  </body>
  <?php include('footer.html') ?>
</html>