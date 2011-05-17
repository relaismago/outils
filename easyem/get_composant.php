<?php

	header('Content-Type: text/html; charset=iso-8859-1'); 	
    require_once("easyem_functions.php");	
	
	$xpath = new DOMXPath(getEMComposantVariable());		
	
	if( $_POST["type"] == 'composant' )
		$composants = $xpath->query("/Elements/Element[@nom='" .$_POST["nom"]. "' and @emplacement='" .$_POST["emplacement"]. "']");	
	
	$xpath = new DOMXPath(getComposant());		
	
	if( $_POST["type"] == 'compotroll' )
		$composants = $xpath->query("/Elements/Element[contains(child::text(),'" .$_POST["nom"]. "') and @emplacement='" .$_POST["emplacement"]. "']");	

	if( $_POST["type"] == 'recherchecompotroll' ){
		
		if ( $_POST["famille"] )
			$_POST["famille"] = '="' .$_POST["famille"]. '"';		
		if ( $_POST["nom"] )
			$_POST["nom"] = '="' .$_POST["nom"]. '"';	
						
		$emplacements = explode ( "|", $_POST["emplacement"] );
		unset($emplacements[count($emplacements)-1]);
		$stremplacement	= "(@emplacement";
		foreach ( $emplacements as $i => $emplacement )
			$stremplacement .= ( $i != count($emplacements)-1 )  ? "='$emplacement' or @emplacement" : "='$emplacement') and ";
		
		if ( !$emplacements )
			$stremplacement = "not(@emplacement) and ";
		
		$composants = $xpath->query('/Elements/Element[' .$stremplacement. '@famille' .$_POST["famille"]. ' and @monstre' .$_POST["nom"]. ' and @niveau>="' .intval($_POST["min"]). '" and @niveau<="' .intval($_POST["max"]). '"]');

	}	
	
	foreach ( $composants as $composant )		
		if ( $_POST["type"] != 'recherchecompotroll' )
			echo "<option value=\"" .utf8_decode($composant->nodeValue). "\">" .utf8_decode($composant->nodeValue). "</option>";
		else
			echo "<tr align='center' class='mh_tdborder'><td class='mh_tdpage'>" .utf8_decode($composant->getAttribute("famille")). "</td><td class='mh_tdpage'>" .utf8_decode($composant->nodeValue). "</td><td class='mh_tdpage'>" .utf8_decode($composant->getAttribute("emplacement")). "</td><td class='mh_tdpage'>" .utf8_decode($composant->getAttribute("niveau")). "</td></tr>";

?>