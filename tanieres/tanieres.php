<?

require_once('../top.php');
require_once('inc_functions_db_tanieres.php');
require_once('inc_functions_tanieres.php');

require_once('../secure.php');

$type_action = $_REQUEST[type_action];
$id_lieu_gtaniere = $_REQUEST[taniere];


if ( $type_action == "editdb")
	editDbGrandeTaniere();
elseif ( is_numeric($id_lieu_gtaniere) || $id_lieu_gtaniere == 'new' )
	afficher_fiche_gtaniere($id_lieu_gtaniere);	
else
	afficher_liste_gtanieres();

?>
