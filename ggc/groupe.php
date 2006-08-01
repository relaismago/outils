<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

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
//RECHERCHE DES INFOS DU TROLL CONNECTE
if ($_REQUEST[id_groupe] != "") {
	$id_groupe = $_REQUEST[id_groupe];
	$nom_troll = $_SESSION["AuthNomTroll"];
} else {
	$requete_groupe=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
	$id_groupe = mysql_result($requete_groupe,0,"id_groupe");
	$nom_troll = mysql_result($requete_groupe,0,"nom_troll");
}

//recherche du groupe et des infos du groupe
$requete_groupe=mysql_db_query($bdd,"select * from ggc_groupe where id_groupe='$id_groupe'",$db_link) or die(mysql_error());
$nom_groupe = mysql_result($requete_groupe,0,"nom_groupe");
$nb_troll = mysql_result($requete_groupe,0,"nb_trolls");
$nb_monstre = mysql_result($requete_groupe,0,"nb_monstres");
$nb_pehiks = mysql_result($requete_groupe,0,"nb_px");

//recherche de tous les trolls du groupe et des infos
$sql = 'select ggc_troll.nom_troll, ggc_troll.niveau_troll, ggc_troll.race, ggc_troll.dla_en_cours, ggc_troll.dla_suivante, ggc_troll.dla_prevue, ggc_troll.position_x, ggc_troll.position_y, ggc_troll.position_z, ggc_troll.pv_actuel, ggc_troll.pv_max, trolls.nom_image_troll, ggc_troll.id_troll, ggc_troll.pa'
        . ' from ggc_troll, trolls'
        . ' where ( ggc_troll.id_troll = trolls.id_troll ) and ( ggc_troll.id_groupe = '.$id_groupe.' )';
		
$requete_infos=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());

//recherche de tous les monstres suivis par le groupe
$sql = "select distinct(id_monstre) from ggc_evt where id_groupe='$id_groupe' order by id_monstre asc";
$requete_infos_evt=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());

//RECHERCHE DES DERNIERS EVENEMENTS DU GROUPE
$sql = "SELECT ggc_evt.id_troll, " .
  "ggc_evt.date_maj, " .
  "ggc_evt.type_evt, " .
  "ggc_evt.texte_evt, " .
  "ggc_evt.pv, " .
  "ggc_troll.nom_troll, " .
  "ggc_evt.id_monstre " .
  "from " .
  "ggc_evt, " .
  "ggc_troll " .
  "where " .
  "( ggc_evt.id_troll=ggc_troll.id_troll  ) " .
  "AND  ( ggc_evt.id_groupe  =  $id_groupe )" .
  "order by ggc_evt.date_maj desc limit 5; ";
$requete_histo_evt = mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());


//Date/heure en cours (heure pleine pour éviter les décallages)
$date = mktime(date("H"), 0, 0, date("m"), date("d"), date("Y"));


/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("GGC : ".stripslashes($nom_groupe),"'file:images/ajouter_monstre_over.gif','file:images/enlever_monstre_over.gif','file:images/maj_profil_over.gif','file:images/retour2_over.gif','file:images/deconnexion_over.gif','file:images/enlever_monstre_over.gif','file:images/up_over.gif','file:images/voir_histo_over.gif','file:images/ajout_evt_over.gif'");


/*---------------------------------------------------------------*/
/*                      PAGE                                     */
/*---------------------------------------------------------------*/	

echo "<a name='haut'></a>";
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td colspan='3' align='center'>\n";

//Affichage du titre
AfficheTitre($nom_groupe);

echo "	  </td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td width='150' rowspan='4' align='center' valign='top'>\n";

//Affichage Menu
echo "		<table width='100%'>\n";
echo "		 <tr>\n";
echo "		  <td>\n";
echo "		   <table width='100%' class='mh_tdborder_trans'>\n";
echo "		    <tr>\n";
echo "			  <td align='center'>\n";
echo "			  <img src='images/titre_menu.gif' border='0'>\n";
echo "			  </td>\n";
echo "		 	</tr>\n";
echo "		   </table>\n";
echo "		   <br>\n";
echo "		   <table width='100%' class='mh_tdborder'>\n";
echo "		    <tr>\n";
echo "			  <td class='mh_tdpage' align='center'>\n";
echo "			  <a href='maj_profil.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('maj_profil','','images/maj_profil_over.gif',1)\"><img src='images/maj_profil.gif' name='maj_profil' border='0'></a>\n";
echo "			  <a href='accueil.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('retour','','images/retour2_over.gif',1)\"><img src='images/retour2.gif' name='retour' border='0'></a>";
echo "			  <a href='../index.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('deconnexion','','images/deconnexion_over.gif',1)\"><img src='images/deconnexion.gif' name='deconnexion' border='0'></a>";
echo "			  </td>\n";
echo "		 	</tr>\n";
echo "		   </table>\n";
echo "		   <br>\n";
//Fin du menu

//Affichage Menu Monstres
echo "		   <table width='100%' class='mh_tdborder_trans'>\n";
echo "		    <tr>\n";
echo "			  <td align='center'>\n";
echo "			  <img src='images/titre_monstres.gif' border='0'>\n";
echo "			  </td>\n";
echo "		 	</tr>\n";
echo "		   </table>\n";
echo "		   <br>\n";
echo "		   <table width='100%' class='mh_tdborder'>\n";
echo "		    <tr>\n";
echo "			  <td class='mh_tdpage' align='center'>\n";
echo "			  <a href='ajouter_monstre.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('ajouter','','images/ajouter_monstre_over.gif',1)\"><img src='images/ajouter_monstre.gif' name='ajouter' border='0'></a><br>\n";
echo "			  <a href='modifier_monstre.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('modifier','','images/modifier_monstre_over.gif',1)\"><img src='images/modifier_monstre.gif' name='modifier' border='0'></a>\n";
echo "			  <a href='enlever_monstre.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('enlever','','images/enlever_monstre_over.gif',1)\"><img src='images/enlever_monstre.gif' name='enlever' border='0'></a>\n";
echo "			  </td>\n";
echo "		 	</tr>\n";
echo "		   </table>\n";
echo "		   <br>\n";
//Fin des monstres

//Affichage des stats
echo "		   <table width='100%' class='mh_tdborder_trans'>\n";
echo "		    <tr>\n";
echo "			  <td align='center'>\n";
echo "			  <img src='images/titre_stats.gif' border='0'>\n";
echo "			  </td>\n";
echo "		 	</tr>\n";
echo "		   </table>\n";
echo "		   <br>\n";
Affiche_stats($nb_troll,$nb_monstre,$nb_pehiks);
echo "		  </tr>\n";
echo "		 </td>\n";
echo "		</table>\n";
echo "    &nbsp;</td>\n";
echo "    <td width='20' rowspan='4'>&nbsp;</td>\n";
echo "    <td rowspan='4' align='center' valign='top'>\n";
//Fin des stats

//Affichage Centre
echo "		<table width='100%'>\n";
echo "		 <tr>\n";
echo "		  <td>\n";
//Table histo
echo "         <table width=\"100%\" class='mh_tdborder'>\n";
echo "           <tr>\n";
echo "            <td height='30' align='center'><img src=\"images/quepassado.gif\"></td>\n";
echo "           </tr>\n";
echo "           <tr>\n";
echo "            <td class='mh_tdpage' align='center'>\n";
AfficheHistoEvt($requete_histo_evt);
echo "       <br></td>\n";
echo "          </tr>\n";
echo "          <tr>\n";
echo "           <td align='right'><a href=\"#haut\" onMouseOut=\"MM_swapImgRestore()\" onMouseOver=\"MM_swapImage('up','','images/up_over.gif',1)\"><img src=\"images/up.gif\" name=\"up\" border=\"0\"></a></td>\n";
echo "          </tr>\n";
echo "      </table><br>\n";
//Table trolls
echo "         <table width='100%' class='mh_tdborder'>\n";
echo "           <tr>\n";
echo "            <td height='30' align='center'><img src='images/trolls.gif'></td>\n";
echo " 	         </tr>\n";
echo "           <tr>\n";
echo "            <td class='mh_tdpage' align='center'>\n";
AfficheGraphAxe($date);

//Pour chacun des trolls on apelle la fonction d'affichage
while ($infos = mysql_fetch_array($requete_infos, MYSQL_NUM))
{
AfficheGraphTroll ($date,$infos[0],$infos[12],$infos[1],$infos[2],$infos[3],$infos[4],$infos[5],$infos[6],$infos[7],$infos[8],$infos[9],$infos[10],$rep_avatar.$infos[11],$infos[13]);
}

echo "   		  <br></td>\n";
echo "	         </tr>\n";
echo "          <tr>\n";
echo "           <td align='right'><a href='#haut' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('up','','images/up_over.gif',1)\"><img src='images/up.gif' name='up' border='0'></a></td>\n";
echo " 	        </tr>\n";
echo "      </table>\n";
echo "		   <br>\n";
echo "<table width='100%' class='mh_tdborder'>\n";
echo "  <tr>\n";
echo "   <td height='30' align='center'><img src='images/monstres.gif'></td>\n";
echo " 	</tr>\n";
echo "  <tr>\n";
echo "   <td class='mh_tdpage' align='center'>\n";

//Pour chacun des monstres suivis dans ggc_evt on va chercher les infos et on lance l'affichage
while ($infos_evt = mysql_fetch_array($requete_infos_evt, MYSQL_NUM)) {
	//On cherche les infos du monstres
	$sql = "select * from ggc_monstre where id_monstre='".$infos_evt[0]."'";
	$requete_infos_monstre=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
	//On va chercher la position du monstre dans la table de la vue2D
	$sql = "select * from monstres where id_monstre='".$infos_evt[0]."'";
	$requete_pos_monstre=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
	$num=mysql_num_rows($requete_pos_monstre);
	if($num!=0){
	$pos_m_x = mysql_result($requete_pos_monstre,0,"x_monstre");
	$pos_m_y = mysql_result($requete_pos_monstre,0,"y_monstre");
	$pos_m_z = mysql_result($requete_pos_monstre,0,"z_monstre");
	$pos_monstre = "X=$pos_m_x | Y=$pos_m_y | N=$pos_m_z";
	} else {
	$pos_monstre = "Mettre à jour la vue2D ...";
	}
	//on cherche les évênements du monstre
	$sql = "select date_maj,type_evt,texte_evt,id_troll from ggc_evt where id_monstre='".$infos_evt[0]."' order by date_maj desc limit 3";
	$requete_infos_evt_monstre=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
	//on calcule les dégats effectués sur le monstre
	$sql = "select sum(pv) from ggc_evt where id_monstre='$infos_evt[0]'";
	$requete_pv_monstre=mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());
	$nb_pv = mysql_result($requete_pv_monstre,0,"sum(pv)");
	
	//On appelle la fonction d'affichage en passant les paramètres
	while($infos_monstre=mysql_fetch_array($requete_infos_monstre, MYSQL_NUM)) 
	{
		AfficheMonstre($id,$infos_monstre[0],$infos_monstre[1],$requete_infos_evt_monstre,$pos_monstre,$nb_pv);
	}
}


echo "   </td>\n";
echo " 	</tr>\n";
echo "  <tr>\n";
echo "   <td align='right'><a href='#haut' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('up2','','images/up_over.gif',1)\"><img src='images/up.gif' name='up2' border='0'></a></td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "		  </tr>\n";
echo "		 </td>\n";
echo "		</table>\n";
//Fin d'affichage Centre

echo "    </td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td colspan='3' align='center'>\n";

//Affichage du pied
AffichePied(date("H:i:s \l\e j/m/Y"));
//Fin d'affichage du pied

echo "    <td colspan='3' align='center'>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "  <tr>\n"; 
echo "    <td width='10'>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td>&nbsp;</td>\n";
echo "    <td width='10'>&nbsp;</td>\n";
echo "  </tr>\n";
echo "</table>\n";

/*-----------------------------------------------------------------*/
/*	                PIED DE LA PAGE HTML                           */
/*-----------------------------------------------------------------*/
AfficheBasPage ();

mysql_free_result($requete_groupe);
mysql_free_result($requete_infos);
mysql_free_result($requete_histo_evt);

?>
