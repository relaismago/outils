<?
include_once('../top.php');

initSource();
include_once('../foot.php');

function initSource()
{
	echo "<br><br>";
	afficher_titre_tableau('Liens Pratiques');
	
	//$text .= "<a href=''></a><br>";

	$text .= "<b>Gowaps</b><br>";


	$text .= "<a href='http://www.mountyhall.com/mountyhall/Forum/display_topic_threads.php?ForumID=17&TopicID=44799&PagePosition=1#'>Gowapiers : Tarifs</a><br>";
	$text .= "<a href='http://www.mountyhall.com/mountyhall/Forum/display_topic_threads.php?ForumID=10&TopicID=34731&PagePosition=1'>FAQ Gowap</a><br>";

	$text .= "<a href='http://www.g-ros.com/~burk/Asile/gowap/'>Salle des archives Gowap (Asile)</a><br>";

	$text .= "<a href='http://thextrolls.free.fr/?page=gowapiers'>Gowapiers (X-Trolls)</a><br>";
	$text .= "<hr noshade>";

	$text .= "<b>Puits</b><br>";

	$text .= "<a href='http://trolls.game-host.org/mountyhall/lieux.php?search=position&orderBy=distance&posx=0&posy=0&posn=0&typeLieu=7'>Puits recencés chez les Bricol'Trolls</a><br>";

	$text .= "<hr noshade>";
	$text .= "<br><b>Hors-Jeux</b><br>";
	$text .= "<a href='http://games.mountyhall.com/mountyhall/ScriptPublic/'>Page d'aide des Scripts Publics</a><br>";

	afficher_contenu_tableau($text);
}

?>
