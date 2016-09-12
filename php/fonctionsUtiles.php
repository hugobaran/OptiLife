<?php


	function ConnexionBase(){
		$host = "https://spartacus.iutc3.unicaen.fr/phpmyadmin/";
		$user = "julien_chevron";
		$passwd = "tiiselai";
		try
		{
			$bdd = new PDO('mysql:host=spartacus.iutc3.unicaen.fr/phpmyadmin/;dbname=julien_chevron;', $user, $passwd);
		}
		
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}

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





?>