
<?php include('connexionBDD.php') ?>
<?php //include('fonctionsUtiles.php') ?>

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

 <?php
  
    function afficherActivite($categorie,$bdd){
        $sql = 'SELECT * FROM pratiquer JOIN activite USING(ACT_NUM) WHERE CAT_NUM = ' . $categorie;
        $reponse = $bdd->query($sql);
        $cpt = 1;
        if($reponse->rowCount() == 0){
            echo 'Aucune activité dans cette classe d\'age';
        }else{
             echo '<table class="table table-condensed" id="table"><thead> <tr> <th>ACTIVITE</th> <th>FREQUENCE</th> <th>NB FOIS</th> <th>DUREE</th> ';
             echo '<th style="display:none;">CA</th><th style="display:none;">nbHeure</th><th style="display:none;">nbMinute</th></tr> </thead>';
        }
        while ($donnees = $reponse->fetch())
        {   
            $dure = $donnees['PRA_DUREE'];
            $opti = estOpti($bdd, $donnees['ACT_NUM'], $donnees['FR_LIBELLE'],$donnees['CAT_NUM'], $donnees['EMP_NUM']);
            if($opti){
                $tpsMini = tempsMini($bdd, $donnees['CAT_NUM'], $donnees['ACT_NUM']);
                if($tpsMini < $dure){
                    $dure = $tpsMini;
                }
            }
            $minute = (int)(($dure%60));
            $heure = (int)($dure - $minute)/60;
            $activite = utf8_encode($donnees['ACT_LIBELLE']);
            echo '<tr id="ligne"><td>' . $activite . "</td><td>" . $donnees['FR_LIBELLE'] . "</td><td>" . $donnees['PRA_NB_FOIS'] . "</td>";
            echo "<td>";
            if($opti)
                echo "<font color='green'>";
            echo  $heure. "h ". $minute . "m" . '</td>'; 
            if($opti)
                echo "</font>";
            echo '<td style="display:none;">'.$categorie. '</td><td style="display:none;">'.$heure. '</td><td style="display:none;">'.$minute. '</td></tr>';
            $cpt++;
        }
        echo '</table>';
        $reponse->closeCursor();
    }
    
 ?>