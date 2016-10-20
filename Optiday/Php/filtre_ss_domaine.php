<?php
	echo "<select name='sous-domaine'>";
	if(isset($_POST["DO_ID"])){
		include('../../connexion.php');
        
		$res = $bdd->query("SELECT SO_LIBELLE, SO_ID FROM SOUSDOMAINE WHERE DO_ID=".$_POST["DO_ID"]." ORDER BY SO_LIBELLE");
		while($row = $res->fetch()){
			echo "<option value='".$row["SO_ID"]."'>".$row["SO_LIBELLE"]."</option>";
		}
	}
	echo "</select>";
?>