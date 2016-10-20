 <?php
    if(isset($_GET["action"]) ){
      if($_GET["action"]=="ajout"){
        echo "<div style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Activité ajoutée</strong>
        </div>";
      }else if($_GET["action"]=="modif"){
        echo "<div style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Activité Modifiée</strong>
        </div>";
      }
      else if($_GET["action"]=="supp"){
        echo "<div style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Activité Supprimée</strong>
        </div>";
      }else if($_GET["action"]=="echec"){
        echo "<div style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Echec de l'action</strong>
        </div>";
      }
    }
  ?>
