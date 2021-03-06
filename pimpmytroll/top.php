<?php
session_start();
header("Pragma: no-cache");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");

if (strstr($_SERVER['HTTP_HOST'],"relaismago.cat-the-psion.net")) {
	die("L'adresse est : <a href='http://outils.relaismago.com'>http://outils.relaismago.com</a>");
}

require_once('../functions_auth.php');
require_once('../functions_display.php');
require_once('../functions_help.php');
require_once('../options_functions_db.php');

require_once('../includes/troll.class.php');
require_once('../loteries/loterie.class.php');
require_once('../loteries/loteries.class.php');
require_once('../loteries/loterie_participant.class.php');
require_once('../loteries/loterie_participants.class.php');  
require_once('../loteries/inc_loterie.php');  

require_once('../includes/ggc_groupe.class.php');
require_once('../includes/recherche.class.php');
require_once('../includes/options.class.php');

setlocale (LC_TIME, 'fr_FR.ISO8859-1');
initAuth();

?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
all.clsMenuItemNS, .clsMenuItemIE{text-decoration: none; font: bold 12px Arial; color: white; cursor: hand; z-index:1000}
#MainTable A:hover {color: yellow;}
</style>
<link rel='stylesheet' href='/css/MH_Style_Play.css' type='text/css'>
<link rel='stylesheet' href='/css/feuille2.css' type='text/css'>
<link rel='stylesheet' href='/css/vue.css' type='text/css'>
<script language="JavaScript">
	var keepstatic=0 //specify whether menu should stay static 0=non static (works only in IE4+)
	var menucolor="#000000" //specify menu color
	var menucolorItem="#30385C" //specify menu color
	var menucolorOver="#3038b5" //specify menu color
	var submenuwidth=150 //specify sub menus' color
</script>
<script SRC="/menu/ssmMenu.js" language="JavaScript1.2"></script>
<script src="/menu/ssmItems.php" language="JavaScript1.2"></script>
<script language="javascript" type="text/javascript" src="/js/overlib.js"></script>
<script language="javascript" type="text/javascript" src="/js/overlib_exclusive.js"></script>
<script language="javascript" type="text/javascript" src="/js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="/js/recherche.js"></script>
<script language="javascript" type="text/javascript" src="/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="/js/pmt.js"></script>
<script language="javascript" type="text/javascript">var $j = jQuery.noConflict();</script>
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

<br><br><table width='100%'>
<tr valign='top'><td>
<? afficherFormAuth(); ?>
</td><td align='left' width='60%' valign='top'>

<? if ( userIsGuilde() ) { ?>
<table width="100%" class='mh_tdborder'>
	<tr class="mh_tdtitre">
		<td>
			<marquee behavior="scroll" align="center" direction="left" scrollamount="2" scrolldelay="3" onmouseover='this.stop();' onmouseout='this.start();'>
<? echo "Maj liste trolls : ".getTraitement("TROLLS"); ?>
 &nbsp; &nbsp; &nbsp; &nbsp; 
<? echo "Maj liste guildes: ".getTraitement("GUILDES"); ?>
 &nbsp; &nbsp; &nbsp; &nbsp; 
<? echo "Maj avatars clairs: ".getTraitement("AVATARS_CLAIRS"); ?>
 &nbsp; &nbsp; &nbsp; &nbsp; 
<? echo "Maj avatars sombres: ".getTraitement("AVATARS_SOMBRES"); ?>
 &nbsp; &nbsp; &nbsp; &nbsp; 
<? echo "Maj affiches wanted: ".getTraitement("AFFICHES_WANTED"); ?>
			</marquee>
		</td>
	</tr>
		<?
		loterie_info_top();
		?>
</table>
<? } ?>


</td>

<? if ( userIsGuilde() || userIsGroupSpec() ) { 
	echo "<td align='left' width='40%' valign='top'>";
	afficherAccesRapide();
	$recherche = new recherche();
	echo $recherche->get_html_input();
	echo "</td>";
} ?>

</tr>
</table>

<? 
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
				r&eacute;gl&eacute;es ! C'est par l� => <a href='/options.php'>Ici</a></font></h2>
			</td>
		</tr>
	</table><br>

	<?
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
<?
} 
?>
