function affiche_bouton() 
{ 
	var ca=false,
	activite=false,
	frequence=false,
	nbfois=false,
	heures=false,
	minutes=false;
	for (i=0; i<document.getElementsByTagName("input").length; i++){
		if (document.getElementsByTagName("input")[i].type=="checkbox"){
			if (document.getElementsByTagName("input")[i].checked){
				ca=true;
			}
		}
		if (document.getElementsByTagName("input")[i].type=="radio"){
			if (document.getElementsByTagName("input")[i].checked){
				frequence=true;
			}
		}
	}
	if(document.getElementById('activite').value!=''){
		activite = true;
	}
	if(document.getElementById('nbFois').value != ''){
		nbfois = true;
	}
	if(document.getElementById('nbHeure').value != ''){
		heures = true;
	}
	if(document.getElementById('nbMinutes').value != ''){
		minutes = true;
	}
	
	if (ca && frequence && activite && nbfois && heures && minutes){
		document.getElementById('ajouter').title='';
		document.getElementById('ajouter').disabled='';
	} else {
		document.getElementById('ajouter').title='Remplissez tous les champs';
		document.getElementById('ajouter').disabled='disabled';
	}
}