<?php

        function do_attrib( $post, $pseudo ){
                
                $retour = "";
                $start = "<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'>";
                $end = "</td></tr>";
                
                if ( array_key_exists('attrib',$post) ){
                        
                        $nom_attrib = htmlspecialchars( trim($post['attrib']), ENT_QUOTES );
                        $pseudo = htmlspecialchars( trim($pseudo), ENT_QUOTES );
                        
                        // vérifie les saisies
                        if ( empty($nom_attrib) )
                                $retour .= $start ."<h3>Veuillez saisir un nom d'attribution !</h3>". $end;
                                
                        if ( !empty($nom_attrib) && !empty($pseudo) ){
                                
                                $retour .= $start ."<h2>Nom de l'attribution : " .$nom_attrib. "</h3>". $end;
                                
                                // ajoute l'attribution au fichier xml si le nom n'existe pas
                                if ( check_name($nom_attrib) ){
                                        
                                        create_attrib($nom_attrib,$pseudo);
                                        $retour .= $start .create_troll_form($nom_attrib). $end;
                                
                                } else
                                        $retour .= $start ."<h3>Le nom d'attribution existe déja !</h3>". $end;                                 
                                
                        }
                                                                        
                }

                if ( array_key_exists('chance',$post) && array_key_exists('pseudo',$post) ){
                        
                        $nom_attrib = $post['hidden'];
                        $chance = intval(trim($post['chance']));
                        $pseudo = htmlspecialchars( trim($post['pseudo']), ENT_QUOTES, "UTF-8" );
                        $retour .= $start ."<h2>Nom de l'attribution : " .$nom_attrib. "</h2>". $end;;
                        
                        // vérifie les saisies
                        if ( empty($pseudo) )
                                $retour .= $start ."<h3>Veuillez saisir un nom de Troll !</h3>". $end;                          
                        if ( empty($chance) || !is_int($chance) || $chance <= 0 )
                                $retour .= $start ."<h3>Le nombre de chance est incorrecte ! ( Seulement un chiffre strictement supérieur à  0 )</h3>". $end;   
                                
                        // ajoute le participant au fichier xml 
                        if ( !empty($pseudo) && !empty($chance) && is_int($chance) && $chance > 0 )
                                create_participant($pseudo,$chance);
                                
						$attrib = get_last_attribution(get_dom());								
								
                        // affiche les deux formulaires ainsi que les participants
                        $retour .= $start .create_troll_form($nom_attrib). $end;
                        if ( check_participants($attrib) )
                                $retour .= $start .get_participants($attrib). $end; 
                        $retour .= "<br/>";
                        $retour .= $start .create_validation_form($nom_attrib). $end;                                   
                        
                }
                
                return $retour;         
                
        }

        function create_troll_form($nom_attrib){
        // retourne le formulaire d'ajout d'un participant      
                
                $retour = "";
                
                $retour .= "<form id=\"troll\" action=\"#\" method=\"post\">";
                        $retour .= "<table>";
                                $retour .= "<tr>";
                                        $retour .= "<td><label for=\"pseudo\">Pseudo du Troll : </label></td>";
                                        $retour .= "<td><input name=\"pseudo\" id=\"pseudo\" type=\"text\" /></td>";
                                $retour .= "</tr>";                                     
                                $retour .= "<tr>";                                      
                                        $retour .= "<td><label for=\"chance\">Chance d'attribution : </label></td>";
                                        $retour .= "<td><input name=\"chance\" id=\"chance\" type=\"text\" /></td>";
                                $retour .= "</tr>";                                     
                        $retour .= "</table>";
                        $retour .= "<input type=\"submit\" value=\"Ajouter le Troll !\" />";
                        $retour .= "<input name=\"hidden\" type=\"hidden\" value=\"" .$nom_attrib. "\" />";             
                $retour .= "</form>";
                
                $retour .= "<h3>Participants : </h3>";
                
                return $retour;
                
        }

        function create_validation_form($nom_attrib){
        // retourne le formulaire de validation d'attribution
                
                $retour = "";
                
                $retour .= "<form action=\"result.php\" method=\"post\">";
                        $retour .= "<input type=\"submit\" value=\"Laisser KKWET décider !\" />";
                        $retour .= "<input name=\"hidden\" type=\"hidden\" value=\"" .$nom_attrib. "\" />";             
                $retour .= "</form>";
                
                return $retour;
                
        }
        
        function create_participant($pseudo,$chance){
        // ajoute un participant dans le fichier xml
                
                $dom = get_dom();      

                $participant = $dom->createElement("participant",$pseudo);
                $participant->setAttribute("chance", $chance);     
                get_last_attribution($dom)->appendChild($participant);
                $dom->formatOutput = true;
                $dom->save("attribution.xml");          
                
        }

        function create_attrib($nom_attrib,$pseudo){
        // ajoute une attribution dans le fichier xml
                
                $dom = get_dom();       

                $attrib = $dom->createElement("attrib");
                $attrib->setAttribute("name", utf8_encode($nom_attrib));        
                $attrib->setAttribute("pseudo", utf8_encode($pseudo));          
                $attribs = $dom->getElementsByTagName("attribs")->item(0);
                $attribs->appendChild($attrib);
                
                $dom->formatOutput = true;
                $dom->save("attribution.xml");
                
        }
        
        function check_name($nom_attrib){
        // retourne vrai si le nom d'attribution est déja utilisé
        
                $dom = get_dom();               
                
                foreach ( $dom->getElementsByTagName("attrib") as $attrib )
                        if ( utf8_decode($attrib->getAttribute("name")) == $nom_attrib )
                                return false;
                
                return true;
                                
        }
        
        function check_participants($nom_attrib){
        // vérifie l'existance de participants dans une attribution
                
                return get_last_attribution(get_dom())->hasChildNodes();
                
        }
        
        function get_dom(){
        // retourne l'objet DOM
                
                $dom = new DOMDocument("1.0");  
                $dom->preserveWhiteSpace = false;
                $dom->encoding = "UTF-8";               
                $dom->load("attribution.xml");
                
                return $dom;            
                
        }       

        function get_participants($attribution){
        // retourne le code html des participants d'une attribution
                
                $retour = "";            
                
                $participants = $attribution->getElementsByTagName("participant");
                                
                foreach ( $participants as $participant )       
                	$retour .= "<tr class='mh_tdtitre'><td align='center'>" .utf8_decode(stripslashes($participant->nodeValue)). "</td><td align='center'>" .$participant->getAttribute("chance"). "</td></tr>";    
                                
                return "<table class='mh_tdborder' align='center' border='2' frame='void'><tr class='mh_tdtitre' align='center' style='color:white;'><th>&nbsp;Pseudo&nbsp;</th><th>&nbsp;Nombre de Chance&nbsp;</th></tr>" .$retour. "</table>";
                
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
                        $retour .= "<a href=\"view_attribution.php?id=" .$i. "\">" .utf8_decode(stripslashes($attributions->item($i)->getAttribute("name"))). " le " .$attributions->item($i)->getAttribute("date"). " par " .utf8_decode($attributions->item($i)->getAttribute("pseudo")). " : <strong>" .utf8_decode(get_winner($attributions->item($i))). "</strong></a><br/>";   
                
                return $retour;
                
        }
        
        function get_last_attribution($dom){
        // retourne l'attribution correspondante
        
        		$attrib = NULL;
				$attrib = $dom->getElementsByTagName("attrib")->item($dom->getElementsByTagName("attrib")->length-1);			
	
				return $attrib;		

        }
        
        function get_result(){
        // retourne le code html du résultat de l'attribution
                
                $retour = "";
                $start = "<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'>";
                $end = "</td></tr>";
                $chance_totale = 0;
                
                $dom = get_dom();               
                
                $attribution = get_last_attribution($dom);
                
                if ( $attribution->hasAttribute("random") )
                        $retour = $start ."<h2>Attribution d&eacute;ja  effectu&eacute; !</h2>". $end;
                else {
                        
                        $participants = $attribution->getElementsByTagName("participant");
                        
                        foreach ( $participants as $participant ){
                        
                                $chance_totale = $chance_totale + $participant->getAttribute("chance");
                                $array_participant[] = array( "pseudo" => $participant->nodeValue, "min" => $chance_totale-$participant->getAttribute("chance")+1, "max" => $chance_totale );   
                                $retour .= $start ."<h3>" .utf8_decode(stripslashes($participant->nodeValue)). " : " .($chance_totale-$participant->getAttribute("chance")+1). "-" .$chance_totale. "</h3>". $end;
                                
                        }
                        
                        $random = abs((microtime(true)*10000)%$chance_totale) + 1;
                        do_winner($random,$array_participant,$participants)->setAttribute("win","1");
                                        
                        date_default_timezone_set('Europe/Berlin');             
                        $attribution->setAttribute("date",strftime("%d-%m-%Y %Hh%M"));
                        $attribution->setAttribute("random",$random);
        
                        $dom->formatOutput = true;
                        $dom->save("attribution.xml");
                        
                        $retour .= $start ."<h1>R&eacute;sultat du jet :" .$random. "</h1>". $end;
                        $retour .= $start ."<h1>The winner is : " .utf8_decode(get_winner($attribution)). "</h1>". $end;
                
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
                $start = "<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'>";
                $end = "</td></tr>";
                
                $dom = get_dom();               

                $attribution = $dom->getElementsByTagName("attrib")->item($id);
                                
                $retour .= $start ."<h3>" .utf8_decode(stripslashes($attribution->getAttribute("name"))). " par " .utf8_decode(stripslashes($attribution->getAttribute("pseudo"))). " le " .$attribution->getAttribute("date"). "</h3>". $end;
                $retour .= $start .get_participants($attribution). $end;
                $retour .= $start ."<h3>Résutalt du jet : " .$attribution->getAttribute("random"). "</h3>". $end;
                $retour .= $start ."<h3>Vainqueur : " .utf8_decode(get_winner($attribution)). "</h3>". $end;
                
                return $retour;
                
        }

?>
