function change_onglet(name){
    afficher_onglet(); 
    document.getElementById('onglet_etudiant').style.display='none';
    document.getElementById('onglet_actif').style.display='none';
    document.getElementById('onglet_retraite').style.display='none';
    document.getElementById('contenu_onglet_'+name).style.display = 'block';
}

function afficher_onglet(){
    document.getElementById('onglet_etudiant').style.display='inline-block';
    document.getElementById('onglet_actif').style.display='inline-block';
    document.getElementById('onglet_retraite').style.display='inline-block';
    document.getElementById('contenu_onglet_etudiant').style.display = 'none';
    document.getElementById('contenu_onglet_actif').style.display = 'none';
    document.getElementById('contenu_onglet_retraite').style.display = 'none';
}