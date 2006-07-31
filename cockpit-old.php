<?
$tab_cookies = initCookie();

include_once('top.php');
include_once('functions_engine.php');

include_once('secure.php');

if ( isset($_REQUEST['refresh']) && (($_REQUEST['refresh'] == "s_public")||($_REQUEST['refresh'] == "copie_colle")) ) {
	initRefresh();
} else {
	$info = initCockpit($tab_cookies);
	bodyCockpit($info);
}

include_once('foot.php');

function initCockpit($tab_cookies)
{

	include('gps_advanced_js.php3');

	$info = initVue2d($tab_cookies);
	javascriptRecherchator($info);

	?>
	<table class='mh_tdborder' width='98%' align='center'>
	<tr class='mh_tdpage'>
		<td>
			<table width='100%' class='cockpit' align='center'>
				<tr class='mh_tdpage'>
					<td width='30%' valign='top' class='options_vue'>
						<? afficherOptionsVue2d($info) ?>
					</td>
					<td width='45%' valign='top' class='options_recherchator'>
						<? afficherCockpitRecherchator() ?>
					</td>
					<td width='15%' align='right' valign='top' class='options_radar'>
						<? afficherCockpitRadar() ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?
	return $info;
}

function bodyCockpit($info)
{
	if ($_REQUEST['recherche'] != "")
		engine_recherche($_REQUEST['recherche']);
	else
		afficher_vue2d($info);
}

function initCookie()
{

  if (isset($_REQUEST['anim'])) $anim = $_REQUEST['anim']; else $anim = "";
  if (isset($_REQUEST['trolls_disparus'])) $trolls_disparus = $_REQUEST['trolls_disparus']; else $trolls_disparus = "";

  if ($anim == "non" || ($_COOKIE['ANIMATIONS'] == "") ) {
    setcookie("ANIMATIONS","non",time()+365*24*3600);
    $anim="non";
  } elseif ($anim == "oui") {
    setcookie("ANIMATIONS","oui",time()+365*24*3600);
  } else {
    $anim=$_COOKIE['ANIMATIONS'];
  }

  if ( $trolls_disparus == "oui" || ($_COOKIE['TROLLS_DISPARUS'] == "") ) {
    setcookie("TROLLS_DISPARUS","oui",time()+365*24*3600);
    $trolls_disparus = "oui";
  } elseif ( $trolls_disparus == "non") {
    setcookie("TROLLS_DISPARUS","non",time()+365*24*3600);
  } else {
    $trolls_disparus = $_COOKIE['TROLLS_DISPARUS'];
  }

	$tab_cookies["anim"] = $anim;
	$tab_cookies["trolls_disparus"] = $trolls_disparus;

	return $tab_cookies;
}


?>
