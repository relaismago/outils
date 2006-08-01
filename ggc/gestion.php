<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("?","'file:images/retour2_over.gif'");

/*---------------------------------------------------------------*/
/*                      PAGE                                     */
/*---------------------------------------------------------------*/	
echo "<center>\n";
echo "<br><table width='90%' height='90%' border='0' cellpadding='0' cellspacing='2' class='mh_tdborder' align='center'>";
echo "<tr class='mh_tdtitre'><td>";
echo "<table border='0' class='mh_tdborder' cellpadding='0' cellspacing='1' width='100%' height='100%' align='center'>";
echo "<tr valign='middle' class='mh_tdpage'>";
echo "<td width='100%' align='center'>";
echo "<br><br>";

echo "<br><br></td>";
echo "</tr>";
echo "</table>";
echo "</td></tr>";
echo "</table>";

/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();

?>
