<?php
require_once("conf.php");
require_once("fonction_affichage.php");
require_once("fonction_connexion.php");
include("../top.php");

// CONNEXION MYSQL
$db_link = @mysql_connect($serveur,$user,$password);
mysql_select_db($bdd);

$id_troll=TestSecurite();

//EST CE QUE LE TROLL A UN GROUPE DE CHASSE ?
$requete_groupe=mysql_db_query($bdd,"select * from ggc_troll where id_troll=$id_troll",$db_link) or die(mysql_error());
$groupe = mysql_result($requete_groupe,0,"id_groupe");
if($groupe==0){
//LE TROLL N'A PAS DE GROUPE DE CHASSE C'EST UN NOUVEAU !
    $nouveau="ok";
    $nom_groupe = "Première connexion";
} else {
//IL A UN GROUPE, ALLONS CHERCHE LE NOM 
    $requete=mysql_db_query($bdd,"select * from ggc_groupe where id_groupe='$groupe'",$db_link) or die(mysql_error());
    $nom_groupe = mysql_result($requete,0,"nom_groupe");
}

function MenuPrincipal($new,$id){
if($new=="ok"){
	echo "<a href='rejoindre.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('rejoindre','','images/rejoindre_over.gif',1)\"><img src='images/rejoindre.gif' name='rejoindre' border='0'></a><br>";
	echo "<a href='creation.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('creation','','images/creer_over.gif',1)\"><img src='images/creer.gif' name='creation' border='0'></a><br>";
}else{
	echo "<a href='groupe.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('groupe','','images/voir_groupe_over.gif',1)\"><img src='images/voir_groupe.gif' name='groupe' border='0'></a><br>";
	echo "<a href='quitter.php' onMouseOut='MM_swapImgRestore()' onMouseOver=\"MM_swapImage('quitter','','images/quitter_over.gif',1)\"><img src='images/quitter.gif' name='quitter' border='0'></a><br>";
}
echo "<a href='index.php' onMouseOut='MM_swapImgRestore()' onMouseOver='MM_swapImage('deconnexion','','images/deconnexion_over.gif',1)'><img src='images/deconnexion.gif' name='deconnexion' border='0'></a><br>";
}

/*---------------------------------------------------------------*/
/*                      ENTETE DE LA PAGE HTML                   */
/*---------------------------------------------------------------*/
AfficheEnTete("Menu Principal","'file:images/rejoindre_over.gif','file:images/creer_over.gif','file:images/voir_groupe_over.gif','file:images/deconnexion_over.gif','file:images/quitter_over.gif'");


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
MenuPrincipal($nouveau,$id);
echo "			  </td>\n";
echo "		 	</tr>\n";
echo "		   </table>\n";
echo "		   <br>\n";
echo "		  </tr>\n";
echo "		 </td>\n";
echo "		</table>\n";
echo "    </td>\n";
echo "    <td width='20' rowspan='4'>&nbsp;</td>\n";
echo "    <td rowspan='4' align='center' valign='top'>\n";
//Fin du menu

//Affichage Centre
echo "		<table width='100%'>\n";
echo "		 <tr>\n";
echo "		  <td>\n";
echo "         <table width='100%' class='mh_tdborder'>\n";
echo "           <tr>\n";
echo "            <td height='30' align='center'><img src='images/bienvenue.gif'></td>\n";
echo " 	         </tr>\n";
echo "           <tr>\n";
echo "            <td height='250' class='mh_tdpage'><br>Grumf,<br>Te voici dans le <b>GGC</b> : l'outils de Gestion des Groupe de Chasse Relais&Mago.<br>" .
		"Le but du GGC est d'aider les trolls à synchroniser les attaques sur les monstres.<br>" .
		"Quand les membres du groupe mettent à jour leurs profils, le dieu Péhàchepé<br>" .
		"calcule et t'afiche les DLA's à venir !<br>" .
		"Gloire à lui et la fée Unfor'Matik !<br>" .
		"Bonnes chasse à tous !<br>" .
		"Courbettes distinguées,<br>" .
		"Fuleng<br><br></td>\n";
echo "	         </tr>\n";
echo "          <tr>\n";
echo "           <td><em>Merci à <b>Bodéga</b> pour tout se temps passé avec moi pour me dépatouiller mes pages !</em></td>\n";
echo " 	        </tr>\n";
echo "      </table>\n";
echo "		   <br>\n";
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

?>
