<?

include_once('inc_connect.php');
####################
# Affiche le gps
####################
function affiche_image($x,$y,$vue,$taille_map,$quadrillage,$repere,$viseur,
											 $info_text,$relaismago,$baronnies,$tanieres_rm, $gowaps_rm, $allies,
											 $ennemis,$guilde_ennemie,$champignons,
											 $id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee,$lieux,$mode)
{
	
	/*echo "<font size='-1'><i>Taille du GPS : $taille_map. Taille de la vue : $vue cases.";
	echo "Centré sur x=$x et y=$y</i></font><br>";*/

	$options .= "?x=$x";
	$options .= "&y=$y";
	$options .= "&vue=$vue";
	$options .= "&taille_map=$taille_map";
	$options .= "&quadrillage=$quadrillage";
	$options .= "&repere=$repere";
	$options .= "&viseur=$viseur";
	$options .= "&info_text=$info_text";
	$options .= "&relaismago=$relaismago";
	$options .= "&baronnies=$baronnies";
	$options .= "&tanieres_rm=$tanieres_rm";
	$options .= "&gowaps_rm=$gowaps_rm";
	$options .= "&allies=$allies";
	$options .= "&ennemis=$ennemis";
	$options .= "&guilde_ennemie=$guilde_ennemie";
	$options .= "&champignons=$champignons";
	$options .= "&id_objet_depart=$id_objet_depart";
	$options .= "&id_objet_arrivee=$id_objet_arrivee";
	$options .= "&type_objet_depart=$type_objet_depart";
	$options .= "&type_objet_arrivee=$type_objet_arrivee";
	$options .= "&lieux=$lieux";
	$options .= "&mode_radar=$mode";


  echo "\n<map name='gps' id=backMap>\n"; 
	$_SESSION[mode_radar] = "map_write";
  include("gps_advanced_img.php");
  echo "</map>\n";

	$_SESSION[mode_radar] = "";

	echo "<img border='0' id=carteDyn usemap='#gps' onload='init();' onMouseDown='mouseDown();' onClic='mouseDown();'";
	echo " src='gps_advanced_img.php$options' style='cursor:crosshair'";
	echo ">";
}

?>
