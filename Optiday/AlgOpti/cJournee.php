<?php
require_once ('cTache.php');
//creation de la classe journee
class Journee {
    private $_userId;
    private $_date;

    private $_hDebut;
    private $_hFin;
    private $_oDebut;
    private $_oFin;

    private $_jDuree;//Durée de la journée de base
    private $_oDuree;

    private $_tabTache;
    private $_optiTabTache;
    private $_optiTabMethode;

    /**
     *@params la date de la journee a optimiser ainsi que le nom de l'utilisateur
    */
    public function __construct ($userId, $date) {
        $this->_userId = $userId;
        $this->_tabTache = array();
        $this->_date = $date;

        self::remplirTabTache();
    }

    /**
     *Cette fonction permet à partir de l'id utilisateur et de la date de remplir le tableau des taches
    */
    public function remplirTabTache () {
        global $bdd;
        $counter = 0;
        $req = $bdd->prepare("SELECT * FROM TACHE_UTILISATEUR as ta JOIN CATALOGUE as ca USING (CA_ID) JOIN OPTION_TACHE as op USING (CA_ID) WHERE ta.UT_ID= :userId AND TA_OPTIMISE = :opti AND DATE_FORMAT(TA_DATE,'%Y-%m-%d')= :date ORDER BY TA_DATE");
        $req->execute(array('userId' => $this->_userId, 'opti' => 0, 'date' => $this->_date));
        while($tache_ut =$req->fetch())
        {
            array_push($this->_tabTache, new Tache($tache_ut));
            $counter ++;
        }

    }

    /**
    *Cette fonction lance l'optimisation globale, pour cela elle appel les trois fonctions d'otpimisation, compresser(), superposer() et organiser()
    */
    public function optimiser () {
        global $bdd;
        //Suppression des données dans la BDD
        $req_sup = $bdd->prepare("DELETE FROM TACHE_UTILISATEUR WHERE UT_ID = :id AND TA_OPTIMISE = 1 AND DATE_FORMAT(TA_DATE,'%Y-%m-%d')= :date");
        $nb_sup = $req_sup->execute(array(
            'id' => $this->_userId,
            'date' => $this->_date
        ));
        self::compresser();
        //Creation du tableau de superposabilité
        $this->_tabTache = self::theSuperpo($this->_tabTache);
        //on insere les taches dans la BDD
        foreach($this->_tabTache as $value){
            $value->inserer();
        }
    }

    /**
    *Cette fonction compresse la tache en appelant la fonction optimiserDuree() qui va chercher la duree standard de la tache (par rapport à son modèle
    */
    public function compresser() {
        foreach($this->_tabTache as &$value){
            $value->tCompresser();
        }
    }

    public function theSuperpo($pTab) {
        echo "<h2>THE SUPERPO---------------------</h2>";
        $tabFinal = [];

        $insere = false;
        for ($i = 0; $i < count($pTab); $i++) {
            if ($pTab[$i]->getDeplacable() == 0) {
                array_push($tabFinal, $pTab[$i]);
                unset($pTab[$i]);
                $pTab = array_values($pTab);
                $insere = true;
                break;
            }
        }
        if (!$insere) {
            array_push($tabFinal, $pTab[0]);
            unset($pTab[0]);
            $pTab = array_values($pTab);
        }

        $C = true;
        $watch_index = 0;

        while ($C) {
            echo"<h4>WHILE</h4>";

            $save_index = null;
            $place_index = null;
            $same_place = false;
            $superposable = false;
            $tps_diff = null;

            //On parcour le tableau de superposition
            for ($i = 0; $i < count($pTab); $i++) {
                if ($pTab[$i]->checkLieuSuperpo($tabFinal[$watch_index])) {
                    $same_place = true;
                    $place_index = $i;
                    if ($tabFinal[$watch_index]->checkMembreSuperpo($pTab[$i]) == 1) {
                        $tmp_time = $tabFinal[$watch_index]->getDiffTemps($pTab[$i]);
                        if (abs($tmp_time < $tps_diff) || $tps_diff == null) {
                            $tps_diff = $tmp_time;
                            $save_index = $i;
                            $superposable = true;
                        }
                    }
                }
            }
            if ($superposable != null) {
                echo "SUPERPOSITION<br>";
                array_push($tabFinal, $pTab[$save_index]);
                //On rentre la nouvelle heure de debut
                $tabSuperposed = $tabFinal[$watch_index]->getSuperposedTo();

                $hDebut = $tabFinal[$watch_index]->gethDebut();
                for ($i = 0; $i < count($tabSuperposed); $i++) {
                    if ($tabFinal[$tabSuperposed[$i]]->checkMembreSuperpo($pTab[$save_index]) == 0) {
                        if ($tabFinal[$tabSuperposed[$i]]->gethFin() > $hDebut) {
                            $hDebut = $tabFinal[$tabSuperposed[$i]]->gethFin();
                        }
                    }
                }

                $tabFinal[count($tabFinal)-1]->sethDebut($hDebut);
                $tabFinal[count($tabFinal)-1]->superposeTo($watch_index);
                $tabFinal[$watch_index]->superposeTo(count($tabFinal)-1);
                unset($pTab[$save_index]);
                $pTab = array_values($pTab);

            } else {
                echo "PAS SUPERPOSITION<br>";
                if ($watch_index == count($tabFinal)-1) {
                    if ($same_place != null) {
                        array_push($tabFinal, $pTab[$place_index]);
                        $tabFinal[count($tabFinal)-1]->sethDebut($tabFinal[$watch_index]->gethFin());

                        unset($pTab[$place_index]);
                        $pTab = array_values($pTab);

                    } else {
                        $insere = false;
                        for ($j = 0; $j < count($pTab); $j++) {
                            if ($pTab[$j]->getDeplacable() == 0) {
                                array_push($tabFinal, $pTab[$j]);
                                unset($pTab[$j]);
                                $pTab = array_values($pTab);
                                $insere = true;
                                break;
                            }
                        }
                        if (!$insere) {
                            array_push($tabFinal, $pTab[0]);
                            unset($pTab[0]);
                            $pTab = array_values($pTab);
                        }
                    }
                }
                $watch_index ++;
                $tmp_time = null;
                echo "<h6>FIN".count($pTab)."</h6>";
                if (count($pTab) == 0) {
                    $C = false;
                }
            }
        }
        echo"<pre>tabFinal : ";print_r($tabFinal);echo"</pre>";
        echo "<h2>FIN THE SUPERPO</h2>";
        return $tabFinal;
    }


    public function superposer () {
        $counter = 0;//variable servant lors des tests pour eviter de tester un element qui n'existe pas dans le tableau

        $wrecked = false;

        //PARCOUR DU TABLEAU DES TACHES
        foreach($this->_optiTabTache as $curTa){
            $isSup = null;//Tableau de confirmation de superposition

            $insert_before = false;//Variable pour savoir si l'on doit inserer à la colonne precedente
            $posBefore = 0;//La position de la colonne precedente

            if($counter > 0){

                //PARCOUR DU TABLEAU
                foreach($this->_tabSuperpo as $k=>&$col)
                {
                    //PARCOUR DES COLONNES
                    foreach($col as $ta)
                    {
                        $isSup = $curTa->checkSuperpo($ta);

                        if(!$isSup['okLieu'] | !$isSup['okMembre'])
                        {
                            //Si la tache n'est pas superposable mais que l'on devait l'inserer avant
                            if($insert_before){
                                $this->_tabSuperpo = self::insert_array($this->_tabSuperpo, array($curTa), $posBefore);
                                $insert_before = false;
                                $wrecked = true;
                            }
                            break;
                        }
                    }

                    if($wrecked){
                        break;
                    }

                    //Superposable : On ajoute dans la colonne correspondante
                    if($isSup['okLieu'] & $isSup['okMembre'])
                    {
                        array_push($col, $curTa);
                        $insert_before = false;
                        break;
                    }

                    //Non superposable mais meme lieu: On ajoute une nouvelle colonne derriere la precedente et on decale les autres
                    else if($isSup['okLieu'] & !$isSup['okMembre'])
                    {
                        $insert_before = true;
                    }
                    $posBefore++;

                }
                if($insert_before)
                {
                    $this->_tabSuperpo = self::insert_array($this->_tabSuperpo, array($curTa), $posBefore);
                }

                //3-Non superposable : On ajoute une nouvelle colonne à la fin
                if(!$isSup['okLieu'] && !$wrecked)
                {
                    array_push($this->_tabSuperpo, array($curTa));
                }
                $wrecked = false;
                //4-On recalcule les dates de debut des tache dans les colonnes par rapport au date de fin des colonne precedente
                //5-On recopie ce tableau dans _optiTabTache
            }
            $counter ++;
        }

        unset($this->_optiTabTache);
        $this->_optiTabTache = array();
        $gr_debut=0;$gr_fin=0;
        $counter = 0;
        //Partie ou l'on gere les dates de debut et de fin des groupes
        foreach($this->_tabSuperpo as &$col)
        {
            //On regarde la date de debut et de fin du groupe
            foreach($col as &$ta)
            {
                if($counter == 0){
                    $gr_debut = $ta->gethDebut();
                }
                $ta->sethDebut($gr_debut);

                if($ta->gethFin() > $gr_fin){
                    $gr_fin = $ta->gethFin();
                }

                array_push($this->_optiTabTache, $ta);
                $counter ++;
            }
            $gr_debut = $gr_fin;
            $gr_fin = 0;
        }

    }

    //Fonction creant une nouvelle colonne dans un tableau
    public function insert_array($tab,$item,$i)
    {
        if($i < count($tab)-1){
            $re_ar = array();
            foreach($tab as $k=>$val)
            {
                if ($k == $i){
                    array_push($re_ar,$item);
                }
                array_push($re_ar,$val);
            }
            return $re_ar;
        }
        else
        {
            array_push($tab, $item);
            return $tab;
        }
    }
}
?>
