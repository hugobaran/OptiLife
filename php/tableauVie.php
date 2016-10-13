 <?php

    function afficherActivite($categorie,$bdd){
        $sql = 'SELECT ACT_LIBELLE,FR_LIBELLE,EMP_NUM,PRA_NB_FOIS,PRA_DUREE FROM PRATIQUER JOIN ACTIVITE USING(ACT_NUM) WHERE CAT_NUM = ' . $categorie;
        /*echo '<pre>';
        print_r($sql);
        echo '</pre>';*/
        $reponse = $bdd->query($sql);
        $cpt = 1;
        if($reponse->rowCount() == 0){
            echo 'Aucune activité dans cette classe d\'age';
        }else{
             echo '<table class="table table-condensed" id="table"><thead> <tr> <th>ACTIVITE</th> <th>FREQUENCE</th> <th>NB FOIS</th> <th>DUREE</th> </tr> </thead>';
        }
        while ($donnees = $reponse->fetch())
        {   
            $heure =  (int)$donnees['PRA_DUREE']/1;
            $minute = (int)(($donnees['PRA_DUREE'] - $heure) * 60 /1);
            echo '<tr id="ligne" value="OUI"><td>' . $donnees['ACT_LIBELLE'] . "</td><td>" . $donnees['FR_LIBELLE'] . "</td><td>" . $donnees['PRA_NB_FOIS'] . "</td><td>" . $heure. "h ". $minute . "m" . '</td></tr>';
            $cpt++;
        }
        echo '</table>';
        $reponse->closeCursor();
    }
    
 ?>

 <?php include('connexionBDD.php') ?>

 <div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet" id="onglet_etudiant" onclick="javascript:change_onglet('etudiant');">Etudiant</span>
            <span class="onglet" id="onglet_actif" onclick="javascript:change_onglet('actif');">Actif</span>
            <span class="onglet" id="onglet_retraite" onclick="javascript:change_onglet('retraite');">Retraite</span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_etudiant">
                <div class="header_onglet">
                   <img src="../img/retour.gif" class="retour" onclick="javascript:afficher_onglet();"/>
                   <h3>Liste d'activité de la classe d'age : Etudiant</h3>
                </div>
                <div class="table-striped" id="activite_etudiant">
                <?php
                    afficherActivite('1',$bdd);
                ?>
                </div>
            </div>
            <div class="contenu_onglet" id="contenu_onglet_actif">
                <div class="header_onglet">
                   <img src="../img/retour.gif" class="retour" onclick="javascript:afficher_onglet();"/>
                   <h3>Liste d'activité de la classe d'age : Actif</h3>
                </div>
                <div class="table-striped" id="activite_actif">
                     <?php
                        afficherActivite('2',$bdd);
                     ?>
                </div>
            </div>
            <div  class="contenu_onglet" id="contenu_onglet_retraite">
                <div class="header_onglet">
                   <img src="../img/retour.gif" class="retour" onclick="javascript:afficher_onglet();"/>
                   <h3>Liste d'activité de la classe d'age : Retraite</h3>
                </div>
                <div class="table-striped   " id="activite_retraite">
                <?php
                    afficherActivite('3',$bdd);
                ?>
                </div>
            </div>
        </div>
</div>