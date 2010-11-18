<?php



include_once("../inc_connect.php");



function my_mysqlerror()

{

  $erreur='N°= '.mysql_errno().' -->> '.mysql_error()."<br>\n";

  echo $erreur;

  exit;

}



function my_mysql_query($requete)

{

 global $db_vue_rm;



 if ($resultat = mysql_query( $requete , $db_vue_rm)) return $resultat ;

 my_mysqlerror();

}



/*--------------------------------------------------------------------------------------

FONCTION DE DESACTIVATION DU CACHE DU NAVIGATEUR

--------------------------------------------------------------------------------------*/

function no_cache() {

  header("Pragma: no-cache");

  header("Cache-Control: no-cache");

}



?>

