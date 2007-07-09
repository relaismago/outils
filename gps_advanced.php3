<?

include_once("top.php");
include_once("secure.php");
include_once("gps_advanced_db.php3");
include_once("gps_advanced_js.php3");
include_once("gps_advanced_functions.php3");
include_once ("admin_functions.php3");
include_once ("admin_functions_db.php3");


global $quadrillage,$quadrillage_old;
global $repere, $repere_old;
global $viseur, $viseur_old;
global $relaismago, $relaismago_old;
global $baronnies, $baronnies_old;
global $ennemis, $ennemis_old;
global $allies, $allies_old;
global $id_objet_depart, $id_objet_arrivee;
global $x,$y,$vue;




?>
       <table class='mh_tdborder' width='60%' align='center'>
        <tr><td>
          <table width='100%' cellspacing='0'>
            <tr class='mh_tdtitre' align="center">
              <td>
							<h2><img src='images/titre-GPS.gif'>
							<? afficheAideGpsAdvanced(); ?>
                </h2>
              </td>
            </tr>
          </table>
        </td></tr>
        <tr class='mh_tdpage'><td width='50%'>
<?
echo "Des soucis avec le GPS Advanced ? C'est par là -> ";
echo "<a href='http://relaismago.forumactif.com/Forum-Prive-des-RM-c1/Les-Outils-f9/Questions-sur-le-GPS-t1048.htm
' target='_blank'>";
echo "topic GPS Advanced</a>";
echo " ou sur le <a href='./bugs.php' target='_blank'>BugTrack</a>";

/*echo " <font size=1>Anciens GPS : <a href='gps.php'>GPS</a> - <a href='gps2.php'>GPSng</a>,";
echo " le futur : <a href='http://www.google.fr/search?q=GPS+extreme'>GPSxtrem</a></font><br><br>";*/

$lien = "href='http://www.mozilla-europe.org/fr/'";
echo "Il se peut qu' <font color=red>Internet Explorer ne soit pas compatible</font>";
echo " (Zoom michelin...).";
echo " Utilisez <a $lien>Firefox</a> si vous voulez avoir toutes les fonctionnalités ";
echo " (en attendant que l'on résolve les problèmes...)<br><br>";

echo "</td></tr>";
echo "</table>";

init_gps();

include_once("foot.php");

function init_gps()
{

	global $x,$y,$vue;

	$taille_map = $_REQUEST[taille_map];
	$vue = $_REQUEST[vue];
	$x = $_REQUEST[x];
	$y = $_REQUEST[y];

	$viseur_id_troll = $_REQUEST[poi_viseur_id_troll];
	
	$quadrillage = $_REQUEST[quadrillage];
	$quadrillage_old = $_REQUEST[quadrillage_old];
	
	$swap_reglage = $_REQUEST[swap_reglage];
	$swap_poi = $_REQUEST[swap_poi];
	$swap_affutage = $_REQUEST[swap_affutage];
	$swap_autres_options = $_REQUEST[swap_autres_options];
	$swap_guide_micheline = $_REQUEST[swap_guide_micheline];

	$swap_list_relaismago  = $_REQUEST[swap_list_relaismago];
	$swap_list_baronnies  =  $_REQUEST[swap_list_baronnies];
	$swap_list_tanieres_rm  =  $_REQUEST[swap_list_tanieres_rm];
	$swap_list_lieux =  $_REQUEST[swap_list_lieux];
	$swap_list_trolls  = $_REQUEST[swap_list_trolls];
	$swap_list_ennemis  = $_REQUEST[swap_list_ennemis];

	// quadrillage vient d'une checkbox. on est la valeur par défaut
	// on regarde donc avec l'anciennce valeur de quadrillage qui est
	// stockée dans un champ hidden, si l'utilisateur veut ou on afficher
	// cause : une checkbox décocher renvoit aucune valeur et l'on veut que 
	// la valeur par défaut soit 'on' c'est à dire cochée
	$res = init_value_with_old_compare($quadrillage,$quadrillage_old,"on");
	$quadrillage = $res[0];
	$quadrillage_old = $res[1];
	
	$repere = $_REQUEST[repere];
	$repere_old = $_REQUEST[repere_old];
	$res = init_value_with_old_compare($repere,$repere_old,"on");
	$repere=$res[0] ;
	$repere_old =$res[1] ;
	
	$viseur = $_REQUEST[viseur];
	$viseur_old = $_REQUEST[viseur_old];
	$res = init_value_with_old_compare($viseur,$viseur_old,"on");
	$viseur =$res[0] ;
	$viseur_old =$res[1] ;

	$info_text = $_REQUEST[info_text];

	// Affichage ou non des relaismago
	$relaismago = $_REQUEST[relaismago];
	$relaismago_old = $_REQUEST[relaismago_old];
	$res = init_value_with_old_compare($relaismago,$relaismago_old,"on");
	$relaismago=$res[0] ;
	$relaismago_old =$res[1] ;
	
	// Affichage ou non des Baronnies
	$baronnies = $_REQUEST[baronnies];
	$baronnies_old = $_REQUEST[baronnies_old];
	$res = init_value_with_old_compare($baronnies,$baronnies_old,"non");
	$baronnies=$res[0] ;
	$baronnies_old =$res[1] ;

	// Affichage ou non des Tanières
	$tanieres_rm = $_REQUEST[tanieres_rm];
	$tanieres_rm_old = $_REQUEST[tanieres_rm_old];
	$res = init_value_with_old_compare($tanieres_rm,$tanieres_rm_old,"non");
	$tanieres_rm=$res[0] ;
	$tanieres_rm_old =$res[1] ;

	// Affichage ou non des Gowap RM
	$gowaps_rm = $_REQUEST[gowaps_rm];
	$gowaps_rm_old = $_REQUEST[gowaps_rm_old];
	$res = init_value_with_old_compare($gowaps_rm,$gowaps_rm_old,"non");
	$gowaps_rm=$res[0] ;
	$gowaps_rm_old =$res[1] ;

	// Affichage ou non des Lieux (POI)
	$lieux= $_REQUEST[lieux];

	// Affichage ou non des ennemis 
	$ennemis = $_REQUEST[ennemis];
	$ennemis_old = $_REQUEST[ennemis_old];
	$res = init_value_with_old_compare($ennemis,$ennemis_old,"on");
	$ennemis=$res[0] ;
	$ennemis_old =$res[1] ;

	// Affichage ou non des relaismago
	$allies = $_REQUEST[allies];
	$allies_old = $_REQUEST[allies_old];
	$res = init_value_with_old_compare($allies,$allies_old,"on");
	$allies=$res[0] ;
	$allies_old =$res[1] ;

	// Affichage ou non des champignons
	$champignons = $_REQUEST[champignons];
	
	// Affichage ou non des trolls de la guilde ennemies choisie
	$guilde_ennemie = $_REQUEST[guilde_ennemie];

	// Guide de Micheline
	$id_objet_depart = $_REQUEST[id_objet_depart];
	$id_objet_arrivee = $_REQUEST[id_objet_arrivee];
	$type_objet_depart = $_REQUEST[type_objet_depart];
	$type_objet_arrivee = $_REQUEST[type_objet_arrivee];

	if ($id_objet_depart =="")  $id_objet_depart = $_SESSION[AuthTroll];
	//$id_objet_arrivee = control_id_troll($id_objet_arrivee);
	if ($type_objet_depart =="")  $type_objet_depart="troll";
	if ($type_objet_arrivee =="") $type_objet_arrivee="";  	

	$viseur_id_troll = control_id_troll($viseur_id_troll);

	$tab = init_x_y($x,$y,$viseur_id_troll);
	$x = $tab['x'];
	$y = $tab['y'];
	
	if 	($vue == "" ) $vue=200;
	if 	($info_text == "" ) $info_text=50;
	if 	($taille_map == "") $taille_map=500;
	if 	($champignons == "") $champignons="non";
	if 	($guilde_ennemie == "") $guilde_ennemie="-1";
	
	if 	($swap_reglage == "") $swap_reglage = 'none'; // none ou block
	if 	($swap_poi == "") $swap_poi = 'none'; 
	if 	($swap_affutage == "") $swap_affutage = 'none';
	if 	($swap_autres_options == "") $swap_autres_options = 'none';
	if 	($swap_guide_micheline == "") $swap_guide_micheline = 'none';

	if 	($swap_list_relaismago  == "") $swap_list_relaismago  = 'none';
	if 	($swap_list_baronnies  == "") $swap_list_baronnies = 'none';
	if 	($swap_list_tanieres_rm  == "") $swap_list_tanieres_rm = 'none';
	if 	($swap_list_gowaps_rm  == "") $swap_list_gowaps_rm = 'none';
	if 	($swap_list_lieux == "") $swap_list_lieux = 'none';
	if 	($swap_list_trolls  == "") $swap_list_trolls = 'none';
	if 	($swap_list_ennemis  == "") $swap_list_ennemis = 'none';
	if 	($swap_list_champignons  == "") $swap_list_champignons = 'none';

	javascript_image($x,$y,$vue,$taille_map);
	javascript_joystick();
	naviguer($_REQUEST[nav]);

	echo "<form name='form_gps_advanced' action='gps_advanced.php3'>";
	// Pour le javascript de selection
	echo "<img src='images/shim.gif' width=30'>";
	echo "<img id=upRect style='position:absolute;border:none;' src='images/shim.gif'";
	echo "width=0 height=0 border=5 onMouseDown='mouseDown();' onClic='mouseDown();' />";
	echo "<input type='hidden' name='XX' value=''>";
	echo "<input type='hidden' name='X1' value=''>";
	echo "<input type='hidden' name='YY' value=''>";
	echo "<input type='hidden' name='Y1' value=''>";

	echo "<table class='mh_tdborder' width='60%' align='center'>";
  echo "<tr><td>";

	echo "<table width='100%' cellspacing='0'>";
	echo "<tr class='mh_tdpage' align='center'>";
	echo "<td>";

	echo "<table class='gps'><tr><td valign='top' align='center'>";

	echo "<i>Manche à balais</i>";
	affiche_joystick($x,$y,$vue,$taille_map);
	
	echo "<br><br>";
	// Affichage du formulaire
	affiche_formulaire($swap_reglage, $swap_affutage , $swap_autres_options, $swap_guide_micheline,$swap_poi,
										 $x,$y,$vue,$taille_map,$quadrillage,$quadrillage_old,$repere,$repere_old,$viseur,$viseur_old,
										 $info_text,$relaismago,$relaismago_old,$baronnies,$baronnies_old,
										 $tanieres_rm, $tanieres_rm_old, $gowaps_rm, $gowaps_rm_old, $allies,$allies_old,
										 $ennemis,$ennemis_old,$guilde_ennemie,$champignons,
										 $id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee,
										 $viseur_id_troll,$lieux);

	echo "</td><td valign=top>";
	
	// Affichage du GPS
	if ($_REQUEST[vue] != "")
		affiche_image($x,$y,$vue,$taille_map,$quadrillage,$repere,$viseur,
								$info_text,$relaismago,$baronnies,$tanieres_rm, $gowaps_rm,$allies,$ennemis,$guilde_ennemie,
								$champignons,$id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee,$lieux,"mode_gps");
	else
		echo "<b><h1>Choisis les options et un ch'it clic sur le bouton sur décollage </h1></b>";

	echo "</td></tr></table>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
	affiche_resultats($relaismago,$baronnies,$tanieres_rm,$gowaps_rm,$allies,$ennemis,
										$guilde_ennemie,$champignons,$vue,$x,$y,
									  $swap_list_relaismago, $swap_list_baronnies,$swap_list_tanieres_rm,
										$swap_list_gowaps_rm,$swap_list_trolls, 
										$swap_list_ennemis, $swap_list_champignons,$swap_list_lieux,$viseur_id_troll,$lieux,
										$id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee
										);

	echo "</form>";
?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1451857-2";
urchinTracker();
</script>

<?
}

###################################
# Fonction de comparaison et maj de $name
###################################
function init_value_with_old_compare($name,$name_old,$default_val)
{
	// Si l'on arrive sur la page
	if ($name_old == "") {
		//$name = "on";
		$name=$default_val;
		$name_old = $default_val;
	} else {
		if ($name == "")
			$name_old = "non";
	}
	$res[0] = $name;
	$res[1] = $name_old;
	return $res;
}

###################################
# Fonction Javascript
###################################
function javascript_joystick()
{
	echo "<script language=\"JavaScript\">";
	echo "function navigation(id)";
	echo "{document.form_gps_advanced.nav.value=id;";
	echo "document.form_gps_advanced.submit();}";
	echo "</script>";
}	

####################################
# Affiche le Joystick
####################################
function affiche_joystick($x,$y,$vue,$taille_map)
{
	echo "<input type='hidden' name='nav'>";
	echo "<table>";
	echo "<tr><td align='center'>";
	echo "<input type='button' value='\' onClick='JavaScript:navigation(1)'>";		
	echo "</td>";
	echo "<td align='center'>";
	echo "<input type='button' value='^' onClick='JavaScript=navigation(2)'>";		
	echo "</td>";
	echo "<td align='center'>";
	echo "<input type='button' value='/' onClick='JavaScript=navigation(3)'>";		
	echo "</td></tr>";

	echo "<tr><td align='center'>";
	echo "<input type='button' value='<' onClick='JavaScript=navigation(4)'>";		
	echo "</td><td align='center'>";
	echo "Zoooom<br>";
	echo "<input type='button' value='In -10' onClick='JavaScript=navigation(9)'>";		
	echo "<input type='button' value='x2' onClick='JavaScript=navigation(11)'>";		
	echo "<input type='button' value='x4' onClick='JavaScript=navigation(13)'><br>";		
	echo "<input type='button' value='Out +10' onClick='JavaScript=navigation(10)'>";		
	echo "<input type='button' value='x2' onClick='JavaScript=navigation(12)'>";		
	echo "<input type='button' value='x4' onClick='JavaScript=navigation(14)'>";		
	echo "</td><td align='center'>";
	echo "<input type='button' value='>' onClick='JavaScript=navigation(5)'>";		
	echo "</td></tr>";

	echo "<tr><td align='center'>";
	echo "<input type='button' value='/' onClick='JavaScript=navigation(6)'>";		
	echo "</td>";
	echo "<td align='center'>";
	echo "<input type='button' value='v' onClick='JavaScript=navigation(7)'>";		
	echo "</td>";
	echo "<td align='center'>";
	echo "<input type='button' value='\' onClick='JavaScript=navigation(8)'>";		
	echo "</td></tr>";

	echo "</table>";
}

######################################
# Met à jour x, y, vue suivant nav et control les débordement de zone
######################################
function naviguer($nav)
{
	global $x,$y,$vue;

	switch ($nav) {
		case 1 : $x -= 10; $y += 10; break;
		case 2 : $x -= 0;  $y += 10; break;
		case 3 : $x += 10; $y += 10; break;
		case 4 : $x -= 10; $y -= 0; break;
		case 5 : $x += 10; $y -= 0; break;
		case 6 : $x -= 10; $y -= 10; break;
		case 7 : $x -= 0;  $y -= 10; break;
		case 8 : $x -= 10; $y -= 10; break;
		case 9 : $vue -= 10; break;
		case 10 : $vue += 10; break;
		case 11 : $vue -= $vue/2; break;
		case 12 : $vue += $vue*2; break;
		case 13 : $vue -= $vue/2; break;
		case 14 : $vue += $vue*2; break;
	}

	// Contrôle des débordements
	if ($vue <= 2) $vue = 3;
	if ($vue >= 200) $vue = 200;
	if ($x>200) $x=200;
	if ($x<-200) $x=-200;
	if ($y>200) $y=200;
	if ($y<-200) $y=-200;

}

#############################
# Affiche le formulaire
############################
function affiche_formulaire($swap_reglage, $swap_affutage , $swap_autres_options, $swap_guide_micheline,
														$swap_poi,
														$x,$y,$vue,$taille_map,$quadrillage,$quadrillage_old,$repere,$repere_old,
														$viseur,$viseur_old,
														$info_text,$relaismago,$relaismago_old, $baronnies,$baronnies_old ,
														$tanieres_rm, $tanieres_rm_old, $gowaps_rm, $gowaps_rm_old, $allies,$allies_old,
														$ennemis,$ennemis_old,$guilde_ennemie,$champignons,
														$id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee,
														$viseur_id_troll, $lieux
														)
{

	echo "<table width=300 ><tr><td>";
	/* ----------------------------------------------------------------------*/
	/* Reglage */
	/* ----------------------------------------------------------------------*/
	$act = "onClick=\"JavaScript:swapSpan('reglage','img_reglage','swap_reglage')\"";
	echo "<br><center><img id='img_reglage' src='images/triangle-bleu.gif' $act> ";
	echo "<b><i><span $act>Réglages</span></i></b>";
	echo "<center>";
	echo "<span id='reglage' style='display: $swap_reglage;'>";
	echo "<input type='hidden' id='swap_reglage' name='swap_reglage' value='$swap_reglage'>";

	echo "<table><tr><td>";
	echo "Taille de la carte </td><td valign=top>"; 
	formulaire_listbox("taille_map",200,2000,100,$taille_map);
	echo "</td><td>";
	afficheAideGpsCritereTailleMap();
	echo "</td></tr>";

	echo "<tr><td>Taille de la vue </td><td>";
	formulaire_listbox("vue",10,200,10,$vue);
	echo "</td><td>";
	afficheAideGpsCritereTailleVue();
	echo "</td></tr>";
	
	echo "<tr><td>Centrer sur </td><td>";
	formulaire_listbox("x",-200,200,1,$x,"plusmoins");
	echo "(x) </td><td>";
	afficheAideGpsCritereCentrerSur();
	echo "</td></tr><tr><td>&nbsp;</td><td>";
	formulaire_listbox("y",-200,200,1,$y,"plusmoins");
	echo "(y) </td><td>";
	afficheAideGpsCritereCentrerSur();
	echo "</td></tr>";

	echo "<tr><td>Viseur sur</td><td>"; 
	echo "<select name='poi_viseur_id_troll'>";
	afficher_listbox_troll_rm_select($viseur_id_troll);
	echo "</select></td><td>";
	afficheAideGpsCritereViseurSur();
	echo "</td></tr>";

	echo "</table>";

	echo "</span>";
	/* ----------------------------------------------------------------------*/

	echo "</td></tr><tr><td>";
	/* ----------------------------------------------------------------------*/
	/* Points d'Intérêts */
	/* ----------------------------------------------------------------------*/
	$act = "onClick=\"JavaScript:swapSpan('poi','img_poi','swap_poi')\"";
	echo "<center><br><img id='img_poi' src='images/triangle-bleu.gif' $act> ";
	echo "<b><i><span $act>Points d'intérêts</span> </i></b>";
	echo "<center>";
	echo "<span id='poi' style='display: $swap_poi;'>";
	echo "<input type='hidden' id='swap_poi' name='swap_poi' value='$swap_poi'>";

	echo "<table>";

	echo "<tr><td>Baronnies </td><td>";
	formulaire_checkbox("baronnies",$baronnies,$baronnies_old);
	echo "</td><td>";
	afficheAideGpsCritereBaronnies();
	echo "</td></tr>";
	
	echo "<tr><td>Tanières RM </td><td>";
	formulaire_checkbox("tanieres_rm",$tanieres_rm,$tanieres_rm_old);
	echo "</td><td>";
	afficheAideGpsCritereTanieresRm();
	echo "</td></tr>";

	echo "<tr><td>Gowap RM </td><td>";
	formulaire_checkbox("gowaps_rm",$gowaps_rm,$gowaps_rm_old);
	echo "</td><td>";
	afficheAideGpsCritereGowapsRm();
	echo "</td></tr>";

	echo "<tr><td>Lieux </td><td>";
	formulaire_listbox_lieux("lieux",$lieux);
	echo "</td><td>";
	afficheAideGpsCritereLieux();
	echo "</td></tr>";

	echo "</table>";

	/* ----------------------------------------------------------------------*/
	echo "</td></tr><tr><td>";

	/* Affutage */
	/* ----------------------------------------------------------------------*/

	$act = "onClick=\"JavaScript:swapSpan('affutage','img_affutage','swap_affutage')\"";
	echo "<center><br><img id='img_affutage' src='images/triangle-bleu.gif' $act> ";
	echo "<b><i><span $act>L'affûtage... </span> </i></b>";
	echo "<center>";
	echo "<span id='affutage' style='display: $swap_affutage;'>";
	echo "<input type='hidden' id='swap_affutage' name='swap_affutage' value='$swap_affutage'>";
	echo "<table>";

	echo "<tr><td>Relais&Mago </td><td>";
	formulaire_checkbox("relaismago",$relaismago,$relaismago_old);
	echo "</td><td>";
	afficheAideGpsCritereRelaisMago();
	echo "</td></tr>";
	
	echo "<tr><td>Alliés / Amis </td><td>";
	formulaire_checkbox("allies",$allies,$allies_old);
	echo "</td><td>";
	afficheAideGpsCritereAlliesAmis();
	echo "</td></tr>";

	echo "<tr><td>Ennemis </td><td>";
	formulaire_checkbox("ennemis",$ennemis,$ennemis_old);
	echo "</td><td>";
	afficheAideGpsCritereEnnemis();
	echo "</td></tr>";

	echo "<tr><td colspan=3>Guildes ennemies </td><td></td></tr>";
	echo "<tr><td colspan=2 nowrap>";
	formulaire_listbox_guildes_ennenmies($guilde_ennemie);
	echo "</td><td>";
	afficheAideGpsCritereGuildesEnnemies();
	echo "</td></tr>";
	
	echo "<tr><td> Champignons </td><td>";
	formulaire_lisbox_champi("champignons",$champignons);
	echo "</td><td>";
	afficheAideGpsCritereChampignons();
	echo "</td></tr>";
	echo "</table>";

	echo "</span>";
	/* ----------------------------------------------------------------------*/

	echo "</td></tr><tr><td>";

	/* Autres options */
	/* ----------------------------------------------------------------------*/

	$act = "onClick=\"JavaScript:swapSpan('autres_options','img_autres_options','swap_autres_options')\"";
	echo "<center><br><img id='img_autres_options' src='images/triangle-bleu.gif' $act> ";
	echo "<b><i><span $act>Autres options</span></i></b>";
	echo "</center>";

	echo "<span id='autres_options' style='display: $swap_autres_options;'>";
	echo "<input type='hidden' id='swap_autres_options' name='swap_autres_options' value='$swap_autres_options'>";
	echo "<table>";

	echo "<tr><td>Quadrillage </td><td>";
	formulaire_checkbox("quadrillage",$quadrillage,$quadrillage_old);
	echo "</td><td>";
	afficheAideGpsCritereQuadrillage();
	echo "</td></tr>";
	
	echo "<tr><td>Repère (0,0) </td><td>";
	formulaire_checkbox("repere",$repere,$repere_old);
	echo "</td><td>";
	afficheAideGpsCritereRepere();
	echo "</td></tr>";
	
	echo "<tr><td>Viseur </td><td>";
	formulaire_checkbox("viseur",$viseur,$viseur_old);
	echo "</td><td>";
	afficheAideGpsCritereViseur();
	echo "</td></tr>";

	echo "<tr><td>InfoText à partir de <br><font size=1>(en nombre de cases de vue)</font></td><td>";
	formulaire_listbox("info_text",10,200,10,$info_text);
	echo "</td><td>";
	afficheAideGpsCritereInfoTexte();
	echo "</td></tr>";
	echo "</table>";

	echo "</span>";
	/* ----------------------------------------------------------------------*/
	echo "</td></tr><tr><td>";

	/* Guide de Micheline */
	/* ----------------------------------------------------------------------*/
	$act = "onClick=\"JavaScript:swapSpan('guide_micheline','img_guide_micheline','swap_guide_micheline')\"";
	echo "<center><br><img id='img_guide_micheline' src='images/triangle-bleu.gif' $act> ";
	echo "<b><i><span $act>Guide de Micheline</span> </i></b>";
	echo "</center>";

	echo "<span id='guide_micheline' style='display: $swap_guide_micheline;'>";
	echo "<input type='hidden' id='swap_guide_micheline' name='swap_guide_micheline' value='$swap_guide_micheline'>";
	
	echo "<table><tr><td>Type Objet Départ</td><td>";
	afficheGuideTypeObjet("depart",$type_objet_depart);
	echo "</td><td>";
	afficheAideGpsCritereMicheline();
	echo "</td></tr>";
	echo "<tr><td>Id Objet Départ </td><td>";
	formulaire_textbox("id_objet_depart",$id_objet_depart,'troll');
	echo "</td><td>";
	afficheAideGpsCritereMicheline();
	echo "</td></tr>";
	echo "<tr><td>Type Objet Arrivée</td><td>";
	afficheGuideTypeObjet("arrivee",$type_objet_arrivee);
	echo "</td><td>";
	afficheAideGpsCritereMicheline();
	echo "</td><tr><td>Id Objet Arrivée </td><td>";
	formulaire_textbox("id_objet_arrivee",$id_objet_arrivee,'troll');
	echo "</td><td>";
	afficheAideGpsCritereMicheline();
	echo "</td></tr>";
	echo "</table>";

	/*echo "<table>";
	echo "<tr><td>N° Troll Départ </td><td>";
	formulaire_textbox("id_objet_depart",$id_objet_depart,'troll');
	echo "</td></tr>";

	echo "<tr><td>N° Troll Arrivée </td><td>";
	formulaire_textbox("id_objet_arrivee",$id_objet_arrivee,'troll');
	echo "</td></tr>";
	echo "</table>";*/
	
	echo "</span>";
	/* ----------------------------------------------------------------------*/
	echo "</td></tr>";
	echo "</table>";

	echo "<br><input type='submit' value='Décollage !'>&nbsp;&nbsp;";
	echo "<input type='button' value='Reset' onClick='JavaScript=document.location.href=\"gps_advanced.php3\"'><br><br>";
	
	echo "<i><b>Accès Vue 2d</b></i>";
	afficheAideGpsAccesVue2d();
	echo "<br><br>";
	if ($vue <=20) {
		$act  = "JavaScript=document.location.href=\"cockpit.php?";
		$act2 = $act."id_troll=$_SESSION[AuthTroll]&centrer=on&cX=$x&cY=$y&taille_vue=5&ZOOM=1.2\"";
		$act .= "id_troll=$_SESSION[AuthTroll]&centrer=on&cX=$x&cY=$y&taille_vue=$vue&ZOOM=1.6\"";
		
		echo " <input type='button' value='>>Accès vue2D (vue de $vue)<<' onClick='$act'><br>";
		echo " <input type='button' value='>>Accès vue2D (vue de 5)<<' onClick='$act2'>";
	} else {
		echo "Zoomez un peu plus pour avoir<br>";
		echo " accès à la vue2d ";
	}
}


##########################
# Listbox des guildes ennemies
##########################
function formulaire_listbox_guildes_ennenmies($guilde_to_select)
{
	global $db_vue_rm;

	$lesGuildes = selectDbGuilde("","tk");
	$nbGuildes = count($lesGuildes);

	echo "<select name='guilde_ennemie'>";
	echo "<option value='-1'>Aucune</option>";
	if ($guilde_to_select == -2 ) $selected="selected";
	echo "<option value='-2' $selected>Toutes</option>";

	for($i=1;$i<=$nbGuildes;$i++) {
		$res = $lesGuildes[$i];
		$selected="";
		if ($guilde_to_select == $res[1]) $selected="selected";
		// Si le nom de la guilde est trop long, on le coupe à 30 caractères
		if(strlen($res[2])>=25) {
			$nom = substr($res[2],0,25)."..."; 
		} else {
			$nom = $res[2];
		}
		echo "<option $selected value='$res[1]'>".stripslashes($nom)."</option>";
		$list_guildes .= "$res[2]<br>";
	}
	echo "</select>";

	// Le nom des guildes ennmies est parfois trop long, on affiche donc une popup 
	// avec la liste des guildes et les noms complets
	affiche_popup("Liste des guildes ennemies","Red",$list_guildes);
}

#########################
# Affiche une checkbox 
#########################
function formulaire_checkbox($name,$checked,$checked_old)
{
	echo "<input type='hidden' name='".$name."_old' value='$checked_old'>";
	if ($checked == "on") $checked = "checked";
	echo "<input type='checkbox' name='$name' $checked>";
}

###########################
# Affiche une textbox avec une valeur par défaut
###########################
function formulaire_textbox($name,$val,$type)
{
	echo "<input type='textbox' name='$name' value='$val' size='6' maxlength='6'>";

	if (($val != "") && ($type == "troll")) {
		if ($val == "nan")
			echo "<tr><td colspan='2'><font color='red'>Veuillez rentrez un chiffre</font></td></tr>";
		elseif ($val == "not")
			echo "<tr><td colspan='2'><font color='red'>Troll non trouvé</font></td></tr>";
	}
}

########################
# Affiche la listbox pour les critères sur les champignons
#######################
function formulaire_lisbox_champi($name,$val_to_select)
{
	echo "<select name='$name'>";

	afficher_listbox_select('non', $val_to_select,"Non");
	afficher_listbox_select('vus', $val_to_select,"Oui (Vus)");
	afficher_listbox_select('5',   $val_to_select,"Stats 5 jours");
	afficher_listbox_select('10',  $val_to_select,"Stats 10 jours");
	afficher_listbox_select('15',  $val_to_select,"Stats 15 jours");
	afficher_listbox_select('30',  $val_to_select,"Stats 30 jours");
	afficher_listbox_select('90',  $val_to_select,"Stats 3 mois");
	afficher_listbox_select('120', $val_to_select,"Stats 6 mois");
	afficher_listbox_select('210', $val_to_select,"Stats 9 mois");
	afficher_listbox_select('254', $val_to_select,"Stats 1 an");
			
	echo "</select>";
}

########################
# Affiche la listbox pour les critères sur les Lieux (POI) 
#######################
function formulaire_listbox_lieux($name,$val_to_select)
{
	echo "<select name='$name'>";

	afficher_listbox_select('', $val_to_select,"");
	afficher_listbox_select('Campement', $val_to_select,"Campement");
	afficher_listbox_select('Caverne', $val_to_select,"Caverne");
	afficher_listbox_select('Croisée des cavernes', $val_to_select,"Croisée des cavernes");
	afficher_listbox_select('Geyser', $val_to_select,"Geyser");
	afficher_listbox_select('Gouffre', $val_to_select,"Gouffre");
	afficher_listbox_select('Gowapier', $val_to_select,"Gowapier");
	afficher_listbox_select('Grotte', $val_to_select,"Grotte");
	afficher_listbox_select('Lac', $val_to_select,"Lac");
	afficher_listbox_select('Portail', $val_to_select,"Portail");
	afficher_listbox_select('Sanctuaire', $val_to_select,"Sanctuaire");
	afficher_listbox_select('Tanière de trõll', $val_to_select,"Tanière Vide");
			
	echo "</select>";
}

#########################################
# Affiche les résultats 
#########################################
function affiche_resultats($relaismago,$baronnies,$tanieres_rm, $gowaps_rm, $allies,$ennemis,
													 $guilde_ennemie,$champignons, $vue,$x,$y,
													 $swap_list_relaismago, $swap_list_baronnies, $swap_list_tanieres_rm, 
													 $swap_list_gowaps_rm, $swap_list_trolls, $swap_list_ennemis,
													 $swap_list_champignons, $swap_list_lieux, $viseur_id_troll,$lieux,
													 $id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee
													 )
{
	 $page = "engine_view.php";

	$taille = $vue * 2;
	$x_min = $x - $taille/2;
	$x_max = $x + $taille/2;
	$y_min = $y - $taille/2;
	$y_max = $y + $taille/2;

	echo "<table class='mh_tdborder' width='60%' align='center'>";
  echo "<tr><td>";

	echo "<table width='100%' cellspacing='0'>";
	echo "<tr class='mh_tdpage' align='center'>";
	echo "<td>";

	echo "<table><tr>";
	if ($relaismago == "on") {
		echo "<td valign='top'>";
		affiche_trolls($page,$x_min,$x_max,$y_min,$y_max,'relaismago', $swap_list_relaismago);
		echo "</td>";
	}
	if ($baronnies == "on") {
		echo "<td valign='top'>";
		affiche_baronnies($page,$x_min,$x_max,$y_min,$y_max, $swap_list_baronnies);
		echo "</td>";
	}

	if ($tanieres_rm == "on") {
		echo "<td valign='top'>";
		affiche_tanieres($page,$x_min,$x_max,$y_min,$y_max, $swap_list_tanieres_rm);
		echo "</td>";
	}

	if ($gowaps_rm == "on") {
		echo "<td valign='top'>";
		affiche_gowaps($page,$x_min,$x_max,$y_min,$y_max, $swap_list_gowaps_rm);
		echo "</td>";
	}

	if ($allies == "on") {
		echo "<td valign='top'>";
		affiche_trolls($page,$x_min,$x_max,$y_min,$y_max,'allies', $swap_list_trolls);
		echo "</td>";
	}

	if ($ennemis == "on") {
		echo "<td valign='top'>";
		affiche_trolls($page,$x_min,$x_max,$y_min,$y_max,'ennemis', $swap_list_ennemis);
		echo "</td>";
	}

	if ($guilde_ennemie != "-1") {
		echo "<td valign='top'>";
		affiche_troll_guilde_ennemie($page,$x_min,$x_max,$y_min,$y_max,$guilde_ennemie);
		echo "</td>";
	}
	
	// On affiche la liste des champignons que l'on voit uniqumeent
	// On affiche pas lorsqu'on demande les statistiques...
	if ($champignons != "non") {
		echo "<td valign='top'>";
		affiche_champignons($champignons,$x_min,$x_max,$y_min,$y_max, $swap_list_champignons);
		echo "</td>";
	}
	if (is_numeric($viseur_id_troll)) {
		echo "<td valign='top'>";
		affiche_viseur_sur($page,$x_min,$x_max,$y_min,$y_max,$viseur_id_troll);
		echo "</td>";
	}
	if ($lieux != "") {
		echo "<td valign='top'>";
		affiche_lieux($page,$x_min,$x_max,$y_min,$y_max,$lieux,$swap_list_lieux);
		echo "</td>";
	}

	if (($id_objet_depart != "") && ($id_objet_arrivee != "")) {
		echo "<td valign='top'>";
		affiche_guide_micheline($page,$id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee);
		echo "</td>";
	}

	echo "</tr></table>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";
}

#############################################
# Affiche la liste des trolls Relais&Mago que l'on voit sur le gps
#############################################
function affiche_trolls($page,$x_min,$x_max,$y_min,$y_max,$type,$swap)
{
	global $db_vue_rm;

	echo "<table class='mh_tdtitre'>";
	echo "<tr class='mh_tdtitre'>";
	echo "<td nowrap> ";
	if ($type=="relaismago") {
		$act = "onClick=\"JavaScript:swapSpan('list_relaismago','img_list_relaismago','swap_list_relaismago')\"";
		
		echo "<img id='img_list_relaismago' src='images/triangle-bleu.gif' $act> ";
		echo "<span $act> Relais&Mago</span>";
		echo "<input type='hidden' id='swap_list_relaismago' name='swap_list_relaismago' value='$swap'>";
		echo "</td></tr></table>";
		echo "<span id='list_relaismago' style='display: $swap;'>";

		$lesTrolls = selectDbGpsTrolls($x_min,$x_max,$y_min,$y_max,ID_GUILDE);

	}elseif ($type=='allies') {
		$act = "onClick=\"JavaScript:swapSpan('list_allies','img_list_allies','swap_list_allies')\"";

		echo "<img id='img_list_allies' src='images/triangle-bleu.gif' $act> ";
		echo "<span $act> Trolls alliés/amis</span>";
		echo "<input type='hidden' id='swap_list_allies' name='swap_list_allies' value='$swap'>";
		echo "</td></tr></table>";
		echo "<span id='list_allies' style='display: $swap;'>";

		$lesTrolls = selectDbGpsTrolls($x_min,$x_max,$y_min,$y_max,'allies');
	}elseif ($type=='ennemis') {
		$act = "onClick=\"JavaScript:swapSpan('list_ennemis','img_list_ennemis','swap_list_ennemis')\"";

		echo "<img id='img_list_ennemis' src='images/triangle-bleu.gif' $act> ";
		echo "<span $act>Ennemis</span>";
		echo "<input type='hidden' id='swap_list_ennemis' name='swap_list_ennemis' value='$swap'>";
		echo "</td></tr></table>";
		echo "<span id='list_ennemis' style='display: $swap;'>";

		$lesTrolls = selectDbGpsTrolls($x_min,$x_max,$y_min,$y_max,'ennemis');
	}

	$nbTrolls = count($lesTrolls);
	echo "<table class='list'>";
	if ($nbTrolls ==0) {
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "<td nowrap>Pas de résultat</td>";
		echo "</tr>";
	}
	for($i=1;$i<=$nbTrolls;$i++) {
		$res = $lesTrolls[$i];
		//$lien = "target=troll HREF='http://games.mountyhall.com/mountyhall/View/PJView_Events.php?ai_IDPJ=$res[1]'";
		$lien = "href='engine_view.php?troll=$res[id_troll]'";
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		echo "<td nowrap><a $lien>$res[id_troll]&nbsp;</a></td>";
		echo "<td nowrap><a $lien>$res[nom_troll]</a></td>";
		echo "<td nowrap><a $lien>($res[x_troll],$res[y_troll],$res[z_troll])</a></td></tr>";
	}
	echo "</table>";
	echo "</span>";
}

#############################################
# Affiche la liste des Baronnies que l'on voit sur le gps
#############################################
function affiche_baronnies($page,$x_min,$x_max,$y_min,$y_max)
{
	global $db_vue_rm;

	echo "<table class='list'>";
	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td>Les Baronnies</td>";
	echo "<td>Baron</td>";
	echo "<td>Trone</td></tr>";

	$lesBaronnies = selectDbGpsBaronnies($x_min,$x_max,$y_min,$y_max);
	$nbBaronnies = count($lesBaronnies);

	for($i=1;$i<=$nbBaronnies;$i++) {
		$res = $lesBaronnies[$i];
		$lien = "href='$page?baronnie=$res[id_baronnie]'";
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		echo "<td><a $lien>".stripslashes($res[nom_baronnie])."&nbsp;</a></td>";
		$lien2 = "href='$page.php?troll=$res[id_baron_baronnie]'";
		echo "<td><a $lien2>$res[nom_baron]</a></td>";
		echo "<td nowrap><a $lien>";
		echo "($res[x_trone_baronnie],$res[y_trone_baronnie],$res[z_trone_baronnie])</a></td></tr>";
	}
	echo "</table>";
}

#############################################
# Affiche la liste des tanières que l'on voit sur le gps
#############################################	
function affiche_tanieres($page,$x_min,$x_max,$y_min,$y_max, $swap)
{
	global $db_vue_rm;

	echo "<table class='list'>";

	$act = "onClick=\"JavaScript:swapSpan('list_tanieres_rm','img_list_tanieres_rm','swap_list_tanieres_rm')\"";
	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td nowrap> ";
		
	echo "<img id='img_list_tanieres_rm' src='images/triangle-bleu.gif' $act> ";
	echo "<span $act>Tanières RM</span>";
	echo "<input type='hidden' id='swap_list_tanieres_rm' name='swap_list_tanieres_rm' value='$swap'>";
	echo "</td></tr></table>";
	echo "<span id='list_tanieres_rm' style='display: $swap;'>";
	
	echo "<table class='list'>";

	$lesTanieres = selectDbGpsTanieres($x_min,$x_max,$y_min,$y_max);
	$nbTanieres = count($lesTanieres);

	if ($nbTanieres ==0) {
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "<td nowrap>Pas de résultat</td>";
		echo "</tr>";
	}
	for($i=1;$i<=$nbTanieres;$i++) {
		$res = $lesTanieres[$i];
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";

		$lien = "href='$page?taniere=$res[id_taniere]'";
		$lien2 = "href='$page.php?troll=$res[nom_troll]'";
		echo "<td nowrap><a $lien2>$res[nom_troll]</a></td>";
		echo "<td nowrap><a $lien>".stripslashes($res[nom_lieu])."&nbsp;</a></td>";
		echo "<td nowrap><a $lien>";
		echo "($res[x_lieu],$res[y_lieu],$res[z_lieu])</a></td></tr>";
	}
	echo "</table>";
}

#############################################
# Affiche la liste des gowaps que l'on voit sur le gps
#############################################	
function affiche_gowaps($page,$x_min,$x_max,$y_min,$y_max, $swap)
{
	global $db_vue_rm;

	echo "<table class='list'>";

	$act = "onClick=\"JavaScript:swapSpan('list_gowaps_rm','img_list_gowaps_rm','swap_list_gowaps_rm')\"";
	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td nowrap> ";
		
	echo "<img id='img_list_gowaps_rm' src='images/triangle-bleu.gif' $act> ";
	echo "<span $act>Gowaps RM</span>";
	echo "<input type='hidden' id='swap_list_gowaps_rm' name='swap_list_gowaps_rm' value='$swap'>";
	echo "</td></tr></table>";
	echo "<span id='list_gowaps_rm' style='display: $swap;'>";
	
	echo "<table class='list'>";

	$lesGowaps = selectDbGpsGowaps($x_min,$x_max,$y_min,$y_max);
	$nbGowaps = count($lesGowaps);

	if ($nbGowaps == 0) {
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "<td nowrap>Pas de résultat</td>";
		echo "</tr>";
	}
	for($i=1;$i<=$nbGowaps;$i++) {
		$res = $lesGowaps[$i];
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";

		$lien = "href='$page?gowap=$res[id_gowap]'";
		$lien2 = "href='$page.php?troll=$res[nom_troll]'";
		echo "<td nowrap><a $lien2>$res[nom_troll]</a></td>";
		echo "<td nowrap><a $lien>".stripslashes($res[nom_monstre])."&nbsp;</a></td>";
		echo "<td nowrap><a $lien>";
		echo "($res[x_monstre],$res[y_monstre],$res[z_monstre])</a></td></tr>";
	}
	echo "</table>";
}


#############################################
# Affiche la liste des lieux l'on voit sur le gps (choisit dans la listbox)
#############################################	
function affiche_lieux($page,$x_min,$x_max,$y_min,$y_max,$nom_lieu,$swap)
{
	global $db_vue_rm;

	echo "<table class='list'>";

	$act = "onClick=\"JavaScript:swapSpan('list_lieux','img_list_lieux','swap_list_lieux')\"";
	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td nowrap>";
		
	echo "<img id='img_list_lieux' src='images/triangle-bleu.gif' $act> ";
	echo "<span $act>Lieux</span>";
	echo "<input type='hidden' id='swap_list_lieux' name='swap_list_lieux' value='$swap'>";
	echo "</td></tr></table>";

	echo "<span id='list_lieux' style='display: $swap;'>";
	
	echo "<table class='list'>";

	$lesLieux = selectDbGpsLieux($x_min,$x_max,$y_min,$y_max,$nom_lieu);
	$nbLieux = count($lesLieux);

	if ($nbLieux ==0) {
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "<td nowrap>Pas de résultat</td>";
		echo "</tr>";
	}
	for($i=1;$i<=$nbLieux;$i++) {
		$res = $lesLieux[$i];
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";

		echo "<td nowrap><a $lien>".stripslashes($res[nom_lieu])."&nbsp;</a></td>";
		echo "<td nowrap><a $lien>";
		echo "($res[x_lieu],$res[y_lieu],$res[z_lieu])</a></td></tr>";
	}
	echo "</table>";
}

#############################################
# Affiche la liste des trolls de la guilde ennemie choisie 
#############################################
function affiche_troll_guilde_ennemie($page,$x_min,$x_max,$y_min,$y_max,$id_guilde)
{
	global $db_vue_rm;

	// -2 Tous les Trolls de guildes ennemies
	if ( $id_guilde==-2) {
		$lesTrolls = selectDbGpsTrolls($x_min,$x_max,$y_min,$y_max,"guildes_ennemies");
		$nom_guide = selectDbGuilde($id_guilde);
	} else {
		$lesTrolls = selectDbGpsTrolls($x_min,$x_max,$y_min,$y_max,$id_guilde);
		$nom_guide = selectDbGuilde($id_guilde);
		$nom_guide = $nom_guilde[1][2]; 
	}
	$nbTrolls = count($lesTrolls);
	
	echo "<table class='list'>";
	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td align='center' colspan='3'>Guilde Ennemie";
	echo "<br><font size=1>".$nom_guilde."</font></td></tr>";

	for($i=1;$i<=$nbTrolls;$i++) {
		$res = $lesTrolls[$i];
		//$lien = "target=troll HREF='http://games.mountyhall.com/mountyhall/View/PJView_Events.php?ai_IDPJ=$res[1]'";
		$lien = "href='$page?troll=$res[id_troll]'";
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\">";
		echo "<td><a $lien>$res[id_troll]&nbsp;</a></td>";
		echo "<td><a $lien>$res[nom_troll]</a></td>";
		echo "<td nowrap><a $lien>($res[x_troll],$res[y_troll],$res[z_troll])</a></td></tr>";
	}
	echo "</table>";
}

#############################################
# Affiche la liste des champignons
#############################################
function affiche_champignons($champignons,$x_min,$x_max,$y_min,$y_max,$swap)
{

	$lesChampis = selectDbChampignons($x_min,$x_max,$y_min,$y_max,$champignons);
	$nbChampis = count($lesChampis);

	echo "<table class='list'>";

	$act = "onClick=\"JavaScript:swapSpan('list_champignons','img_list_champignons','swap_list_champignons')\"";
	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td nowrap>";
	echo "<img id='img_list_champignons' src='images/triangle-bleu.gif' $act> ";
	echo "<span $act>Chamgignons</span>";
	echo "<input type='hidden' id='swap_list_champignons' name='swap_list_champignons' value='$swap'>";
	echo "</td></tr></table>";
	echo "<span id='list_champignons' style='display: $swap;'>";
	
	echo "<table class='list'>";
	if ($nbChampis ==0) {
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "<td nowrap>Pas de résultat</td>";
		echo "</tr>";
	}

	for($i=1;$i<=$nbChampis;$i++) {
		$res = $lesChampis[$i];
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\"> <td coslpan='2' nowrap>";
		echo "$res[nom_champi]</td>";
		echo "<td nowrap>($res[x_champi],$res[y_champi],$res[z_champi]) $res[date_champi]</td></tr>";
	}
	echo "</table>";
	echo "</span>";
}

#############################################
# Affiche le résultat du guide de Micheline
#############################################
function affiche_guide_micheline($page,$id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee)
{

	$res = selectDbMicheline($id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee);

	$depart = $res[0];
	$arrivee = $res[1];

	echo "<table class='list'>";

	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td nowrap>";
	echo "<span $act>Guide de Micheline</span>";
	echo "</td></tr></table>";
	
	echo "<table class='list'>";
	echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
	echo "onmouseout=\"this.className='item-impair'\"> <td nowrap>";

	if ($depart[nom] == "") {
		echo "Départ : $type_objet_depart ($id_objet_depart) non trouvé ! <br>";
	} elseif ($arrivee[nom] == "") {
		echo "Arrivée : $type_objet_arrivee ($id_objet_arrivee) non trouvé ! <br>";
	} else {
		echo "Départ : $type_objet_depart $depart[nom] ";
		echo "($id_objet_depart) ($depart[x],$depart[y],$depart[z]) </td></tr>";

		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\"> <td nowrap>";
		echo "Arrivée : $type_objet_arrivee $arrivee[nom] ";
		echo "($id_objet_arrivee) ($arrivee[x],$arrivee[y],$arrivee[z]) </td></tr>";
	
		echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
		echo "onmouseout=\"this.className='item-impair'\"> <td nowrap> Distance : ";
	
		//prototype de calcPA : calcPA($X,$Y,$Z,$objet,$type); => type ne sert pas ici
		$pa = calcPA($depart[x],$depart[y],$depart[z],$arrivee[x],$arrivee[y],$arrivee[z]);
		$disx= $depart[x]-$arrivee[x];
		$disy= $depart[y]-$arrivee[y];
		$disz= $depart[z]-$arrivee[z];
	
		if ($disx <0) $disx = -$disx;
		if ($disy <0) $disy = -$disy;
		if ($disz <0) $disz = -$disz;
	
		echo " $pa PA <br>";
		echo " Soit : <br>$disx de distance en x <br>";
		echo "$disy de distance en y <br>";
		echo "$disz de distance en z <br>";
	}
	echo "</td></tr>";
	echo "</table>";
	echo "</span>";
}

######################################
# Affiche le troll sur lequel le viseur est positioné
######################################
function affiche_viseur_sur($page,$x_min,$x_max,$y_min,$y_max,$viseur_id_troll)
{
	global $db_vue_rm;
	
	echo "<table class='list'>";
	echo "<tr class='titre-tableau' style='background-color:#6f7ca2;'>";
	echo "<td>Points d'intérêts";
	echo "</td></tr></table>";
	
	if (is_numeric($viseur_id_troll)) {
		$lesTrolls = selectDbTrolls($viseur_id_troll);
		$nbTrolls = count($lesTrolls);

		echo "<table class='list'>";
		for($i=1;$i<=$nbTrolls;$i++) {
			$res = $lesTrolls[$i];
			echo "<tr class=\"item-impair\" onmouseover=\"this.className='item-mouseover'\"";
			echo "onmouseout=\"this.className='item-impair'\"> <td coslpan='2'>";
			echo "<td nowrap>$res[nom_troll]";
			echo "($res[x_troll],$res[y_troll],$res[z_troll])<br>";
			echo "maj le: $res[date_troll] ";
			echo "Vu : $res[is_seen_troll]</td></tr>";
		}
		echo "</table>";
	}	
}


function afficheGuideTypeObjet($name,$val_to_select)
{
	echo "<select name='type_objet_$name'>";

	afficher_listbox_select('', $val_to_select,"");
	afficher_listbox_select('troll', $val_to_select,"Troll");
	afficher_listbox_select('monstre',   $val_to_select,"Monstre");
	afficher_listbox_select('lieux',  $val_to_select,"Lieux");
	afficher_listbox_select('champignon',  $val_to_select,"Champignon");
			
	echo "</select>";
}
#######################################
# Control l'ID d'un troll
#######################################
function control_id_troll($id_troll,$val_default="")
{
	// On regarde s'il est numérique
	if ($id_troll != "") {
		if ( is_numeric($id_troll) == true ){
			if (selectIsExistIdTroll($id_troll) == false)
					$id_troll = "not";
		} else {
			$id_troll = "nan";
		}
	} else {
		$id_troll = $val_default;
	}
	return $id_troll;
}

######################################
# Initialise x et y
######################################
function init_x_y($x,$y,$viseur_id_troll)
{

	global $db_vue_rm;

	if 	($x == "") $x=0;
	if 	($y == "") $y=0;
	
	// On regarde si l'on a demande de centrer sur un troll de la guilde
	if (is_numeric($viseur_id_troll))
	{
		$lesTrolls = selectDbTrolls($viseur_id_troll);
		$nbTrolls = count($lesTrolls);
	
		for($i=1;$i<=$nbTrolls;$i++) {
			$res = $lesTrolls[$i];
			$x = $res[x_troll];
			$y = $res[y_troll];
		}
	}
	$ret['x']=$x;
	$ret['y']=$y;
	return $ret;
}

?>
