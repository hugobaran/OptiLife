	$(function(){
	    $("#Optimisation").chained("#activiteO");
	});


	function MAJTemps(){

		var cpt = 0;
		$("#tempsGagne").val(0);
		$("#tempsOpti").val($("#temps"));


		$("li" ).each(function() {

			if(cpt!=0){
				var liType = $(this).attr('data-type');
				var liGagne = parseInt($(this).attr('data-subtext'),10);
				var tpsInitVal = parseInt($("#temps").val(),10);
				var tpsGagneVal = parseInt($("#tempsGagne").val(),10);
				var gagne = 0;

				alert("tpsgagne = "+tpsGagneVal);

				if(liType = "temps"){
					gagne = tpsGagneVal + liGagne;
				}else if(liType = "pourcentage"){
					gagne = tpsGagneVal + liGagne;
				}else{
					gagne = tpsGagneVal;
				}

				alert("Gagne = " + gagne);

				var tpsFinal = tpsInitVal - gagne;

				alert("final = " + tpsFinal);



				$("#tempsGagne").val(gagne);
				$("#tempsOpti").val(tpsFinal);
				$("#affichageTempsGagne").text(gagne + " minutes(s)");
				$("#affichageTempsOpti").text(tpsFinal + " minutes(s)")
			}

			cpt++;

		});

		var opti=false;

		if(document.getElementById('Optimisation').value!=''){
			opti = true;
		}
		
		if (opti){
			document.getElementById('optimiserManuellement').title='';
			document.getElementById('optimiserManuellement').disabled='';
		} else {
			document.getElementById('optimiserManuellement').title='Selectionnez une optimisation';
			document.getElementById('optimiserManuellement').disabled='disabled';
		}
    	
	}

	function listeOptiEnlever(li){
		 $(li).remove();
		 MAJTemps();
	}

	function listeOptiAjout()
    {
      var ul = $("#liste");
      var select = $("#Optimisation");
      var optiName = $('#Optimisation option:selected').attr('data-name');
      var optiVal = $('#Optimisation option:selected').attr('data-subtext');
      var optiType = $('#Optimisation option:selected').attr('data-type');

      if (select.val() != "" && ul.find('input[value=' + select.val() + ']').length == 0)
        ul.append('<li id="listeOpti" data-name="'+optiName+'" data-subtext="'+optiVal+'" data-type="'+optiType+'" onclick="listeOptiEnlever(this);">' +
          '<input type="hidden" name="ingredients[]" value="' + 
          select.val() + '" /> ' +
          optiName + '</li>');

      MAJTemps();
    }