<?
include_once('top.php');

initSource();
include_once('foot.php');

function initSource()
{
	echo "<br><br><br><br>";
	afficher_titre_tableau('Les sources des outils '.RELAISMAGO);

	$text = "Les outils ".RELAISMAGO." sont d�velopp�s sous licence GPL.<br/><br/>";
	$text .= "Vous pouvez obtenir les sources sur� <br/>";
	$text .= "<a href='https://github.com/relaismago/outils'>https://github.com/relaismago/outils</a>";
	$text .= "<br/><br/>Une documentation d'installation est disponible <a href='/documentation/documentation.pdf'>Ici</a>";
	$text .= " <br/><br/> Pour plus d'informations, contactez glupglup (51166).";

	afficher_contenu_tableau($text);

}

?>
