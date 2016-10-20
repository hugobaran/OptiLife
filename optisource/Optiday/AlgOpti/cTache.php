<?php
include_once ('../../connexion.php');

//Creation de la classe tache
class Tache
{
    private $_idCatal; //l'id standard de la tache (pas celui de l'utilisateur)
    private $_utId;
    private $_lieu;
    private $_algoId;
    private $_superposedTo = [];

    //Partie non optimisee
    private $_id;//id de la tache utilisateur
    private $_date;
    private $_hDebut;
    private $_hFin;
    private $_duree;
    private $_tpsRestant;
    //partie optimisée
    private $_ihFini;//l'id de la tache lors de la réinsertion ###peut-être pas utile###

    private $_compressible;
    private $_deplacable;
    private $_superposable;

    //partie des membres
    //le tableau est construit de la meme façon que la BDD la clée est le membre est la valeur 0,1 ou 2 en fonction des membres utilisé.
    private $_tabMembre;


    public function __construct ($tArray) {
        global $bdd;
        $this->_id = $tArray["TA_ID"];
        $this->_idCatal = $tArray["CA_ID"];
        $this->_utId = $tArray["UT_ID"];
        $this->_souDom = $tArray["SO_ID"];

        $this->_date = $tArray["TA_DATE"];
        $this->_hDebut = $tArray["TA_HEUREDEBUT"];
        $this->_hFin = $tArray["TA_HEUREFIN"];

        $this->_lieu = $tArray["LI_ID"];

        $this->_superposable = $tArray["CA_SUPERPOSABLE"];
        $this->_deplacable = $tArray["CA_DEPLACABLE"];
        $this->_compressible = $tArray["CA_COMPRESSIBLE"];

        $req_m = $bdd->query("SELECT * FROM MEMBRE ORDER BY ME_ID");

        while($val = $req_m->fetch())
        {
            $this->_tabMembre[$val['ME_LIBELLE']] = 0;
        }

        self::calculDuree();
        self::defineMembre();

        $this->_tpsRestant = $this->_duree;

    }


    /**
    *fonction permettant de voir les membres utilisés pour réaliser la tache
    */
    function defineMembre () {
        global $bdd;
        $reqMembre = $bdd->prepare("SELECT * FROM UTILISATION JOIN MEMBRE USING (ME_ID) WHERE CA_ID= :id");

        $reqMembre->execute(array('id' => $this->_idCatal));

        while($membre = $reqMembre->fetch())
        {
            $this->_tabMembre[$membre['ME_LIBELLE']] = $membre['QUANTITE'];
        }

    }

    /**
    *calcul la durée par rapport à la date de debut et la date de fin
    */
    public function calculDuree () {
        //faire le timestamp de l'heure de fin moins le timestamp de l'heure de debut.
        $this->_duree = strtotime($this->_hFin) - strtotime($this->_hDebut); //ATTENTION resultat en seconde et nous le voulons en minutes
        $this->_duree = $this->_duree/60;
    }

    /**
    *Calcul la date de fin par rapport à la durée
    */
    public function calculHFin () {
        $this->_hFin = date('H:i:s', (strtotime($this->_hDebut)+($this->_duree*60)));
    }

    /**
    *Fonction permettant de changer la duree d'une tache par la duree definie dans la BDD
    */
    public function tCompresser () {
        global $bdd;
        if ($this->_compressible)
        {
            $reqDuree = $bdd->prepare("SELECT CA_DUREE FROM CATALOGUE WHERE CA_ID= :idCatal");
            $reqDuree->execute(array('idCatal' => $this->_idCatal));
            $reqDuree = $reqDuree->fetch();
            //on compare les durees et les echange si necessaire
            if($reqDuree["CA_DUREE"] < $this->_duree){
                $this->_duree = $reqDuree["CA_DUREE"];
                self::calculHFin();
            }
        }
    }

    public function checkSuperpo (Tache $a_compare) {
        $isSup = array('okLieu'=>false, 'okMembre'=>false);
        if($this->_superposable & $a_compare->getSuperposable()){
            $isSup['okMembre'] = true;
            //verifier la corespondance des lieux
            if($a_compare->getLieu() == $this->_lieu)
            {
                $isSup['okLieu'] = true;
            }
            //parcourir les deux tableau de membre en même temps et si il y a un doublon passer isSup en false dans les membres
            $a_Membre = $a_compare->getMembre();
            foreach($this->_tabMembre as $k=>$val)
            {
                if($val!=0 && $a_Membre[$k]!=0)
                {
                    $isSup['okMembre']= false;
                }
            }
        }
        return $isSup;
    }

    public function checkLieuSuperpo (Tache $a_compare) {
        if ($this->_superposable & $a_compare->getSuperposable()) {
            if ($a_compare->getLieu() == $this->_lieu || $a_compare->getLieu() == 1 || $this->_lieu == 1) {
                return 1;
            }
        }
        return 0;
    }

    public function checkMembreSuperpo (Tache $a_compare) {
        if ($this->_superposable & $a_compare->getSuperposable()) {
            $a_Membre = $a_compare->getMembre();
            foreach ($this->_tabMembre as $k=>$val) {
                if ($val != 0 & $a_Membre[$k] != 0) {
                    return 0;
                }
            }
            return 1;
        }
        return 0;
    }

    public function getDiffTemps (Tache $a_compare) {
        return $this->_duree - $a_compare->getTpsRestant();
    }

    public function getId () {
        return $this->_id;
    }

    public function getLieu () {
        return $this->_lieu;
    }

    public function getMembre () {
        return $this->_tabMembre;
    }

    public function gethDebut () {
        return $this->_hDebut;
    }

    public function getDuree () {
        return $this->_duree;
    }

    public function sethDebut ($d) {
        if ($this->_deplacable == 1){
            $this->_hDebut = $d;
            self::calculHFin();
        }
    }

    public function gethFin () {
        return $this->_hFin;
    }

    public function getSuperposable () {
        return $this->_superposable;
    }

    public function getDeplacable () {
        return $this->_deplacable;
    }

    public function superposeTo ($t) {
        array_push($this->_superposedTo, $t);
    }

    public function getSuperposedTo () {
        return $this->superposedTo;
    }
    public function getTpsRestant () {
        return $this->_tpsRestant;
    }

    public function subTps ($tps) {
        $this->_tpsRestant -= $tps;
    }

    public function inserer () {
        global $bdd;
        //calcul de l'id qu'aura la tache optimisée
        $req_idFini = $bdd->query("SELECT MAX(TA_ID)+1 as newID FROM TACHE_UTILISATEUR");
        $req_idFini = $req_idFini->fetch();
        $this->_idFini = $req_idFini['newID'];

        $req_inser = $bdd->prepare("INSERT INTO TACHE_UTILISATEUR (`TA_ID`, `TA_ASSOCIE`, `CA_ID`, `LI_ID`, `UT_ID`, `TA_DATE`,`TA_HEUREDEBUT`, `TA_HEUREFIN`, `TA_OPTIMISE`) VALUES ( :taId, :taAs, :caId, :liId, :utId,:date, :hDebut, :hFin, :opti)");

        $req_inser->execute(array(
            'taId' => $this->_idFini,
            'taAs' => $this->_id,
            'caId' => $this->_idCatal,
            'liId' => $this->_lieu,
            'utId' => $this->_utId,
            'date' => $this->_date,
            'hDebut' => $this->_hDebut,
            'hFin' => $this->_hFin,
            'opti' => 1
        ));
    }
}
?>
