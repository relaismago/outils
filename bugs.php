<?

include_once ("inc_connect.php3");
include_once ("functions_auth.php");

include_once ("bugs_functions.php");
include_once ("bugs_functions_db.php");

include_once ("top.php");

$bug = $_REQUEST[bug];

init_bug($bug);
	
function init_bug($bug)
{

  // Si l'on vient de remplir le formulaire d'ajout ou d"�dition 
  // d'un bug, on met � jour la bdd
/*  if ($bug == "edit" && userIsGuilde()) {
    editDbBug(); // editDbBug ne prend pas de parametre

	// Suppression d'un bug
  } elseif ( (is_numeric($bug)) && ($_REQUEST[action] == "del")  && userIsGuilde()) {
    deleteDbBug($bug);
*/
  // On affiche le formulaire si l'on connait l'id du bug
  // ou que l'on veut en cr�er un nouveau
  if (is_numeric($bug)) {
		afficher_titre_tableau("Bug Track des outils ".RELAISMAGO,bug_affiche_info());
    afficherFicheBug($bug);

  // Sinon, on affiche la liste des bugs
  } else {
/*		$text = "<i>Vous venez de d�couvrir un dysfonctionnement dans les outils, ou vous voulez voir ";
		$text .= "une nouvelle fonctionnalit� appara�tre ? Cet outil est pour vous !</i><br><br>";
		if (userIsGuilde()) {
			$text .= "<input type='button' class='mh_form_submit' ";
			$text .= "onClick=\"Javascript:document.location.href='bugs.php?bug=new'\" value=\"Ajouter un bug ou une demande d'am�lioration\">";
		} else {
			$text .= "L'ajout de Bug ou Souhait est uniquement accessible par les ".RELAISMAGO." authentifi�s pour l'instant.<br>";
		}*/
		afficher_titre_tableau("Bug Track ".RELAISMAGO." : Les Bugs ou Souhaits dans les outils",bug_affiche_info());

    afficherListeBugs();
  }
}

function bug_affiche_info()
{
	$text = "L'ajout de bugs s'effectue � l'aide de la nouvelle interface : <br>";
	$text .= "<a href='http://outils.lipyx.net/bugs/?group=relaismago'>Anomalies</a><br>";
	$text .="Avec cette interface, les d�veloppeurs recevront un mail � chaque nouveau bug,";
	$text .= "et vous aussi lorsque celui-ci sera corrig�.<br><br>";
	$text .= "Tous les bugs pr�sents ici seront transf�r�s sur la nouvelle interface.<br>";
	$text .= "Pour ajouter un bug, vous devrez �tre authentifi�. Pour vous inscrire, c'est ici : ";
	$text .= "<a href='http://outils.lipyx.net/account/register.php'>http://outils.lipyx.net/account/register.php</a>";
	$text .= "Pour toutes questions, contactez Bodega (49145).";

	return $text;
}

?>
