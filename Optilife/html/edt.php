<html lang="fr">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Emploi du temps</title>
        <script type="text/javascript" src="../js/tableauVie.js"></script>
        <script type="text/javascript" src="../js/JQueryBBQ.js"></script>
        <!--integration CSS-->
        <link rel="stylesheet" href="../css/edt.css" type="text/css" />
  </head>

  <body onload="preparer();"">
    <?php include('../php/fonctionsUtiles.php') ?>
      
    <?php include('header.html') ?>

    <?php include('../php/notifications.php')  ?>

    <?php require_once('../php/afficherTempsOpti.php');
    afficherTempsOpti($bdd); ?>

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

   <?php include('footer.html') ?>
   
</body>
  
<script type="text/javascript">

//Affichage des modals


$(document).ready(function(){
    $("#btnAdd").click(function(){
        $("#ModalAjout").modal();
    });
    $("#btnModif").click(function(){
      if( document.supprimerActivite.activite.value == ""){
          $("#ModalErreur").modal();
        }else{
          $("#ModalModifier").modal();
        }
    });
     $("#btnSupp").click(function(){
        if( document.supprimerActivite.activite.value == ""){
          $("#ModalErreur").modal();
        }
        else{
          $("#ModalSupprimer").modal();
        }
    });
});


//gestion de sauvegarde des pages
$( window ).on( 'hashchange', function() {
  var hash = window.location.hash;
  if(hash == "#etudiant")
    change_onglet('etudiant');
  else if(hash == "#actif")
    change_onglet('actif');
  else if(hash == "#retraite")
    change_onglet('retraite');
  else if(hash == "#edt")
    afficher_onglet();
  else if(hash == "")
    afficher_onglet();
});


var tr = document.querySelectorAll("#table #ligne"),
  modif = document.getElementById('btnModif');
  sup = document.getElementById('btnSupp');
  modif.style.background = "#D5CEB5";
  sup.style.background = "#D5CEB5";
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
    sup.disabled = true;
    modif.disabled = true;
    modif.style.background = "#D5CEB5";
    sup.style.background = "#D5CEB5";
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
    sup.disabled = false;
    modif.disabled = false;
    modif.style.background = "#FF8F15 linear-gradient( #FF8F15, #D55601)";
    sup.style.background = "#FF8F15 linear-gradient( #FF8F15, #D55601)";
    document.supprimerActivite.activite.value = this.children[0].innerHTML;
    document.supprimerActivite.frequence.value = this.children[1].innerHTML;
    document.supprimerActivite.classeAge.value = this.children[4].innerHTML;

    //remplissage formulaire modifier
    document.modifierTache.EXfrequence.value = this.children[1].innerHTML;
    document.modifierTache.activite.value = this.children[7].innerHTML;
    $('#affichageActivite').text(this.children[0].innerHTML);
    $('#affichageActiviteS').text(this.children[0].innerHTML);
    document.modifierTache.frequence.value = this.children[1].innerHTML;
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