<?php
include_once('../functions_auth.php');
initAuth();
include_once('../secure.php');

global $HTTP_GET_VARS;

if (isset($HTTP_GET_VARS['taniere']) && $HTTP_GET_VARS['taniere']!='' && is_numeric($HTTP_GET_VARS['taniere'])) $taniere = $HTTP_GET_VARS['taniere'];
else header("Location: ./index.php");
//taniere concernée

$no_troll=$_SESSION['AuthTroll']; // Id du troll connecté

include_once("../functions.php3");
include_once("./inc/tresor.inc.php");
include_once("./inc/fonctions.inc.php");

global $HTTP_POST_VARS;

include_once('../inc_connect.php3');

foreach($HTTP_POST_VARS as $champ=>$value)
{
	$tab=explode("_",$champ);

	if ($tab[0]=="res")
		$result = reserver($tab[1],$HTTP_POST_VARS['no_troll']);
	else
		continue;

	if ($result!="") echo($result);
}

include_once("../inc_disconnect.php3");

header("Location: ./affichage.php?taniere=".$taniere);

?>
