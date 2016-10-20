<?php
    echo "<select name='tache'>";
	if(isset($_POST["SO_ID"])){
        include('../../connexion.php');
	
        $res = $bdd->query('SELECT CA_LIBELLE, CA_ID FROM CATALOGUE WHERE SO_ID= '.$_POST["SO_ID"].' AND (UT_ID_CA = 1 OR UT_ID_CA = '.$_SESSION["id"].') ORDER BY CA_LIBELLE');
        while($row = $res->fetch()){
            echo "<option value='".$row["CA_ID"]."'>".$row["CA_LIBELLE"]."</option>";
		}
    }
	echo "</select>";
?>