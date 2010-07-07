<?php

	function create_troll_form($nom_attrib){
	// retourne le formulaire d'ajout d'un participant	
		
		$retour = "";
		
		$retour .= "<form id=\"troll\" action=\"#\" method=\"post\">";
			$retour .= "<label for=\"pseudo\">Pseudo du Troll : </label>";
			$retour .= "<input name=\"pseudo\" id=\"pseudo\" type=\"text\" /> ";
			$retour .= "<label for=\"chance\">Chance d'attribution : </label>";
			$retour .= "<input name=\"chance\" id=\"chance\" type=\"text\" /> ";
			$retour .= "<input type=\"submit\" value=\"Ajouter le Troll !\" />";
			$retour .= "<input name=\"hidden\" type=\"hidden\" value=\"" .$nom_attrib. "\"";		
		$retour .= "</form>";
		
		$retour .= "<h3>Participants : </h3>";
		
		return $retour;
		
	}

	function create_validation_form($nom_attrib){
	// retourne le formulaire de validation d'attribution
		
		$retour = "";
		
		$retour .= "<form action=\"result.php\" method=\"post\">";
			$retour .= "<input type=\"submit\" value=\"Laisser KKWET d�cider !\" />";
			$retour .= "<input name=\"hidden\" type=\"hidden\" value=\"" .$nom_attrib. "\"";		
		$retour .= "</form>";
		
		return $retour;
		
	}
	
	function create_participant($nom_attrib,$pseudo,$chance){
	// ajoute un participant dans le fichier xml
		
		$dom = get_dom();	

		$participant = $dom->createElement("participant",$pseudo);
		$participant->setAttribute("chance", $chance);			
		get_attribution($dom,$nom_attrib)->appendChild($participant);
		$dom->formatOutput = true;
		$dom->save("attribution.xml");		
		
	}

	function create_attrib($nom_attrib,$pseudo){
	// ajoute une attribution dans le fichier xml
		
		$dom = get_dom();	

		$attrib = $dom->createElement("attrib");
		$attrib->setAttribute("name", $nom_attrib);	
		$attrib->setAttribute("pseudo", $pseudo);		
		$attribs = $dom->getElementsByTagName("attribs")->item(0);
		$attribs->appendChild($attrib);
		
		$dom->formatOutput = true;
		$dom->save("attribution.xml");
		
	}
	
	function check_name($nom_attrib){
	// retourne vrai si le nom d'attribution est déja utilisé
	
		$dom = get_dom();		
		
		foreach ( $dom->getElementsByTagName("attrib") as $attrib )
			if ( $attrib->getAttribute("name") == $nom_attrib )
				return false;
		
		return true;
				
	}
	
	function check_participants($nom_attrib){
	// vérifie l'existance de participants dans une attribution
		
		return get_attribution(get_dom(),$nom_attrib)->hasChildNodes();
		
	}
	
	function get_dom(){
	// retourne l'objet DOM
		
		$dom = new DOMDocument("1.0");	
		$dom->preserveWhiteSpace = false;		
		$dom->load("attribution.xml");
		
		return $dom;		
		
	}	

	function get_participants($nom_attrib){
	// retourne le code html des participants d'une attribution
		
		$retour = "";
		$dom = get_dom();		
		
		$participants = get_attribution($dom,$nom_attrib)->getElementsByTagName("participant");
				
		foreach ( $participants as $participant )	
			$retour .= "<tr><td>" .stripslashes($participant->nodeValue). "</td><td>" .$participant->getAttribute("chance"). "</td></tr>";	
				
		return "<table align=\"center\" border=\"3\" frame=\"void\" ><tr><th>Pseudo</th><th>Nombre de Chance</th></tr>" .$retour. "</table>";
		
	}
	
	function get_winner($attrib){
	// retourne le vainqueur de l'attribution
		
		foreach( $attrib->getElementsByTagName("participant") as $participant )
			if ( $participant->getAttribute("win") == 1 )
				return stripslashes($participant->nodeValue);
		
	}
	
	function get_attributions(){
	// retourne le code html des attributions effectuées
		
		$retour = "";
		
		$dom = get_dom();	
		$attributions = $dom->getElementsByTagName("attrib");	
		
		for ( $i=$attributions->length-1; $i>=0; $i-- )
			$retour .= "<a href=\"view_attribution.php?id=" .$i. "\">" .stripslashes($attributions->item($i)->getAttribute("name")). " le " .$attributions->item($i)->getAttribute("date"). " par " .$attributions->item($i)->getAttribute("pseudo"). " : <strong>" .get_winner($attributions->item($i)). "</strong></a><br/>";   
		
		return $retour;
		
	}
	
	function get_attribution($dom,$nom_attrib){
	// retourne l'attribution correspondante
		
		foreach( $dom->getElementsByTagName("attrib") as $attrib )
			if ( $attrib->getAttribute("name") == $nom_attrib )
				return $attrib;	
		
	}
	
	function get_result($nom_attrib){
	// retourne le code html du résultat de l'attribution
		
		$retour = "";
		$chance_totale = 0;
		
		$dom = get_dom();		
		
		$attribution = get_attribution($dom,$nom_attrib);
		
		if ( $attribution->hasAttribute("random") )
			$retour = "<p>Attribution d�jà effectu� !</p>";
		else {
			
			$participants = $attribution->getElementsByTagName("participant");
			
			foreach	( $participants as $participant ){
			
				$chance_totale = $chance_totale + $participant->getAttribute("chance");
				$array_participant[] = array( "pseudo" => $participant->nodeValue, "min" => $chance_totale-$participant->getAttribute("chance")+1, "max" => $chance_totale );	
				$retour .= "<p>" .stripslashes($participant->nodeValue). " : " .($chance_totale-$participant->getAttribute("chance")+1). "-" .$chance_totale. "</p>";
				
			}
			
			// génère le jet et décide le vainqueur
			$random = abs((microtime(true)*10000)%$chance_totale) + 1;
			do_winner($random,$array_participant,$participants)->setAttribute("win","1");
					
			// ajoute la date et le résultat du jet à l'attribution		
			date_default_timezone_set('Europe/Berlin');		
			$attribution->setAttribute("date",strftime("%d-%m-%Y %Hh%M"));
			$attribution->setAttribute("random",$random);
	
			$dom->formatOutput = true;
			$dom->save("attribution.xml");
			
			$retour .= "<h1>" .$random. "</h1>";
			$retour .= "<h3>The winner is : " .get_winner($attribution). "</h3>";
		
		}
		
		return $retour;
		
	}

	function do_winner($random,$array_participant,$participants){
	// retourne le DOMNode du gagnant	
		
			foreach ( $array_participant as $participant ){
				
				if ( $random >= $participant['min'] && $random <= $participant['max'] )
					foreach ( $participants as $winner )
						if ( $winner->nodeValue == $participant['pseudo'] )
							return $winner;
												
			}		
		
	}
	
	function get_info_attribution($id){
	// retourne le code html des informations de l'attribution
		
		$retour = "";
		
		$dom = get_dom();		

		$attribution = $dom->getElementsByTagName("attrib")->item($id);
				
		$retour .= "<h3>" .stripslashes($attribution->getAttribute("name")). " par " .stripslashes($attribution->getAttribute("pseudo")). " le " .$attribution->getAttribute("date"). "</h3>";
		$retour .= get_participants($attribution->getAttribute("name"));
		$retour .= "<h3>R�sutalt du jet : " .$attribution->getAttribute("random"). "</h3>";
		$retour .= "<h3>Vainqueur : " .get_winner($attribution). "</h3>";
		
		return $retour;
		
	}

?>