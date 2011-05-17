<?php

	header('Content-Type: text/html; charset=iso-8859-1'); 	
    require_once("easyem_functions.php");	

	$xpath = new DOMXPath(getComposant());
	echo $xpath->query('/Elements/Element[@monstre="' .$_POST["nom"]. '"]')->item(0)->getAttribute("niveau");

?>