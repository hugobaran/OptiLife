//Affichage des modals
$(document).ready(function(){
    $("#btnAdd").click(function(){
        MAJbutton();
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
     $("#btnChanger").click(function(){
        $("#ModalChanger").modal();
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
  echange = document.getElementById('btnChanger');
  modif.style.background = "#D5CEB5";
  sup.style.background = "#D5CEB5";
  opti.style.background = "#D5CEB5";
  echange.style.background = "#D5CEB5";
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
    echange.disabled = true;
    modif.style.background = "#D5CEB5";
    sup.style.background = "#D5CEB5";
    opti.style.background = "#D5CEB5";
    echange.style.background = "#D5CEB5";
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
  }else {

    selected[0].className = selected[0].className.replace(" selected", "");
    selected = [];
    this.className += " selected";
    selected.push(this);
    sup.disabled = false;
    modif.disabled = false;
    opti.disabled = false;
    echange.disabled = false;
    modif.style.background = "#FF8F15 linear-gradient( #FF8F15, #D55601)";
    sup.style.background = "#FF8F15 linear-gradient( #FF8F15, #D55601)";
    opti.style.background = "#FF8F15 linear-gradient( #FF8F15, #D55601)";
    echange.style.background = "#FF8F15 linear-gradient( #FF8F15, #D55601)";

    //initialisation des variables récupérée par le tableau
    var praNum = this.children[0].innerHTML;
    var actLibelle = this.children[1].innerHTML;
    var frequence = this.children[2].innerHTML;
    var nbFois = this.children[3].innerHTML;
    var dureeTexte = this.children[4].innerHTML;
    var dureeOptiTexte = this.children[5].innerHTML;
    var classeAge = this.children[6].innerHTML;
    var nbHeures = this.children[7].innerHTML;
    var nbMinutes = this.children[8].innerHTML;
    var actNum = this.children[9].innerHTML;
    var dureeOpti = this.children[10].innerHTML;
    var optiAutoFLag = this.children[11].innerHTML;
    var actDuree = this.children[12].innerHTML;
    var duree = this.children[13].innerHTML;
    var domaine = this.children[14].innerHTML;
    var sousDomaine = this.children[15].innerHTML;
    var nature = this.children[16].innerHTML;
    var natureLibelle = this.children[17].innerHTML;

    //remplissage du formulaire de suppression
    document.supprimerActivite.activite.value = actNum;
    document.supprimerActivite.suppFrequence.value = frequence;
    document.supprimerActivite.classeAge.value = classeAge;
    document.supprimerActivite.suppPra.value = praNum;

    //remplissage formulaire modifier
    document.modifierTache.EXfrequence.value = frequence;
    document.modifierTache.activite.value = actNum;
    document.modifierTache.pratique.value = praNum;
    $('#affichageActivite').text(actLibelle);
    $('#affichageActiviteS').text(actLibelle);
    document.modifierTache.frequence.value = frequence;
    document.modifierTache.classe_age.value = classeAge;
    classeAgeNB = classeAge;
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
    document.modifierTache.nbFois.value = nbFois;
    document.modifierTache.nbHeure.value = nbHeures;
    document.modifierTache.nbMinutes.value = nbMinutes;

    //remplissage formulaire de changement d'activité
    $('#pratiqueChange').val(praNum);
    $('#affichageActiviteChange').text(actLibelle);
    $('#ChangerActNature option[value="'+natureLibelle+'"]').prop('selected', true);
    $('#ChangerActNature').change();

    //remplissage formulaire Optimisation
    if(optiAutoFLag == 1 && actDuree != 0 )
      var tps = actDuree;
    else var tps = duree;
    $('#affichageTemps').text(formaterTemps(tps));
    $('#affichageTempsOpti').text(formaterTemps(tps));
    $('#affichageTempsGagne').text(formaterTemps(0));
    $('#tempsOpti').val(tps);
    $('#temps').val(tps);
    $('#tempsGagne').val(0);
    $('#tempsPratique').val(dureeTexte);
    $('#activiteO').val(actNum).change();
    $('#pratiqueOpti').val(praNum);
    $('#affichageActiviteOpti').text(actLibelle);
    document.optimiserActivite.classe_age.value = classeAge;
    classeAgeNB = classeAge;
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

    resetListe(); 
    MAJListe();

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

function formaterTemps(temps){
  var heures = parseInt(temps/60,10);
  var minutes = parseInt(((temps/60)-heures)*60,10);
  var secondes = parseInt((temps - heures*60 - minutes)*60,10);
  if(secondes == 60){
    minutes ++;
    secondes = 00;
  }
  return heures + 'h ' + minutes + 'm ' + secondes + 's';
}
