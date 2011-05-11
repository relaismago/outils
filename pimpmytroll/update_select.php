<?php

	header('Content-Type: text/html; charset=iso-8859-1'); 
	require_once ("functions_pmt.php");	
	
	echo "<option onMouseOver=\"getItemCarac(0,'" .$_POST["type"]. "');\" value=\"0\">" .str_replace( "_", " ", $_POST["type"] ). "</option>";	
	
	// Création de l'objet DOM et chargement du fichier xml du troll
	$dom = getDom();
	$dom->load("trolls/" .$_POST["idTroll"]. ".xml");	

	// Parcours la liste d'équipement du Troll et affiche une option si l'objet correspond au critère de recherche
	foreach ( $dom->getElementsByTagName("Equipements")->item(0)->childNodes as $item )
		if ( $item->getAttribute("type") == $_POST["type"] && preg_match( "#.*" .$_POST["nom"]. ".*" .$_POST["template"]. ".*" .$_POST["mithril"]. "#i", stripslashes($item->nodeValue) ) )
			echo htmlOptionEquipements( $_POST["idTroll"],  $item, $_POST["type"] );	
		
	// Chargement du fichier d'objet des tanieres	
	$dom->load("tanieres/" .$_POST["type"]. ".xml");	

	// Parcours la liste d'objet des tanieres et affiche une option si l'objet correspond au critère de recherche
	foreach ( $dom->getElementsByTagName("Element") as $item )
		if ( preg_match( "#.*" .$_POST["nom"]. ".*" .$_POST["template"]. ".*" .$_POST["mithril"]. "#i", stripslashes($item->nodeValue) ) )
			echo htmlOptionEquipements( $_POST["idTroll"], $item, $_POST["type"] );

?>