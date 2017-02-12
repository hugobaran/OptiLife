
<?php include('connexionBDD.php') ?>
<?php //include('fonctionsUtiles.php') ?>

 <div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet" id="onglet_etudes" onclick="window.location.href='#etudes'">Etudes</span>
            <span class="onglet" id="onglet_vieActive" onclick="window.location.href='#vieActive'">Vie Active</span>
            <span class="onglet" id="onglet_retraite" onclick="window.location.href='#retraite'">Retraite</span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_etudes" style="display:none;">
                <div class="header_onglet">
                   <img src="../img/retour.gif" class="retour" onclick="window.location.href='#edt'"/>
                   <h3>Liste d'activités de la classe d'age : Etudes</h3>
                </div>
                <div class="table-striped" id="activite_etudes">
                <?php
                    afficherActivite('1',$bdd);
                ?>
                </div>
            </div>
            <div class="contenu_onglet" id="contenu_onglet_vieActive" style="display:none;">
                <div class="header_onglet">
                   <img src="../img/retour.gif" class="retour" onclick="window.location.href='#edt'"/>
                   <h3>Liste d'activités de la classe d'age : Vie Active</h3>
                </div>
                <div class="table-striped" id="activite_vieActive">
                     <?php
                        afficherActivite('2',$bdd);
                     ?>
                </div>
            </div>
            <div  class="contenu_onglet" id="contenu_onglet_retraite" style="display:none;">
                <div class="header_onglet">
                   <img src="../img/retour.gif" class="retour" onclick="window.location.href='#edt'"/>
                   <h3>Liste d'activités de la classe d'age : Retraite</h3>
                </div>
                <div class="table-striped" id="activite_retraite">
                <?php$
                    afficherActivite('3',$bdd);
                ?>
                </div>
            </div>
        </div>
        <div class="contenu_onglet" id="contenu_onglet_vieComplete" style="display:true;">
                <div class="header_onglet">
                   <h3>Liste d'activités de toute la vie</h3>
                </div>
                <div class="table-striped" id="activite_vieActive">
                     <?php
                        afficherActivite('0',$bdd);
                     ?>
                </div>
            </div>
</div>

 <?php
  
    function afficherActivite($categorie,$bdd){
        if($categorie == 0){
            $sql = "SELECT * FROM pratiquer JOIN activite USING(ACT_NUM) Where EMP_NUM = '".$_SESSION["EMP_NUM"]."' order by PRA_NUM";
        }
        else{
            $sql = "SELECT * FROM pratiquer JOIN activite USING(ACT_NUM) WHERE EMP_NUM = '".$_SESSION["EMP_NUM"]."' and CAT_NUM = " . $categorie . " order by PRA_NUM";
        }
        $reponse = $bdd->query($sql);
        $cpt = 1;
        if($reponse->rowCount() == 0){
            echo 'Aucune activité dans cette classe d\'age';
        }else{
             echo '<table class="table table-condensed" id="table"><thead> <tr><th>NUMERO ACTIVITE</th> <th>ACTIVITE</th> <th>FREQUENCE</th> <th>NB FOIS</th> <th>DUREE</th> <th>NOUVELLE DUREE</th>';
             echo '<th style="display:none;">CA</th><th style="display:none;">nbHeure</th><th style="display:none;">nbMinute</th><th style="display:none;">actNum</th><th style="display:none;">dureeOpti</th></tr> </thead>';
        }
        while ($donnees = $reponse->fetch())
        {   
            $dure = $donnees['PRA_DUREE'];
            $dureOpti = $donnees['PRA_DUREE'];
            //verification optimisation Automarique appliquée
            $optiAuto = estOpti($bdd, $donnees['ACT_NUM'], $donnees['FR_LIBELLE'],$donnees['CAT_NUM'], $donnees['EMP_NUM']);
            if($optiAuto){
                $tpsMini = tempsMini($bdd, $donnees['ACT_NUM']);
                if($tpsMini < $dure){
                    $dureOpti = $tpsMini;
                }
            }
            //Verification optimisation Manuelle appliquée
            $optiManuelle = possedeOptiManuelle($bdd, $donnees['ACT_NUM'], $donnees['FR_LIBELLE'],$donnees['CAT_NUM'], $donnees['EMP_NUM']);
            if($optiManuelle){
                $dureOpti -= tempsOptiManuelle($bdd, $donnees['ACT_NUM'], $donnees['FR_LIBELLE'],$donnees['CAT_NUM'], $donnees['EMP_NUM']);
            }
            $dureOpti = $donnees['PRA_DUREE_OPTI'];
            $minute = (int)(($dure%60));
            $heure = (int)($dure - $minute)/60;
            $minuteOpti = (int)(($dureOpti%60));
            $heureOpti = (int)($dureOpti - $minuteOpti)/60;
            $activite = utf8_encode($donnees['ACT_LIBELLE']);
            $numPra = $donnees['PRA_NUM'];
            echo '<tr id="ligne"><td>' . $numPra .'</td><td>' . $activite . "</td><td>" . $donnees['FR_LIBELLE'] . "</td><td>" . $donnees['PRA_NBFOIS'] . "</td>";
            echo "<td>";
            echo  $heure. "h ". $minute . "m" . '</td>'; 
            echo "<td>";
            if($optiAuto || $optiManuelle){
                $tps = $dureOpti;
                echo "<font color='red'>";
                echo  $heureOpti. "h ". $minuteOpti . "m" ;
            }else{
                $tps = $dure;
                echo "<font color='green'>";
                echo  $heure. "h ". $minute . "m" ;
            } 
            echo '</td>';
            if($optiAuto || $optiManuelle)
                echo "</font>";
            echo '<td style="display:none;">'.$donnees['CAT_NUM']. '</td><td style="display:none;">'.$heure. '</td><td style="display:none;">'.$minute. '</td><td style="display:none;">'.$donnees['ACT_NUM']. '</td><td style="display:none;">'.$tps. '</td></tr>';
            $cpt++;
        }
        echo '</table>';
        $reponse->closeCursor();
    }
    
 ?>