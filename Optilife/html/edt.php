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
    <?php include('../php/fonctionsUtiles.php') ?>
      
    <?php include('header.html') ?>

    <?php include('../php/notifications.php')  ?>

    <form  class="boutonsGroup" method="post" action= "../php/optiAuto.php" enctype="application/x-www-form-urlencoded" name="optimiser">
      <input type="submit" class="bouton" value="Optimiser" name="optimiser" id="optimiser"/>
    </form>

    <?php include('../php/tableauVie.php') ?>

    <?php include('Modals.php') ?>

  <div class="boutonsGroup"> <!--debut boutons-->
    <button type="button" class="bouton" id="btnAdd">Ajouter</button>
    <button type="button" class="bouton" id="btnModif">Modifier</button>
    <button type="button" class="bouton" id="btnSupp">Supprimer</button>
  </div> <!--fin boutons-->

   <?php include('footer.html') ?>
   
</body>
  
<script type="text/javascript">

//Affichage des modals
$(document).ready(function(){
    $("#btnAdd").click(function(){
        $("#ModalAjout").modal();
    });
    $("#btnModif").click(function(){
      if( document.supprimerActivite.activite.value == "")
          $("#ModalErreur").modal();
        else
          $("#ModalModifier").modal();
    });
     $("#btnSupp").click(function(){
        if( document.supprimerActivite.activite.value == "")
          $("#ModalErreur").modal();
        else
          $("#ModalSupprimer").modal();
    });
});


var tr = document.querySelectorAll("#table #ligne"),
  element = document.getElementById('test');
  sup = document.getElementById('btnSupp');
  selected = [],
  i = 0,
  l = tr.length,
  classeAgeNB = null,
  classeAgeTxt = "";

for (i ; i<l; i++) tr[i].addEventListener("click", clicked, false);
  selected[0]= tr[0];


function clicked(){
  var cl = this.className;
  var valeur;
  if (/selected/.test(cl)) {
    this.className = cl.replace(" selected", "");
    selected[0]= tr[0];
    document.supprimerActivite.activite.value = "";
    document.supprimerActivite.frequence.value = "";
    document.supprimerActivite.classeAge.value = "";

    document.modifierTache.activite.value = "";
    document.modifierTache.frequence.value = "";
    document.modifierTache.classeAge.value = "";
    document.modifierTache.classeAge.value = "";
    document.modifierTache.classeAge.value = "";
    //selected.splice(selected.indexOf(this), 2);
  }else {
    selected[0].className = selected[0].className.replace(" selected", "");
    selected = [];
    this.className += " selected";
    selected.push(this);
    document.supprimerActivite.activite.value = this.children[0].innerHTML;
    document.supprimerActivite.frequence.value = this.children[1].innerHTML;
    document.supprimerActivite.classeAge.value = this.children[4].innerHTML;

    //remplissage formulaire modifier
    document.modifierTache.EXfrequence.value = this.children[1].innerHTML;
    document.modifierTache.activite.value = this.children[0].innerHTML;
    $('#affichageActivite').text(this.children[0].innerHTML);
    $('#affichageActiviteS').text(this.children[0].innerHTML);
    //document.modifierTache.frequence.value = this.children[1].innerHTML;
    document.modifierTache.classe_age.value = this.children[4].innerHTML;
    classeAgeNB = this.children[4].innerHTML;
    if(classeAgeNB==1){
      classeAgeTxt = "Etudiant";
    }
    else if(classeAgeNB==2){
      classeAgeTxt = "Actif";
    }
    else if(classeAgeNB==3){
      classeAgeTxt = "Retraité";
    }
    else {
      classeAgeTxt = "Inconnu";
    }
    $('#affichageClasseAge').text(classeAgeTxt);
    $('#affichageClasseAgeS').text(classeAgeTxt);
    document.modifierTache.nbFois.value = this.children[2].innerHTML;
    document.modifierTache.nbHeure.value = this.children[5].innerHTML;
    document.modifierTache.nbMinutes.value = this.children[6].innerHTML;
    

  }
}


</script>

</html>