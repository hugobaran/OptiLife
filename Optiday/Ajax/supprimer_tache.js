function supprimer_tache(file, id){
    $.ajax({
        url: 'Ajax_php/ajax_'+file+'.php',
        type: 'POST',
        data: 'ta_id='+id,
        success:function(data){
            location.reload();
        }
    });
}