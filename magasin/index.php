<?php
include('../top.php');
include_once('../secure.php');
include_once("./inc/fonctions.inc.php");


$no_troll=$_SESSION['AuthTroll']; // Id du troll connect�
?>
<br/>
<?
$maj = getDerniereMaj();
	$c = ' Derni�re mise � jour du contenu le '.$maj['date'].' par '.$maj['troll'];
	afficher_contenu_tableau($c);

afficher_titre_tableau("S�lectionnez la tani�re o� passer votre commande");

$c = ' [ <a href="./affichage.php?taniere=33931">Le Mag\'Hasin de Kasseroll</a> ] <br>';
$c .= ' [ <a href="./affichage.php?taniere=34111">La Taverne d\'Heliacyn</a> ] <br>';
$c .= ' [ <a href="./affichage.php?taniere=38965">La B�blyohtek de Grognon</a> ] <br>';
$c .= '<br>';
$c .= ' [ <a href="./recherche.php">Rechercher</a> ] <br>';

afficher_contenu_tableau($c);


if (isDbAdministration() || isGGT() ) {

	if (!isGGT()) {
		$msg = "<b>Attention : vous �tes administrateur des outils et pas ";
		$msg .= "gestionnaire des grandes tani�res, merci de ne pas trop jouer avec �a...</b>";
		afficher_titre_tableau("Gestion",$msg);
	}
	else {
		afficher_titre_tableau("Gestion");
	}

	$c = ' [ <a href="./affichageAdmin.php?taniere=33931">Derri�re le comptoir du Mag\'Hasin</a> ] <br> ';
	$c .= ' [ <a href="./affichageAdmin.php?taniere=34111">Au bar de la Taverne</a> ] <br>';
	$c .= ' [ <a href="./affichageAdmin.php?taniere=38965">Au guichet de la B�blyohtek</a> ] <br>';
	$c .= '<br>';
	$c .= ' [ <a href="./rechercheAdmin.php">Rechercher</a> ] <br>';
	$c .= '<br>';
	$c .= ' [ <a href="./affichageMaj.php">Mettre � jour</a> ] <br>';

	afficher_contenu_tableau($c);
}

include('../foot.php');
?>
