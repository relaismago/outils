<?
include_once('top.php');

initSource();
include_once('foot.php');

function initSource()
{
	echo "<br><br><br><br>";
	afficher_titre_tableau('Les sources des outils '.RELAISMAGO);

	$text = "Les outils ".RELAISMAGO." sont développés sous licence GPL.<br><br>";
	$text .= "Vous pouvez obtenir les sources à partir de TrollForge : <br>";
	$text .= "<a href='http://trollforge.lipyx.net/projects/relaismago/'>http://trollforge.lipyx.net/projects/relaismago/</a>";
	$text .= "<br><br>Une documentation d'installation est disponible <a href='http://outils.relaismago.com/documentation/documentation.pdf'>Ici</a>";
	$text .= " <br><br> Pour plus d'informations, contactez Bodéga (49145).";

	afficher_contenu_tableau($text);

}

?>
