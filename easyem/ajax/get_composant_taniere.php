<?php

	header('Content-Type: text/html; charset=iso-8859-1'); 	
    require_once("../easyem_functions.php");	
	
	if( $_POST["type"] == "sortilege" )
		echo ($_POST["nom"]) ? getTanieresComposant('/Elements/Element[contains(@sortilege,"' .$_POST["nom"]. '")]') : getTanieresComposant();

	if( $_POST["type"] == "mundidey" )
		echo ($_POST["nom"]) ? getTanieresComposant('/Elements/Element[contains(@mundidey,"' .$_POST["nom"]. '")]') : getTanieresComposant();

?>