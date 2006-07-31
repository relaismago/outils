<?

include_once("functions_auth.php");
include_once("functions_display.php");
include_once("gps_advanced_functions.php3");

?>
<html>
<head>
<script type="text/javascript" src="/js/overlib.js"><!-- overLIB (c) Erik Bosrup --></script>
<script type="text/javascript" src="/js/overlib_exclusive.js"><!-- overLIB (c) Erik Bosrup --></script>
<? if ( userIsGuilde() ) { ?>
<link rel='stylesheet' href='/css/news.css' type='text/css'>
<? } ?>
</head>
<body>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
<div class=popperlink id=topdecklink style='z-index:1000;'></div>
<script language="javascript" src="vue.js" type="text/javascript">
</script>

<?




$x = $_REQUEST[x];
$y = $_REQUEST[y];
$vue = $_REQUEST[vue];
$taille_map = $_REQUEST[taille_map];
$quadrillage = $_REQUEST[quadrillage];
$repere = $_REQUEST[repere];
$viseur = $_REQUEST[viseur];
$info_text = $_REQUEST[info_text];
$relaismago = $_REQUEST[relaismago];
$baronnies = $_REQUEST[baronnies];
$tanieres_rm = $_REQUEST[tanieres_rm];
$gowaps_rm = $_REQUEST[gowaps_rm];
$allies = $_REQUEST[allies];
$ennemis = $_REQUEST[ennemis];
$guilde_ennemie = $_REQUEST[guilde_ennemie];
$champignons = $_REQUEST[champignons];
$id_objet_depart = $_REQUEST[id_objet_depart];
$id_objet_arrivee = $_REQUEST[id_objet_arrivee];
$type_objet_depart = $_REQUEST[type_objet_depart];
$type_objet_arrivee = $_REQUEST[type_objet_arrivee];
$lieux = $_REQUEST[lieux];
$mode = $_REQUEST[mode_radar];


affiche_image($x,$y,$vue,$taille_map,$quadrillage,$repere,$viseur,
              $info_text,$relaismago,$baronnies,$tanieres_rm, $gowaps_rm,$allies,$ennemis,$guilde_ennemie,
              $champignons,$id_objet_depart,$id_objet_arrivee,$type_objet_depart,$type_objet_arrivee,$lieux,"");

?>
