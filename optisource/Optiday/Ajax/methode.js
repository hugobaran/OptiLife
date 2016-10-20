function AjaxMethode(){
    var date = $('#hide_date').val();
    $.ajax({
        url: 'Ajax_php/ajax_methode.php',
        type: 'POST',
        data: 'date='+date,
        success:function(data){
            $('#affiche_methode').show();
            $('#affiche_methode').html(data);
        }
    });
}