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

    <div class="page"> <!--debut page-->
    <div class="contenu">
      
    <?php include('header.html') ?>

    <?php include('../php/notifications.php')  ?>

    <?php include('../php/tableauVie.php') ?>

    <?php include('Modals.php') ?>


  <div class="boutons"> <!--debut boutons-->
    <button type="button" class="bouton" id="btnAdd">Ajouter</button>
    <button type="button" class="bouton" id="btnModif">Modifier</button>
    <button type="button" class="bouton" id="btnSupp">Supprimer</button>
  </div> <!--fin boutons-->

   </div>
   <?php include('footer.html') ?>
</div>
</body>
  
<script type="text/javascript">

//Affichage des modals
$(document).ready(function(){
    $("#btnAdd").click(function(){
        $("#ModalAjout").modal();
    });
    $("#btnModif").click(function(){
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
  l = tr.length;

for (i ; i<l; i++) tr[i].addEventListener("click", clicked, false);

element.addEventListener('click', function(e) {
  e.preventDefault(); 
  var confirmation = "Vous avez choisi :  \n",
    i = 0,
    l = selected.length;
  for( ; i<l; i+=2) confirmation += "- Activite " + selected[i+1][0] + " avec la frequence " + selected[i+1][1] +  " " + selected[i+1][2] + "fois pendant " + selected[i+1][3] + "\n";
  
  l == 0 && (confirmation = "Vous n'avez rien choisi :(");
  
  alert(confirmation);

    });


function clicked(){
  var cl = this.className;
  var valeur;
  if (/selected/.test(cl)) {
    this.className = cl.replace(" selected", "");
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
    this.className += " selected";
    //selected.push(this, [this.children[0].innerHTML, this.children[1].innerHTML, this.children[2].innerHTML, this.children[3].innerHTML]);
    document.supprimerActivite.activite.value = this.children[0].innerHTML;
    document.supprimerActivite.frequence.value = this.children[1].innerHTML;
    document.supprimerActivite.classeAge.value = this.children[4].innerHTML;

    document.modifierTache.activite.value = this.children[0].innerHTML;
    document.modifierTache.frequence.value = this.children[1].innerHTML;
    document.modifierTache.classeAge.value = this.children[2].innerHTML;
    document.modifierTache.classeAge.value = this.children[3].innerHTML;
    document.modifierTache.classeAge.value = this.children[4].innerHTML;

  }
}


</script>

</html>