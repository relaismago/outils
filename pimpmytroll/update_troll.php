<?php

	header('Content-Type: text/html; charset=iso-8859-1'); 
	require_once ("class/c_Troll.php");		
	require_once ("class/c_TrollHTML.php");		
	require_once ("functions_pmt.php");	

	// Cr�er un objet Troll et r�cup�re ses caract�ristiques
	$troll = new c_Troll($_POST["idTroll"]);
	$troll->getTroll();	

	// Applique les objets au Troll
	if ( isset($_POST["itemInfo"]) ){
		
		// Cr�ation de l'objet DOM
		$dom = getDom();		
		
		// Parcours l'�quipements choisit
		foreach ( explode( ";", $_POST["itemInfo"] ) as $itemCarac ){
			
			// S�pare la chaine en idObjet typeObjet
			$itemCarac = explode( "|", $itemCarac );
			
			if ( $itemCarac[0] != 0 ){
				
				// Charge le  fichier xml et r�cup�re l'objet
				$dom->load("tanieres/" .$itemCarac[1]. ".xml");
				$item = getItemById( $dom->getElementsByTagName("Element"), $itemCarac[0] );	
				
				// Regarde dans l'�quipement du Troll si l'objet n'a pas �t� trouv�
				if ( $item == NULL ){
					
					$dom->load("trolls/" .$_POST["idTroll"]. ".xml");
					$item = getItemById( $dom->getElementsByTagName("Equipements")->item(0)->childNodes, $itemCarac[0] );	
					
				}												
				
				// Applique les modifications au Troll selon la configuration utilis�e
				if ( $itemCarac[1] != "Arme_2_mains" && $itemCarac[1] != "Arme_1_main" && $itemCarac[1] != "Bouclier" || $itemCarac[1] == "Arme_2_mains" && $_POST["configArme"] || ($itemCarac[1] == "Arme_1_main" || $itemCarac[1] == "Bouclier") && !$_POST["configArme"] )
					$troll->applyItem($item->getAttribute("carac")." | ".$item->getAttribute("temps"));		
			
			}
			
		}
		
		// Mets � jour les temps du Troll
		$troll->updateTrollTime();
		
	}
	
	// Cr�er un objet trollHTML et affiche le tableau de caract�ristiques du Troll
	$trollHTML = new c_TrollHTML($troll);		
	echo $trollHTML->htmlGetTableProfil();
	
?>