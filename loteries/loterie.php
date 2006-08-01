<?

require_once('../top.php');
require_once('../functions_engine.php');

require_once('../secure.php');   
require_once('inc_loterie.php');   
require_once('loterie.class.php');   
require_once('loteries.class.php');   
require_once('loterie_participant.class.php');   
require_once('loterie_participants.class.php');   

init_loterie();

function init_loterie()
{

	$img = "<img src='/images/loterie.jpg'>";
	//afficher_titre_tableau("$img",$text);  
	afficher_titre_tableau($img);
	
	$loteries = new loteries();
	$id_loterie = $loteries->get_last_id_loterie();
	
	$loterie_participant = new loterie_participant($_SESSION[AuthTroll], $id_loterie);

	$id_troll = $_SESSION[AuthTroll];
	if ($_SESSION[admin] == "authenticated" && is_numeric($_GET[id_troll])) { 
		$id_troll = $_GET[id_troll];
	}

	if ($_GET[admin] == "liste") {
		loterie_admin_liste();

	} elseif ($_POST[admin_post] == "enregistre") {
		loterie_admin_enregistre($_REQUEST[id_loterie]) ;   

	} elseif ($_GET[admin] == "fiche") {
		loterie_admin_fiche($_REQUEST[id_loterie]);

	} elseif ($_GET[admin] == "cloturer") {
		loterie_admin_cloturer($_REQUEST[id_loterie]) ;   

	} elseif ($_GET[admin] == "encours") {
		loterie_admin_encours($_REQUEST[id_loterie]) ;   

	} elseif ($_POST[gain] == "enregistre") {
		loterie_interface_gain_enregistre($id_troll, $_POST[gain_num_loterie]);

	} elseif ($_GET[gain] == "liste") {
		loterie_interface_gain_liste($id_troll);

	} elseif ($_GET[gain] == "fiche") {
		loterie_interface_gain_fiche($id_troll, $_GET[id_loterie]);

	} elseif ($_GET[gain] == "liste") {
		loterie_interface_gain_liste($id_troll, $id_loterie);


	} elseif ($loterie_participant->is_participant()) {
		loterie_informations($id_loterie);
		loterie_participation_existante();

	} elseif (!$loterie_participant->can_participe()) {
		loterie_participation_refusee();

	} else {
		if ($_POST['actiondb'] == 'enregistre' && $_POST['participe'] == 'oui')
			loterie_enregistre_participation($id_loterie);
		else {
			loterie_informations($id_loterie);
			$loterie = new loterie($id_loterie);
			// on v&eacute;rifie que l'&eacute;tat &eacute;tait bien en_cours
			if ($loterie->get_etat() == 'en_cours')
				loterie_nouvelle_participation($id_loterie);
			else
				afficher_contenu_tableau("La loterie n'est pas encore ouverte");
		}
	}
}
?>
