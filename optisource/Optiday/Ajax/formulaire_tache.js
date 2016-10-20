function AjaxTache(){
    var tache = $('#tache').val();
    $.ajax({
        url: 'Ajax_php/ajax_tache.php',
        type: 'POST',
        data: 'tache='+tache,
        success:function(data){
            $('#jqueryTache').show();
            $('#jqueryTache').html(data);
        }
    });
}

function AjaxLieu(){
    var lieu = $('#lieu').val();
    $.ajax({
        url: 'Ajax_php/ajax_lieu.php',
        type: 'POST',
        data: 'lieu='+lieu,
        success:function(data){
            $('#jqueryLieu').show();
            $('#jqueryLieu').html(data);
        }
    });
}

function heureDebut() {
    var tache = $('#tache').val();
    var lieu = $('#lieu').val();
    var date = $('#date').val();
    $.ajax({
        url: 'Ajax_php/ajax_date_debut.php',
        type: 'POST',
        data: 'date='+date,
        success:function(data){
            $('#jqueryHeureDebut').show();
            $('#jqueryHeureDebut').html(data);
        }
    });
}

function heureFin() {
    var date = $('#date').val();
    var heure_debut = $('#heure_debut').val();
    $.ajax({
        url: 'Ajax_php/ajax_date_fin.php',
        type: 'POST',
        data: 'date='+date+'&heure_debut='+heure_debut,
        success:function(data){
            $('#jqueryHeureFin').show();
            $('#jqueryHeureFin').html(data);
        }
    });
}