<?
##################################################################
#                                                                # 
#  Vue publique de la guilde RELAIS&MAGO                         # 
#                                                                # 
#  Ce code source est librement redistribuable et modifiable;    #
#  dans le cadre de la license GPL                               #  
#  que vous trouverez &agrave; :                                        #
#             http://clx.anet.fr/spip/article.php3?id_article=7  #
#                                                                #
##################################################################
#
#
#
#$Id: functions_vue.php,v 1.17 2006/07/06 17:37:05 glupglup Exp $
#
#$Log: functions_vue.php,v $
#Revision 1.17  2006/07/06 17:37:05  glupglup
#correction du problème d'accent dans le lien vers le bestiaire
#
#Revision 1.16  2006/05/19 19:09:53  bodega
#ajout
#
#Revision 1.15  2006/04/29 10:11:17  bodega
#zoubli
#
#Revision 1.14  2006/04/29 10:06:49  bodega
#allegement fonctionnalite, surchage serveur
#
#Revision 1.13  2006/04/29 09:51:04  bodega
#suppression info popop monstre
#
#Revision 1.12  2005/09/27 05:52:37  bodega
#ajout
#
#Revision 1.11  2005/09/26 10:54:01  bodega
#avancement nouveau cockpit (recherche)
#
#Revision 1.10  2005/09/25 12:20:59  glupglup
#correction bug du filtre sur les gowaps
#
#Revision 1.9  2005/09/24 12:40:51  bodega
#Trollometer ancien cockpit
#
#Revision 1.8  2005/09/23 21:51:18  bodega
#trollometer en double :)
#
#Revision 1.7  2005/09/23 20:51:12  bodega
#Nouveau cockpit
#
#Revision 1.6  2005/08/21 14:54:46  bodega
#test proto
#
#Revision 1.5  2005/08/20 12:47:15  bodega
#Correction bug 107
#
#Revision 1.4  2005/08/19 19:12:03  bodega
#Souhait 121, couleurs trollometer taniÃ¨re
#
#Revision 1.2  2005/08/19 13:09:47  bodega
#Correction bugs 103 et 108
#
#Revision 1.1.1.1  2005/08/14 21:33:17  bodega
#Importation
#
#Revision 1.99  2005/07/20 12:19:41  yvo
#trollo remis sur cockpit
#
#Revision 1.98  2005/07/20 11:24:57  yvo
#Trollometer &agrave; part
#
#Revision 1.97  2005/07/13 20:22:21  yvo
#suppression de l'alias /vue2d/
#
#Revision 1.96  2005/07/05 21:51:46  yvo
#Amoi n'est plus... :)
#
#Revision 1.95  2005/06/26 19:38:34  yvo
#htmlentities popup lieu
#
#Revision 1.94  2005/06/19 15:27:45  yvo
#Filtrer Gowap
#
#Revision 1.93  2005/06/19 14:29:06  max
#Ajout du filtrage sur les gowaps.
#
#Revision 1.92  2005/06/19 12:29:10  yvo
#gowap
#
#Revision 1.91  2005/06/19 11:24:28  yvo
#couleur guilde / troll
#
#Revision 1.90  2005/06/19 10:23:00  yvo
#Correction Popup
#
#Revision 1.89  2005/06/19 09:55:28  yvo
#couleur R&M gowaps
#
#Revision 1.88  2005/06/19 09:37:52  yvo
#Couleur Jaune pour les trolls R&M
#
#Revision 1.87  2005/06/08 21:24:17  kasseroll
#*** empty log message ***
#
#Revision 1.86  2005/05/24 10:42:51  yvo
#mdif
#
#Revision 1.85  2005/05/17 11:27:51  yvo
#ajout
#
#Revision 1.84  2005/05/14 17:43:37  yvo
#correction GT
#
#Revision 1.83  2005/05/10 21:12:14  yvo
#recherche basse
#
#Revision 1.82  2005/05/10 11:22:39  yvo
#opuos
#
#Revision 1.81  2005/05/10 11:19:40  yvo
#liche
#
#Revision 1.80  2005/05/10 10:22:32  yvo
#png to gif
#
#Revision 1.79  2005/05/09 13:01:40  yvo
#modif
#
#Revision 1.78  2005/05/07 22:59:27  yvo
#Distinction des groupes de gowaps
#
#Revision 1.77  2005/05/07 16:36:53  yvo
#Grandes tani&egrave;res
#
#Revision 1.76  2005/05/06 16:39:20  yvo
#addslashe (2nd)
#
#Revision 1.75  2005/05/06 16:17:01  yvo
#Légende
#
#Revision 1.74  2005/05/06 16:15:07  yvo
#addslashes
#
#Revision 1.73  2005/05/06 16:07:34  yvo
#couleur normale taille > 10
#
#Revision 1.72  2005/05/05 14:18:40  yvo
#var connu correction
#
#Revision 1.71  2005/05/05 13:58:41  yvo
#tips brouillard
#
#Revision 1.70  2005/05/05 13:52:51  yvo
#ajustement taille maximale (pa + vue)
#
#Revision 1.69  2005/05/05 13:41:37  yvo
#ajustement taille max vue / pas
#
#Revision 1.68  2005/05/04 21:42:05  yvo
#sales bestioles
#
#Revision 1.67  2005/05/03 19:27:14  yvo
#mouches
#
#Revision 1.66  2005/05/01 17:33:41  yvo
#maj lien acc&egrave;s rapieed
#
#Revision 1.65  2005/05/01 16:54:15  yvo
#ajustement monstre connu ou non du bestiaire
#
#Revision 1.64  2005/05/01 14:14:11  yvo
#legénde quad incomplet
#
#Revision 1.63  2005/05/01 14:11:46  yvo
#brouillard pour vue<10
#
#Revision 1.62  2005/05/01 11:56:48  yvo
#Ajout images / legende / correciton bug refresh
#
#Revision 1.61  2005/04/30 15:21:23  yvo
#cf Forum.
#
#Revision 1.60  2005/04/29 14:30:22  yvo
#ajout couleurs tani&egrave;re + backup base auto
#
#Revision 1.59  2005/04/29 11:01:06  yvo
#ajout distance popup monstres
#
#Revision 1.58  2005/04/28 09:56:46  yvo
#*** empty log message ***
#
#Revision 1.57  2005/04/27 14:57:56  yvo
#*** empty log message ***
#
#Revision 1.56  2005/04/27 09:10:28  yvo
#*** empty log message ***
#
#Revision 1.55  2005/04/27 09:00:56  yvo
#*** empty log message ***
#
#Revision 1.54  2005/04/26 09:56:56  yvo
#*** empty log message ***
#
#Revision 1.53  2005/04/25 11:47:26  yvo
#*** empty log message ***
#
#Revision 1.52  2005/04/25 08:53:01  yvo
#*** empty log message ***
#
#Revision 1.51  2005/04/25 07:24:31  yvo
#*** empty log message ***
#
#Revision 1.50  2005/04/23 12:24:03  yvo
#appartient &agrave; (gowap) trollometer
#
#Revision 1.49  2005/04/23 12:21:18  yvo
#quote addslaches
#
#Revision 1.48  2005/04/23 09:06:48  yvo
#correction bug
#
#Revision 1.47  2005/04/22 11:57:46  yvo
#*** empty log message ***
#
#Revision 1.46  2005/04/22 11:49:55  yvo
#*** empty log message ***
#
#Revision 1.45  2005/04/22 11:40:47  yvo
#*** empty log message ***
#
#Revision 1.44  2005/04/22 11:31:36  yvo
#*** empty log message ***
#
#Revision 1.43  2005/04/22 11:17:21  yvo
#bugbug
#
#Revision 1.42  2005/04/22 11:10:06  yvo
#correction $tab
#
#Revision 1.41  2005/04/22 10:52:37  yvo
#correction proprio gowap
#
#Revision 1.40  2005/04/21 15:46:39  yvo
#*** empty log message ***
#
#Revision 1.39  2005/04/21 15:44:46  yvo
#correctiond
#
#Revision 1.38  2005/04/21 11:23:55  yvo
#correciton lien
#
#Revision 1.37  2005/04/21 11:19:51  yvo
#correction limite verticale
#
#Revision 1.36  2005/04/21 08:52:22  yvo
#correction /
#
#Revision 1.35  2005/04/21 08:25:38  yvo
#*** empty log message ***
#
#Revision 1.34  2005/04/21 08:21:47  yvo
#*** empty log message ***
#
#Revision 1.33  2005/04/21 07:45:23  yvo
#correction sessoin
#
#Revision 1.32  2005/04/21 07:24:55  yvo
#arf
#
#Revision 1.31  2005/04/21 07:23:33  yvo
#correction foreach
#
#Revision 1.30  2005/04/21 07:17:51  yvo
#correction bug
#
#Revision 1.29  2005/04/21 07:03:48  yvo
#revue de code
#
#Revision 1.28  2005/04/18 19:32:00  yvo
#correction bug champi
#
#Revision 1.27  2005/04/14 09:04:32  yvo
#modif apparence cockpit
#
#Revision 1.26  2005/04/12 19:20:56  yvo
#correction cookie
#
#Revision 1.25  2005/04/11 10:48:07  yvo
#correction fixe
#
#Revision 1.24  2005/04/11 10:37:14  yvo
#fixe cookie
#
#Revision 1.23  2005/04/10 13:39:59  yvo
#correction bug
#
#Revision 1.22  2005/04/09 23:10:45  yvo
#correction TROLL
#
#Revision 1.21  2005/04/09 19:11:44  yvo
#modif
#
#Revision 1.20  2005/04/08 20:51:21  yvo
#var admin connexion
#
#Revision 1.19  2005/04/06 10:47:45  yvo
#get
#
#Revision 1.18  2005/03/28 14:12:51  yvo
#correction bug 93
#
#Revision 1.17  2005/03/28 13:55:03  yvo
#css
#
#Revision 1.16  2005/03/25 21:38:22  yvo
#nettoyage pour intégration refresh auto
#
#Revision 1.15  2005/03/20 19:01:32  yvo
#mdoif
#
#Revision 1.14  2005/03/19 12:22:21  yvo
#*** empty log message ***
#
#Revision 1.13  2005/03/19 11:21:48  yvo
#vue par défaut sur son troll
#
#Revision 1.12  2005/03/19 10:57:55  yvo
#correction lien + avatar
#
#Revision 1.11  2005/03/16 22:15:06  yvo
#correction
#
#Revision 1.10  2005/03/16 21:25:00  yvo
#avancement
#
#Revision 1.9  2005/03/16 21:01:25  yvo
#avancement
#
#Revision 1.8  2005/03/16 20:31:11  yvo
#radar &agrave; droite
#
#Revision 1.7  2005/03/15 21:53:44  yvo
#ajout radar
#
#Revision 1.6  2005/03/11 20:48:29  yvo
#correction
#
#Revision 1.5  2005/03/11 19:08:50  yvo
#correction
#
#Revision 1.4  2005/03/11 17:46:17  yvo
#del <a
#
#Revision 1.3  2005/03/10 22:11:43  yvo
#modif
#
#Revision 1.2  2005/03/08 21:31:57  yvo
#ajout
#
#Revision 1.1  2005/03/07 22:46:19  yvo
#modif
#
#Revision 1.33  2005/02/15 21:16:46  yvo
#modif
#
#Revision 1.32  2005/01/23 19:49:49  yvo
#pleins de modifs
#
#Revision 1.31  2005/01/17 12:02:01  yvo
#correction bug
#
#Revision 1.30  2005/01/15 18:03:35  yvo
#pleins de changements
#
#Revision 1.29  2005/01/14 11:13:00  yvo
#nouveau
#
#Revision 1.28  2005/01/06 18:04:58  asr
#Modification aspect recherche
#
#Revision 1.27  2004/12/31 07:36:52  yvo
#Informations sur l'utilisation des scripts publics
#
#Revision 1.26  2004/12/27 20:41:18  yvo
#du zolie... ;-)
#
#Revision 1.25  2004/12/27 16:20:53  yvo
#md5
#
#Revision 1.24  2004/12/26 21:57:57  yvo
#Informations sur l'utilisation des scripts publics (popup vue2d, [info 24h]
#
#Revision 1.23  2004/12/19 15:19:45  yvo
#Avancement sur les baronnies. Le centrage refonctionne
#
#Revision 1.22  2004/12/17 23:37:49  yvo
#Informations sur la mise &agrave; jour du quadrillage
#
#Revision 1.21  2004/12/17 11:36:00  yvo
#pleins de modifs, cf forum algo
#
#Revision 1.20  2004/12/12 18:28:01  yvo
#taille de vue publique variable
#suppression des width qui n'affichait pas les monstres, troll pour la vue publique
#
#Revision 1.19  2004/12/11 17:38:57  yvo
#*** empty log message ***
#
#Revision 1.18  2004/12/09 12:08:33  yvo
#pleins de modifs
#
#Revision 1.17  2004/12/07 16:31:05  asr
#Fin de codage du zoom
#
#Revision 1.16  2004/12/07 15:09:05  asr
#Ayé. Le zoom est arrivé
#
#

########################## Déclaration des fonctions

include_once ("inc_connect.php");
include_once ("functions_auth.php");
include_once ("functions.php");
include_once ("admin_functions.php");
include_once ("functions_dev.php");

include_once ("functions_help.php");
require_once('includes/ggc_groupe.class.php');
function initRefresh()
{

	$id_troll = ($_REQUEST["id_troll"] <= 0) ? $_SESSION["AuthTroll"] : $_REQUEST["id_troll"];

	$refresh = $_REQUEST['refresh'];
	
	if ($_REQUEST['refresh'] == 'copie_colle') { 
		
			echo "<script language='JavaScript'>";
			echo "document.location.href='get_vue.php?id_troll=$id_troll'";
			echo "</script>";

	} elseif ($refresh == 's_public')
		$troll = refreshVue($id_troll);
	
}

function afficherOptionsVue2d($info) 
{

	$cX = $info['x_position'];
	$cY = $info['y_position'];
	$cZ = $info['z_position'];
	$taille_vue = $info['taille_vue'];
	$max_pa = $info['max_pa'];
	
	$mytroll = $info['myTroll'];
	$id_troll = $mytroll['id_troll'];

	$zoom=$_REQUEST['zoom'];
	if ($zoom<=0) $zoom=1;
	$anim = $info['anim'];	
	$trolls_disparus = $info['trolls_disparus'];	
	$taille_niveau_z = $info['taille_niveau_z'];	

	?>
<script language='Javascript'>
	function control_id_script_public(){
		myForm = document.select_troll;
		id_troll = myForm.id_troll.value;
		x = myForm.cX.value;
		y = myForm.cY.value;
		z = myForm.cZ.value;
		go_submit = false;

		if (document.getElementById('refresh_ss').checked == true) {
			if (id_troll == "") {
				alert('Vous devez s&eacute;lectionner un Troll Relais&Mago');
			} else {
				go_submit = true;
			}
		} else if (document.getElementById('refresh').checked == true) {
			if ( (x != "") && (y != "") && (z != "") )
				go_submit = true;
			else
				alert('Positions invalides');
		} else {
			go_submit = true;
		}

		if (go_submit == true)
			myForm.submit();
	}
</script>

	<table width='100%' cellspacing='0'>
		<tr class='mh_tdtitre'>
			<td align='center' colspan='3'>Options Vue2d</td>
		</tr>
		<tr class='mh_tdpage'>
			<td>
				<form name='select_troll' method='GET' action='cockpit.php'>
				<input type='hidden' name='vue_refresh' value='oui'>
				<input type='hidden' name='id_troll' size=6 value='<? echo $id_troll ?>'>
			</td>
		</tr>

	<?	
	/*--------------------*/
	echo "<tr><td valign='top'>";
	echo "Centrer sur ";
	echo "</td><td>";
	echo "<input type='text' value='$cX' name='cX' size='2' onChange='javascript:clear_id_troll()'>";
	echo "<input type='text' value='$cY' name='cY' size='2' onChange='javascript:clear_id_troll()'>";
	echo "<input type='text' value='$cZ' name='cZ' size='2' onChange='javascript:clear_id_troll()'>";
	echo "</td><td>";
	afficheAideVueCenterSur();
	echo "</td></tr>";

	/*--------------------*/
	echo "<tr><td>Taille de la vue </td><td>";
	formulaire_listbox("taille_vue",0,LIMITE_MAX_VUE,1,$taille_vue,"moinsplus","",false);
	echo "</td><td>";
	afficheAideVueTailleVue();
	echo "</td></tr>";

	/*--------------------*/
	echo "<tr><td>Limite verticale</td>";
	echo "<td><input type=text name='taille_niveau_z' size=2 value='$taille_niveau_z'></td>";
	echo "<td>";
	afficheAideVueLimiteVerticale();
	echo "</td></tr>";

			
	/*--------------------*/
	echo "<tr><td> Zoom </td>";
	echo "<td><select name='zoom'>";
	// Prototype : afficher_listbox_select($val, $val_to_select,$display="");
	afficher_listbox_select(5.0, $zoom,"toupeti");
	afficher_listbox_select(4.5, $zoom,"=====");
	afficher_listbox_select(4.0, $zoom,"====-");
	afficher_listbox_select(3.6, $zoom,"===--");
	afficher_listbox_select(3.2, $zoom,"==---");
	afficher_listbox_select(2.9, $zoom,"=----");
	afficher_listbox_select(2.6, $zoom,"peti");
	afficher_listbox_select(2.3, $zoom,"-----");
	afficher_listbox_select(2.0, $zoom,"----");
	afficher_listbox_select(1.6, $zoom,"---");
	afficher_listbox_select(1.4, $zoom,"--");
	afficher_listbox_select(1.2, $zoom,"-");
	afficher_listbox_select(1 , $zoom,"Normal");
	afficher_listbox_select(0.9, $zoom,"+");
	afficher_listbox_select(0.8, $zoom,"++");
	afficher_listbox_select(0.7, $zoom,"+++");
	afficher_listbox_select(0.6, $zoom,"++++");
	afficher_listbox_select(0.5, $zoom,"BIG");
	echo "</select></td><td>";
	afficheAideVueZoom();
	echo "</td></tr>";

	/*--------------------*/
	echo "<tr><td>Taille en PA du <br>troll-O-meter </td><td>";
	formulaire_listbox("max_pa",0,LIMITE_MAX_TAILLE_PA,1,$max_pa,"moinsplus","",false);

	echo "</td><td>";
	afficheAideVueTrollometer();
	echo "</td></tr>";

	/*--------------------*/
	echo "<tr><td>Animations </td>";
	echo "<td> <input type='radio' name='anim' value='oui'";
	if ($anim == "oui") echo "CHECKED";
	echo "> oui <input type='radio' name='anim' value='non'";
	if ($anim == "non") echo "CHECKED";
	echo "> non";
	echo "</td><td>";
	afficheAideVueAnimation();
	echo "</td></tr>";

	/*--------------------*/
	echo "<tr><td>Trolls disparus </td>";
	echo "<td nowrap> <input type='radio' name='trolls_disparus' value='oui'";
	if ($trolls_disparus == "oui") echo "checked";
	echo "> afficher <input type='radio' name='trolls_disparus' value='non'";
	if ($trolls_disparus == "non") echo "checked";
	echo "> cacher";
	echo "</td><td>";
	afficheAideVueTrollsDisparus();
	echo "</td></tr>";
	
	/*--------------------*/
	echo "<tr><td valign='top' nowrap>";
	echo "Rafraîchir la vue</td>";
	echo "<td valign='top' nowrap>";

	echo "<input type='radio' id='refresh' name='refresh' value='non' checked>";
	echo "non <br>";

	echo "<input type='radio' id='refresh_cc' name='refresh' value='copie_colle'>";
	echo "copier/coller <br>";
	
	echo "<input type='radio' id='refresh_ss' name='refresh' value='s_public' >";
	echo "scripts publics <br>";

	echo "</td>";
	echo "<td valign='top' nowrap>";
	echo "<br><br>";

	afficheAideVueCopierColler();
	informationImportanteScriptsPublics($id_troll);
	echo "<br>";
	afficheAideVueRefreshPublic();
	vue2d_afficher_utilisation_scripts_publics($id_troll);
	echo "</td>";
	echo "</tr>";
	?>
		<tr>
			<td colspan='3' align='center'>
				<input type='button' name='button' class='mh_form_submit' value='On y va !' onClick='javascript:control_id_script_public()'> &nbsp;
				<input type='reset' name='reset' class='mh_form_submit' value='Par d&eacute;faut'>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
  </form>
<?

}

function initVue2d($tab_cookies)
{
 	$options = $_SESSION["options"];
	$vue_taille_option = $options["vue_taille_option"];
	$vue_zoom_option = $options["vue_zoom_option"];
	$vue_max_pa_option = $options["vue_max_pa_option"];

	if (isset($_REQUEST['id_troll'])) $id_troll = $_REQUEST['id_troll']; else $id_troll = "";
	if (isset($_REQUEST['taille_vue'])) $nCasesVue = $_REQUEST['taille_vue']; else $nCasesVue = "";
	if (isset($_REQUEST['max_pa'])) $max_pa = $_REQUEST['max_pa']; else $max_pa = "";
	if (isset($_REQUEST['taille_niveau_z'])) $taille_niveau_z = $_REQUEST['taille_niveau_z']; else $taille_niveau_z = "";

	if (isset($_REQUEST['cX'])) $cX = $_REQUEST['cX']; else $cX = "";
	if (isset($_REQUEST['cY'])) $cY = $_REQUEST['cY']; else $cY = "";
	if (isset($_REQUEST['cZ'])) $cZ = $_REQUEST['cZ']; else $cZ = "";

	if (! is_numeric($nCasesVue))  {
		$nCasesVue = $vue_taille_option; //$nCasesVue = LIMITE_VUE_DEFAUT;
	}

	if ($nCasesVue < 1) 
		$nCasesVue = $vue_taille_option; //$nCasesVue = LIMITE_VUE_DEFAUT;
	elseif ($nCasesVue > LIMITE_MAX_VUE)
		$nCasesVue = LIMITE_MAX_VUE;

	if ($max_pa < 1) 
		$max_pa = $vue_max_pa_option; //$max_pa = LIMITE_TAILLE_PA_DEFAUT;
	elseif ($max_pa > LIMITE_MAX_TAILLE_PA)
		$max_pa = LIMITE_MAX_TAILLE_PA;

	// si l'on a demandé une recherche dans le cockpit, on retourne de suite
	if (isset($_REQUEST['recherche']) && $_REQUEST['recherche'] != "") {
	  $tab['taille_niveau_z'] = $taille_niveau_z;
	  $tab['max_pa'] = $max_pa;
	  $tab['taille_vue'] = $nCasesVue;
	  $tab['x_position'] = $cX;
	  $tab['y_position'] = $cY;
	  $tab['z_position'] = $cZ;
	 // $tab[id_troll] = $id_troll;
	  return $tab;
	}

  if (($id_troll == 0) && ($cX=="" || $cY == "" || $cZ == "")) { 	 
		die("<b><font color='red'>Pas de vue disponible.</font></b>");
	} else { 	 
		
		$trolls_disparus = $tab_cookies['trolls_disparus'];
//		$taille_niveau_z = $tab_cookies['taille_niveau_z'];
		
		$tabinfo = parseZone($id_troll,$cX,$cY,$cZ,$nCasesVue,$max_pa,$trolls_disparus);

		$tabinfo['anim'] = $tab_cookies['anim'];
	  	$tabinfo['taille_niveau_z'] = $taille_niveau_z;
//		$tabinfo['taille_niveau_z'] = $taille_niveau_z;

		return $tabinfo;
	}
}

function afficher_vue2d($info) 
{
	$zoom = $_REQUEST['zoom'];
	$info['zoom'] = $zoom;

	$taille_vue = $info['taille_vue'];
	$x_position = $info['x_position'];
	$y_position = $info['y_position'];
	$z_position = $info['z_position'];
	$max_pa = $info['max_pa'];
	$taille_niveau_z = $info['taille_niveau_z'];
	$mytroll = $info['myTroll'];
	$id_troll = $mytroll['id_troll'];

	$min_x = $x_position - $taille_vue;
	$max_x = $x_position + $taille_vue;
	$min_y = $y_position - $taille_vue;
	$max_y = $y_position + $taille_vue;

	if (is_numeric($taille_niveau_z)) {
		$min_z = $z_position - $taille_niveau_z;
		$max_z = $z_position + $taille_niveau_z;
	} else {
		$min_z = floor($z_position-($taille_vue)/2);
		$max_z = ceil($z_position+($taille_vue)/2);
	}
	//vue2d_afficher_baniere_position($x_position,$y_position,$z_position,$taille_vue,$mytroll);
	
	if (is_numeric($taille_niveau_z))
		vue2d_afficher_navigation_niveau($x_position,$y_position,$z_position,$taille_vue,$max_pa,$taille_niveau_z);

	//if ($taille_vue > LIMITE_CASES_BROUILLARD)
	//@	vue2d_afficher_baniere_brouillard();

	if ( userIsGuilde() )
		vue2d_afficher_baronnie($min_x,$max_x,$min_y,$max_y,$min_z,$max_z,$info[t_baronnies]);
	vue2d_afficher_zone_haut($x_position,$y_position,$z_position,$taille_vue,$mytroll);
	vue2d_afficher_zone_centre($min_z,$max_z,$info);
	vue2d_afficher_zone_bas($x_position,$y_position,$z_position,$taille_vue,$mytroll);
	
	/* le trollometer si c'est le cockpit uniquement */
	if ( ( userIsGuilde() && preg_match("/cockpit-old/",$_SERVER["REQUEST_URI"]) ) ||
	     ( !userIsGuilde() ))
		vue2d_afficher_trollometer($info);

	if ( userIsGuilde() && preg_match("/cockpit-old/",$_SERVER["REQUEST_URI"]) )
		vue2d_afficher_legende();

}


#######################################
# Voir l'utilisation des scripts publics
######################################
function vue2d_afficher_utilisation_scripts_publics($id_troll)
{
  global $DEV, $db_vue_rm;

  if ($id_troll == "")
    return;

  $sql = "SELECT date_refresh, by_me_refresh FROM refresh_count";
  $sql .= " WHERE id_troll_refresh = $id_troll";
  $sql .= " AND categorie_refresh= 'classiques'";
  $sql .= " AND script_name_refresh = 'SP_Vue2'";
  $sql .= " ORDER BY date_refresh DESC";

  if ($DEV) echo "DEBUG vue2d_afficher_utilisation_scripts_publics() $sql <br>\n";
  $result=mysql_query($sql,$db_vue_rm);

  echo mysql_error();

  $titre = "<font color=red>Utilisation des scripts publics depuis 24 heures</font><br>";
  $text = "Troll : $id_troll<br>";
	
  while (list($date_refresh, $by_me_refresh)=mysql_fetch_array($result))
  {
    $info = "";
    if ($by_me_refresh == 'non')
      $info = " <font color=green> Par un troll de la guilde</font>";
    $text .= "Le $date_refresh $info<br>";
    $nb++;
  }
  if ($nb == 0)
    $text .= "Aucune utilisation depuis 24 heures<br>";
  else
    $text .= "<font color=white>Soit $nb utilisation(s)</font><br>";

	$text .= "<br>Info concernant les refresh avec les scripts publics : <br>";
	$text .= "Un troll peut rafraichir sa vue ".NB_REFRESH_VUE_2D_BY_TROLL." en 24 heures.<br>";
	$text .= "Les refresh automatiques peuvent refraichir la vue d'un troll<br>";
	$text .= "au maximum ".NB_REFRESH_VUE_2D_BY_GUILDE." fois en 24 heures<br><br>";
	$text .= "Un troll qui rafraichit la vue d'un autre troll est consid&eacute;r&eacute;<br>";
	$text .= "comme &eacute;tant un refresh <font color=green> Par un troll de la guilde</font><br>";
	$text .= "tout comme les refresh autos.<br><br>";
	
	$ex_nb_troll = NB_REFRESH_VUE_2D_BY_TROLL - NB_REFRESH_VUE_2D_BY_GUILDE;
	$ex_nb_guilde = NB_REFRESH_VUE_2D_BY_GUILDE ;
	$text .= "Exemple : Si un troll rafraichit sa vue $ex_nb_troll fois, qu'il s'est fait<br>";
	$text .= "rafraichir sa vue par un troll de la guilde $ex_nb_guilde fois, alors il <br>";
	$text .= "ne peut plus refraichir sa vue avec les scripts publics<br>";


  $puce = "<b><font color=green>[24h]</font></b>";
	affiche_popup($titre, "yellow", $text,$puce);
}

function vue2d_afficher_baniere_position($x_position,$y_position,$z_position,$taille_vue,$myTroll)
{
	echo "<br><table class='mh_tdborder' width='60%' align='center' cellspacing='0'>";

	/*  Info sur la date de la maj de la position du troll */
	if (( userIsGuilde() ) && ($myTroll['id_troll'] != "")) {
		echo "<tr class='mh_tdpage'>";
		echo "<td nowrap align='center' colspan='4'>";
		if ($myTroll[id_troll] != "") {
			echo "Position de $myTroll[nom_troll] ($myTroll[id_troll]) (mise &agrave; jour le ";
			echo "<b>".date("d/m/Y H:i", $myTroll[date_troll])."</b>";
			echo " : il y a " .calcElapsedTime($myTroll[date_troll]);
		}
		echo ")</td></tr>";
	}
	echo "<tr class='mh_tdpage'>";
	if ($myTroll[id_troll] != "") {
		echo "<td width='5%'>";
		echo "<img src='images/avatars/$myTroll[nom_image_troll]_avatar.gif' width='54' height='54'>";
		echo "</td>";
	}
	?>
			<td width='50%'>
				<b>Position :</b> x=<b><? echo $x_position ?></b> ; y=<b><? echo $y_position ?></b> ; z=<b><? echo $z_position ?></b>
				<br>
				<b>Vue :</b><? echo $taille_vue ?>
			</td>
			<td width='5%'>
				<font size=1><a href='#trollometer'>Trollometer</a><br>
			</td>
		</tr>
	</table>
	<?	
}

function vue2d_afficher_baniere_brouillard()
{
	?><br>
		<table class='mh_tdborder' align='center' width='60%'>
			<tr class='mh_tdpage'>
				<td align='center'>
					La taille de vue est sup&eacute;rieure &agrave; 10, le brouillard de guerre est d&eacute;sactiv&eacute;.<br>
					Pour voir la date de mise &agrave; jour d'une caverne, cliquez dessus pour fixer la popup.
					Puis &agrave; côt&eacute; de <i>inconnu</i> &agrave; un niveau donn&eacute;, cliquez sur <img src='images/puce_vue2d.gif'> pour centrer la vue dessus.
					avec une taille de 3.
				</td>
			</tr>
		</table>
	<?
}

function vue2d_afficher_baronnie($min_x,$max_x,$min_y,$max_y,$min_z,$max_z,$baronnies)
{
	if (( userIsGuilde() ) && ($baronnies)) {
	  $i = 1;
		$text = "";
	  foreach ($baronnies as $baronnie2) {
	    foreach ($baronnie2 as $baronnie3) {
	      foreach ($baronnie3 as $baronnie) {
			    if (($baronnie['x_deb_baronnie'] <= $max_x) && ($baronnie['x_fin_baronnie'] >= $min_x) &&
		        	($baronnie['y_deb_baronnie'] <= $max_y) && ($baronnie['y_fin_baronnie'] >= $min_y) &&
							($baronnie['z_deb_baronnie'] <= $max_z) && ($baronnie['z_fin_baronnie'] >= $min_z)
						)
					{
			       $text .= "<img src='$baronnie[img_drapeau_baronnie]' border=0 >";
			       $text .= "Vous êtes sur les terres de la Baronnie ";
			       $text .= "<a href='$page?baronnie=$baronnie[id_baronnie]'>".stripslashes($baronnie['nom_baronnie'])."</a>, tron&eacute;e par ";
			       $text .= "<a href='$page?troll=$baronnie[id_baron_baronnie]'>$baronnie[nom_baron]</a>.";
			       $text .= " Trone en x=$baronnie[x_trone_baronnie],y=$baronnie[y_trone_baronnie],z=$baronnie[z_trone_baronnie] <br>";
			       $i++;
					}
	      }
	    }
	  }
	}
	if ($text != "") {
  	echo "<br><table class='mh_tdborder' width='80%' align='center' cellspacing='0'><tr class='mh_tdpage'><td>";
		echo $text;
		echo "</td></tr></table>";
	}
	echo "<br>";
}

function vue2d_afficher_zone_haut($x_position,$y_position,$z_position,$taille_vue,$myTroll)
{
	if ( userIsGuilde() ) {
		$ggc_groupe = new ggc_groupe();
		$ggc_groupe->read_db_by_id_troll($myTroll[id_troll]);
		$ggc_membres = $ggc_groupe->get_db_list_membres();
	}
 ?>
	<table class='mh_tdborder' width='80%' align='center'>
		<tr valign="top">
			<td colspan='3' class='mh_tdpage' align='center'>

			<table width="100%">
				<tr valign="top">
				<td valign='center' align='center' class='mh_tdtitre' width="30%">
					<?
					
					if ( userIsGuilde() ) {
						if ($ggc_groupe->get_id_groupe())
							echo "<a href='/ggc/groupe.php?id_groupe=".$ggc_groupe->get_id_groupe()."'>".$ggc_groupe->get_nom_groupe()."</a>";
						else
							echo $ggc_groupe->get_nom_groupe();

						echo "<table>";

						for ($i=1; $i<=count($ggc_membres); $i+=3) {
							$troll = $ggc_membres[$i];
							$troll2 = $ggc_membres[$i+1];
							$troll3 = $ggc_membres[$i+2];
							echo "<tr class='mh_tdpage' >";
							echo "<td>";
							info_membre_ggc($troll);
							echo "</td>";
							echo "<td>";
							info_membre_ggc($troll2);
							echo "</td>";
							echo "<td>";
							info_membre_ggc($troll3);
							echo "</td>";
							echo "</tr>";
						}
						echo "</table>";
					}
					?>
			</td>

					<td align='center' width="30%">
				<img src='images/shim.gif' height='20px'>
				
				<?
				if ( userIsGuilde() ) {
					?>
					x<input type='text' value='<?=$x_position ?>' name='cX' size='2'>
					y<input type='text' value='<?=$y_position ?>' name='cY' size='2'>
					z<input type='text' value='<?=$z_position ?>' name='cZ' size='2'>
					<input type='button' onClick='get_map_center();' value='>' class="mh_form_submit">
					<?
					afficheAideVueCenterSur();
					
					if ($myTroll[nom_troll] != "") {
						echo "<br>Position de ".htmlentities($myTroll[nom_troll])." ($myTroll[id_troll]) <br>maj: ";
						echo date("d/m H:i", $myTroll[date_troll]);
						echo ", il y a " .calcElapsedTime($myTroll[date_troll]);
					}
				}	
				?>
				</td>
				<td width="5%" align="right">
					Radar 
					<?
					affiche_popup("radar", "yellow", afficherCockpitRadar());	
					?>
				</td>
				<td width="30%" align="right">
				<?
				if ( userIsGuilde() ) {
				?>
				<table class='mh_tdborder'>
					<tr align='center'  class='mh_tdtitre' align="center">
						<td>
							<a href='#' onClick='document.form_cockpit.cX.value=<?=$x_position - $taille_vue;?>;document.form_cockpit.cY.value=<?=$y_position + $taille_vue;?>;get_map_center();'>Haut Gauche</a>
						</td>
						<td>
							<a href='#' onClick='document.form_cockpit.cY.value=<?=$y_position + $taille_vue;?>;get_map_center();'>Haut</a>
						</td>
						<td>
							<a href='#' onClick='document.form_cockpit.cX.value=<?=$x_position + $taille_vue;?>;document.form_cockpit.cY.value=<?=$y_position + $taille_vue;?>;get_map_center();'>Haut Droit</a>
						</td>
					</tr>
					<tr class='mh_tdtitre' align="center">
						<td>
							<a href='#' onClick='document.form_cockpit.cX.value=<?=$x_position - $taille_vue;?>;get_map_center();'>Gauche</a>
						</td>
						<td>
							<a href='#' onClick='document.form_cockpit.cX.value=<?=$myTroll[x_troll]?>;document.form_cockpit.cY.value=<?=$myTroll[y_troll]?>;get_map_center();'><?=$myTroll[id_troll]?></a>
						</td>
						<td>
							<a href='#' onClick='document.form_cockpit.cX.value=<?=$x_position + $taille_vue;?>;get_map_center();'>Droit</a>
						</td>
					</tr>
			<tr class='mh_tdtitre' align="center">
						<td>
							<a href='#' onClick='document.form_cockpit.cX.value=<?=$x_position - $taille_vue;?>;document.form_cockpit.cY.value=<?=$y_position - $taille_vue;?>;get_map_center();'>Bas Gauche</a>
						</td>
						<td>
							<a href='#' onClick='document.form_cockpit.cY.value=<?=$y_position - $taille_vue;?>;get_map_center();'>Bas</a>
						</td>
						<td>
							<a href='#' onClick='document.form_cockpit.cX.value=<?=$x_position + $taille_vue;?>;document.form_cockpit.cY.value=<?=$y_position - $taille_vue;?>;get_map_center();'>Bas Droit</a>
						</td>
					</tr>
				</table>
				</td>
				</tr>
				
				</table>
				<? } ?>
			</td>
		</tr>
		<tr>
			<td class='mh_tdpage' valign="top">
		<table valign="top"><tr>
			<td class='mh_tdpage'>
		&nbsp;
		</td>
		</tr>
		<tr>
			<td class='mh_tdpage'>
	
				<img src='images/shim.gif' width='20px'>
				<?
					if ( userIsGuilde() ) {
					?>
					<input type='button' onClick='document.form_cockpit.pcenter.value="oui";document.form_cockpit.cX.value=<?=$x_position - $taille_vue;?>;get_map_center();' value="<< X-<?=$taille_vue?>" class='mh_form_submit'>
				<? } ?>
			</td>
		</tr>
		</table>
		</td>
			<td class='mh_tdpage' width='80%'>

			<table class='tableVue' border='0' cellpadding=0 cellspacing=0>
	<?
}

function vue2d_afficher_zone_bas($x_position,$y_position,$z_position,$taille_vue,$mytroll)
{
	?>
			</table>
		</td>
		<td class='mh_tdpage' valign="top">
		
			<img src='images/shim.gif' height='20px'>
		<?
		if ( userIsGuilde() ) {
		?>
		<table valign="top"><tr>
			<td class='mh_tdpage'>
<br>
<a href='#' onClick='document.form_cockpit.zoom.value=0.8;document.form_cockpit.taille_vue.value=3;get_map_center();'>Mioppe</a>
<br>
<a href='#' onClick='document.form_cockpit.zoom.value=1;document.form_cockpit.taille_vue.value=3;get_map_center();'>Normal</a>
<br>
<a href='#' onClick='document.form_cockpit.zoom.value=2.6;document.form_cockpit.taille_vue.value=8;document.form_cockpit.anim="non";get_map_center();'>Grand</a>
<br>
<a href='#' onClick='document.form_cockpit.zoom.value=4.5;document.form_cockpit.taille_vue.value=12;document.form_cockpit.anim="non";get_map_center();'>Enorme</a>
<br>
		</td>
		</tr>
		<tr>
	
		<td class='mh_tdpage'>
			<img src='images/shim.gif' width='20px'>
			<input type='button' onClick='document.form_cockpit.cX.value=<?=$x_position + $taille_vue;?>;get_map_center();' value='>> X+<?=$taille_vue?>' class='mh_form_submit'>
		</td>
	</tr>
	</table>
	<? } ?>
	</tr>
	<tr>
		<td colspan='3' class='mh_tdpage' align='center'>
		<?
		if ( userIsGuilde() ) {
		?>
			<input type='button' onClick='document.form_cockpit.cY.value=<?=$y_position + $taille_vue;?>;get_map_center();' value='Bas Y-<?=$taille_vue?>' class='mh_form_submit'>

	<? } ?>
		</td>
	</tr>
	</table>
	<br><br>
<?php
}

function info_membre_ggc($troll) {
	if (isset($troll)) {
			$date = mktime(date("H"), 0, 0, date("m"), date("d"), date("Y"));

			//echo $troll[troll]->get_nom_troll(). " ";
			$text = "Position : ".$troll[troll]->get_x_troll().",".$troll[troll]->get_y_troll().",".$troll[troll]->get_z_troll()."<br>";
			$text .= "PV : ".$troll[pv_actuel]."/".$troll[pv_max]."<br>";
			$text .= "Maj GGC: ".date("j/m H:i",$troll[date_maj])."<br>";
			$pa= $troll[pa];
			$dla1= $troll[dla1];
			$dla2= $troll[dla2];
			$dla3= $troll[dla3];

			$img = "/ggc/graph.php?date=$date&dla=$dla1&dla2=$dla2&dla3=$dla3&pa=$pa";
			$text .= "<img src=$img>";
			affiche_popup("info", "yellow", $text, $troll[troll]->get_nom_troll());
	}
}

function vue2d_afficher_zone_centre($min_z,$max_z,$info)
{
	$taille_vue = $info['taille_vue'];
	$x_pos = $info['x_position'];
	$y_pos = $info['y_position'];
	$z_pos = $info['z_position'];
	$zoom = $info['zoom'];

	$myTroll = $info['myTroll'];
	$id_troll = $myTroll['id_troll'];

	$wtab=100;
	$htab=89;
	if (($zoom>0) and ($zoom<=5)) {
		$wtab=$wtab/$zoom;
		$htab=$htab/$zoom;
	} else $info['zoom'] = 1;


	for ($ay=$y_pos+$taille_vue; $ay>=$y_pos-$taille_vue; $ay--) {
	  echo "<tr>\n";
	  for ($ax=$x_pos-$taille_vue; $ax<=$x_pos+$taille_vue; $ax++) {
			vue2d_afficher_zone_centre_td_start($x_pos,$y_pos,$z_pos,$ax,$ay,$wtab,$htab,$info['t_quadrillage'],$info['taille_vue'],$info['t_laby']);

			$text = "";
	  	for ($az=$max_z; $az>=$min_z; $az--) {
				$text_niveau = "<font color=#ffa800><b>Niveau $az</b></font> ";
				
				if ( userIsGuilde() )
					$text_niveau_lien = afficherLien('centrage_vue','vue2d',"",$ax,$ay,$az,"",false);
					
				$text_data = "";

				#$brouillard = vud2d_get_popup_quadrillage($ax,$ay,$az,$info['t_quadrillage']);
				//$text_data .= vud2d_get_popup_quadrillage($ax,$ay,$az,$info['t_quadrillage']);
				$text_data .= vue2d_get_popup_trolls($ax,$ay,$az,$info['t_trolls']);
				$text_data .= vue2d_get_popup_monstres($ax,$ay,$az,$info['t_monstres']);
				$text_data .= vue2d_get_popup_lieux($ax,$ay,$az,$info['t_lieux']);
				$text_data .= vue2d_get_popup_tresors($ax,$ay,$az,$info['t_tresors']);
				$text_data .= vue2d_get_popup_champignons($ax,$ay,$az,$info['t_champignons']);
				$text_data .= vue2d_get_popup_baronnies($ax,$ay,$az,$info['t_baronnies']);
				
				if ($text_data != "")
					$text .= $text_niveau.$brouillard.$text_niveau_lien."<br>".$text_data."<br>";
					
			}

			vue2d_afficher_zone_centre_td_start_end($text);
			vue2d_afficher_zone_centre_td_div_haut($ax,$ay,$max_z,$max_z,$info['t_baronnies']);
			vue2d_afficher_zone_centre_td_div_milieu($ax,$ay,$min_z,$max_z,$wtab,$htab,$info);
			vue2d_afficher_zone_centre_td_end();
		}
		echo "</tr>";
	}
}

function vue2d_afficher_zone_centre_td_start($x_pos,$y_pos,$z_pos,$ax,$ay,$wtab,$htab, $quadrillage,$taille,$laby)
{
	
	if ($laby[$ax+100][$ay+100] ) {
		foreach($laby[$ax+100][$ay+100] as $lab) {
			$type = $lab['type'];
			echo "<td height='30' class='$type";
		}
	}
	else {
    	echo "<td height=30 class='tableVue";
	}
    if ( ($x_pos == $ax) && ($y_pos == $ay) ) 
			echo " actif";

    # Couleurs des cases avec la date de refresh
		#$delais =  $quadrillage["$ax"]["$ay"]["$z_pos"]["delais"];

    #if ( !userIsGuilde() ) echo "";
    echo "";
    #elseif ($taille > LIMITE_CASES_BROUILLARD) echo " "; 
    #elseif ($delais == "") echo " inconnu l$delais l"; 
    #elseif ($delais < 1) echo " ";
    #elseif ($delais < 2) echo " h";
    #elseif ($delais < 3) echo " hh";
    #elseif ($delais < 4) echo " hhh";
    #elseif ($delais < 5) echo " hhhh";
    #elseif ($delais >= 5) echo " inconnu";
    echo "' ";

    echo " width=$wtab height=$htab valign=top align=left ";
}

function vue2d_afficher_zone_centre_td_start_end($text)
{
	if ($text != "") {
		echo " onmouseover=\"return overlib('$text',CAPTION,'Clique !');\"";
		echo " onclick=\"return overlib('$text', STICKY, CAPTION, 'Informations', CLOSECLICK, EXCLUSIVE);\" ";
		echo " onmouseout=\"return nd();\"";
	}
	echo ">";

}

function vue2d_afficher_zone_centre_td_div_haut($ax,$ay,$max_x,$max_z,$baronnies)
{
  echo "<div class='caseNum'>";
  echo "$ax,$ay ";

  $i = 1;
	// Pas tr&egrave;s jolie, mais fonctionnel. Tant qu'il n'y a pas 100 baronnies...
	// Affichage des mini blason des baronnies
	if ($baronnies) {
		foreach ($baronnies as $baronnie2) {
	    foreach ($baronnie2 as $baronnie3) {
	      foreach ($baronnie3 as $baronnie) {
	        $list_baronnies[$i] = $baronnie;
	        $i++;
				}
			}
		}
	}

  for ($k=1;$k<=count($list_baronnies);$k++) {
    if (($list_baronnies[$k]['x_deb_baronnie'] <= $ax) && ($list_baronnies[$k]['x_fin_baronnie'] >= $ax) &&
        ($list_baronnies[$k]['y_deb_baronnie'] <= $ay) && ($list_baronnies[$k]['y_fin_baronnie'] >= $ay) &&
				($list_baronnies[$k]['z_deb_baronnie'] <= $max_z) && ($list_baronnies[$k]['z_fin_baronnie'] >= $min_z)
				) 
		{
		  $text .= "Terres de la Baronnie ";
		  $text .= stripslashes($baronnie['nom_baronnie']);
   		echo "<img src='".$list_baronnies[$k]['img_mini_blason_baronnie']."' title='$text'>";
		//print_r($list_baronnies[$k]);
		}
  }

   ?>
  </div>
	<?
}


function vue2d_afficher_zone_centre_td_div_milieu($ax,$ay,$min_z,$max_z,$wtab,$htab,$info)
{
	?>
	<div class='contenu'>
		<img src="images/shim.gif" width=<? echo $wtab;?> height=1 alt=""><br>
		<img src="images/shim.gif" width=1 height=<? echo $htab;?> align=right alt="">
	<?
	$anim=$info[anim];
	vue2d_afficher_get_image_trolls($ax,$ay,$info['t_trolls'],$min_z,$max_z,$info['zoom'],$anim);
	vue2d_afficher_get_image_monstres($ax,$ay,$info['t_monstres'],$min_z,$max_z,$info['zoom'],$anim);
	vue2d_afficher_get_image_lieux($ax,$ay,$info['t_lieux'],$min_z,$max_z,$info['zoom'],$anim);
	vue2d_afficher_get_image_tresors($ax,$ay,$info['t_tresors'],$min_z,$max_z,$info['zoom'],$anim);
	vue2d_afficher_get_image_champignons($ax,$ay,$info['t_champignons'],$min_z,$max_z,$info['zoom'],$anim);
	vue2d_afficher_get_image_baronnies($ax,$ay,$info['t_baronnies'],$min_z,$max_z,$info['zoom'],$anim);
}

function vue2d_afficher_zone_centre_td_end()
{
	?>
		</div> <!-- fin div class=contenu -->
	</td>
	<?
}

function vud2d_get_popup_quadrillage($ax,$ay,$az,$quadrillage)
{
	if ( !userIsGuilde() )
		return;

	$delais =  $quadrillage["$ax"]["$ay"]["$az"]["delais"];
	$last_seen =  $quadrillage["$ax"]["$ay"]["$az"]["last_seen"];

	if ($delais <= 1) $jours = "jour";
	else $jours = "jours";

	if (($delais == "") || ($delais > 5)) $text .= " inconnu"; 
	else {
		$text .= " ($delais $jours - ";
		$text .= date ("d/m H:i", ($last_seen));
		$text .= ")";
	}

	return $text." ";
}

function vue2d_get_popup_trolls($ax,$ay,$az,$trolls)
{
	if (!$trolls[$ax+100][$ay+100] )
		return;
		

	foreach ($trolls[$ax+100][$ay+100] as $troll) {

		if ($troll[z] == $az) {
			//$nom=preg_replace("/'/","_",$troll[nom]);
			$nom = addslashes($troll['nom']);
			$nom = $nom;
			if ( ($nom == "moi") && ($troll['id'] == -1)) {
				$nom = "Je suis l&agrave; !";
				$text .= "<span class=trollText>".$nom;
				$text .= " [$troll[race] $troll[level]] $troll[malade] ";
			} else {
				if ($troll['is_seen'] == 'non') {
					$text .= "<span class=invisible>";
				} else {
					$text .= "<span class=trollText>";
				}
				$text .= htmlentities($nom);
				$text .= " [$troll[race] $troll[level]] ($troll[id]) $troll[malade] ";
			}

			if ( userIsGuilde() ) {
				if ($troll['is_seen'] == 'non') {
					$text .= " (disparu ";
					$text .= date ("d/m H:i", $troll['date_troll']);
					$text .= ") ";
				} 
				$text .= afficherLien('troll','vue2d',$troll['id'],"","","","",false);
				$text .= afficherLien('troll','fiche',$troll['id'],"","","","",false);
			}

			$text .= afficherLien('troll','mh_evenements',$troll['id'],"","","","",false);

			$text .= "</span><br>";
		}
	}
	return $text;
}

function vue2d_get_popup_monstres($ax,$ay,$az,$monstres)
{
	if (!$monstres[$ax+100][$ay+100])
		return;
	foreach ($monstres[$ax+100][$ay+100] as $monstre) {
		if ($monstre[z] == $az) {
			$nom = htmlentities(addslashes($monstre['nom']));
			$text .= "<span class=streumText>".$nom." (<a href=#$monstre[id]></a>$monstre[id]) ";

			// Si c'est un gowap de la guilde, on affiche le proprio
			if ( userIsGuilde() ) {
				if ($monstre['id_troll_gowap'] != "" ) {
					$text .= htmlentities(" Appartient &agrave; ".addslashes($monstre['nom_troll']));
					$text .= afficherLien('gowap','fiche',$monstre['id'],"","","","",false);
				}

				if ($monstre['recherche'] != "")
					$text .= " recherch&eacute; !";
			}

			if ( userIsGuilde() ) {
				preg_match("/(.+) \[(.+)\]/",$monstre['nom'],$resultat);

				// Lien vers le bestiaire
				$nom = preg_replace("/'/","%27",$resultat[1]);
				$age = preg_replace("/'/","%27",$resultat[2]);
				$urle = "Monstre=$nom&age=$age";

				$text .= " <a href=\'/bestiaire2/bestiaire.php?$urle\' title=Bestiaire";
				$text .= "<img src=images/puce_bestiaire.gif border=0></a>";
			}
	
			$text .= afficherLien('monstre','mh_evenements',$monstre[id],"","","","",false);
	
			$text .= "</span><br>";
  	}
	}
	return $text;
}

function vue2d_get_popup_lieux($ax,$ay,$az,$lieux)
{
	if (!$lieux[$ax+100][$ay+100] )
		return;

	foreach ($lieux[$ax+100][$ay+100] as $lieu) {
		if ($lieu[z] == $az) {
			$text .= "<span class=lieuxText>";
			if (preg_match("/Tani.re de (.*)/",$lieu['nom'],$matches)) {	
			// nothing
			} elseif (preg_match("/.*\((\d+)\)$/",chop($lieu['nom']),$matches)) {
				$text .= "[GT] ";
			}
			$text .= htmlentities(addslashes(htmlentities($lieu['nom'])));
//			$text .= " ($lieu[id]) "; 

			// Si c'est une tanni&egrave;re de la guilde, on affiche le proprio
			if ( userIsGuilde() ) {
				if ($lieu['id_info'] != "" ) {
					$text .= htmlentities(" Appartient &agrave; ".addslashes($lieu['id_info']));
				}
			}
			$text .= "</span><br>"; 
		}
	}
	return $text;
}

function vue2d_get_popup_tresors($ax,$ay,$az,$tresors)
{
	if(!$tresors[$ax+100][$ay+100])
		return;

	foreach ($tresors[$ax+100][$ay+100] as $objet) {
		if ($objet[z] == $az) {
			//$nom = preg_replace("/'/","_",$objet[nom]);
			$nom = htmlentities(addslashes($objet['nom']));
			$text .= "<span class=cameText>".$nom." ($objet[id]) ";
			$text .= "</span><br>";
		}
	}
	return $text;
}

function vue2d_get_popup_champignons($ax,$ay,$az,$champignons)
{
	if (!$champignons[$ax+100][$ay+100])
		return;

	foreach ($champignons[$ax+100][$ay+100] as $champi) {
		if ($champi[z] == $az) {
			//$nom = preg_replace("/'/","_",$champi[nom]);
			$nom = htmlentities(addslashes($champi['nom']));
			$text .= "<span class=champiText>".$nom." ($champi[id]) ";
			$text .= "</span><br>";
		}
	}
	return $text;
}

function vue2d_get_popup_baronnies($ax,$ay,$az,$baronnies)
{
	if (!$baronnies[$ax+100][$ay+100])
		return ;

	foreach ($baronnies[$ax+100][$ay+100] as $baronnie) {
		if ( ($baronnie['z_trone_baronnie'] == $az) ) {
			$nom_baronnie = htmlentities(addslashes($baronnie['nom_baronnie']));
			$text .= "<span class=baronnieText>Trone de la baronnie ".stripslashes($nom_baronnie)."<br>";
			$text .= "</span><br>";
		}
	}
	return $text;
}

function vue2d_afficher_get_image_trolls($ax,$ay,$trolls,$min_z,$max_z,$zoom,$anim)
{
	global $imgSizes;
	
	$n_trolls = 0;
	unset($img);

	$is_guilde="";
	$is_malade="";
	$id_tk="";

	if ($trolls[$ax+100][$ay+100]) {
		foreach ( $trolls[$ax+100][$ay+100] as $troll ) {
			if (($troll[z] >= $min_z) && ($troll[z] <= $max_z)) {
				echo "<a name='$troll[id]'></a>\n"; # On pose les balises d'cc&egrave;s direct
				$tab=imgTroll($troll);

				if ($tab["is_malade"] != "")
					$is_malade = $tab["is_malade"];
				
				if ($tab["is_tk"] != "")
					$is_tk = $tab["is_tk"];

				if ($tab["is_guilde"] != "")
					$is_guilde = $tab["is_guilde"];

				$img = $tab["img"];
				$n_trolls++;
			}
		}
	}

	if ($n_trolls>=1) {
		echo "<img alt='images/$img' src='";
		if ($anim == 'oui') {
			if ($n_trolls>1) {
				$img="groupe$is_guilde$is_malade$is_tk"; 
				echo "images/$img.gif";
			} else {
				echo "images/$img.gif";
			}
		} else {
			if ($n_trolls>1) {
				$img="groupe$is_guilde$is_malade$is_tk"; 
				echo "images/$img.gif";
			} else {
				echo "images/$img-fixe.gif";
			}
		}
		echo "' width='";
		echo $imgSizes["$img"][0]/$zoom;
		echo "' border=0>\n";
	}
}

function vue2d_afficher_get_image_monstres($ax,$ay,$monstres,$min_z,$max_z,$zoom,$anim)
{
	global $imgSizes;
	
	$recherche='';
	$img="";
	$n_monstres = 0;
	$gowap = 0;
	$rm = "";
	$liche = false;

	if ($monstres[$ax+100][$ay+100] ) {
		foreach ($monstres[$ax+100][$ay+100] as $objet) { 
			echo "<a name='$objet[id]'></a>";
			if ( ($objet[z] >= $min_z) && ($objet[z] <= $max_z) ) {
				$tab = imgStreum($objet);

				if  ($tab["recherche"] != "")
					$recherche = $tab["recherche"];

				$img = $tab["img"];

				if  (!preg_match("/Gowap/",$objet['nom']))
					$gowap = "";
				elseif (is_numeric($gowap))
					$gowap++;
				if  (preg_match("/Liche/",$objet['nom']))
					$liche = true;
				if  (preg_match("/Beholder/",$objet['nom']))
					$beholder = true;

				if ($objet['id_troll_gowap'] != "")
					$rm = "RM";

				$n_monstres++;
			}
		} 
	}
	if ($n_monstres>=1)  {
		if ($gowap == "1") {
			$img='gowap'.$rm;
		} else if ($gowap > 1) {
			$img='gowap-plus'.$rm;
		} else if ($n_monstres > 1) {
			$img='tasdem'.$recherche;
		}
		echo "<img src='images/$img.gif' border=0 alt='$img'";
		echo "width='";
		echo $imgSizes[$img][0]/$zoom;
		echo "'>";
		if ( ($liche || $beholder) && ($n_monstres >1) ) {
			if ($liche) $img = "laliche";
			if ($beholder) $img = "beholder";
			echo "<img src='images/$img.gif' border=0 alt='$img'";
			echo "width='";
			echo $imgSizes[$img][0]/$zoom;
			echo "'>";
		}
	}

}


function vue2d_afficher_get_image_lieux($ax,$ay,$lieux,$min_z,$max_z,$zoom,$anim)
{
	global $imgSizes;
	
	$n_lieux = 0;
	if ($lieux[$ax+100][$ay+100]) {
		foreach($lieux[$ax+100][$ay+100] as $lieu) {
			if ( ($lieu[z] >= $min_z) && ($lieu[z] <= $max_z) ) {
				echo "<a name='$lieu[id]'></a>";
				$n_lieux++;
			}
		}
	}

	if ($n_lieux > 0) {
		echo "<img src='images/";
		if ($anim == 'oui') {
			$img = imgLieu($lieu);
			echo $img.".gif";
		} else {
			$img= imgLieu($lieu);
			echo $img."-fixe.gif";
		}
		echo "' width='";
		echo ($imgSizes[$img][0])/$zoom;
		echo "' border=0 alt='$img'>";
	}
}

function vue2d_afficher_get_image_tresors($ax,$ay,$tresors,$min_z,$max_z,$zoom,$anim)
{
	global $imgSizes;	
	
	$n_tresors = 0;
	unset($img);
	if ($tresors[$ax+100][$ay+100] ) {
		foreach ($tresors[$ax+100][$ay+100] as $objet) {
			if ( ($objet[z] >=$min_z) && ($objet[z] <= $max_z) ) {
				//$nom = preg_replace("/'/","_",$objet[nom]);
				$nom = addslashes($objet['nom']);
				$img2 = imgObjet($objet['nom']);
				$imgC[$img2] = $img2;
				$n_tresors++;
			}
		}
	}
	if ($n_tresors >=1) {
		foreach ($imgC as $nom) {
			if ($anim == 'oui') {
				echo "<img src='images/$nom.gif' width='";
			} else {
				echo "<img src='images/$nom"."-fixe.gif'";
				echo "width='";
			}
			echo min( $imgSizes[$nom][0], 2*$imgSizes[$nom][0]/count($imgC)) / $zoom;
			echo "' alt='$nom'>";
		}
	}
}

function vue2d_afficher_get_image_champignons($ax,$ay,$champignons,$min_z,$max_z,$zoom,$anim)
{
	global $imgSizes;
	
	$n_champi = 0;
	if ($champignons[$ax+100][$ay+100] ) {
		foreach($champignons[$ax+100][$ay+100] as $champi) {
			if ( ($champi[z] >= $min_z) && ($champi[z] <= $max_z) ) {
				$n_champi++;
			}
		}
	}

	if ($n_champi == 1) {
		echo "<img alt='champignon' src='images/champignon.gif' border=0 ";
		echo "width='";
		echo $imgSizes["champignon"][0]/$zoom;
		echo "' >";
	} elseif ($n_champi > 1) {
		echo "<img alt='champignon' src='images/champignon-plus.gif' ";
		echo "width='";
		echo $imgSizes["champignon"][0]/$zoom;
		echo "' border=0>";
	}
}

function vue2d_afficher_get_image_baronnies($ax,$ay,$baronnies,$min_z,$max_z,$zoom,$anim)
{
	global $imgSizes;

	$n_baronnie = 0;
	if ($baronnies[$ax+100][$ay+100] ) {
		foreach ($baronnies[$ax+100][$ay+100] as $baronnie) {
			if ( ($baronnie['z_trone_baronnie'] >= $min_z) && ($baronnie['z_trone_baronnie'] <= $max_z) ) {
				$n_baronnie++;
			}
		}
	}

	if ($n_baronnie >=1) {
		echo "<img alt='Baronnie' src='images/baronnie.gif' border=0 ";
		echo "width='";
		echo $imgSizes['baronnie'][0]/$zoom;
		echo "'>";
	}
}

/* Légende de la vue2d */
function vue2d_afficher_legende()
{
	//<table class=objetsProches>
	?><br>
	<table class='mh_tdborder' align='center'>
		<tr class='mh_tdtitre'>
			<td align='center'><h3>L&eacute;gende</h3></td>
			<td align='center'><h3>Brouillard de guerre</h3></td>
		</tr>
		<tr class='mh_tdpage'>
			<td>
				<table class='mh_tdpage'>
					<tr class='ligne_vide'><td>Monstre non renseign&eacute; (se d&eacute;p&ecirc;cher de faire une CDM)</td></tr>
					<tr class='ligne'><td>Monstre renseign&eacute; ou troll neutre</td></tr>
					<tr class='ligne recherche'><td>Monstre recherch&eacute; (pour pi&egrave;ces d&eacute;tach&eacute;es)</td></tr>
					<tr class='ligne recherche urgent'><td>Monstre recherch&eacute; (Viiiiite !)</td></tr>
					<tr class='ligne invisible'><td>Monstre ou troll disparu (date JJ/MM hh:mn)</td></tr>
					<tr class='amie'><td>Troll ami (aide-le et tu t'en feras un alli&eacute;)</td></tr>
					<tr class='alliee'><td>Troll alli&eacute; (un pour tous, et tous partis)</td></tr>
					<tr class='guilde'><td>Troll <? echo NOM_GUILDE ?></td></tr>
					<tr class='tk'><td>Troll TK (graine de Wanted, s'en m&eacute;fier comme de la peste scrofuleuse)</td></tr>
					<tr class='ennemie'><td>Troll ennemi ou recherch&eacute;(&agrave; pourchasser  jusqu'&agrave; ce qu'excuses s'ensuivent)</td></tr>
					<tr><td><img src='images/puce_disparu.gif'> Troll disparu ou cach&eacute;</td></tr>
					<tr><td><img src='images/puce_rg.gif'> Acc&egrave;s &agrave; la fiche RG (Renseignements G&eacute;n&eacute;raux)</td></tr>
					<tr><td><img src='images/puce_mh.gif'> Acc&egrave;s aux &eacute;v&egrave;nements Mountyhall</td></tr>
					<tr><td><img src='images/puce_vue2d.gif'> Acc&egrave;s &agrave; la vue2d</td></tr>
					<tr><td><img src='images/puce_bestiaire.gif'> Acc&egrave;s au bestiaire</td></tr>
					<tr><td><img src='images/puce_gps.gif'> Acc&egrave;s au gps</td></tr>
				</table>
			</td>
			<td valign='top'>
    		 <!--<table>
				 	<tr><td height=30 width=30 class='tableVue inconnu'></td><td> 
						Zone inconnue, jamais vue, ou vue il y a 5 jours ou plus<br>
					</td></tr>
				 	<tr><td height=30 width=30 class='tableVue '></td><td> Zone vue il y a moins d'1 jour<br>
						Si la taille de la vue est sup&eacute;rieure &agrave; echo LIMITE_CASES_BROUILLARD; , pas de brouillard.</td></tr>
				 	<tr><td height=30 width=30 class='tableVue h'></td><td> Zone vue il y a moins de 2 jours</td></tr>
				 	<tr><td height=30 width=30 class='tableVue hh'></td><td> Zone vue il y a moins de 3 jours</td></tr>
				 	<tr><td height=30 width=30 class='tableVue hhh'></td><td> Zone vue il y a moins de 4 jours</td></tr>
				 	<tr><td height=30 width=30 class='tableVue hhhh'></td><td> Zone vue il y a moins de 5 jours</td></tr>
				 </table>--> 
			</td>	
		</tr>
	</table>
	<?
}

function vue2d_afficher_trollometer($info)
{
	?>
	<a name='trollometer'></a>
	<center><img src='images/trollometer.gif' alt='TROLL-O-METER'></center>
	<br>
	<table class='mh_tdborder' width='100%' align='center'>
		<tr class='mh_tdpage'>
			<!-- <td colspan='2'><? //vue2d_afficher_trollometer_baronnies($info['t_baronnies'],$info['max_pa']); ?></td>-->
			<td colspan='2'><? vue2d_afficher_trollometer_mythiques($info['t_mythiques'],$info['max_pa'],$info['x_position'],$info['y_position'],$info['z_position']); ?></td>
		</tr>
		<tr class='mh_tdpage' valign='top'>
			<td width='50%'><? vue2d_afficher_trollometer_monstres($info['t_monstres'],$info['max_pa'],$info['x_position'],$info['y_position'],$info['z_position']); ?></td>
			<td width='50%'><? vue2d_afficher_trollometer_trolls($info['t_trolls'],$info['max_pa']); ?></td>
		</tr>
		<tr class='mh_tdpage' valign='top'>
			<td width='50%'><? vue2d_afficher_trollometer_tresors($info['t_tresors'],$info['max_pa']); ?></td>
			<td width='50%'><? vue2d_afficher_trollometer_lieux($info['t_lieux'],$info['max_pa']); ?></td>
		</tr>
	</table>
	<?
}

function vue2d_afficher_trollometer_mythiques($mythiques,$max_pa,$ax,$ay,$az)
{

	if (  !userIsGuilde()  )
		return;
	if (!$mythiques)
		return;

	$titre = "<tr class='mh_tdtitre'><td>Distance : $i Pa</td></tr>";
	  foreach ($mythiques as $mythiques2)
	    foreach ($mythiques2 as $mythiques3)
	      foreach ($mythiques3 as $mythique) 
	      {
	      		$titre = "<tr class='mh_tdtitre'><td>Distance : $mythique[distance_pa] Pa</td></tr>";
				$text = "<tr class='mh_tdpage'>";
				$text .= "<td nowrap>";
				$text .= afficher_position($mythique['x'],$mythique['y'],$mythique['z']);
				$text .= "</td>";
				$text .= "<td>$mythique[id]</td>";
				$text .= "<td>";
				$text .= htmlentities(stripslashes($mythique['nom']));
				$text .= "</td>";

				$text .= "</tr>";
				if ($titre != "") {
					$text = $titre . $text;
					$titre = "";
				}
				$retour .= $text;
		  }

		if ( $retour != "" ) {
			?>
			<center><h3> Les Myhtiques </h3></center>
			<table class='mh_tdtitre' width='90%' align='center'>
			<? echo $retour ?>
			</table>
			<?
		}
}


function vue2d_afficher_trollometer_baronnies($baronnies,$max_pa)
{

	if (  !userIsGuilde()  )
		return;
	if (!$baronnies)
		return;

	for ($i = 0; $i <= $max_pa; $i++) {
		$titre = "<tr class='mh_tdtitre'><td>Distance : $i Pa</td></tr>";
	  foreach ($baronnies as $baronnie2)
	    foreach ($baronnie2 as $baronnie3)
	      foreach ($baronnie3 as $baronnie) {
					if ($baronnie[distance_pa] == $i) {
						$text = "<tr><td class='mh_tdpage'>";
						$text .= "<img src='$baronnie[img_mini_blason_baronnie]'>";
						$text .= "Baronnie ".stripslashes($baronnie['nom_baronnie']).", tron&eacute;e par ".stripslashes($baronnie['nom_baron'])." en";
						$text .= " x=$baronnie[x_trone_baronnie]/y=$baronnie[y_trone_baronnie]/z=$baronnie[z_trone_baronnie]</td></tr>";
						if ($titre != "") {
							$text = $titre . $text;
							$titre = "";
						}
						$retour .= $text;
					}
				}
			}

		if ( $retour != "" ) {
			?>
			<center><h3> Les Baronnies </h3></center>
			<table class='mh_tdtitre' width='90%' align='center'>
			<? echo $retour ?>
			</table>
			<?
		}
}

function vue2d_afficher_trollometer_monstres($monstres,$max_pa,$ax,$ay,$az)
{
	if (!$monstres)
		return;

	for ($i = 0; $i <= $max_pa; $i++) {
		$titre = "<tr  class='mh_tdtitre'><td nowrap colspan='100'>Distance : $i Pa</td></tr>";
	  foreach ($monstres as $monstre2)
	    foreach ($monstre2 as $monstre3)
	      foreach ($monstre3 as $monstre) {
					if ($monstre['distance_pa'] == $i) {

						if ($monstre['connu'] == 'non') {
							$text = "<tr class='ligne_vide'>";
						} else {
							if ($monstre['recherche']!="") {
								switch ($monstre['recherche']) {
									case 'haute':
									case 'superhaute':
										$rech=" recherche urgent";
										break;
									case 'aucune':
										break;
									case 'tresbasse' :
									case 'basse' :
									case 'moyenne' :
									default:
										$rech=" recherche";
										break;
								}
							} else {
								$rech = "";
							}
							$text = "<tr class='ligne$rech'>";
						}

						$text .= "<td nowrap>";
						$text .= afficher_position($monstre['x'],$monstre['y'],$monstre['z']);
						$text .= "</td><td>";
						$text .= $monstre[id];
						$c = "";
						if ( userIsGuilde() ) {
							if ($monstre['id_troll_gowap'] != "" ) {
								$c = "class='objetsProches.ligne guilde'";
							}
						}
						$text .= "</td><td $c><b>";

						preg_match("/(.+) \[(.+)\]/",$monstre['nom'],$resultat);
						$nom = preg_replace("/'/","%27",$resultat[1]);
						$age = preg_replace("/'/","%27",$resultat[2]);

						$urle = "Monstre=".htmlentities($nom)."&Age=".htmlentities($age);

						// Si c'est un RM, on affiche le lien vers le bestiaire
						if ( userIsGuilde() ) {
							$text .= "<span class='white' ";
							#$text .= vue2d_informations_monstres_popup($monstre,$ax,$ay,$az,$max_pa);
							$text .= ">";
							$text .= htmlentities(stripslashes($resultat[1]));
							$text .= "</span> ";
						} else {
							$text .= htmlentities(stripslashes($resultat[1]));
						}

						if ( userIsGuilde() ) {
							if ($monstre['id_troll_gowap'] != "" ) {
								$lien = "href=engine_view.php?gowap=$monstre[id]";
								$title = "Appartient &agrave; ".addslashes($monstre[nom_troll]);
								$title .= "<br><br><a $lien >Lien RG</a>";
								$text .= affiche_popup("Propri&eacute;taire","yellow",$title,"",true,false);
								$text .= "<br> ";
							}
						}

						$text .= "</td>";

						$text .= "<td>[".htmlentities($resultat[2])."]</b></td>";

						if ( userIsGuilde() ) {
							$text .= "<td>".htmlentities($monstre[famille])."</a></td>";
//							$text .= "<td>$monstre[race]</a></td>";
							$text .= "<td>$monstre[niveau]</a></td>";

							$text .= "<td nowrap><a href=\"/bestiaire2/bestiaire.php?$urle\" title='Acc&egrave;s Bestiaire'>";
							$text .= "<img src='images/puce_bestiaire.gif' border='0'></a> ";
						} else {
							$text .= "<td nowrap> ";
						}

						$text .= afficherLien('monstre','mh_evenements',$monstre['id'],"","","","",false);

						$text .= "</td></tr>";

						if ($titre != "") {
							$text = $titre . $text;
							$titre = "";
						}
						$retour .= $text;
					}
				}
	}

	if ( $retour != "" ) {
		?>
		<center><h3> Les Monstres </h3></center>
		<input onclick="toggleGowap();" name="delgowap" type="checkbox">Filtrer Gowaps
		<table width='100%' align='center' cellspacing='0' cellpadding='1' id="IdMonstres">
		<? echo $retour ?>
		</table>
		<?
	}
}

function vue2d_afficher_trollometer_trolls($trolls,$max_pa)
{
/*	$titre = "<td>x,y,z</td>";
	$titre .= "<td colspan=2>$i PA de distance : ".count($objetsProches[$i][troll])."</td>";
	$titre .= "<td colspan=2>Race</td>";
	$titre .= "<td>Guilde</td>";
	$titre .= "<td>Disparu</td>";
	$titre .= "<td>&nbsp;</td></tr>";*/
	if (!$trolls)
		return ;
	for ($i = 0; $i <= $max_pa; $i++) {
		$titre = "<tr  class='mh_tdtitre'><td nowrap colspan='100'>Distance : $i Pa</td></tr>";
	  foreach ($trolls as $troll2)
	    foreach ($troll2 as $troll3)
	      foreach ($troll3 as $troll) {
					if ($troll[distance_pa] == $i) {
						$c_guilde = "";
						$c_troll = "";
						
						if ($troll['diplomatie'] == 'ennemie')
							$c_guilde =' ennemie';
						
						if ($troll['diplomatie'] == 'tk')
							$c_guilde =' tk';
						
						if ($troll['tk'] == 'oui')
							$c_troll =' tk';

						if ($troll['wanted'] == 'oui')
							$c_troll =' ennemie';

						
							
						if ($troll['diplomatie'] == 'amie')
							$c_guilde =' amie';
							
						if ($troll['diplomatie'] == 'alliee')
							$c_guilde =' alliee';
						
						if ($troll['guilde_troll'] == ID_GUILDE) {
							$c_guilde =' guilde';
							$c_troll =' guilde';
						}

						if ($troll['is_seen'] == 'non')
							$invi = " invisible";
						else
							$invi = "";

						//$text = "<tr class='objetsProches.ligne$invi'>";
						$text = "<tr class='objetsProches.ligne$invi'>";
						$text .= "<td nowrap>";
						$text .= afficher_position($troll['x'],$troll['y'],$troll['z'],$troll['id'],$troll['nom']);
						$text .= "</td>";
						$text .= "<td nowrap>$troll[id]</td>";
						
						$text .= "<td nowrap class='objetsProches.ligne$c_troll$invi'><b>";
						$text .= htmlentities(stripslashes($troll['nom']));
						$text .= "</b></td>";

						$text .= "<td nowrap title='$troll[race]'> ".substr($troll['race'],0,1)." </td>";
						$text .= "<td nowrap>$troll[level]</td>";
						
						$text .= "<td class='objetsProches.ligne$c_guilde$invi'>";
						if ( userIsGuilde() ) {
							$text .= "<a href='engine_view.php?guilde=".$troll['guilde_troll']."' title='Fiche RG de la guilde'>";
							$text .= stripslashes($troll['guilde']);
							$text .= "</a>";
						} else {
							$text .= stripslashes($troll['guilde']);
						}

						$text .= "</td>";
						$text .= "<td nowrap>";
						if ($troll['is_seen'] == 'non') {
							$title = "Disparu depuis le ".date ("d/m H:i", $troll['date_troll'])."";
							$text .= "<img src='images/puce_disparu.gif' title='$title'>";
						}
						$text .= "</td>";
						$text .= "<td nowrap>";
						if ( userIsGuilde() ) {
							$text .= afficherLien('troll','fiche',$troll['id'],"","","","",false);
						}
						$text .= afficherLien('troll','mh_evenements',$troll['id'],"","","","",false);
						$text .= "</td></tr>";

						$text .= "</tr>";
						if ($titre != "") {
							$text = $titre . $text;
							$titre = "";
						}
						$retour .= $text;
					}
				}
			}
		?>
		<center><h3> Les Trolls </h3></center>
		<table width='90%' align='center' cellspacing='0' cellpadding='1'>
		<? echo $retour ?>
		</table>
	<?
}

function vue2d_afficher_trollometer_tresors($tresors,$max_pa)
{
	if (!$tresors)
		return;

	for ($i = 0; $i <= $max_pa; $i++) {
		$titre = "<tr  class='mh_tdtitre'><td nowrap colspan='100'>Distance : $i Pa</td></tr>";
		foreach ($tresors as $tresor2) {
			foreach ($tresor2 as $tresor3) {
				foreach ($tresor3 as $tresor) {
					if ($tresor['distance_pa'] == $i) {

						$text = "<tr class='mh_tdpage'>";
						$text .= "<td nowrap>";
						$text .= afficher_position($tresor['x'],$tresor['y'],$tresor['z']);
						$text .= "</td>";
						$text .= "<td>$tresor[id]</td>";
						$text .= "<td>";
						$text .= htmlentities(stripslashes($tresor['nom']));
						$text .= "</td>";

						$text .= "</tr>";
						if ($titre != "") {
							$text = $titre . $text;
							$titre = "";
						}
						$retour .= $text;
					}
				}
			}
		}
	}
	?>
		<center><h3> Les Tr&eacute;sors</h3></center>
		<table width='90%' align='center' cellspacing='0' cellpadding='1'>
		<? echo $retour ?>
		</table>
	<?
}

function vue2d_afficher_trollometer_lieux($lieux,$max_pa)
{
	if (!$lieux)
		return;

	for ($i = 0; $i <= $max_pa; $i++) {
		$titre = "<tr  class='mh_tdtitre'><td nowrap colspan='100'>Distance : $i Pa</td></tr>";
		foreach ($lieux as $lieu2) {
			foreach ($lieu2 as $lieu3) {
				foreach ($lieu3 as $lieu) {
					if ($lieu['distance_pa'] == $i) {

						$text = "<tr ";
						if ($lieu['statut_info'] != "" ) {
								$text .= "class='objetsProches.ligne $lieu[statut_info]'";
						} else {
							$text .= "class='mh_tdpage'";
						}
						
						$text .= ">";

						$text .= "<td nowrap>";
						$text .= afficher_position($lieu['x'],$lieu['y'],$lieu['z']);
						$text .= "</td>";
						$text .= "<td>$lieu[id]</td>";
						$text .= "<td>";
						$text .= htmlentities(stripslashes($lieu['nom']));
						// Si c'est une tanni&egrave;re de la guilde, on affiche le proprio
						if ( userIsGuilde() ) {
							if ($lieu['nom_info'] != "" ) {
								if ($lieu['type_info'] == 'guilde') {
									$lien = "href=\"engine_view.php?guilde=$lieu[id_info]\"";
									$text .= "<td><a $lien title='Fiche RG de la guilde'> GT de ";
									$text .= htmlentities($lieu[nom_info])."</a></td>";
								} elseif ($lieu['type_info'] == "troll") {
									if ($lieu['statut_info'] == 'guilde') {
										$lien = "href=\"engine_view.php?taniere=$lieu[id]\"";
										$text .= "<td><a $lien title='Fiche RG de la tani&egrave;re'> Appartient &agrave;";
										$text .= htmlentities($lieu[nom_info])."</a></td>";
									} else {
										$lien = "href=\"engine_view.php?troll=$lieu[id_info]\"";
										$text .= "<td><a $lien title='Fiche RG du troll'> Appartient &agrave; ";
										$text .= htmlentities($lieu[nom_info])."</a></td>";
									}
								}
							}
						}
						$text .= "</td>";

						$text .= "</tr>";
						if ($titre != "") {
							$text = $titre . $text;
							$titre = "";
						}
						$retour .= $text;
					}
				}
			}
		}
	}
	?>
		<center><h3> Les Lieux </h3></center>
		<table width='90%' align='center' cellspacing='0' cellpadding='1'>
		<? echo $retour ?>
		</table>
	<?
}

function vue2d_informations_monstres_popup($monstre,$ax,$ay,$az,$max_pa)
{
	$titre = "<b>".addslashes($monstre['nom'])."</b>";
	$text = "Desactivation des informations pour surcharge serveur.";

	$info = " onmouseover=\"return overlib('$text',CAPTION,'Clique pour fixer la popup !');\"";
	$info .= " onclick=\"return overlib('$text', STICKY, CAPTION, '$titre', CLOSECLICK, EXCLUSIVE);\" ";
	$info .= " onmouseout=\"return nd();\"";

	return $info ;

	include_once('bestiaire2/Libs/inc_affichage.php');
	$titre = "<b>".addslashes($monstre['nom'])."</b>";

	$text = "<center>";
	$text .= "<br>";
	$text .= "<table><tr><td>";
	
	$text .= "<table align=center class=mh_tdborder><tr><td colspan=4>";
	$text .= "<h2>$titre</h2>";
	$text .= "</center></td></tr>";

	preg_match("/(.+) \[(.+)\]/",$monstre['nom'],$resultat);
	$nom = preg_replace("/'/","%27",$resultat[1]);
	$age = preg_replace("/'/","%27",$resultat[2]);

	$race = $monstre['infos_monstre']['race'];
	$race = addslashes($race);
	$famille = $monstre['infos_monstre']['famille'];
	$famille = addslashes($famille);
	$niveau = $monstre['niveau'];
	
	$text .= "<tr class=mh_tdpage>";
	$text .= "<td>Age : $age</td>";
	$text .= "<td>Niveau : $niveau</td>";
	$text .= "</tr>";
	
	$text .= "<tr class=mh_tdpage>";
	$text .= "<td>Race : ".htmlentities($race)."<br>";
	$text .= "<td>Famille : ".htmlentities($famille)."</td>";
	$text .= "</tr>";
	
	$text .= "</table>";

	$text .= "</td><td>";
	$x_dist = $ax - $monstre['x'];
	$y_dist = $ay - $monstre['y'];
	$z_dist = $az - $monstre['z'];

	if ($x_dist <0) $x_dist = -$x_dist;
	if ($y_dist <0) $y_dist = -$y_dist;
	if ($z_dist <0) $z_dist = -$z_dist;

	$text .= "<table align=center class=mh_tdborder><tr><td nowrap class=mh_tdtitre>";
	$text .= "Distance";
	$text .= "</td><td nowrap class=mh_tdpage>";
	$text .= "en x = $x_dist case(s)<br>";
	$text .= "en y = $y_dist case(s)<br>";
	$text .= "en z = $z_dist case(s)";
	$text .= "</td></tr></table>";
	$text .= "</td></tr></table><br>";

	if ($monstre['infos_monstre']['id_age'] != "") {
		$tab_cdm=SelectCdM_mh($monstre['id'],$monstre['infos_monstre']['race'],$monstre['infos_monstre']['id_age']);
		if (count($tab_cdm) >0) {
			$text .= "<table class=mh_tdtitre>";
			$text .= "<tr><td align=center class=mh_titre colspan=12><b>CdM sur ce monstre</b></td></tr></table>";
			$text .= addslashes(affiche_liste_cdms($tab_cdm,false));
		}
	}
	if ($max_pa > 15) {
		$text .= "La taille en PA est sup&eacute;rieure &agrave; 15. Pour plus d\'info sur ce monstre, consultez le bestiaire.<br>";
	}
//	if ((	$monstre[infos_monstre][id_template] != "" ) && ($monstre[infos_monstre][id_age] != "") ) {
	//	$tab_cdm=SelectCdMs($monstre[infos_monstre][race],$monstre[infos_monstre][id_template],$monstre[infos_monstre][id_age],"-1","-1", true);
		if (count($monstre[tab_cdm]) >0) {
			$text .= "<table class=mh_tdtitre>";
			$text .= "<tr><td align=center class=mh_titre colspan=12><b>Derni&egrave;re CdM de même race, même template et même âge</b></td></tr></table>";
			$text .= addslashes(affiche_liste_cdms($monstre['tab_cdm'],false));
		}
//	}

	$tab = $monstre['caracs_moyennes'];
	$td="td align=center width=50";

	/*$text .= "<br><table class=mh_tdborder>";
	$text .= "<tr><td align=center class=mh_titre colspan=12><b>Caract&eacute;tistiques moyennes</b></td></tr>";
	$text .= "<tr class=mh_tdtitre><$td>niv</td><$td>pdv</td><$td>att</td><$td>esq</td><$td>deg</td><$td>reg</td><$td>arm</td><$td>vue</td></tr>";
	$text .= "<tr class=mh_tdpage><$td>$tab[niv]</td><$td>$tab[pdv]</td><$td>$tab[att]</td><$td>$tab[esq]</td><$td>$tab[deg]</td><$td>$tab[reg]</td><$td>$tab[arm]</td><td>$tab[vue]</td></tr>";
	$text .= "</table><br>";*/

	$capspe = $monstre['capacites_speciales']; 

	if ($capse) {
		$text .= "<table class=mh_tdborder>";

		$text .= " <tr><td colspan=6><em>Capacit&eacute; sp&eacute;ciale </em>&nbsp;&nbsp;".htmlentities($capspe['nom_capspe'])."&nbsp;&nbsp;&nbsp;<em>affecte</em>&nbsp;&nbsp;&nbsp;".htmlentities($capspe['affecte_capspe'])."</td>";
		$text .= "</tr>";

		$text .= "<tr class=mh_tdtitre>";
		$text .= "  <$td>MM</td><$td>deg</td><$td>portee</td><$td>dur&eacute;e</td><$td>zone</td></tr>";
		$carac = carac_monstre($capspe['MMsom_capspe'],$capspe['MMnbr_capspe']);
		$text .= "<tr class=mh_tdpage>";
		$text .= "  <$td>".$carac."</td>";
		$carac = carac_monstre($capspe['degatsom_capspe'],$capspe['degatnbr_capspe']);
		$text .= "  <$td>".$carac."</td>";
		$text .= "  <$td>".$capspe['portee_capspe']."</td>";
		$text .= "  <$td>".$capspe['duree_capspe']."</td>";
		$text .= "  <$td>".$capspe['portee_zone_capspe']."</td>";
	
		$text .= "</tr>";
		$text .= "</table>";
	
		$text .= "</center>";
	}

	$text .= "<br><table align=center class=mh_tdborder><tr><td>";
	$text .= "<h2><a href=\'/bestiaire2/bestiaire.php?Monstre=$nom&Age=$age\'>lien vers le bestiaire</a></h2>";
	$text .= "</td></tr></table>";

	$info = " onmouseover=\"return overlib('$text',CAPTION,'Clique pour fixer la popup !');\"";
	$info .= " onclick=\"return overlib('$text', STICKY, CAPTION, '$titre', CLOSECLICK, EXCLUSIVE);\" ";
	$info .= " onmouseout=\"return nd();\"";

	return $info ;
}

function vue2d_afficher_navigation_niveau($x_position,$y_position,$z_position,$taille_vue,$max_pa,$taille_niveau_z)
{
	?><br>
	<table class='mh_tdborder' width='60%' align='center' cellspacing='0'>
		<tr class='mh_tdtitre' align='center'>
			<td>Vous avez choisis de limiter la taille en Z. Niveau actuel : <? echo $z_position ?>. Limitation Taille :<? echo $taille_niveau_z ?>.</td>
		</tr>
		<tr>
			<td class='mh_tdpage' align='center'>
				<? 
				$z_superieur = $z_position + 1;
				$z_inferieur = $z_position - 1;
				$lien_superieur = "cockpit.php?cX=$x_position&cY=$y_position&cZ=$z_superieur&max_pa=$max_pa&taille_vue=$taille_vue&taille_niveau_z=$taille_niveau_z";
				$lien_inferieur = "cockpit.php?cX=$x_position&cY=$y_position&cZ=$z_inferieur&max_pa=$max_pa&taille_vue=$taille_vue&taille_niveau_z=$taille_niveau_z";
				echo "<a href='$lien_superieur'>Niveau inf&eacute;rieur (z=".$z_superieur.")</a> - ";
				echo "<a href='$lien_inferieur'>Niveau sup&eacute;rieur(z=".$z_inferieur.")</a>";
				?>
			</td>
	</table>

	<?
}

function afficher_position($x, $y, $z,$id="", $nom="")
{
	if ($id == "") {
		$alt = "Centrer sur $x/$y/$z";
		$texta = "$x/$y/$z";
		$link = "cX=$x&cY=$y&cZ=$z";
	} else {
		$alt = "Centrer la vue2d sur ce troll";
		$texta = "$x/$y/$z";
		$link = "id_troll=$id";
	}
	if ( userIsGuilde() ) {
		$text_d = "<a href='/cockpit.php?$link' title='$alt'>";
		$text_f = "</a>";
	}
	return $text_d.$texta.$text_f;
}

function vue_afficher_zoom_select($zoom, $name, $js="") {

	echo " Zoom <select name='$name' $js>";
  echo afficher_listbox_select(5.0, $zoom,"toupeti");
	echo afficher_listbox_select(4.5, $zoom,"=====");
	echo afficher_listbox_select(4.0, $zoom,"====-");
	echo afficher_listbox_select(3.6, $zoom,"===--");
	echo afficher_listbox_select(3.2, $zoom,"==---");
	echo afficher_listbox_select(2.9, $zoom,"=----");
	echo afficher_listbox_select(2.6, $zoom,"peti");
	echo afficher_listbox_select(2.3, $zoom,"-----");
	echo afficher_listbox_select(2.0, $zoom,"----");
	echo afficher_listbox_select(1.6, $zoom,"---");
	echo afficher_listbox_select(1.4, $zoom,"--");
	echo afficher_listbox_select(1.2, $zoom,"-");
	echo afficher_listbox_select(1 , $zoom,"Normal");
	echo afficher_listbox_select(0.9, $zoom,"+");
	echo afficher_listbox_select(0.8, $zoom,"++");
	echo afficher_listbox_select(0.7, $zoom,"+++");
	echo afficher_listbox_select(0.6, $zoom,"++++");
	echo afficher_listbox_select(0.5, $zoom,"BIG");
	echo "</select>";
	afficheAideVueZoom();

	echo $text;
}

?>
