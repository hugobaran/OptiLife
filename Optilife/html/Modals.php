<html lang="en">
  <head>
        <meta charset="utf-8">
  </head>

  <body>

 <!-- Modal Ajouter-->
  <div class="modal fade" id="ModalAjout" role="dialog">
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

  <!-- Modal Modifier-->
  <div class="modal fade" id="ModalModifier" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modifier une activité</h4>
        </div>
        <div class="modal-body">
          <?php
            include("modifier.php");
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Modal Supprimer-->
  <div class="modal fade" id="ModalSupprimer" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Supprimer une activité</h4>
        </div>
        <div class="modal-body">
          <?php
            include("supprimer.php");
          ?>
        </div>
      </div>
    </div>
  </div>


   <!-- Modal Optimisation Manuelle-->
  <div class="modal fade" id="ModalOpti" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Optimiser une activité</h4>
        </div>
        <div class="modal-body">
          <?php
            include("optiManuelle.php");
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


  <!-- Modal Rien selectionné -->
  <div class="modal fade" id="ModalErreur" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Erreur</h4>
        </div>
        <div class="modal-body">
          <p>Veuillez selectionner une activité</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
      </div> 
    </div>
  </div>

  <div class="modal fade" id="ModalChanger" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Changer une activité</h4>
        </div>
        <div class="modal-body">
         <?php
            include('changerActivite.php');
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
      </div> 
    </div>
  </div>


  </body>
</html>