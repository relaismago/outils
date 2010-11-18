<?
DIE('ERREUR GPS HELP');

function afficheAideImg($titre, $titre_couleur, $text)
{
	$text = addslashes($text);
	$titre = addslashes($titre);
	
	echo "<img src='images/aide_puce.gif' ";
	echo " onmouseover=\"return overlib('$text',CAPTION,'Clique ! $titre');\"";
	echo " onclick=\"return overlib('$text', STICKY, CAPTION, 'Informations', CLOSECLICK, EXCLUSIVE);\" ";
	echo " onmouseout=\"return nd();\">";

/*  echo " <img src='images/aide_puce.gif' onMouseOver=\"poplink('";  
  echo "<center><font color=$titre_couleur>$titre</font></center><br>";
	echo $text;
  echo " ')\" onmouseout=\"killlink()\">";*/

}

function afficheAideGpsAdvanced()
{
	$titre = "Le GPS Advanced";

  $text = "GPS : Global Positioning System<br><br>";

	$text .= "Le GPS s'appelle GPS Advanced, puisqu'il utilise le second";
	$text .= " lot de Satellites envoy� autour de la terre MountyHall.<br><br>";
	$text .= " Sa pr�cision tient compte de tous les donn�es re�ues par les satellites";
	$text .= " <font color=yellow>Relais</font>&<font color=yellow>Mago</font>.<br><br>";
	$text .= " <font color=red>D�finition : </font> Un satelitte est un troll ";
	$text .= " <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " qui utilise les outils <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " et renseigne donc par ce biais <br>les positions de chaque objet qu'il peut voir.<br><br>";
	$text .= " <font color=yellow>C'est donc g�ographiquement Trollement Chouette ;-)</font><br><br>";
	

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereTailleMap()
{
	$titre = "Aide : Taille de la Carte";

  $text = "La taille de la carte est en pixel.<br><br>";

	$text .= "Plus vous mettez une taille importante,";
	$text .=" plus l'image sera grande � l'�cran.<br>";

	afficheAideImg($titre, "yellow", $text);
} 

function afficheAideGpsCritereTailleVue()
{
	$titre = "Aide : Taille de la vue";
  $text = "La taille de la vue est en nombre de cases.<br><br>";
	$text .= "Si vous mettez une vue de 20, vous pourrez";
	$text .=" voir 40 cases horizontalement et 40 cases verticalement.<br><br>";
	$text .=" La taille de la vue est aussi appel�e Zoom dans le gps.<br>";

	afficheAideImg($titre, "yellow", $text);
} 

function afficheAideGpsCritereCentrerSur()
{
	$titre = "Aide : Centrage du GPS";

  $text = "Vous pouvez centrer sur une case donn�e en pr�cisant (x) et (y).<br><br>";
	$text .= "<font color=red>Attention</font> : Si le viseur est centr� sur un troll de la guilde,<br> ";
	$text .= "cette option (centrer sur x, ou sur y) n'est pas prise en compte.<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereViseurSur()
{
	$titre = "Aide : Viseur Sur";

  $text = "Vous pouvez positionner le viseur sur un troll de la guide.<br><br>";
	$text .= "<font color=red>Attention</font> : Si le viseur est centr� sur un troll de la guilde,<br> ";
	$text .= "les options centrer sur x, ou centrer sur y ne sont pas prises en compte.<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereRelaisMago()
{
	$titre = "Aide : L'affutage RelaisMago";

  $text = "Si vous cochez la case, les ";
	$text .= "<font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " seront affich�s sur le gps.<br>";

	$text .= " Si vous ne cochez pas, ils ne seront pas affich�s.<br><br>";
	$text .= " Les <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " sont repr�sent�s par des points bleus.<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereBaronnies()
{
	$titre = "Aide : L'affichage des Baronnies";

  $text = "Si vous cochez la case, les ";
	$text .= "baronnies seront affich�es sur le gps.<br>";
	$text .= " Si vous ne cochez pas, elles ne seront pas affich�es.<br><br>";
	$text .= " Les baronnies sont repr�sent�es par des rectangles roses/saumon";
	$text .= " (du plus bel effet).<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereTanieresRm()
{
	$titre = "Aide : Affichage des Tani�res Relais&Mago";

  $text = "Si vous cochez la case, les ";
	$text .= " tani�res des <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " seront affich�es sur le GPS.<br>";
	$text .= " Si vous ne cochez pas, elles ne seront pas affich�es.<br><br>";
	$text .= " Les tani�res sont repr�sent�es par des images de tani�res, qui s'agrandissent avec le zoom.<br><br>";
	$text .= " <font color=red>Attention</font> :  il faut que les propri�taires de tani�res renseignent<br> ";
	$text .= " leurs tani�res dans leur fiche dans ENGINE.<br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereGowapsRm()
{
	$titre = "Aide : Affichage des Gowaps Relais&Mago";

  $text = "Si vous cochez la case, les ";
	$text .= " gowaps des <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " seront affich�s sur le GPS.<br>";
	$text .= " Si vous ne cochez pas, ils ne seront pas affich�s.<br><br>";
	$text .= " Les gowaps sont repr�sent�s par des images de gowap, qui s'agrandissent avec le zoom.<br><br>";
	$text .= " <font color=red>Attention</font> :  il faut que les propri�taires de gowaps renseignent<br> ";
	$text .= " leurs gowaps dans leur fiche dans ENGINE.<br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereLieux()
{
	$titre = "Aide : Affichage des Lieux";

  $text = "Vous pouvez choisir d'afficher certains lieux sur le GPS.<br><br>";
	$text .= "Les lieux sont repr�sent�s par des images de lieux, qui s'agrandissent avec le zoom.<br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereAlliesAmis()
{
	$titre = "Aide : L'affutage Alli�s/Amis";

  $text = "Si vous cochez la case, les ";
	$text .= "trolls alli�s ou amis seront affich�s sur le gps.<br>";
	$text .= " Si vous ne cochez pas, ils ne seront pas affich�s.<br><br>";
	$text .= " Les trolls alli�s sont repr�sent�s par des points jaunes.<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereEnnemis()
{
	$titre = "Aide : L'affutage Ennemis";

  $text = "Si vous cochez la case, les ";
	$text .= "�nnemis ou amis seront affich�s sur le gps.<br>";
	$text .= " Si vous ne cochez pas, ils ne seront pas affich�s.<br><br>";
	$text .= " Les trolls ennemis sont repr�sent�s par des points rouges.<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereGuildesEnnemies()
{
	$titre = "Aide : L'affutage Guildes Ennemies";

  $text = "Vous pouvez choisir d'afficher tous les trolls d'une guildes ennemies,<br> ";
	$text .= "ou les trolls de toutes les guildes ennemies.<br><br>";
	
	$text .= " Cette option peut �tre utile dans les Vengeances (exemple : Vengeance";
	$text .= " pour Grognon VPG).<br>";
	
	$text .= " Les trolls des guildes ennemis sont repr�sent�s par des points rouges<br>";
	$text .= " comme les trolls ennemis.<br><br>";

	$text .= " Si vous choisissez cette option, d�cochez l'affichage des trolls Alli�s / Amis<br>";
	$text .= " sinon des trolls pourront se retrouver en double dans les listes en bas du gps.<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereChampignons()
{
	$titre = "Aide : L'affichage des champignons";

  $text = "Vous pouvez choisir ou non d'afficher les champignons.<br><br> ";
	$text .= " Vus : affiche les champignons qui sont vus ou qui ont �t� vus il<br> ";
	$text .= " y a moins de 5 jours. Si un <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " a vu un champignon et qu'il est cens� <br>le voir encore mais ne le voit plus,<br> ";
	$text .= " ce champignon n'est pas affich� (m�me s'il a �t� vu il y a ";
	$text .= " moins de 5 jours).<br><br>";
	
	$text .= " Stats n jours : Affiche tous les champignons qui ont �t� vus depuis n temps.<br><br>";
	$text .= " Les champignons sont repr�sent�s par des points gris<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereQuadrillage()
{
	$titre = "Aide : L'affichage du quadrillage";

  $text = "Si vous cochez la case, le ";
	$text .= " quadrillage sera dessin� sur le gps.<br><br>";
	$text .= " La distance entre deux traits horizontaux du quadrillage est de 10 cases,";
	$text .= " de m�me pour l'espacement entre les traits verticaux.<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereRepere()
{
	$titre = "Aide : L'affichage du rep�re";

  $text = "Si vous cochez la case, le ";
	$text .= " rep�re sera affich� sur le gps.<br><br>";
	$text .= " Le rep�re est un axe(X) et un axe(Y) qui est dessin� pour X=0 et Y=0.<br><br>";
	$text .= " En d'autres termes, le rep�re est un rep�re orthogonal ayant pour d�finition : <br>";
	$text .= " y1(X) = 0 et y2(Y)=0.<br><br>";
	$text .= " y1 �tant la barre verticale, et y2 la barre horizontale.<br><br>;-)";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereViseur()
{
	$titre = "Aide : L'affichage du viseur";

  $text = "Si vous cochez la case, le ";
	$text .= " viseur sera affich� sur le gps.<br><br>";
	$text .= " Le viseur est le rond rouge qui est toujours au milieu du gps pour bien viser";
	$text .= " Il est aussi appel� colimateur en language �volu�.<br><br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereInfoTexte()
{
	$titre = "Aide : L'affichage de l'InfoTexte";

  $text = "Vous pouvez choisir d'afficher l'InfoTexte � partir d'un certain Zoom ";
	$text .= " (zoom = taille de vue).<br><br>";
	$text .= " Si vous choisissez d'afficher l'InfoTexte � partir de 200, testez et ";
	$text .= " vous verrez que cela devient brouillon sur l'image.<br><br>";

	$text .= " L'InfoTexte est un texte qui donne des informations.<br>";
	$text .= " Par exemple, sur le point d'un troll, est affich� : <br>";
	$text .= " son nom (position x, position Y, position Z).<br>";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsCritereMicheline()
{
	$titre = "Aide : Guide de Micheline";

	$text = " Choisissez un type d'objet de d�part, puis renseignez son id.<br>";
	$text .=" Choisissez un type d'objet d'arriv�e, puis renseignez son id.<br><br>";
	$text .=" Cliquez sur D�collage !<br><br>";

	$text .= "Voyez un trait <font color=red>Rouge</font> entre les deux positions <br>";
	$text .= "sur la carte, et dans les r�sultats en bas (en dessous de la carte), <br>";
	$text .= "la distance en PA entre les deux objets (et aussi en x, y, z).";

	afficheAideImg($titre, "yellow", $text);
}

function afficheAideGpsAccesVue2d()
{
	$titre = "Aide : Acc�s vue 2d";
	$text = "Deux boutons apparaissent lorsque le zoom est inf�rieur ou �gal � 20.<br>";
	$text .= "Le premier bouton avec <font color=yellow>vue de 20</font> ou";
	$text .= " <font color=yellow>vue de 10</font>, permet <br>";
	$text .= " d'acc�der � la vue 2d avec une taille de vue qui est �gale � la <br>";
	$text .= " taille du zoom donn� au gps.<br><br>";
	
	$text .= " Le second boutton avec <font color=yellow>vue de 5</font> permet d'acc�der<br>";
	$text .= " � la vue 2d avec une vue de 5, centr�e sur le viseur du GPS.<br><br>";
	$text .= " <font color=red>Conseil</font> : choisissez plut�t le l'acc�s � la vue 2d avec<br>";
	$text .= " la vue de 5, ce sera plus lisible... testez, vous verrez ;-)<br> ";
	afficheAideImg($titre, "yellow", $text);
}

?>
