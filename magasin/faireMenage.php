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

nettoyerTresors($taniere);

header("Location: ./affichageAdmin.php?taniere=".$taniere);

?>
