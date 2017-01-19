//Affichage des modals
$(document).ready(function(){
    $("#btnAdd").click(function(){
        $("#ModalAjout").modal();
    });
    $("#btnModif").click(function(){
        $("#ModalModifier").modal();
    });
     $("#btnSupp").click(function(){
        $("#ModalSupprimer").modal();
    });
     $("#btnOptiManuelle").click(function(){
        $("#ModalOpti").modal();
    });
});


//gestion de sauvegarde des pages
$( window ).on( 'hashchange', function() {
  var hash = window.location.hash;
  if(hash == "#etudes"){
    change_onglet('etudes');
  }else if(hash == "#vieActive"){
    change_onglet('vieActive');
  }else if(hash == "#retraite"){
    change_onglet('retraite');
  }else if(hash == "#edt"){
    change_onglet('vieComplete');
  }else if(hash == ""){
    change_onglet('vieComplete');
  }
});

//Initialisation des variables
var tr = document.querySelectorAll("#table #ligne"),
  modif = document.getElementById('btnModif');
  sup = document.getElementById('btnSupp');
  opti = document.getElementById('btnOptiManuelle');
  modif.style.background = "#D5CEB5";
  sup.style.background = "#D5CEB5";
  opti.style.background = "#D5CEB5";
  selected = [],
  i = 0,
  l = tr.length,
  classeAgeNB = null,
  classeAgeTxt = "";

//Assignation de l'evenement clic sur chaque lignes du tableau
for (i ; i<l; i++) tr[i].addEventListener("click", clicked, false);
  selected[0]= tr[0];
   

//Fonction clic sur les lignes du tableau
function clicked(){
  var cl = this.className;
  var valeur;
  if (/selected/.test(cl)) {
    this.className = cl.replace(" selected", "");
    selected[0]= tr[0];
    sup.disabled = true;
    modif.disabled = true;
    opti.disabled = true;
    modif.style.background = "#D5CEB5";
    sup.style.background = "#D5CEB5";
    opti.style.background = "#D5CEB5";
    document.supprimerActivite.activite.value = "";
    document.supprimerActivite.frequence.value = "";
    document.supprimerActivite.classeAge.value = "";
    document.modifierTache.activite.value = "";
    document.modifierTache.frequence.value = "";
    document.modifierTache.classeAge.value = "";
    document.optimiserActivite.classeAge.value = "";
    document.optimiserActivite.activite.value = "";
    document.optimiserActivite.activiteNum.value = "";
    document.optimiserActivite.temps.value = "";
    $('#activiteO').val("").change();
    //selected.splice(selected.indexOf(this), 2);
  }else {
    selected[0].className = selected[0].className.replace(" selected", "");
    selected = [];
    this.className += " selected";
    selected.push(this);
    sup.disabled = false;
    modif.disabled = false;
    opti.disabled = false;
    modif.style.background = "#FF8F15 linear-gradient( #FF8F15, #D55601)";
    sup.style.background = "#FF8F15 linear-gradient( #FF8F15, #D55601)";
    opti.style.background = "#FF8F15 linear-gradient( #FF8F15, #D55601)";
    document.supprimerActivite.activite.value = this.children[9].innerHTML;
    document.supprimerActivite.suppFrequence.value = this.children[2].innerHTML;
    document.supprimerActivite.classeAge.value = this.children[6].innerHTML;
    document.supprimerActivite.suppPra.value = this.children[0].innerHTML;
    //remplissage formulaire modifier
    document.modifierTache.EXfrequence.value = this.children[2].innerHTML;
    document.modifierTache.activite.value = this.children[9].innerHTML;
    $('#affichageActivite').text(this.children[1].innerHTML);
    $('#affichageActiviteS').text(this.children[1].innerHTML);
    document.modifierTache.frequence.value = this.children[2].innerHTML;
    document.modifierTache.classe_age.value = this.children[6].innerHTML;
    classeAgeNB = this.children[6].innerHTML;
    if(classeAgeNB==1){
      classeAgeTxt = "Etudes";
    }
    else if(classeAgeNB==2){
      classeAgeTxt = "Vie Active";
    }
    else if(classeAgeNB==3){
      classeAgeTxt = "Retraite";
    }
    else {
      classeAgeTxt = "Inconnu";
    }
    $('#affichageClasseAge').text(classeAgeTxt);
    $('#affichageClasseAgeS').text(classeAgeTxt);
    document.modifierTache.nbFois.value = this.children[3].innerHTML;
    document.modifierTache.nbHeure.value = this.children[7].innerHTML;
    document.modifierTache.nbMinutes.value = this.children[8].innerHTML;


    //remplissage formulaire Optimisation
    $('#affichageTemps').text(this.children[10].innerHTML + " minutes");
    $('#affichageTempsOpti').text(this.children[10].innerHTML + " minutes");
    $('#tempsOpti').val(this.children[10].innerHTML);
    $('#temps').val(this.children[10].innerHTML);
    $('#activiteO').val(this.children[9].innerHTML).change();
    $('#pratiqueOpti').val(this.children[0].innerHTML);
    $('#affichageActiviteOpti').text(this.children[1].innerHTML);
    document.optimiserActivite.classe_age.value = this.children[6].innerHTML;
    classeAgeNB = this.children[6].innerHTML;
    if(classeAgeNB==1){
      classeAgeTxt = "Etudes";
    }
    else if(classeAgeNB==2){
      classeAgeTxt = "Vie Active";
    }
    else if(classeAgeNB==3){
      classeAgeTxt = "Retraite";
    }
    else {
      classeAgeTxt = "Inconnu";
    }
    $('#affichageClasseAgeOpti').text(classeAgeTxt);

    var ListeOption = document.getElementById('Optimisation');
    var temps = document.getElementById('temps').value;
    for(var i = 0 ,l = ListeOption.options.length; i< l; i++ ){
      var typeDonnee = ListeOption[i].getAttribute("data-type");
      var gagne = ListeOption[i].getAttribute('data-value');
      ListeOption[i].disabled = false;
      if(typeDonnee == "temps" && temps - gagne <= 0){
          ListeOption[i].title = "Impossible : Temps final trop faible";
          ListeOption[i].disabled = true;
      }
    }


  }
}


function preparer(){
var hash = window.location.hash;
  if(hash == "#etudes")
    change_onglet('etudes');
  else if(hash == "#vieActive")
    change_onglet('vieActive');
  else if(hash == "#retraite")
    change_onglet('retraite');
  else if(hash == "#edt")
    change_onglet('vieComplete');
  else if(hash == "")
    change_onglet('vieComplete');
}
