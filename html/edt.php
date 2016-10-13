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
        <button type="button" class="bouton" id="btnAdd">Ajouter(modal)</button>
        <input type="button" class="bouton" value="Ajouter(page)" onclick="document.location.href='ajouter.php'"/>
        <input type="button" class="bouton" value="Modifier" id="btnMod"/>
        <input type="button" class="bouton" value="Modifer(page)" onclick="document.location.href='modifier.php'"/>
        <button type="button" class="bouton" id="btnSupp">Supprimer</button>
        <button type="button" class="bouton" id="test">TEST</button>
    </div> 


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

  <div class="modal fade" id="ModalSupprimer" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <form method="POST" action= "../php/passerelle.php" enctype="application/x-www-form-urlencoded" name="supprimerActivite">
            <input type="text" id="suppActivite" name="activite" value=""/>
            <input type="text" id="suppFrequence" name="frequence" value=""/>  
            <input type="text" id="suppCA" name="classeAge" value="Actif"/>
            <p>Voulez vous supprimer cette activite ?<p>       
            <input type="submit" name="supprimer" value="supprimer"/>
          </form>
        </div>
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

<script type="text/javascript">

//Affichage des modals
$(document).ready(function(){
    $("#btnAdd").click(function(){
        $("#ModalAjout").modal();
    });
    $("#btnMod").click(function(){
        $("#ModalModifier").modal();
    });
     $("#btnSupp").click(function(){
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

element.addEventListener('click', function(e) {
  e.preventDefault(); 

    var act = 208;
    var fre = "Hebdomadaire";

    document.supprimerActivite.activite.value = act;
    document.supprimerActivite.frequence.value = fre;
    });


function clicked(){
  var cl = this.className;
  var valeur;
  if (/selected/.test(cl)) {
    this.className = cl.replace(" selected", "");
    selected.splice(selected.indexOf(this), 2);
  }else {
    this.className += " selected";
    var valeur = $('#e1 input[name="n1"]').val()
    alert (valeur);
    selected.push(this, [this.children[0].innerHTML, this.children[1].innerHTML, this.children[2].innerHTML, this.children[3].innerHTML]);
  }
}


</script>


  </div> 


  </body>
  <?php include('footer.html') ?>
</html>