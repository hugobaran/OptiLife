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

    <div id="Page" style="height:100%;">
	    <div id="wrapper" toggleClass="" >
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
    </div>
    <?php include('footer.html') ?>
</body>


 <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
 </script>

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