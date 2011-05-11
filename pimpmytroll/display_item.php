<?php
	
	header('Content-Type: text/html; charset=iso-8859-1'); 	
	require_once("functions_pmt.php");
	
	// Création de l'objet DOM et récupération de l'objet
	$dom = getDom();	
	$dom->load("tanieres/" .$_POST["type"]. ".xml");
	$item = getItemById( $dom->getElementsByTagName("Element"), $_POST["idItem"] );	
	
	// Si l'objet n'a pas été trouvé on regarde dans l'équipement du Troll
	if ( $item == NULL ){
		
		$dom->load("trolls/" .$_POST["idTroll"]. ".xml");
		$item = getItemById( $dom->getElementsByTagName("Equipements")->item(0)->childNodes, $_POST["idItem"] );	
		
	}
	
	// Affichage de ses caractéristiques
	echo getItemCarac($item);
	
?>