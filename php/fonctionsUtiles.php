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
//---------------------------------------------------------------------------------------------
function PreparerRequete($conn,$req)
{
  $cur = oci_parse($conn, $req);
  
  if (!$cur)
  {  
  $e = oci_error($conn);  
  print htmlentities($e['message']);  
  exit;
  }
  return $cur;
}
//---------------------------------------------------------------------------------------------
function ExecuterRequete($cur)
{
  $r = oci_execute($cur, OCI_DEFAULT);
  echo "<br>résultat de la requête: $r<br />";
  if (!$r)
  {  
  $e = oci_error($stid);  
  echo htmlentities($e['message']);  
  exit;
  }
  return $r;
}
//---------------------------------------------------------------------------------------------
function FermerConnexion($conn)
{
  oci_close($conn);
}
//---------------------------------------------------------------------------------------------
function LireDonnees1($cur,&$tab)
{
  $nbLignes = oci_fetch_all($cur, $tab,0,-1,OCI_ASSOC); //OCI_FETCHSTATEMENT_BY_ROW, OCI_ASSOC, OCI_NUM
  return $nbLignes;
}
//---------------------------------------------------------------------------------------------
function LireDonnees2($cur,&$tab)
{
  $nbLignes = 0;
  $i=0;
  while ($row = oci_fetch_array ($cur, OCI_BOTH  ))
  {    
    $tab[$nbLignes][$i]  = $row[0];
    $tab[$nbLignes][$i+1]  = $row[1];
    $tab[$nbLignes][$i+2]  = $row[2];
  $nbLignes++;
  }
  return $nbLignes;
}
//---------------------------------------------------------------------------------------------
function LireDonnees3($cur,&$tab)
{
  $nbLignes = 0;
  $i=0;
  while ($row = oci_fetch ($cur))
  {    
  $tab[$nbLignes][$i] = oci_result($cur,'VAL'); // respecter la casse
    $tab[$nbLignes][$i+1] = oci_result($cur,'TYPE');
  $tab[$nbLignes][$i+2] = oci_result($cur,'COULEUR');
  $nbLignes++;
  }
  return $nbLignes;
}
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



?>