<?php

	header('Content-Type: text/html; charset=iso-8859-1'); 
	require_once ("class/c_Troll.php");		
	require_once ("class/c_TrollHTML.php");		
	require_once ("functions_pmt.php");	

	// Créer un objet Troll et récupère ses caractéristiques
	$troll = new c_Troll($_POST["idTroll"]);
	$troll->getTroll();	

	// Applique les objets au Troll
	if ( isset($_POST["itemInfo"]) ){
		
		// Création de l'objet DOM
		$dom = getDom();		
		
		// Parcours l'équipements choisit
		foreach ( explode( ";", $_POST["itemInfo"] ) as $itemCarac ){
			
			// Sépare la chaine en idObjet typeObjet
			$itemCarac = explode( "|", $itemCarac );
			
			if ( $itemCarac[0] != 0 ){
				
				// Charge le  fichier xml et récupère l'objet
				$dom->load("tanieres/" .$itemCarac[1]. ".xml");
				$item = getItemById( $dom->getElementsByTagName("Element"), $itemCarac[0] );	
				
				// Regarde dans l'équipement du Troll si l'objet n'a pas été trouvé
				if ( $item == NULL ){
					
					$dom->load("trolls/" .$_POST["idTroll"]. ".xml");
					$item = getItemById( $dom->getElementsByTagName("Equipements")->item(0)->childNodes, $itemCarac[0] );	
					
				}												
				
				// Applique les modifications au Troll selon la configuration utilisée
				if ( $itemCarac[1] != "Arme_2_mains" && $itemCarac[1] != "Arme_1_main" && $itemCarac[1] != "Bouclier" || $itemCarac[1] == "Arme_2_mains" && $_POST["configArme"] || ($itemCarac[1] == "Arme_1_main" || $itemCarac[1] == "Bouclier") && !$_POST["configArme"] )
					$troll->applyItem($item->getAttribute("carac")." | ".$item->getAttribute("temps"));		
			
			}
			
		}
		
		// Mets à jour les temps du Troll
		$troll->updateTrollTime();
		
	}
	
	// Créer un objet trollHTML et affiche le tableau de caractéristiques du Troll
	$trollHTML = new c_TrollHTML($troll);		
	echo $trollHTML->htmlGetTableProfil();
	
?>