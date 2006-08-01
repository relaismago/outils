<?php
global $HTTP_POST_VARS;

if ( isset($HTTP_POST_VARS['login']) && $HTTP_POST_VARS['login']!='' && is_numeric($HTTP_POST_VARS['login'])
		&& isset($HTTP_POST_VARS['password']) && $HTTP_POST_VARS['password']!='') {
		
	$login = $HTTP_POST_VARS['login'];
	$password = $HTTP_POST_VARS['password'];
}
else
	header("Location: ./index.php");


include_once('../functions_auth.php');
initAuth();
include_once('../secure.php');
include_once('../functions.php3');
include_once("./inc/tresor.inc.php");
include_once("./inc/fonctions.inc.php");

$no_troll=$_SESSION['AuthTroll']; // Id du troll connecté
if (!isDbAdministration() && !isGGT() ) die("<h1><font color=black><b>Vous n'avez pas accès à cette page</b></font></h1");

include_once('../inc_connect.php3');

$tab=appelScript($login,$password);
majTableAuto($tab);

include_once("../inc_disconnect.php3");

header("Location: ./index.php");

?>
