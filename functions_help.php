<?

#######################################
# Informations importantes scripts publics
######################################
function informationImportanteScriptsPublics($id_troll)
{
	$titre ="Information Importante sur les scripts publics";
	
	$text = "Il y a un décalage entre la vue résultant des scripts publics et votre vue depuis MountyHall<br><br>";
	
	$text .= "<center><font color=red>Il vaut mieux utiliser le copié / collé de la vue lorsqu'on joue</font></center><br>";
	$text .= "Cela évite par exemple de voir un composant que l'on vient de rammasser, <br>";
	$text .= "toujours présent sur la vue2d après un refresh avec les scripts publics<br>";

	$puce =	"<b><font color='blue'>[!]</font></b>";

  affiche_popup($titre, "yellow", $text,$puce);
}

function afficheAideVueRefreshPublic()
{
  $titre = "Aide : Refresh avec les scripts publics ";

  $text = "Pour mettre à jour la vue du troll sélectionné, il faut cocher cette case.<br>";
	$text .= "Ceci va donner l'ordre d'aller chercher la vue avec les scripts publics de <br>";
	$text .= "MountyHall.<br>";
	$text .= " Des fois çà marche, des fois çà marche pas... tout dépend de la charge de MoutyHall<br>";
	$text .= ", mais généralement çà met bien la vue à jour ! <br><br>";
	$text .= " Vous avez le droit d'utiliser au maximum 24 fois les scripts publics en moins de 24 heures.<br>";
	$text .= " Les outils de RelaisMago font attention à cela, et permettent en plus aux <br>";
	$text .= " trolls de la guilde de pouvoir rafraîchir la vue d'un autre troll au maximum 4 fois,<br>";
	$text .= " tout en faisant attention de ne pas dépasser 24 fois en moins de 24 heures.<br><br>";
	
	$text .= " Un procédure de refresh automatique est mise en place, celle-ci se comporte comme si <br>";
	$text .= " c'était un troll de la guilde qui rafraichissait un vue d'un troll Relais&Mago au hazard.<br>";

  affiche_popup($titre, "yellow", $text);
}

function afficheAideVueCopierColler()
{
  $titre = "Aide : Copié / Collé ";

  $text = "Vous pouvez mettre à jour votre vue en utilisant un copié/collé de<br>";
	$text .= " votre vue à partir de MountyHall. <br><br>";
	$text .= " C'est très pratique lorsque MountyHall interdit l'utilisation des scripts<br>";
	$text .= " publics pendant des temps incertains...<br><br>";
	$text .= " Ils est recommandé d'utiliser cette méthode de rafraichissement lorsque <br>";
	$text .= " vous jouez votre troll sur MountyHall.<br>";

  affiche_popup($titre, "yellow", $text);
}

function afficheAideVueCenterSur()
{
  $titre = "Aide : Centrer sur";

  $text = "Les gros Tomawaks R&M avec vues démentielles renseignent les outils R&M <br>";
	$text .= "jusqu'aux confins de l'univers connu. Dès lors, il est possible de <br>";
	$text .= "centrer la vue sur n'importe quelle zone. <br><br>";

	$text .= "Il suffit de renseigner les positions x, y et z dans les petites cases.<br>";
	$text .= "Vous pouvez également les remplir automatiquement en sélectionnant un<br>";
	$text .= "troll R&M dans la liste.<br><br>";

	$text .= "Les trolls <i>Made in Lebohaum'</i>, complètement aveugles, n'ont plus <br>";
	$text .= "besoin de lunettes pour savoir où poser les papattes.<br><br>";

  affiche_popup($titre, "yellow", $text);
}

function afficheAideVueTailleVue()
{
  $titre = "Aide : Taille Vue";

  $text = "Par défaut, la visibilité du troll est de 3 cases.<br>";
	$text .= "Un 0 signifie valeur donnée par <i>Mounty Hall</i>.<br><br>";
	$text .= "Par exemple, si le troll Woyczek Ihllé a 13 cases de vue, de base, seules 3 cases <br> ";
	$text .= "sur le plan, sur 2 étagères, seront affichées.<br><br>";

  affiche_popup($titre, "yellow", $text);
}

function afficheAideVueLimiteVerticale()
{
  $titre = "Aide : Limite Verticale";

  $text = "Il est possible de limiter la taille de la vue (options ci-dessus)<br>";
	$text .= "Il est également possible de limiter la vue verticalement à l'aide <br>";
	$text .= " de cette option.<br><br>";
	$text .= "Par exemple, si l'on centre sur -28,-86,-37, que l'on met une <br>";
	$text .= " taille vue de  3 cases, on verra afficher les niveau -35 à -39.<br> ";
	$text .= "Si l'on ne veut voir que le niveau -37, on indique 1 dans cette option.<br><br>";

	$text .= "Si cette option est renseignée, une boite va apparaître au dessus <br>";
	$text .= " de la vue2d vous proposant de changer de niveaux facilement.<br><br>";

	$text .= "Et si enfin vous ne pigez pas, mettez 1 dans cette option et <br>";
	$text .= "regardez votre vue ;-)";

  affiche_popup($titre, "yellow", $text);
}

function afficheAideVueZoom()
{
  $titre = "Aide : Zoom";

	$text .= " Cette option permet d'appliquer un zoom sur la vue2d qui peut<br>";
	$text .= " être pratique si l'on renseigne une taille de vue de 10<br>";
	$text .= " et que l'on souhaite avoir quelque chose de lisible.<br><br>";

	$text .= " Pour tester, mettez la taille de vue à 10 avec un zoom 'peti'.<br>";

  affiche_popup($titre, "yellow", $text);
}

function afficheAideVueTrollometer()
{
  $titre = "Aide : Troll-O-Meter";

  $text = "On donne une distance en 'PA' maximum pour le troll-o-meter.<br>";
	$text .= "La distance en PA est le coût théorique minimum avec <br>";
	$text .= "Déplancement Eclair.<br><br> ";

	$text .= "Si le troll se situe à la surface, la distance en tient compte <br>";
	$text .= " (c'est à dire 2 fois plus de distance parcourue avec un PA).<br><br>";

	$text .= "Il est donc possible de regarder sa vue avec une taille de 3 et <br>";
	$text .= "d'indiquer 10 en Taille en PA du Troll-O-Meter. On peut ainsi voir<br>";
	$text .= "des monstres à 6 PA sans forcémenent les voir sur la vue2d.<br>";
	
  affiche_popup($titre, "yellow", $text);
}

function afficheAideVueAnimation()
{
  $titre = "Aide : Animations ";

  $text = "Une petite case à cocher : <b>Pas d'animations</b> pour les grosses vues, <br>";
	$text .= "et les machines lentes. Pour éviter à votre ordinateur de chauffer inutilement <br>";
	$text .= "à regarder ces petits trolls s'agiter en tous sens...<br>";

  affiche_popup($titre, "yellow", $text);
}

function afficheAideVueTrollsDisparus()
{
  $titre = "Aide : Les trolls disparus ";

  $text = "Les trolls disparus peuvent être deux type de trolls : <br>";
	$text .= " => soit des Tomawaks qui se sont cachés.<br>";
	$text .= " => soit des Trolls qui ont été envoyés au soleil.<br><br>";

	$text .= " La vue2d affiche par défaut ses deux types de trolls avec <br>";
	$text .= " la date de la dernière position connue.<br><br>";
	
	$text .= "Par exemple : (disparu 29/04 19:40)<br>";
	$text .= " signifie que le troll a été vue pour la dernière fois le <br>";
	$text .= "29 avril à 19h40, mais que depuis, on ne sait pas où il est.<br><br>";

	$text .= "Il est possible de ne pas afficher ces types de trolls sur la <br>";
	$text .= " vue2d.<br>";

  affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsAdvanced()
{
	$titre = "Le GPS Advanced";

  $text = "GPS : Global Positioning System<br><br>";

	$text .= "Le GPS s'appelle GPS Advanced, puisqu'il utilise le second";
	$text .= " lot de Satellites envoyé autour de la terre MountyHall.<br><br>";
	$text .= " Sa précision tient compte de tous les données reçues par les satellites";
	$text .= " <font color=yellow>Relais</font>&<font color=yellow>Mago</font>.<br><br>";
	$text .= " <font color=red>Définition : </font> Un satelitte est un troll ";
	$text .= " <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " qui utilise les outils <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " et renseigne donc par ce biais <br>les positions de chaque objet qu'il peut voir.<br><br>";
	$text .= " <font color=yellow>C'est donc géographiquement Trollement Chouette ;-)</font><br><br>";
	

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereTailleMap()
{
	$titre = "Aide : Taille de la Carte";

  $text = "La taille de la carte est en pixel.<br><br>";

	$text .= "Plus vous mettez une taille importante,";
	$text .=" plus l'image sera grande à l'écran.<br>";

	affiche_popup($titre, "yellow", $text);
} 

function afficheAideGpsCritereTailleVue()
{
	$titre = "Aide : Taille de la vue";
  $text = "La taille de la vue est en nombre de cases.<br><br>";
	$text .= "Si vous mettez une vue de 20, vous pourrez";
	$text .=" voir 40 cases horizontalement et 40 cases verticalement.<br><br>";
	$text .=" La taille de la vue est aussi appelée Zoom dans le gps.<br>";

	affiche_popup($titre, "yellow", $text);
} 

function afficheAideGpsCritereCentrerSur()
{
	$titre = "Aide : Centrage du GPS";

  $text = "Vous pouvez centrer sur une case donnée en précisant (x) et (y).<br><br>";
	$text .= "<font color=red>Attention</font> : Si le viseur est centré sur un troll de la guilde,<br> ";
	$text .= "cette option (centrer sur x, ou sur y) n'est pas prise en compte.<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereViseurSur()
{
	$titre = "Aide : Viseur Sur";

  $text = "Vous pouvez positionner le viseur sur un troll de la guide.<br><br>";
	$text .= "<font color=red>Attention</font> : Si le viseur est centré sur un troll de la guilde,<br> ";
	$text .= "les options centrer sur x, ou centrer sur y ne sont pas prises en compte.<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereRelaisMago()
{
	$titre = "Aide : L'affutage RelaisMago";

  $text = "Si vous cochez la case, les ";
	$text .= "<font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " seront affichés sur le gps.<br>";

	$text .= " Si vous ne cochez pas, ils ne seront pas affichés.<br><br>";
	$text .= " Les <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " sont représentés par des points bleus.<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereBaronnies()
{
	$titre = "Aide : L'affichage des Baronnies";

  $text = "Si vous cochez la case, les ";
	$text .= "baronnies seront affichées sur le gps.<br>";
	$text .= " Si vous ne cochez pas, elles ne seront pas affichées.<br><br>";
	$text .= " Les baronnies sont représentées par des rectangles roses/saumon";
	$text .= " (du plus bel effet).<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereTanieresRm()
{
	$titre = "Aide : Affichage des Tanières Relais&Mago";

  $text = "Si vous cochez la case, les ";
	$text .= " tanières des <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " seront affichées sur le GPS.<br>";
	$text .= " Si vous ne cochez pas, elles ne seront pas affichées.<br><br>";
	$text .= " Les tanières sont représentées par des images de tanières, qui s'agrandissent avec le zoom.<br><br>";
	$text .= " <font color=red>Attention</font> :  il faut que les propriétaires de tanières renseignent<br> ";
	$text .= " leurs tanières dans leur fiche dans ENGINE.<br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereGowapsRm()
{
	$titre = "Aide : Affichage des Gowaps Relais&Mago";

  $text = "Si vous cochez la case, les ";
	$text .= " gowaps des <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " seront affichés sur le GPS.<br>";
	$text .= " Si vous ne cochez pas, ils ne seront pas affichés.<br><br>";
	$text .= " Les gowaps sont représentés par des images de gowap, qui s'agrandissent avec le zoom.<br><br>";
	$text .= " <font color=red>Attention</font> :  il faut que les propriétaires de gowaps renseignent<br> ";
	$text .= " leurs gowaps dans leur fiche dans ENGINE.<br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereLieux()
{
	$titre = "Aide : Affichage des Lieux";

  $text = "Vous pouvez choisir d'afficher certains lieux sur le GPS.<br><br>";
	$text .= "Les lieux sont représentés par des images de lieux, qui s'agrandissent avec le zoom.<br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereAlliesAmis()
{
	$titre = "Aide : L'affutage Alliés/Amis";

  $text = "Si vous cochez la case, les ";
	$text .= "trolls alliés ou amis seront affichés sur le gps.<br>";
	$text .= " Si vous ne cochez pas, ils ne seront pas affichés.<br><br>";
	$text .= " Les trolls alliés sont représentés par des points jaunes.<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereEnnemis()
{
	$titre = "Aide : L'affutage Ennemis";

  $text = "Si vous cochez la case, les ";
	$text .= "énnemis ou amis seront affichés sur le gps.<br>";
	$text .= " Si vous ne cochez pas, ils ne seront pas affichés.<br><br>";
	$text .= " Les trolls ennemis sont représentés par des points rouges.<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereGuildesEnnemies()
{
	$titre = "Aide : L'affutage Guildes Ennemies";

  $text = "Vous pouvez choisir d'afficher tous les trolls d'une guildes ennemies,<br> ";
	$text .= "ou les trolls de toutes les guildes ennemies.<br><br>";
	
	$text .= " Cette option peut être utile dans les Vengeances (exemple : Vengeance";
	$text .= " pour Grognon VPG).<br>";
	
	$text .= " Les trolls des guildes ennemis sont représentés par des points rouges<br>";
	$text .= " comme les trolls ennemis.<br><br>";

	$text .= " Si vous choisissez cette option, décochez l'affichage des trolls Alliés / Amis<br>";
	$text .= " sinon des trolls pourront se retrouver en double dans les listes en bas du gps.<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereChampignons()
{
	$titre = "Aide : L'affichage des champignons";

  $text = "Vous pouvez choisir ou non d'afficher les champignons.<br><br> ";
	$text .= " Vus : affiche les champignons qui sont vus ou qui ont été vus il<br> ";
	$text .= " y a moins de 5 jours. Si un <font color=yellow>Relais</font>&<font color=yellow>Mago</font>";
	$text .= " a vu un champignon et qu'il est censé <br>le voir encore mais ne le voit plus,<br> ";
	$text .= " ce champignon n'est pas affiché (même s'il a été vu il y a ";
	$text .= " moins de 5 jours).<br><br>";
	
	$text .= " Stats n jours : Affiche tous les champignons qui ont été vus depuis n temps.<br><br>";
	$text .= " Les champignons sont représentés par des points gris<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereQuadrillage()
{
	$titre = "Aide : L'affichage du quadrillage";

  $text = "Si vous cochez la case, le ";
	$text .= " quadrillage sera dessiné sur le gps.<br><br>";
	$text .= " La distance entre deux traits horizontaux du quadrillage est de 10 cases,";
	$text .= " de même pour l'espacement entre les traits verticaux.<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereRepere()
{
	$titre = "Aide : L'affichage du repère";

  $text = "Si vous cochez la case, le ";
	$text .= " repère sera affiché sur le gps.<br><br>";
	$text .= " Le repère est un axe(X) et un axe(Y) qui est dessiné pour X=0 et Y=0.<br><br>";
	$text .= " En d'autres termes, le repère est un repère orthogonal ayant pour définition : <br>";
	$text .= " y1(X) = 0 et y2(Y)=0.<br><br>";
	$text .= " y1 étant la barre verticale, et y2 la barre horizontale.<br><br>;-)";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereViseur()
{
	$titre = "Aide : L'affichage du viseur";

  $text = "Si vous cochez la case, le ";
	$text .= " viseur sera affiché sur le gps.<br><br>";
	$text .= " Le viseur est le rond rouge qui est toujours au milieu du gps pour bien viser";
	$text .= " Il est aussi appelé colimateur en language évolué.<br><br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereInfoTexte()
{
	$titre = "Aide : L'affichage de l'InfoTexte";

  $text = "Vous pouvez choisir d'afficher l'InfoTexte à partir d'un certain Zoom ";
	$text .= " (zoom = taille de vue).<br><br>";
	$text .= " Si vous choisissez d'afficher l'InfoTexte à partir de 200, testez et ";
	$text .= " vous verrez que cela devient brouillon sur l'image.<br><br>";

	$text .= " L'InfoTexte est un texte qui donne des informations.<br>";
	$text .= " Par exemple, sur le point d'un troll, est affiché : <br>";
	$text .= " son nom (position x, position Y, position Z).<br>";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsCritereMicheline()
{
	$titre = "Aide : Guide de Micheline";

	$text = " Choisissez un type d'objet de départ, puis renseignez son id.<br>";
	$text .=" Choisissez un type d'objet d'arrivée, puis renseignez son id.<br><br>";
	$text .=" Cliquez sur Décollage !<br><br>";

	$text .= "Voyez un trait <font color=red>Rouge</font> entre les deux positions <br>";
	$text .= "sur la carte, et dans les résultats en bas (en dessous de la carte), <br>";
	$text .= "la distance en PA entre les deux objets (et aussi en x, y, z).";

	affiche_popup($titre, "yellow", $text);
}

function afficheAideGpsAccesVue2d()
{
	$titre = "Aide : Accès vue 2d";
	$text = "Deux boutons apparaissent lorsque le zoom est inférieur ou égal à 20.<br>";
	$text .= "Le premier bouton avec <font color=yellow>vue de 20</font> ou";
	$text .= " <font color=yellow>vue de 10</font>, permet <br>";
	$text .= " d'accéder à la vue 2d avec une taille de vue qui est égale à la <br>";
	$text .= " taille du zoom donné au gps.<br><br>";
	
	$text .= " Le second boutton avec <font color=yellow>vue de 5</font> permet d'accéder<br>";
	$text .= " à la vue 2d avec une vue de 5, centrée sur le viseur du GPS.<br><br>";
	$text .= " <font color=red>Conseil</font> : choisissez plutôt le l'accès à la vue 2d avec<br>";
	$text .= " la vue de 5, ce sera plus lisible... testez, vous verrez ;-)<br> ";
	affiche_popup($titre, "yellow", $text);
}

?>
