<?php
global $HTTP_GET_VARS;

if (isset($HTTP_GET_VARS['taniere']) && $HTTP_GET_VARS['taniere']!='' && is_numeric($HTTP_GET_VARS['taniere'])) $taniere = $HTTP_GET_VARS['taniere'];
else header("Location: ./index.php");
//taniere concernée

include_once('../functions_auth.php');
initAuth();
include_once('../secure.php');
include_once('../functions.php3');
include_once("./inc/tresor.inc.php");
include_once("./inc/fonctions.inc.php");

$no_troll=$_SESSION['AuthTroll']; // Id du troll connecté
if (!isDbAdministration() && !isGGT() ) die("<h1><font color=black><b>Vous n'avez pas accès à cette page</b></font></h1");

global $HTTP_POST_VARS;

include_once('../inc_connect.php3');

foreach($HTTP_POST_VARS as $champ=>$value)
{
	$tab=explode("_",$champ);

	
	if ($tab[0]=="res" && is_numeric($value))
		$result = reserverForce($tab[1],$value,$HTTP_POST_VARS['no_troll']);
	else if ($tab[0]=="deres")
		$result = dereserver($tab[1],$HTTP_POST_VARS['no_troll']);
	else if ($tab[0]=="conf")
		$result = confirmer($tab[1],$HTTP_POST_VARS['no_troll']);
	else if ($tab[0]=="deconf")
		$result = deconfirmer($tab[1],$HTTP_POST_VARS['no_troll']);
	else if ($tab[0]=="bloq")
		$result = bloquer($tab[1],$HTTP_POST_VARS['no_troll']);
	else if ($tab[0]=="debloq")
		$result = debloquer($tab[1],$HTTP_POST_VARS['no_troll']);
	else if ($tab[0]=="cach")
		$result = cacher($tab[1],$HTTP_POST_VARS['no_troll']);
	else if ($tab[0]=="decach")
		$result = decacher($tab[1],$HTTP_POST_VARS['no_troll']);
	else if ($tab[0]=="suppr")
		$result = supprimer($tab[1],$HTTP_POST_VARS['no_troll']);
	else
		continue;

	if ($result!="") echo($result);
}

include_once("../inc_disconnect.php3");

	if ($result=="") header("Location: ./affichageAdmin.php?taniere=".$taniere);

?>
