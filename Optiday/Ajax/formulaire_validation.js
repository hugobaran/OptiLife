function validation(file) {
    var pseudo = $('#ins_pseudo').val();
    var mail = $('#ins_mail').val();
    var mdp = $('#ins_password').val();
    var cf_mdp = $('#cf_password').val();
    var url = 'Ajax_php/ajax_'+file+'.php';
    $.ajax({
        url: url,
        type: 'POST',
        data: 'pseudo='+pseudo+'&mail='+mail+'&mdp='+mdp+'&cf_mdp='+cf_mdp,
        success:function(data){
            $('#style_input').show();
            $('#style_input').html(data);
        }
    });
}

function connexion(file) {
    var mail = $('#mail_connexion').val();
    var mdp = $('#mdp_connexion').val();
    var url = 'Ajax_php/ajax_'+file+'.php';
    $.ajax({
        url: url,
        type: 'POST',
        data: 'mail='+mail+'&mdp='+mdp,
        success:function(data){
            $('#style_input').show();
            $('#style_input').html(data);
        }
    });
}
