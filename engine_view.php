<?

include_once ("inc_connect.php3");
include_once ("inc_define_vars.php");

include_once ("admin_functions.php3");
include_once ("admin_functions_db.php3");
include_once ("functions_engine.php");
include_once ("functions_display.php");

if (!isset($_REQUEST['pass']) || md5($_REQUEST['pass']) != MD5_PASS_EXTERNE) {
	include_once('top.php');
	include_once("secure.php");
}

// Variable que l'on peut recevoir de l'url
$baronnie =				isset($_REQUEST['baronnie']) ?				$_REQUEST['baronnie']				: "";
$troll =				isset($_REQUEST['troll']) ?					$_REQUEST['troll']					: "";
$troll_action =			isset($_REQUEST['troll_action']) ?			$_REQUEST['troll_action']			: "";
$troll_type_action =	isset($_REQUEST['troll_type_action']) ?		$_REQUEST['troll_type_action']		: "";
$guilde =				isset($_REQUEST['guilde']) ?				$_REQUEST['guilde']					: "";
$gowap =				isset($_REQUEST['gowap']) ?					$_REQUEST['gowap']					: "";
$taniere =				isset($_REQUEST['taniere']) ?				$_REQUEST['taniere']				: "";
$recherche =			isset($_REQUEST['recherche']) ?				$_REQUEST['recherche']				: "";
$change_password =		isset($_REQUEST['change_password']) ?		$_REQUEST['change_password']		: "";
$bdd =					isset($_REQUEST['bdd']) ?					$_REQUEST['bdd']					: "";
$avatar =				isset($_REQUEST['avatar']) ?				$_REQUEST['avatar']					: "";
$distinction =			isset($_REQUEST['distinction']) ?			$_REQUEST['distinction']			: "";
$composant =			isset($_REQUEST['composant']) ?				$_REQUEST['composant']				: "";
$stats_vue_publique =	isset($_REQUEST['stats_vue_publique']) ?	$_REQUEST['stats_vue_publique']		: "";
$stats_refresh_auto =	isset($_REQUEST['stats_refresh_auto']) ?	$_REQUEST['stats_refresh_auto']		: "";
$stats_connection =		isset($_REQUEST['stats_connection']) ?		$_REQUEST['stats_connection']		: "";
$list_pass_error =		isset($_REQUEST['list_pass_error']) ?		$_REQUEST['list_pass_error']		: "";
$list_manual_refresh =	isset($_REQUEST['list_manual_refresh'])	?	$_REQUEST['list_manual_refresh']	: "";
$info_ftp_files =		isset($_REQUEST['info_ftp_files']) ?		$_REQUEST['info_ftp_files']			: "";

// On regarde si la personne est authentifiée.
if ($_SESSION['admin'] == "authenticated")
	$isAdmin = true;
else
	$isAdmin= false ;

init_administration($isAdmin,$baronnie,$guilde,$troll,$troll_type_action,$troll_action,$gowap,$taniere,
										$recherche,$change_password,$bdd,$avatar,$distinction,$composant,$stats_vue_publique,
										$stats_refresh_auto,$stats_connection,$info_ftp_files,$list_pass_error,$list_manual_refresh);	


###########################
# Point d'entré
###########################
function init_administration($isAdmin,$baronnie,$guilde,$troll,$troll_type_action,
													 	 $troll_action,$gowap,$taniere,
														 $recherche, $change_password,$bdd, $avatar, $distinction, $composant,
														 $stats_vue_publique,$stats_refresh_auto,$stats_connection,$info_ftp_files,$list_pass_error,
														 $list_manual_refresh)
{

	afficher_entete($isAdmin);
	
	if ($baronnie != "")
		engine_baronnie($isAdmin,$baronnie);
	elseif ($guilde != "")
		engine_guilde($isAdmin,$guilde);
	elseif ($troll != "")
		engine_troll($isAdmin,$troll,$troll_type_action,$troll_action);
	elseif ($gowap != "")
		engine_gowap($isAdmin,$gowap);
	elseif ($taniere != "")
		engine_taniere($isAdmin,$taniere);
	elseif ($change_password != "")
		engine_change_password($isAdmin,$change_password);
	elseif ($bdd != "")
		engine_bdd($isAdmin,$bdd);
	elseif ($recherche != "")
		engine_recherche($recherche,true);
	elseif ($avatar != "")
		engine_avatar($isAdmin,$avatar);
	elseif ($distinction != "")
		engine_distinction($isAdmin,$distinction);
	elseif ($composant != "")
		engine_composant($isAdmin,$composant);
	elseif ($stats_vue_publique != "")
		engine_stats_vue_publique($isAdmin);
	elseif ($stats_refresh_auto != "")
		engine_stats_refresh_auto($isAdmin);
	elseif ($stats_connection != "")
		engine_stats_connection($isAdmin);
	elseif ($list_pass_error != "")
		engine_list_passe_error($isAdmin);
	elseif ($list_manual_refresh != "")
		engine_list_manual_refresh($isAdmin);
	elseif ($info_ftp_files != "")
		engine_info_ftp_files($isAdmin);

	include_once('foot.php');
}


############################
# On affiche les liens vers les différentes gestions
###########################
function afficher_entete($isAdmin)
{
	afficher_titre_tableau("Renseignements Généraux");
}


?>
