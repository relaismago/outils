<?php

	header('Content-Type: text/html; charset=iso-8859-1'); 	
    require_once("easyem_functions.php");	
	
	$tanieres = array ( "38965" => "La Bïblyohtek", "1646554" => "Le Relais des Abysses", "34111" => "La Taverne" );
	
	if ( $_POST["type"] == "Compo" )  
		$composant = getItemById( getComposants(), $_POST["id"] );
		
	if ( $_POST["type"] == "Champi" )  		
		$composant = getItemById( getChampignons(), $_POST["id"] );	
	
	if ( $_POST["type"] == "PoPaAn" )  		
		$composant = getItemById( getParchemins(), $_POST["id"] );		
	
	echo "<h3><a href='' onClick=\"window.open('http://games.mountyhall.com/mountyhall/View/TresorHistory.php?ai_IDTresor=" .$composant->getAttribute("id"). "&as_From=Comptoir&ai_IDLieu=" .$composant->getAttribute("idTaniere"). "','_blank','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=1, copyhistory=0, menuBar=0, width=766, height=636');return(false);\">[" .$_POST["id"]. "]</a> <a href='http://games.mountyhall.com/mountyhall/MH_Comptoirs/Comptoir_o_Stock.php?IDLieu=" .$composant->getAttribute("idTaniere"). "&as_type=" .$_POST["type"]. "' target='_blank'>".strtr( $composant->getAttribute("idTaniere"), $tanieres ). "</a></h3>";

?>