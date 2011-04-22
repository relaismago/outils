<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

$id_monstre = $_GET[id_monstre];

/*---------------------------------------------------------------*/
/*                 TEST CONNEXION MEMBRE                         */
/*---------------------------------------------------------------*/
// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();
	
/*---------------------------------------------------------------*/
/*                 RECUPERATION D'INFOS                          */
/*---------------------------------------------------------------*/

//RECHERCHE DES INFOS DU MONSTRE
$sql = "select nom_monstre from ggc_monstre where id_monstre='$id_monstre'";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
$nom_monstre = mysql_result($requete,0,"nom_monstre");	
	
//recherche des evts du monstre
$sql = "select ggc_evt.id_troll, " .
		"ggc_evt.date_maj, " .
		"ggc_evt.type_evt, " .
		"ggc_evt.texte_evt, " .
		"ggc_evt.pv, " .
		"ggc_troll.nom_troll " .
		"from " .
		"ggc_evt, " .
		"ggc_troll " .
		"where " .
		"( ggc_evt.id_troll=ggc_troll.id_troll  ) " .
		"and  ( ggc_evt.id_monstre  =  $id_monstre )" .
		"order by ggc_evt.date_maj desc; ";
$requete=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Historique d'un monstre : $nom_monstre","'file:images/retour2_over.gif','file:images/up_over.gif'");

/*---------------------------------------------------------------*/
/*                      PAGE                                     */
/*---------------------------------------------------------------*/	

echo "<a name='haut'></a>";
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "  <tr>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>\n";
AfficheTitre("$nom_monstre (".$id_monstre.")");
echo "    </td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>\n";
AfficheHisto($requete);
echo "    </td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>\n";
AffichePied("<a href='groupe.php?id=$id' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('retour','','images/retour2_over.gif',1)\"><img src='images/retour2.gif' name='retour' border='0'></a>");
echo "    </td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "</table>\n";

/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();
mysql_close($db_link);

?>
