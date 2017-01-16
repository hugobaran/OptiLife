function affiche_bouton() 
{ 
	var opti=false;

	if(document.getElementById('Optimisation').value!=''){
		activite = true;
	}
	
	if (opti){
		document.getElementById('optimiserManuellement').title='';
		document.getElementById('optimiserManuellement').disabled='';
	} else {
		alert("sas");
		document.getElementById('optimiserManuellement').title='Selectionnez une optimisation';
		document.getElementById('optimiserManuellement').disabled='disabled';
	}
}