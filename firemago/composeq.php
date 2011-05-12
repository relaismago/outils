<?php

	header('Content-Type: text/html; charset=utf-8'); 	
	include_once ("../functions_auth.php");
	include_once ( "../easyem/easyem_functions.php" );
	
	if (userIsGuilde() || userIsGroupSpec()) 
	{	
		
		echo "try { \n";
		
		$url = "http://outilsrm.free.fr/images/firemago";		
		$index = $_REQUEST["index"];
		$nomCompos = $_REQUEST["nomCompos"];	
		$array = array ( "Œ" => "Oe", "œ" => "oe" );	
		$compotrolls = getCompotrolls();
		$recettes = getEMRecettes();

		foreach ( $nomCompos as $i => $nom ){
			
			$nom = strtr( $nom, $array );

				if ( $sort = getCompoFixeByCompo($nom,$recettes) )
					echo "$('>tr:eq($i)>td:eq(1)>a',compos).after('" .addslashes(" <img align='ABSMIDDLE' title='Composant fixe de " .$sort->parentNode->getAttribute("nom"). " de Qualité " .$sort->getAttribute("qualité"). "' src='$url/emFixe.png'/>"). "');";		
				if ( $mundidey = getCompoVar($nom) )
					echo "$('>tr:eq($i)>td:eq(1)>a',compos).after(' " .addslashes("<img align='ABSMIDDLE' title='Composant Variable Mundidey " .$mundidey. "' src='$url/emV.png'/>"). "');";			
				if ( $compotroll = getCompoTrollByCompo($nom,$compotrolls) )
					echo "$('>tr:eq($i)>td:eq(1)>a',compos).after('" .addslashes(" <img align='ABSMIDDLE' title=\"Compotroll de " .$compotroll->getAttribute("troll"). " de Qualité " .$compotroll->getAttribute("qualité"). "\" src='$url/emCT.png'/>"). "');";
			
		}
		
		echo "} catch ( e ) { 
		alert ( e, 'Compo Equipement error' );
		} \n";
		
	}
	
?>