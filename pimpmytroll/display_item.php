<?php
	
	header('Content-Type: text/html; charset=iso-8859-1'); 	
	require_once("functions_pmt.php");
	
	// Cr�ation de l'objet DOM et r�cup�ration de l'objet
	$dom = getDom();	
	$dom->load("tanieres/" .$_POST["type"]. ".xml");
	$item = getItemById( $dom->getElementsByTagName("Element"), $_POST["idItem"] );	
	
	// Si l'objet n'a pas �t� trouv� on regarde dans l'�quipement du Troll
	if ( $item == NULL ){
		
		$dom->load("trolls/" .$_POST["idTroll"]. ".xml");
		$item = getItemById( $dom->getElementsByTagName("Equipements")->item(0)->childNodes, $_POST["idItem"] );	
		
	}
	
	// Affichage de ses caract�ristiques
	echo getItemCarac($item);
	
?>