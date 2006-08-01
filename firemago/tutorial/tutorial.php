<?

require_once('../../top.php');
require_once('../../secure.php');

init_firemago_tutorial();

include('../../foot.php');

function init_firemago_tutorial()
{
	afficher_titre_tableau("Tutorial Firemago");
	tutorial_haut();
	
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Domfada_avatar_bleu.gif", "Domfada (39684)");
	firemago_tutorial_msg_1();
	tutorial_haut_bas_gauche();
	echo "<br><br>";
	tutorial_haut_bulle_droit();
	firemago_tutorial_msg_2();
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Glupglup_avatar_bleu.gif", "Glupglup (51166)");

	echo "<br><br>";
	echo "<br><br>";
	tutorial_bas();
}

function firemago_tutorial_msg_1()
{
	?>
						<font color="#000000" face="Verdana, Arial, Helvetica, sans-serif" size="2">
						Salut, c'est Domfada (39684). Je développe avec Glupglup (51166) l'outil nommé 
						<b>Firemago</b> et réservé aux trolls de la <b>Guilde Relais &amp; Mago</b>.<br><br>
						
						Mais à quoi sert <b>Firemago</b> nom d'un streum ?!<br><br>

						<strong>Firemago</strong> est un programme permettant d'avoir la puissance des outils
						<strong>Relais &amp; Mago</strong> lorsque l'on joue son troll sur Mountyhall.<br><br>

						Enfin, voyez par vous même avec ces quelques images... <br><br>
						
					<img src="/images/puce.gif"> Améliorations sur la page de profil <br>
					<?
					$img = "<img src='images_firemago/profil_boutons.jpg'>";
					$img_petit = "<img src='images_firemago/profil_boutons_petit.jpg' border=4>";
					affiche_popup("Boutons pratiques pour renseigner les outils.","yellow",$img,$img_petit);

					$img = "<img src='images_firemago/profil_bas.jpg'>";
					$img_petit = "<img src='images_firemago/profil_bas_petit.jpg' border=4>";
					affiche_popup("Calculs sur le profil.","yellow",$img,$img_petit);
					?>

					<br><br>
					<img src="/images/puce.gif"> Amélioration de la vue<br>
					<?
					$img = "<img src='images_firemago/vue_monstres.jpg'>";
					$img_petit = "<img src='images_firemago/vue_monstres_petit.jpg' border=4>";
					affiche_popup("Différentes informations sur les monstres.","yellow",$img,$img_petit);

					?>

					<br><br>
					<img src="/images/puce.gif"> Renseignement du bestiaire<br>
					<?
					$img = "<img src='images_firemago/bestiaire_cdm.jpg'>";
					$img_petit = "<img src='images_firemago/bestiaire_cdm_petit.jpg' border=4>";
					affiche_popup("Renseignement du bestiaire à partir du résultat d'une cdm.","yellow",$img,$img_petit);

					$img = "<img src='images_firemago/bestiaire_bot.jpg'>";
					$img_petit = "<img src='images_firemago/bestiaire_bot_petit.jpg' border=4>";
					affiche_popup("Renseignement du bestiaire à partir des messages du bot.","yellow",$img,$img_petit);
					?>

					<br><br>
					<img src="/images/puce.gif"> Si l'on utilise le Pack Graphique Relais &amp; Mago, <b>Firemago</b>
					corrige les couleurs sur les gowaps.<br>
					<?
					$img = "<img src='images_firemago/gowaps_avant.jpg'>";
					$img_petit = "<img src='images_firemago/gowaps_avant_petit.jpg' border=4>";
					affiche_popup("Avant l'utilisation de Firemago sur les pages des suivants..","yellow",$img,$img_petit);

					$img = "<img src='images_firemago/gowaps_apres.jpg'>";
					$img_petit = "<img src='images_firemago/gowaps_apres_petit.jpg' border=4>";
					affiche_popup("Après l'utilisation de Firemago sur les pages des suivants..","yellow",$img,$img_petit);
					?>
					<br><br>
					Il y a également d'autres fonctionnalités que vous allez découvrir par vous-même.
					<br><br>
					Maintenant, au tour de <b>glupglup</b> ! 
					Il va vous expliquer comment installer <b>Firemago</b> sur votre ordinateur.
	<?
}

function firemago_tutorial_msg_2()
{
	?>
						P'chit, c'est moi Glupglup (51166). Prend un p'tit verre et mets le de côté 2 minutes, 
						juste le temps d'installer <b>Firemago</b>.Tu vas voir c'est pas compliqué.<br><br>

						Tout d'abord, il faut que tu saches que <b>Firemago</b> ne fontionne pas avec Internet Explorer.
						Il te faut installer Mozilla Firefox. Ce logiciel te permettra de naviguer sur
						Internet tout comme Internet Explorer, et de plus, il offre plus de fonctionnalités que tu pourras
						découvrir par toi même.<br><br>

						J'imagine donc que tu as déjà installé Mozilla Firefox. Si toutefois ce n'était pas fait, tu peux le 
						récupérer à l'adresse suivante : 
						<a class="AllLinks" href="http://www.mozilla-europe.org/fr/products/firefox/">Mozilla Firefox</a> <br><br>

					<div class="titre3">Installation de Firemago</div><br>
					<img src="/images/puce.gif"> 1 - Tout d'abord, cliquer sur ce lien : 
					<a class="AllLinks" href='/firemago/firemago.xpi' onclick="xpi={'mountyzilla':this.href};InstallTrigger.install(xpi);return false;">L'extension</a> (si rien ne se passe, autorise les popups pour le site des outils relaismago et recommence).
					<br>
					<img src="/images/puce.gif"> 2 - Redémarre Mozilla Firefox
					<br>
					<img src="/images/puce.gif"> 3 - Tu peux boire ton verre ! Euh non, pas en entier !
					<br><br>

					Il faut regarder maintenant si ça fonctionne bien.<br><br>
					Connecte toi sur <a class="AllLinks" href="http://games.mountyhall.com/">Mountyhall</a> et regarde sur ta 
					vue si le petit cadre de connexion aux outils apparaît comme ci-dessous.<br><br>
						
					<?
					$img = "<img src='images_firemago/connexion.jpg'>";
					$img_petit = "<img src='images_firemago/connexion_petit.jpg' border=4>";
					affiche_popup("Boite ajoutée par Firemago sur la page de profil","yellow",$img,$img_petit);
					?>

					<br><br>

					Si c'est bon, finis ton verre ! Sinon, contacte Domfada ou moi-même, soit par MP, soit sur le 
					<a class="AllLinks" href="http://www.relaismago.com/guilde/forum/index.php?showtopic=2046">Forum Firemago</a>
	<?
}
?>
