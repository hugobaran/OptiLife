function change_onglet(name){
    afficher_onglet(); 
    document.getElementById('onglet_etudes').style.display='none';
    document.getElementById('onglet_vieActive').style.display='none';
    document.getElementById('onglet_retraite').style.display='none';
    document.getElementById('contenu_onglet_'+name).style.display = 'block';
}

function afficher_onglet(){
    document.getElementById('onglet_etudes').style.display='inline-block';
    document.getElementById('onglet_vieActive').style.display='inline-block';
    document.getElementById('onglet_retraite').style.display='inline-block';
    document.getElementById('contenu_onglet_etudes').style.display = 'none';
    document.getElementById('contenu_onglet_vieActive').style.display = 'none';
    document.getElementById('contenu_onglet_retraite').style.display = 'none';
}
