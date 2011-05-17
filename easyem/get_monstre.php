<?php

	header('Content-Type: text/html; charset=iso-8859-1'); 	
    require_once("easyem_functions.php");	

	if ( $_POST["famille"] )
		$_POST["famille"] = "='" .$_POST["famille"]. "'";

	echo "<option value=''>Tous</option>";
	$xpath = new DOMXPath(getComposant());
	foreach( $xpath->query("/Elements/Element[@famille" .$_POST["famille"]. "]") as $monstre )
		if ( $monstre->previousSibling == NULL || $monstre->previousSibling->getAttribute("monstre") != $monstre->getAttribute("monstre") )
			echo '<option value="' .utf8_decode($monstre->getAttribute("monstre")). '">' .utf8_decode($monstre->getAttribute("monstre")). '</option>';	

?>