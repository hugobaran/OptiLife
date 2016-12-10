 <?php
    if(isset($_GET["action"]) ){
      if($_GET["action"]=="ajout"){
        echo "<div id='notif' style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Activité ajoutée</strong>
        </div>";
      }else if($_GET["action"]=="modif"){
        echo "<div id='notif' style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Activité Modifiée</strong>
        </div>";
      }
      else if($_GET["action"]=="supp"){
        echo "<div id='notif' style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Activité Supprimée</strong>
        </div>";
      }else if($_GET["action"]=="echec"){
        switch ($_GET["raison"]) {
          case 'temps':
            $raison = "Vous ne pouvez pratiquer cette activité aussi longtemps";
            break;
          case 'incomplet':
            $raison = "Veuillez remplir le formulaire entièrement";
            break;
          default:
            $raison = "";
            break;
        }
        echo "<div id='notif' style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Echec de l'action</strong>
        <p>" . $raison . "</p>
        </div>";
      }else if($_GET["action"]=="opti"){
        echo "<div id='notif' style='text-align:center; width:50%; margin:auto; margin-bottom:20px;' class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Un nouveau temps a été attribué à vos activités</strong>
        </div>";
      }
    }
  ?>
