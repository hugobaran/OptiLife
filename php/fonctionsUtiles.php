<?php

  function verifierRempli($n)
  {  
    if (!empty($_POST[$n]))
  {
    $var = $_POST[$n];
    if ($var <> "")
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


function encodageUTF8($str){
  $str = utf8_encode($str);
  echo $str;
  return $str;
}


?>