<?php
require_once('functions_display.php');
require_once('functions_auth.php');
include_once('functions_help.php');

require_once('includes/troll.class.php');
require_once('includes/ggc_groupe.class.php');
require_once('includes/recherche.class.php');

require_once('secure.php');

if ($_REQUEST["action"] == "get_recherche") {
	$recherche = new recherche($_REQUEST[valeur],$_REQUEST[page]);
} else {

// Pas jolie, mais c'est juste pour tester	
	$flag = false;
	if (strpos("troll",$_REQUEST[valeur]) !== false) {
		echo "troll:<br>";
		$flag = true;
	}
	if (strpos("monstre",$_REQUEST[valeur]) !== false) {
		echo "monstre:<br>";
		$flag = true;
	}
	if (strpos("lieu",$_REQUEST[valeur]) !== false) {
		echo "lieu:<br>";
		$flag = true;
	}
	if (strpos("guilde",$_REQUEST[valeur]) !== false) {
		echo "guilde:<br>";
		$flag = true;
	}
	if (strpos("champi",$_REQUEST[valeur]) !== false) {
		echo "champi:<br>";
		$flag = true;
	}
	if (strpos("rg",$_REQUEST[valeur]) !== false) {
		echo "rg:<br>";
		$flag = true;
	}
	if (strpos("vue",$_REQUEST[valeur]) !== false) {
		echo "vue:<br>";
		$flag = true;
	}
	if (!$flag && strpos(":",$_REQUEST[valeur]) === false) {
		echo "troll:<br>";
		echo "monstre:<br>";
		echo "lieu:<br>";
		echo "guilde:<br>";
		echo "champi:<br>";
		echo "rg:<br>";
		echo "vue:<br>";
	}
	echo "Regardez l'aide <img src='images/aide_puce.gif'> pour plus de d&eacute;tails";
}

?> 
