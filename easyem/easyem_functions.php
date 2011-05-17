<?php

	function isMonsterSearch( $monstre ){
		
		foreach ( getCompotrolls()->getElementsByTagName("Element") as $compotroll )
			$monsters[] = $compotroll->getAttribute("nom");
		
		if ( preg_match( "#.*".implode( "|", $monsters )."|Abishaii Noir|Abishaii Rouge|Abishaii Vert|Ankheg|Araignée Géante|Banshee|Barghest|Basilisk|Boggart|Chimère|Crasc|Crasc Médius|Crasc Maexus|Diablotin|Dindon|Djinn|Effrit|Erinyes|Essaim Sanguinaire|Fumeux|Fungus|Fungus Géant|Géant des Gouffres|Gnu|Goblin|Gorgone|Gritche|Grylle|Hydre|Limace|Limace Géante|Loup-Garou|Lutin|Manticore|Marilith|Mille-Pattes Géant|Mouch'oo|Nécrochore|Nécrophage|Naga|Nuage d'Insectes|Palefroi Infernal|Phoenix|Plante Carnivore|Pseudo-Dragon|Rat Géant|Rocketeux|Sagouin|Scarabée|Shai|Sorcière|Succube|Tertre Errant|Titan|Trancheur|Vampire|Ver Carnivore|Vouivre|Yéti|Yuan-ti|Zombie.*#", $monstre ) )
			return 1;
		
		return 0;
		
	}

	function getCompoFixe($monstre){
		
		$arrayCompoFixe = array ("Basilisk" => "Analyse Anatomique", "Ankheg|Rocketeux" => "Armure Ethérée", "Loup-Garou|Titan" => "Augmentation de l'Attaque", "Erinyes|Palefroi Infernal" => "Augmentation de l'Esquive", "Manticore|Trancheur" => "Augmentation des Dégâts", "Banshee" => "Bulle Anti-Magie", "Essaim Sanguinaire|Sagouin|Effrit" => "Bulle Magique", "Diablotin|Chimère|Barghest" => "Explosion", "Nécrophage|Vampire" => "Faiblesse Passagère", "Gorgone|Géant des Gouffres" => "Flash Aveuglant", "Limace Géante|Grylle" => "Glue", "Abishaii Noir|Vouivre|Araignée Géante" => "Griffe du Sorcier", "Mille-Pattes Géant" => "Identification des Trésors", "Nuage d'Insectes|Yuan-ti|Gritche" => "Invisibilité", "Yéti|Djinn" => "Projection", "Sorcière" => "Sacrifice", "Crasc|Fumeux" => "Sublifusion Magesque Minor", "Crasc Médius|Pseudo-Dragon" => "Sublifusion Magesque Medius", "Crasc Maexus|Lutin" => "Sublifusion Magesque Maexus", "Plante Carnivore|Tertre Errant" => "Télékinésie", "Boggart|Succube|Nécrochore" => "Téléportation", "Abishaii Vert" => "Vision Accrue", "Fungus Géant|Abishaii Rouge" => "Vision Lointaine", "Zombie|Shai|Phoenix" => "Voir le Caché", "Naga|Marilith" => "Vue Troublée");
	
		foreach ( $arrayCompoFixe as $nom => $sort )
			if ( preg_match( "#.*$nom.*#", $monstre) )
				return $sort;
		
		return 0;
		
	}
	
	function getCompoFixeByCompo($composant,$dom){
		
		foreach ( $dom->getElementsByTagName("composant") as $compofixe )
			if ( preg_match( "#" .$compofixe->nodeValue. ".*#", $composant) )
				return $compofixe;
		
		return 0;	
		
	}	
	
	function getCompoVar($monstre){
		
		$arrayCompoVar = array ( "Phoenix" => "du Phoenix", "Mouch'oo" => "de la Mouche", "Dindon" => "du Dindon", "Goblin" => "du Goblin", "Limace" => "de la Limace", "Rat Géant" => "du Rat", "Hydre" => "de l'Hydre", "Ver Carnivore" => "du Ver", "Fungus" => "du Fungus", "Vouivre" => "de la Vouivre", "Gnu" => "du Gnu", "Scarabée" => "du Scarabée" );

		foreach ( $arrayCompoVar as $nom => $mundidey )
			if ( preg_match( "#.*$nom.*#", utf8_decode($monstre)) )
				return $mundidey;
		
		return 0;		
		
	}

	function getCompoTrollByMonstre($monstre){	

		foreach ( getCompotrolls()->getElementsByTagName("Element") as $compotroll )
			if ( preg_match( "#.*" .$compotroll->getAttribute("nom"). ".*#", $monstre) )
				return $compotroll;
		
		return 0;		
		
	}
	
	function getCompoTrollByCompo($composant,$dom){	

		foreach ( $dom->getElementsByTagName("Element") as $compotroll )
			if ( preg_match( "#" .$compotroll->nodeValue. ".*#", $composant) )
				return $compotroll;
		
		return 0;		
		
	}	

	function getComposant(){
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
		$dom->preserveWhiteSpace = false;			
		$dom->load($_SERVER['DOCUMENT_ROOT']."/easyem/em/composant.xml");
		
		return $dom;				
		
	}
	
	function getComposants(){
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
		$dom->preserveWhiteSpace = false;			
		$dom->load($_SERVER['DOCUMENT_ROOT']."/pimpmytroll/tanieres/Composant.xml");
		
		return $dom;				
		
	}	
	
	function getComposantsTanieres(){
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
		$dom->preserveWhiteSpace = false;	
		$dom->load($_SERVER['DOCUMENT_ROOT']."/easyem/em/composant_tanieres.xml");		
		
		return $dom;		
		
	}
	
	function getCompotrolls(){
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
		$dom->preserveWhiteSpace = false;	
		$dom->load($_SERVER['DOCUMENT_ROOT']."/easyem/em/compotroll.xml");	

		return $dom;	
		
	}
	
	function getParchemins(){
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
		$dom->preserveWhiteSpace = false;			
		$dom->load($_SERVER['DOCUMENT_ROOT']."/pimpmytroll/tanieres/Parchemin.xml");
		
		return $dom;				
		
	}	
	
	function getChampignons(){
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
		$dom->preserveWhiteSpace = false;			
		$dom->load($_SERVER['DOCUMENT_ROOT']."/pimpmytroll/tanieres/Champignon.xml");
		
		return $dom;				
		
	}	

	function getEMComposantVariable(){
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
		$dom->preserveWhiteSpace = false;			
		$dom->load($_SERVER['DOCUMENT_ROOT']."/easyem/em/composants_variable.xml");
		
		return $dom;			
		
	}
	
	function getEMRecettes(){
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
		$dom->preserveWhiteSpace = false;	
		$dom->load($_SERVER['DOCUMENT_ROOT']."/easyem/em/recettes.xml");	
			
		return $dom;	
		
	}	

	function getCompoTroll($id){
		
		$retour = "Pas de CompoTroll pour votre Troll !";
		
		$xpath = new DOMXPath(getCompotrolls());		
		$compotroll = $xpath->query("/Elements/Element[@id='$id']")->item(0);
		if ( $compotroll )
			$retour = utf8_decode($compotroll->nodeValue). " De Qualité " .utf8_decode($compotroll->getAttribute(utf8_encode("qualité"))). " [" .utf8_decode($compotroll->getAttribute("emplacement")). "]";
		
		return $retour;
		
	}
	
	function getMundidey($time){
		
		$mundideys = array( "du Hum ...", "du Phoenix", "de la Mouche", "du Dindon", "du Goblin", "du Démon", "de la Limace", "du Rat", "de l'Hydre", "du Ver", "du Fungus", "de la Vouivre", "du Gnu", "du Scarabée" );
		
		$day = floor(($time-mktime(0,0,0,8,26,2001))/86400)%378;
		
		return ( $day <= 13 ) ? $mundideys["0"]: $mundideys[floor(($day+14)/28)];
		
	}

	function updateRecettesEM($mundidey){
		
		$statut = "";		
		$dom = getEMRecettes();
		$xpath = new DOMXPath($dom);			
		$composantsVariable = $xpath->query("/Recettes/Recette/composant[@mundidey]");
	
		foreach ( $composantsVariable as $composantVariable ){
				
			if ( utf8_decode($composantVariable->getAttribute("mundidey")) == $mundidey && $composantVariable->nodeValue != "Inconnu" )	
				$statut = "COMPLET";
			else {	
				$composantVariable->setAttribute( "nom", "Inconnu" );
				$composantVariable->setAttribute( utf8_encode("qualité"), "Inconnu" );
				$composantVariable->setAttribute( "emplacement", "Inconnu" );
				$composantVariable->setAttribute( "mundidey", utf8_encode($mundidey) );
				$composantVariable->nodeValue = "Inconnu";
				$statut = "INCOMPLET";		
				
			}
			
			if ( $statut == "INCOMPLET" || $composantVariable->parentNode->getAttribute("statut") == "COMPLET" || $composantVariable->getAttribute("position") == 1 && $statut == "COMPLET" && $composantVariable->parentNode->getAttribute("statut") == "INCOMPLET" )
				$composantVariable->parentNode->setAttribute( "statut", $statut );		
			
		}
		
		foreach ( $xpath->query("/Recettes/Recette") as $recette )
			$recette->setAttribute( "ratio", getBestRatioRecette($recette) );			
		
		$dom->formatOutput = true;
		$dom->save("em/recettes.xml");		
		
	}

	function updateComposantVariable( $data ){
		
		$dom = getEMRecettes();
		$xpath = new DOMXPath($dom);		
		$composant = $xpath->query("/Recettes/Recette[" .$_GET["id"]. "+1]/composant[@position='" .$data["position"]. "']")->item(0);			
				
		if ( isset($data["clear"]) ){
		
			$composant->setAttribute( "nom", "Inconnu" );
			$composant->setAttribute( "emplacement", "Inconnu" );
			$composant->setAttribute( utf8_encode("qualité"), "Inconnu" );				
			$composant->nodeValue = "Inconnu";					
			
		} else {
			
			$composant->setAttribute( "nom", utf8_encode($data["nom_monstre"]) );
			$composant->setAttribute( "emplacement", utf8_encode($data["emplacement"]) );
			$composant->setAttribute( utf8_encode("qualité"), utf8_encode($data["qualité"]) );				
			$composant->nodeValue = utf8_encode($data["nom_composant"]);	
		
		}
		
		$dom->save("em/recettes.xml");																							
		$dom->getElementsByTagName("Recette")->item($_GET["id"])->setAttribute( "ratio", getBestRatioRecette ($composant->parentNode)  );
		$dom->formatOutput = true;
		$dom->save("em/recettes.xml");		
		
	}
	
	function updateCompoTroll( $id, $troll, $data ){
		
		$dom = getCompotrolls();	
		$xpath = new DOMXPath($dom);			
		$compotroll = $xpath->query("/Elements/Element[@id='$id']")->item(0);
		
		if ( !$compotroll )
			$compotroll = $dom->createElement("Element");
			
		$compotroll->nodeValue = utf8_encode($data["nom_composant"]);
		$compotroll->setAttribute( "id", $id );	
		$compotroll->setAttribute( "troll", utf8_encode($troll) );			
		$compotroll->setAttribute( "nom",  utf8_encode($data["nom_monstre"]) );
		$compotroll->setAttribute( utf8_encode("qualité"), utf8_encode($data["qualité"]) );
		$compotroll->setAttribute( "emplacement",  utf8_encode($data["emplacement"]) );			
		
		if ( !$compotroll->parentNode )
			$dom->documentElement->appendChild($compotroll);	
		
		$dom->formatOutput = true;
		$dom->save("em/compotroll.xml");			
		
	}

	function htmlRecettes(){
		
		$retour = "";
		$tr = "<tr class='mh_tdtitre' align='center'>";	
		
		$recettes = getEMRecettes()->getElementsByTagName("Recette");
		
		foreach ( $recettes as $i => $recette ){
		
			$couleur = "red";
			if ( $recette->getAttribute("statut") != "INCOMPLET" )
				$couleur = "green";
			$td = "<td  class='mh_tdpage' style='border: 1px solid #F9BB2F;' onClick=\"location.href='view_recette.php?id=" .$i. "'\" onMouseOut=\"this.style.backgroundColor = '#30385C';\" onMouseOver=\"this.style.backgroundColor = '#F9BB2F';this.style.cursor='pointer'\">";		
			
			if ( $i%4 == 0 )
				$retour .= $tr;

			$retour .= $td;
				$retour .= "<h2>" .utf8_decode($recette->getAttribute("nom")). "</h2>";
				$retour .= "<h3 style='display:inline;color:$couleur;'>" .$recette->getAttribute("statut"). "</h3><br/><br/>";
				$retour .= "Chance de réussite : " .addColor($recette->getAttribute("ratio")."%");
			$retour .= "</td>";

			if ( $i%4 == 3 )
				$retour .= "</tr>";
			
		}
		
		return $retour;
		
	}
	
	function getBestRatioRecette ($recette){
		
		$retour = 110;	
		
		$xpath = new DOMXPath(getEMRecettes());			
		$composantsFixe = $xpath->query('/Recettes/Recette[@nom="' .$recette->getAttribute("nom"). '"]/composant[@nom!="Inconnu"]');		
		foreach ( $composantsFixe as $composantFixe ){
			
			$ratio = getBestRatio($composantFixe);
			if ( $ratio != -100 )
				$retour += $ratio;
					
		}			
				
		return $retour;
		
	}
	
	function getBestRatio($composantRecette){
				
		$retour = "";				
		$xpath = new DOMXPath(getComposants());		
		$ratio = -100;
		
		foreach ( $xpath->query('/Elements/Element[contains(child::text(),"' .$composantRecette->getAttribute("nom"). '")]') as $composantMonstre ){					
							
			if ( preg_match( "#" .$composantRecette->nodeValue. ".*#", $composantMonstre->nodeValue ) )
				$ratioTemp = 0;				
			else if ( !$composantRecette->hasAttribute("mundidey") )			
				$ratioTemp = -20;	
			else
				continue;		
			
			if ( !$composantRecette->hasAttribute("mundidey") && !preg_match( "#.*" .$composantRecette->getAttribute("emplacement"). ".*#", $composantMonstre->nodeValue ) )
				$ratioTemp -= 5;					
			
			foreach ( getQualité() as $name => $value )	
				if ( preg_match( "#.*Qualité " .$name. ".*#", utf8_decode($composantMonstre->nodeValue)) ){
					$i = $value;		
					break;
				}
			$ratioTemp += ( $i-getQualité(utf8_decode($composantRecette->getAttribute(utf8_encode("qualité")))) )*5;		
	
			if ( $ratioTemp>$ratio )
				$ratio = $ratioTemp;		
			
		}
	
		return $ratio;	
		
	}
	
	function getRecetteComposants($recette){
		
		$retour = "";
		
		foreach ( $recette->childNodes as $composant ){
		
			$couleur = ($composant->getAttribute("position")%2 == 0) ? "#F86F0A": "#F9BB2F";
		
			$retour .= "<tr class='mh_tdpage'><td align='center' width='200px'><h3 style='color:$couleur;'>Position " .$composant->getAttribute("position"). "</h3></td><td align='center'><h3 style='color:$couleur;'>" .utf8_decode($composant->nodeValue .utf8_encode(" de Qualité "). $composant->getAttribute(utf8_encode("qualité")) . " [" .$composant->getAttribute("emplacement"). "]</h3></td>");
			if ( $composant->hasAttribute("mundidey") )
				$retour .= "<td align='center' width='200px'><h3><a style='color:$couleur;' href='update_composant.php?position=" .$composant->getAttribute("position"). "&id=".$_GET["id"]."'>Composant variable</a></h3></td>";
			else
				$retour .= "<td align='center' width='200px'><h3 style='color:$couleur;'>Composant fixe</h3></td>";
			$retour .= "</tr>";
		
		}
		
		return $retour;
		
	}
	
	function getParcheminOption(){
	
		$retour = "";	
		$xpath = new DOMXPath(getParchemins());		
		$arrayParchemin = array();
		
		foreach ( $xpath->query('/Elements/Element[contains(child::text(),"Parchemin Vierge")]') as $parchemin )
			$arrayParchemin[] = array( "id" => $parchemin->getAttribute("id"), "idTaniere" => $parchemin->getAttribute("idTaniere"), "nom" => $parchemin->nodeValue );
			
		if ( empty($arrayParchemin) ) {
			
			$retour .= "<option onClick='updateRatio();' value='0'>Pas de parchemins en Tanières !</option>";
			$retour = "<td class='mh_tdpage'><select class='composant_taniere'>" .$retour. "</select></td>";
			$retour .= "<td id='td_parchemin' class='mh_tdpage'  width='200px'><h3></h3></td>";
			$retour .= "<input class='hidden_element' type='hidden' value='Pas de parchemins en Tanières !'/>";			
			
		} else { 
			
			foreach ( $arrayParchemin as $parchemin )
				$retour .= "<option onClick='updateHidden( \"hidden_parchemin\", \"[".$parchemin["id"]."] ".addslashes(utf8_decode($parchemin["nom"]))." ".getTanieresById($parchemin["idTaniere"])."\" );updateRatio();getTaniere( \"PoPaAn\", \"parchemin\", " .$parchemin["id"]. " );' value='0'>" .utf8_decode($parchemin["nom"]). " -> 0%</option>";			
			
				$retour = "<td class='mh_tdpage'><select class='composant_taniere'>" .$retour. "</select></td>";
				$retour .= "<td id='td_parchemin' class='mh_tdpage'  width='200px'><h3><a href='' onClick=\"window.open('http://games.mountyhall.com/mountyhall/View/TresorHistory.php?ai_IDTresor=" .$arrayParchemin[0]["id"]. "&as_From=Comptoir&ai_IDLieu=" .$arrayParchemin[0]["idTaniere"]. "','_blank','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=1, copyhistory=0, menuBar=0, width=766, height=636');return(false);\">[" .$arrayParchemin[0]["id"]. "]</a> <a href='http://games.mountyhall.com/mountyhall/MH_Comptoirs/Comptoir_o_Stock.php?IDLieu=" .$arrayParchemin[0]["idTaniere"]. "&as_type=PoPaAn' target='_blank'>" .getTanieresById($arrayParchemin[0]["idTaniere"]). "</a></h3></td>";				
				$retour .= "<input id='hidden_parchemin' class='hidden_element' type='hidden' value=\"[" .$arrayParchemin[0]["id"]. "] " .utf8_decode($arrayParchemin[0]["nom"]). " " .getTanieresById($arrayParchemin[0]["idTaniere"]). "\"/>";
			
		}
			
		return $retour;
	
	}
	
	function getChampignonOption(){
		
		$retour = "";
		$qualités = array ( "Mielleux" => "0", "Sucré" => "-5", "Salé" => "-10", "Acide" => "-20" );
		$arrayCorrespondance = array( "du Hum ..." => "Inconnu" , "du Phoenix" => "Préscientus Reguis" , "de la Mouche" => "Amanite Trolloïde" , "du Dindon" => "Girolle Sanglante" , "du Goblin" => "Horreur Des Prés" , "du Démon" => "Bolet Péteur" , "de la Limace" => "Pied Jaune" , "du Rat" => "Agaric Sous-Terrain" , "de l'Hydre" => "Suinte Cadavre" , "du Ver" => "Cèpe Lumineux" , "du Fungus" => "Fungus Rampant" , "de la Vouivre" => "Nez Noir" , "du Gnu" => "Pleurote Pleureuse" , "du Scarabée" => "Phytomassus Xilénique" );		
		$arrayChampignon = array();
		$mundidey = getMundidey(time());		
		$xpath = new DOMXPath(getChampignons());				
		
		foreach ( $xpath->query('/Elements/Element[contains(child::text(),"' .utf8_encode($arrayCorrespondance[$mundidey]). '")]') as $champignon )
			foreach ( $qualités as $qualité => $value )
				if ( preg_match( "#.*" .utf8_encode($qualité). "#", $champignon->nodeValue ) ){
					$arrayChampignon[] = array ( "id" => $champignon->getAttribute("id"), "idTaniere" => $champignon->getAttribute("idTaniere"), "ratio" => $value, "nom" => $champignon->nodeValue );
					break;
				}
		
		if ( empty($arrayChampignon) ) {
		
			$retour .= "<option onClick='updateRatio();' value='0'>Pas de champignons en Tanières !</option>";
			$retour = "<td class='mh_tdpage'><select class='composant_taniere'>" .$retour. "</select></td>";
			$retour .= "<td id='td_champignon' class='mh_tdpage'  width='200px'><h3></h3></td>";
			$retour .= "<input class='hidden_element' type='hidden' value='Pas de champignons en Tanières !'/>";
		
		} else {		
		
			usort( $arrayChampignon, 'sortByRatio' );
			foreach ( $arrayChampignon as $champignon )
				$retour .= "<option onClick='updateHidden( \"hidden_champignon\", \"[".$champignon["id"]."] ".addslashes(utf8_decode($champignon["nom"]))." ".getTanieresById($champignon["idTaniere"])."\" );updateRatio();getTaniere( \"Champi\", \"champignon\", " .$champignon["id"]. " );' value='" .$champignon["ratio"]. "'>" .utf8_decode($champignon["nom"]). " -> " .$champignon["ratio"]. "%</option>";			
		
			$retour = "<td class='mh_tdpage'><select class='composant_taniere'>" .$retour. "</select></td>";
			$retour .= "<td id='td_champignon' class='mh_tdpage'  width='200px'><h3><a href='' onClick=\"window.open('http://games.mountyhall.com/mountyhall/View/TresorHistory.php?ai_IDTresor=" .$arrayChampignon[0]["id"]. "&as_From=Comptoir&ai_IDLieu=" .$arrayChampignon[0]["idTaniere"]. "','_blank','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=1, copyhistory=0, menuBar=0, width=766, height=636');return(false);\">[" .$arrayChampignon[0]["id"]. "]</a> <a href='http://games.mountyhall.com/mountyhall/MH_Comptoirs/Comptoir_o_Stock.php?IDLieu=" .$arrayChampignon[0]["idTaniere"]. "&as_type=Champi' target='_blank'>" .getTanieresById($arrayChampignon[0]["idTaniere"]). "</a></h3></td>";		
			$retour .= "<input id='hidden_champignon' class='hidden_element' type='hidden' value=\"[" .$arrayChampignon[0]["id"]. "] " .utf8_decode($arrayChampignon[0]["nom"]). " " .getTanieresById($arrayChampignon[0]["idTaniere"]). "\"/>";		
		
		}
		
		return $retour;
		
	}
	
	function getCompoTrollOption(){
		
		$retour = "";
		$arrayCompo = array();		
		
		if ( isset($_SESSION["AuthTroll"]) )
			$compotroll = getItemById( getCompotrolls(), $_SESSION["AuthTroll"] );
			
		if( !$compotroll ) {
			
			$retour .= "<option onClick='updateRatio();' value='0'>Pas de compotroll !</option>";
			$retour = "<td class='mh_tdpage'><select class='composant_taniere'>" .$retour. "</select></td>";
			$retour .= "<td id='td_compotroll'class='mh_tdpage'  width='200px'><h3></h3></td>";
			$retour .= "<input class='hidden_element' type='hidden' value='Pas de compotroll !'/>";				
			
			return $retour;				
			
		}	
		
		$xpath = new DOMXPath(getComposants());		
		foreach ( $xpath->query('/Elements/Element[contains(child::text(),"' .$compotroll->nodeValue. '")]') as $c )
			if ( getInfoCompoTroll( $compotroll, $c ) )
				$arrayCompo[] = getInfoCompoTroll( $compotroll, $c );
			
		if ( empty($arrayCompo) ) {
		
			$retour .= "<option onClick='updateRatio();' value='0'>Pas de compotroll !</option>";
			$retour = "<td class='mh_tdpage'><select class='composant_taniere'>" .$retour. "</select></td>";
			$retour .= "<td id='td_compotroll'class='mh_tdpage'  width='200px'><h3></h3></td>";
			$retour .= "<input class='hidden_element' type='hidden' value='Pas de compotroll !'/>";				
		
		} else {
			
			usort( $arrayCompo, 'sortByRatio' );	
			foreach ( $arrayCompo as $compo )
				$retour .= "<option onClick=\"updateHidden( 'hidden_compotroll', '[".$compo["id"]."] ".addslashes($compo["nom"])." ".getTanieresById($compo["idTaniere"])."' );updateRatio();getTaniere( 'Compo', 'compotroll', " .$compo["id"]. " );\" value='" .$compo["ratio"]. "'>" .$compo["nom"]. " -> " .$compo["ratio"]. "%</option>";			
	
			$retour = "<td class='mh_tdpage'><select class='composant_taniere'>" .$retour. "</select></td>";
			$retour .= "<td id='td_compotroll'class='mh_tdpage'  width='200px'><h3><a href='' onClick=\"window.open('http://games.mountyhall.com/mountyhall/View/TresorHistory.php?ai_IDTresor=" .$arrayCompo[0]["id"]. "&as_From=Comptoir&ai_IDLieu=" .$arrayCompo[0]["idTaniere"]. "','_blank','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=1, copyhistory=0, menuBar=0, width=766, height=636');return(false);\">[" .$arrayCompo[0]["id"]. "]</a> <a href='http://games.mountyhall.com/mountyhall/MH_Comptoirs/Comptoir_o_Stock.php?IDLieu=" .$arrayCompo[0]["idTaniere"]. "&as_type=Compo' target='_blank'>" .getTanieresById($arrayCompo[0]["idTaniere"]). "</a></h3></td>";
			$retour .= "<input id='hidden_compotroll' class='hidden_element' type='hidden' value=\"[" .$arrayCompo[0]["id"]. "] " .$arrayCompo[0]["nom"]. " " .getTanieresById($arrayCompo[0]["idTaniere"]). "\"/>";				
			
		}	

		return $retour;
		
	}	
	
	function getComposantOption( $composant ){
		
		$retour = "";
		$position = $composant->getAttribute("position");
		$arrayCompo = array();	
		$xpath = new DOMXPath(getComposants());		
		
		foreach ( $xpath->query('/Elements/Element[contains(child::text(),"' .$composant->getAttribute("nom"). '")]') as $c )
			if ( getInfoComposant( $composant, $c ) )
				$arrayCompo[] = getInfoComposant( $composant, $c );
			
		if ( empty($arrayCompo) ) {
		
			$retour .= "<option onClick='updateRatio();' value='0'>Pas de composants en Tanières !</option>";
			$retour = "<td class='mh_tdpage'><select class='composant_taniere'>" .$retour. "</select></td>";
			$retour .= "<td id='td_$position'class='mh_tdpage'  width='200px'><h3></h3></td>";
			$retour .= "<input class='hidden_element' type='hidden' value='Pas de composants en Tanières !'/>";			
		
		} else {
			
			usort( $arrayCompo, 'sortByRatio' );	
			foreach ( $arrayCompo as $compo )
				$retour .= "<option onClick=\"updateHidden( 'hidden_composant_$position', '[".$compo["id"]."] ".addslashes($compo["nom"])." ".getTanieresById($compo["idTaniere"])."' );updateRatio();getTaniere( 'Compo', $position, " .$compo["id"]. " );\" value='" .$compo["ratio"]. "'>" .$compo["nom"]. " -> " .$compo["ratio"]. "%</option>";			
	
			$retour = "<td class='mh_tdpage'><select class='composant_taniere'>" .$retour. "</select></td>";
			$retour .= "<td id='td_$position'class='mh_tdpage'  width='200px'><h3><a href='' onClick=\"window.open('http://games.mountyhall.com/mountyhall/View/TresorHistory.php?ai_IDTresor=" .$arrayCompo[0]["id"]. "&as_From=Comptoir&ai_IDLieu=" .$arrayCompo[0]["idTaniere"]. "','_blank','toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=1, copyhistory=0, menuBar=0, width=766, height=636');return(false);\">[" .$arrayCompo[0]["id"]. "]</a> <a href='http://games.mountyhall.com/mountyhall/MH_Comptoirs/Comptoir_o_Stock.php?IDLieu=" .$arrayCompo[0]["idTaniere"]. "&as_type=Compo' target='_blank'>" .getTanieresById($arrayCompo[0]["idTaniere"]). "</a></h3></td>";
			$retour .= "<input id='hidden_composant_$position' class='hidden_element' type='hidden' value=\"[" .$arrayCompo[0]["id"]. "] " .$arrayCompo[0]["nom"]. " " .getTanieresById($arrayCompo[0]["idTaniere"]). "\"/>";			
			
		}	

		return $retour;
		
	}
	
	function getInfoComposant( $composantRecette, $composantMonstre ){
		
		$arrayComposant = NULL;	
			
		if ( preg_match( "#" .$composantRecette->nodeValue. ".*#", $composantMonstre->nodeValue ) )
			$arrayComposant["ratio"] = 0;
		else if ( !$composantRecette->hasAttribute("mundidey") )			
			$arrayComposant["ratio"] = -20;
			
		if ( !$composantRecette->hasAttribute("mundidey") && !preg_match( "#.*" .$composantRecette->getAttribute("emplacement"). ".*#", $composantMonstre->nodeValue ) )
			$arrayComposant["ratio"] -= 5;		
		
		if ( $arrayComposant ){
			
			$arrayComposant["nom"] = utf8_decode($composantMonstre->nodeValue);
			$arrayComposant["id"] = $composantMonstre->getAttribute("id");
			$arrayComposant["idTaniere"] = $composantMonstre->getAttribute("idTaniere");				
			
			foreach ( getQualité() as $name => $value )	
				if ( preg_match( "#.*Qualité " .$name. ".*#", utf8_decode($composantMonstre->nodeValue)) ){
					$i = $value;		
					break;
				}
			$arrayComposant["ratio"] += ( $i-getQualité(utf8_decode($composantRecette->getAttribute(utf8_encode("qualité")))) )*5;		
		
		}
		
		return $arrayComposant;
		
	}
	
	function getInfoCompoTroll( $compoTroll, $composantMonstre ){
		
		$arrayComposant["ratio"] = 0;	
			
		if ( !preg_match( "#.*" .$compoTroll->getAttribute("emplacement"). ".*#", $composantMonstre->nodeValue ) )
			$arrayComposant["ratio"] -= 10;		
		
		if ( $arrayComposant ){
			
			$arrayComposant["nom"] = utf8_decode($composantMonstre->nodeValue);
			$arrayComposant["id"] = $composantMonstre->getAttribute("id");
			$arrayComposant["idTaniere"] = $composantMonstre->getAttribute("idTaniere");				
			
			foreach ( getQualité() as $name => $value )	
				if ( preg_match( "#.*Qualité " .$name. ".*#", utf8_decode($composantMonstre->nodeValue)) )
					$i = $value;		
					
			$i = $i-getQualité(utf8_decode($compoTroll->getAttribute(utf8_encode("qualité"))));
			if ( $i < 0 )
				$i *= 4;
			$arrayComposant["ratio"] += $i*5;		
		
		}
		
		return $arrayComposant;
		
	}	
	
	function getCrapComposant(){
		
		$retour = "";
		$xpathCompo = new DOMXPath(getComposant());	

		$xpath = new DOMXPath(getEMRecettes());
		foreach ( $xpath->query("/Recettes/Recette/composant[not(@mundidey)]") as $composantFixe )
			$composantsFixe[] = $composantFixe->getAttribute("nom"); 
		$xpath = new DOMXPath(getEMComposantVariable());
		foreach ( $xpath->query("/Elements/Element") as $composantFixe )
			$composantsFixe[] = $composantFixe->nodeValue; 		
		$xpath = new DOMXPath(getCompotrolls());
		foreach ( $xpath->query("/Elements/Element") as $composantFixe )
			$composantsFixe[] = $composantFixe->nodeValue; 					
		
		$composantsFixe = implode( "|", $composantsFixe );		
		
		$xpath = new DOMXPath(getComposants());			
		
		foreach ( $xpath->query(utf8_encode("/Elements/Element[contains(child::text(),'Mauvaise')]")) as $composant )
			if ( !preg_match( "#" .$composantsFixe. ".*#", $composant->nodeValue ) ){
			
				$niveau = $xpathCompo->query('/Elements/Element[contains("' .$composant->nodeValue. '",child::text())]')->item(0);
				$niveau = ( $niveau->nodeValue == NULL ) ? "?" : $niveau->getAttribute("niveau");
				$arrayComposants[preg_replace( "#.*Qualité (.*) \[.*#", "$1", utf8_decode($composant->nodeValue) )][utf8_decode($composant->nodeValue)][] = array( "nom" => utf8_decode($composant->nodeValue), "niveau" => $niveau, "id" => $composant->getAttribute("id"), "idTaniere" => $composant->getAttribute("idTaniere") );
			
			}
		
		usort( $arrayComposants["Très Mauvaise"], 'sortByNumber' );
		usort( $arrayComposants["Mauvaise"], 'sortByNumber' );		
		$arrayComposants = array_reverse($arrayComposants);
			
		foreach ( $arrayComposants as $arrayQualité )
			foreach ( $arrayQualité as $composants )
				foreach ( $composants as $composant )
					$retour .= "[" .$composant["id"]. "] ".$composant["nom"]. " " .getTanieresById($composant["idTaniere"]). " niveau:" .$composant["niveau"]. "\n";
		
		return "<textarea rows='25' cols='200'>$retour</textarea>";
		
	}
	
	function getTanieresComposant($query="/Elements/Element"){
		
		$retour = "";
		
		$retour .= "<tr style='color:white'>
						<th>Id</th>
						<th>Tanière</th>					
						<th>Sortilège</th>
						<th>Mundidey</th>
						<th>Nom Complet</th>
					</tr>";
			
		$xpath = new DOMXPath(getComposantsTanieres());
		foreach ( $xpath->query($query) as $composant ){	
		
			$retour .= "<tr align='center'>";
				$retour .= "<td>";
					$retour .= $composant->getAttribute("id");
				$retour .= "</td>";
				$retour .= "<td>";
					$retour .= getTanieresById($composant->getAttribute("idTaniere"));
				$retour .= "</td>";
				$retour .= "<td>";
					$retour .= ( $composant->getAttribute("sortilege") ) ? utf8_decode($composant->getAttribute("sortilege")) : "-";
				$retour .= "</td>";
				$retour .= "<td>";
					$retour .= ( $composant->getAttribute("mundidey") ) ? utf8_decode($composant->getAttribute("mundidey")) : "-";
				$retour .= "</td>";				
				$retour .= "<td>";
					$retour .= utf8_decode($composant->nodeValue);
				$retour .= "</td>";												
			$retour .= "</tr>";			
			
		}
		
		return $retour;
		
	}
	
	function updateTanieresComposant(){
		
		$retour = "";
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
		$dom->preserveWhiteSpace = false;		
		$root = $dom->createElement("Elements");
		$dom->appendChild($root);			
		
		$xpath = new DOMXPath(getEMRecettes());
		foreach ( $xpath->query("/Recettes/Recette/composant[not(@mundidey)]") as $composantFixe ){
			$arraySortilege[] = $composantFixe;	
			$patternNomFixe[] = $composantFixe->getAttribute("nom");
		}
			
		$xpath = new DOMXPath(getEMComposantVariable());
		foreach ( $xpath->query("/Elements/Element") as $composantFixe ){
			$arrayFixe[] = $composantFixe;			
			$patternNomMundidey[] = $composantFixe->getAttribute("nom");		
		}
		
		$xpath = new DOMXPath(getComposants());
		
		foreach ( $xpath->query("/Elements/Element") as $composant )
			if ( $composant->nodeValue ){
				
				$composant = getSortilegeNameByComposant( implode( "|", $patternNomFixe ), $arraySortilege, $composant );
				$composant = getFixeByComposant( implode( "|", $patternNomMundidey ), $arrayFixe, $composant );
				$root->appendChild($dom->importNode( $composant, true ));
				
			}
		
		$dom->formatOutput = true;
		$dom->save("em/composant_tanieres.xml");		
		
	}
	
	function getSortilegeNameByComposant( $patternNomFixe, $arraySortilege, $composant ){
		
		$xpath = new DOMXPath(getEMRecettes());
		
		if ( preg_match( "#.*".$patternNomFixe.".*#", $composant->nodeValue ) )
			foreach ( $arraySortilege as $composantFixe )
				if ( preg_match( "#" .$composantFixe->getAttribute("nom"). "#", $composant->nodeValue ) ){
				
					$info = getInfoComposant( $composantFixe, $composant );
					$composant->setAttribute( "sortilege", $composantFixe->parentNode->getAttribute("nom"). " => " .$info["ratio"]. "%" );
					
					return $composant;
					
				}
				
		return $composant;
		
	}
	
	function getFixeByComposant( $patternNomMundidey, $arrayFixe, $composant ){
		
		$arrayCorrespondance = array( "Phoenix" => "du Phoenix", "Mouch'oo Sauvage" => "de la Mouche", "Mouch'oo Majestueux Sauvage" => "de la Mouche", "Dindon" => "du Dindon", "Goblin" => "du Goblin", "Limace Géante" => "de la Limace", "Rat Géant" => " du Rat", "Hydre" => "de l'Hydre", "Ver Carnivore Géant" => "du Ver", "Fungus Géant" => "du Fungus", "Fungus Violet" => "du Fungus", "Vouivre" => "de la Vouivre", "Gnu Sauvage" => "du Gnu", "Scarabée Géant" => "du Scarabée" );		
		
		if ( preg_match( "#.*".$patternNomMundidey.".*#", $composant->nodeValue ) )		
			foreach ( $arrayFixe as $composantFixe )
				if ( preg_match( "#" .$composantFixe->nodeValue. ".*#", $composant->nodeValue ) ){
					
					$composant->setAttribute( "mundidey", utf8_encode("Mundidey " .strtr( utf8_decode($composantFixe->getAttribute("nom")), $arrayCorrespondance )) );
					
					return $composant;
					
				}		
		
		return $composant;
		
	}
	
	function getItemById( $dom, $id ){
		
		$xpath = new DOMXPath($dom);		
		
		return 	$xpath->query("/Elements/Element[@id='$id']")->item(0);
		
	}	
	
	function getTanieresById($id){
		
		return strtr ( $id, array ( "38965" => "La Bïblyohtek", "1646554" => "Le Relais des Abysses", "34111" => "La Taverne" ) );
		
	}
	
	function getQualité($i=-1){
		
		$qualité = array( "Très Mauvaise" => "0", "Mauvaise" => "1", "Moyenne" => "2", "Bonne" => "3", "Très Bonne" => "4"  );
		
		return ($i==-1) ? $qualité : $qualité[$i];
		
	}
	
	function addColor( $s, $r=1 ){
		
		$c = "orange";
		if ( $s != 0 )
			$c = ($r*$s>99) ? "green" : "red";
		
		return "<span style=\"color:$c;\">$s</span>";
		
	}		
	
	function sortByNumber($a,$b){

		if ( count($a) == count($b) )
			return 0;

		return (count($a) > count($b)) ? -1 : 1;

	}	
	
	function sortByRatio($a,$b){
	
		if ($a["ratio"] == $b["ratio"])
			return 0;

		return ($a["ratio"] > $b["ratio"]) ? -1 : 1;
		
	}		
	
?>