<?php
include('../top.php');
include_once('../secure.php');
include_once("./inc/fonctions.inc.php");


$no_troll=$_SESSION['AuthTroll']; // Id du troll connecté
?>
<br/>
<?
$maj = getDerniereMaj();
	$c = ' Dernière mise à jour du contenu le '.$maj['date'].' par '.$maj['troll'];
	afficher_contenu_tableau($c);

afficher_titre_tableau("Sélectionnez la tanière où passer votre commande");

$c = ' [ <a href="./affichage.php?taniere=33931">Le Mag\'Hasin de Kasseroll</a> ] <br>';
$c .= ' [ <a href="./affichage.php?taniere=34111">La Taverne d\'Heliacyn</a> ] <br>';
$c .= ' [ <a href="./affichage.php?taniere=38965">La Bïblyohtek de Grognon</a> ] <br>';
$c .= '<br>';
$c .= ' [ <a href="./recherche.php">Rechercher</a> ] <br>';

afficher_contenu_tableau($c);


if (isDbAdministration() || isGGT() ) {

	if (!isGGT()) {
		$msg = "<b>Attention : vous êtes administrateur des outils et pas ";
		$msg .= "gestionnaire des grandes tanières, merci de ne pas trop jouer avec ça...</b>";
		afficher_titre_tableau("Gestion",$msg);
	}
	else {
		afficher_titre_tableau("Gestion");
	}

	$c = ' [ <a href="./affichageAdmin.php?taniere=33931">Derrière le comptoir du Mag\'Hasin</a> ] <br> ';
	$c .= ' [ <a href="./affichageAdmin.php?taniere=34111">Au bar de la Taverne</a> ] <br>';
	$c .= ' [ <a href="./affichageAdmin.php?taniere=38965">Au guichet de la Bïblyohtek</a> ] <br>';
	$c .= '<br>';
	$c .= ' [ <a href="./rechercheAdmin.php">Rechercher</a> ] <br>';
	$c .= '<br>';
	$c .= ' [ <a href="./affichageMaj.php">Mettre à jour</a> ] <br>';

	afficher_contenu_tableau($c);
}

include('../foot.php');
?>
