<?php
header("Pragma: no-cache");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");

if (strstr($_SERVER['HTTP_HOST'],"relaismago.cat-the-psion.net")) {
	die("L'adresse est : <a href='http://outils.relaismago.com'>http://outils.relaismago.com</a>");
}

require_once('functions_auth.php');
require_once('functions_display.php');
require_once('functions_help.php');
require_once('options_functions_db.php');

require_once('includes/troll.class.php');
require_once('loteries/loterie.class.php');
require_once('loteries/loteries.class.php');
require_once('loteries/loterie_participant.class.php');
require_once('loteries/loterie_participants.class.php');  
require_once('loteries/inc_loterie.php');  

require_once('includes/ggc_groupe.class.php');
require_once('includes/recherche.class.php');
require_once('includes/options.class.php');

setlocale (LC_TIME, 'fr_FR.ISO8859-1');
initAuth();

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<script SRC="/menu/ssmMenu.js" language="JavaScript1.2"></script>
<script src="/menu/ssmItems.php" language="JavaScript1.2"></script>-->

<!-- start -->
<style>
all.clsMenuItemNS, .clsMenuItemIE{text-decoration: none; font: bold 12px Arial; color: white; cursor: hand; z-index:1000}
#MainTable A:hover {color: yellow;}
</style>

<script language="JavaScript">

//Top Nav Bar I v2.1- By Constantin Kuznetsov Jr.
//Modified by Dynamic Drive for various improvements
//Visit http://www.dynamicdrive.com for this script

var keepstatic=0 //specify whether menu should stay static 0=non static (works only in IE4+)
var menucolor="#000000" //specify menu color
var menucolorItem="#30385C" //specify menu color
var menucolorOver="#3038b5" //specify menu color
var submenuwidth=150 //specify sub menus' color

</script>
<!-- end -->


<link rel='stylesheet' href='/css/MH_Style_Play.css' type='text/css'>
<link rel='stylesheet' href='/css/feuille2.css' type='text/css'>
<link rel='stylesheet' href='/css/vue.css' type='text/css'>
<script type="text/javascript" src="/js/overlib.js"><!-- overLIB (c) Erik Bosrup --></script>
<script type="text/javascript" src="/js/overlib_exclusive.js"><!-- overLIB (c) Erik Bosrup --></script>
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript" src="/js/effects.js"></script>
<script language="javascript" type="text/javascript" src="/js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="/js/recherche.js"></script>
<script src="js/livesearch.js"></script>	
</head>
<body onload="liveSearchInit()">

<script language="JavaScript" src="/menu/menu.js"></script>
<script language="JavaScript" src="/menu/ssmItems.php"></script>

<!-- start -->
<script language="JavaScript">
showToolbar();
</script>
<script language="JavaScript">
function UpdateIt(){
if (ie&&keepstatic&&!opr6)
document.all["MainTable"].style.top = document.body.scrollTop;
setTimeout("UpdateIt()", 200);
}
UpdateIt();
</script>
<!-- end -->

<br/><br/><table width='100%'>
<tr valign='top'><td>
<?php afficherFormAuth(); ?>
</td><td align='left' width='60%' valign='top'>

<?php if ( userIsGuilde() ) { ?>
<table width="100%" class='mh_tdborder'>
	<tr class="mh_tdtitre">
		<td>
			<marquee behavior="scroll" align="center" direction="left" scrollamount="2" scrolldelay="3" onmouseover='this.stop();' onmouseout='this.start();'>
<?php echo "Maj liste trolls : ".getTraitement("TROLLS"); ?>
 &nbsp; &nbsp; &nbsp; &nbsp; 
<?php echo "Maj liste guildes: ".getTraitement("GUILDES"); ?>
 &nbsp; &nbsp; &nbsp; &nbsp; 
<?php echo "Maj avatars clairs: ".getTraitement("AVATARS_CLAIRS"); ?>
 &nbsp; &nbsp; &nbsp; &nbsp; 
<?php echo "Maj avatars sombres: ".getTraitement("AVATARS_SOMBRES"); ?>
 &nbsp; &nbsp; &nbsp; &nbsp; 
<?php echo "Maj affiches wanted: ".getTraitement("AFFICHES_WANTED"); ?>
			</marquee>
		</td>
	</tr>
		<?php
		loterie_info_top();
		?>
</table>
<?php } ?>


</td>

<?php if ( userIsGuilde() || userIsGroupSpec() ) { 
	echo "<td align='left' width='40%' valign='top'>";
	afficherAccesRapide();
	$recherche = new recherche();
	echo $recherche->get_html_input();
	echo "</td>";
} ?>

</tr>
</table>

<?php 
unset($_SESSION['options']);
if ( userIsGuilde() || userIsGroupSpec() ) { 
	if (!isset($_SESSION['options'])) {
		$options = new options($_SESSION['AuthTroll']);
		$_SESSION["options"] = $options->get_options_tab();
	}
	unset($options);
	$options = $_SESSION["options"];

if ($options["date_option"] == '') {
	?>
	<table class='mh_tdborder' align='center' width='80%'>
		<tr align='center' class=mh_tdborder'>
			<td colspan='3' class='mh_tdtitre'>
				<h2><font color='red'>Nouvelles options disponibles et vous ne les avez pas encore
				r&eacute;gl&eacute;es ! C'est par là => <a href='/options.php'>Ici</a></font></h2>
			</td>
		</tr>
	</table><br/>

	<?php
}
?>
    <div id="status_recherche" style="display: none">
      <div class="progressBar" id="progress_bar">
        <div class="border" id='border'>
          <div class="background" id='background_recherche'>
            <div class="foreground" id='foreground_recherche'>Patience...</div>
          </div>
        </div>
      </div>
    </div>
    <div id="recherche_cage">
    </div>
<?php
} 
?>
