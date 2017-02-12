<?php

  function verifierRempli($n)
  {  
    if (!empty($_POST[$n]))
  {
    $var = $_POST[$n];
    /*if ($var <> "")*/
    echo $var;
  }
  }
  function cocherRadio($form, $n)
  {
    if (isset($_POST[$form]))
  {
    if ( $_POST[$form] == $n)
        echo "checked";
  }
  }
  function VerifSelect ($form, $n)
  {
    if (isset($_POST[$form]))
  {
    if ( $_POST[$form] == $n)
        echo "selected";
  }
  }
  function cocherCase ($form, $n)
  {
  if (isset($_POST[$form])) 
    foreach($_POST[$form] as $val)
    {
      if ($n == $val)
      {
        echo "checked";
      }
    }
  }  

  //regarde si une activité précise est optimisé
function estOpti($bdd, $act, $lib, $cat, $emp){
    $sql = "SELECT * FROM `pratiquer` WHERE EMP_NUM = ".$_SESSION["EMP_NUM"]." and ACT_NUM=".$act." and FR_LIBELLE='".$lib."' and CAT_NUM=".$cat."";
    $tab = LireDonneesPDO1($bdd, $sql);
    //$sql = "SELECT count(*) FROM `dure` WHERE `CAT_NUM` = ".$cat." AND `ACT_NUM` =".$act."";
    //$tab2 = LireDonneesPDO1($bdd, $sql);
    if($tab[0]["OPTIMISER"] == 0){
      return false;
    }
    //else if($tab2[0]['count(*)'] == 0)
      //return false;
    else if($tab[0]["PRA_DUREE"] < tempsMini($bdd, $act))
      return false;
    else
      return true;
}

function tempsMini($bdd, $ACT_NUM){
    $sql = "SELECT * FROM `activite` WHERE `ACT_NUM` = ".$ACT_NUM."";
    $tab = LireDonneesPDO3($bdd, $sql);
    return $tab[0]["ACT_TEMPS"];
}


function possedeOptiManuelle($bdd, $activite, $libelle, $cat, $emp){
    $opti = false;
    $sql = "SELECT * FROM `est_optimise` JOIN `pratiquer` using(PRA_NUM) WHERE ACT_NUM = ".$activite." AND FR_LIBELLE = '".$libelle."' AND CAT_NUM = ".$cat." AND `est_optimise`.EMP_NUM = ".$_SESSION["EMP_NUM"];
    $reponse = $bdd->query($sql);
    $valeur = $reponse->fetchAll();
    if (count($valeur) != 0)
      $opti = true;
    return $opti;
}  

function tempsOptiManuelle($bdd, $activite, $libelle, $cat, $emp){
    $tempsOpti = 0;
    $sql = "SELECT * FROM `est_optimise` join `pratiquer` using(pra_num) where act_num = ".$activite." and fr_libelle = '".$libelle."' and cat_num = ".$cat." and `pratiquer`.emp_num = ".$_SESSION["EMP_NUM"];
    $reponse = $bdd->query($sql);
    while ($donnees = $reponse->fetch()){
      $opti = $donnees['OPTI_NUM'];
      $sql2 = "SELECT * FROM `optimiser` where OPTI_NUM = ".$opti." and ACT_NUM = ".$activite;
      $reponse2 = $bdd->query($sql2);
      $donnees2 = $reponse2->fetch();
      if(is_null($donnees2['OP_POURCENTAGE']))
        $tempsOpti += $donnees2['OP_TPS_GAGNE']; 
      else
        $tempsOpti += $donnees['PRA_DUREE']*($donnees2['OP_POURCENTAGE']);
    }
    return $tempsOpti;
} 

  
function LireDonneesPDO1($conn,$sql)
{
  $i=0;
  foreach  ($conn->query($sql,PDO::FETCH_ASSOC) as $ligne)     
    $tab[$i++] = $ligne;
  return $tab;
}
//---------------------------------------------------------------------------------------------
function LireDonneesPDO2($conn,$sql)
{
  $i=0;
  $cur = $conn->query($sql);
  while ($ligne = $cur->fetch(PDO::FETCH_ASSOC))
    $tab[$i++] = $ligne;
  return $tab;
}
//---------------------------------------------------------------------------------------------
function LireDonneesPDO3($conn,$sql)
{
  $cur = $conn->query($sql);
  $tab = $cur->fetchall(PDO::FETCH_ASSOC);
  return $tab;
}
//---------------------------------------------------------------------------------------------
function AfficherDonnee($tab)
{
  foreach($tab as $ligne)
  {
    foreach($ligne as $cle =>$valeur)
    echo $cle.":".$valeur."\t";
    echo "<br/>";
  }
}
//---------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------
// fonctions autres
function AfficherDonnee1($tab,$nbLignes)
{
  if ($nbLignes > 0)
  {
    echo "<table border=\"1\">\n";
    echo "<tr>\n";
    foreach ($tab as $key => $val)  // lecture des noms de colonnes
    {
      echo "<th>$key</th>\n";
    }
    echo "</tr>\n";
    for ($i = 0; $i < $nbLignes; $i++) // balayage de toutes les lignes
    {
      echo "<tr>\n";
      foreach ($tab as $data) // lecture des enregistrements de chaque colonne
    {
        echo "<td>$data[$i]</td>\n";
      }
      echo "</tr>\n";
    }
    echo "</table>\n";
  }
  else
  {
    echo "Pas de ligne<br />\n";
  }
  echo "$nbLignes Lignes lues<br />\n";
}
//---------------------------------------------------------------------------------------------
function AfficherDonnee2($tab)
{
  foreach($tab as $ligne)
  {
    foreach($ligne as $valeur)
    echo $valeur." ";
    echo "<br/>";
  }
}
//---------------------------------------------------------------------------------------------
function AfficherDonnee3($tab,$nb)
{
  for($i=0;$i<$nb;$i++)
    echo $tab[$i][0]." ".$tab[$i][1]." ".$tab[$i][2]."\n";
}

function bidon(){
//juste un test

  $sql = "INSERT INTO bidon VALUES (99,'évier','blanc')";
  $stmt = $conn->exec($sql);
  echo 'RES : ',$stmt ,'<br/>';

}


?>