<?php
   
   class c_TrollHTML {
   	
		private $Troll;
		
		// Constructeur
		function c_TrollHTML($Troll){
			
			$this->Troll = $Troll;
			
		}
	
		// Retourne le code HTML contenant le profil du Troll
		function htmlGetProfil(){
			
			$retour = "";
			
			// Nom et numéro du Troll
			$retour .= "<br/><h1>" .utf8_decode($this->Troll->getVar("Nom")). " " .$this->Troll->getVar("Id"). "</h1>";
			
			// Bouton reset et radio arme bouclier/arme 2 mains
			$retour .= "<button onClick=\"resetEquipement(" .$this->Troll->getVar("Id"). ");\">Reset de l'équipement</button><br/>
						<label for='radioArmeBouclier'>Arme et Bouclier</label><input onClick='updateTroll(" .$this->Troll->getVar("Id"). ");' id='radioArmeBouclier' name='configArme' type='radio' value='0' checked='checked'/>
						<label for='radioArme2Main'>Arme à 2 mains</label><input onClick='updateTroll(" .$this->Troll->getVar("Id"). ");' id='radioArme2Main' name='configArme' type='radio' value='1' /><br/><br/>";			
			
			// Tableau contenant les caracs du Troll
			$retour .= "<table id='tableProfil' class='mh_tdborder' align='center' cellpadding='5' style='color:white;font-size:20'>" .$this->htmlGetTableProfil(). "</table><br/>";
			
			return $retour;
			
		}
		
		// Retourne le code HTML contenant le tableau de caractéristiques
		function htmlGetTableProfil(){
			
			$retour = "";
			
			$retour .= "<tr class='mh_tdtitre' align='center'><th colspan='4'>Tableau de Caractéristiques</th></tr>";
		
			$retour .= $this->htmlContentArray( array( "Nom", "Valeur", "BMP", "BMM" ), "th", "20" );
			
			$retour .= $this->htmlCarac("Attaque");
			$retour .= $this->htmlTr($this->htmlArrayElement( "Esquive", "td", "15" ).$this->htmlArrayElement( $this->addDice("Esquive"), "td", "15" )."<td class='mh_tdpage' style='font-size:15;' colspan='2'><strong>" .$this->addColor($this->Troll->getVar("EsquiveBMP")). "</strong></td>");
			$retour .= $this->htmlCarac("Dégâts");	
			$retour .= $this->htmlCarac("Régénération");	
			$retour .= $this->htmlCarac("Vue");
			$retour .= $this->htmlCarac("Armure");	
			$retour .= $this->htmlCarac("PVMax");		
			$retour .= $this->htmlCarac("RM");			
			$retour .= $this->htmlCarac("MM");																																			
			$retour .= $this->htmlTr($this->htmlArrayElement( "Temps", "td", "15" ).$this->htmlArrayElement( "<strong>".$this->displayTime($this->Troll->getVar("Temps"))."</strong>", "td", "15" )."<td class='mh_tdpage' style='font-size:15;'><strong>" .intval($this->Troll->getVar("TempsEquipement")). "m</strong></td><td class='mh_tdpage' style='font-size:15;'><strong>" .$this->addColor( $this->Troll->getVar("TempsBMM")."m", -1 ). "</strong></td>");						
			
			return $retour;
			
		}
		
		// Retourne le code HTML contenant la ligne d'une caractéristique
		function htmlCarac($name){
			
			$nameBMP = $name."BMP";
			$nameBMM = $name."BMM";
			
			return $this->htmlContentArray( array ( $name, $this->addDice($name), "<strong>" .$this->addColor($this->Troll->getVar($nameBMP)). "</strong>" , "<strong>" .$this->addColor( $this->Troll->getVar($nameBMM) ). "</strong>" ), "td", "15" );
			
		}
		
		// Retourne le code HTML du contenu d'un tableau
		private function htmlContentArray( $array, $tag, $size ){
			
			$retour = "";
			
			foreach ( $array as $element )
				$retour .= $this->htmlArrayElement( $element, $tag, $size );
			
			return $this->htmlTr($retour);
			
		}
		
		// Retourne le code HTML d'un tr
		private function htmlTr($s){
			return "<tr class='mh_tdtitre' align='center'>$s</tr>";
		}
		
		// Retourne le code HTML d'un élément d'un tableau
		private function htmlArrayElement( $s, $tag, $size ){
			return "<$tag class='mh_tdpage' style='font-size:$size;'>$s</$tag>";
		}	
		
		// Ajoute le type de dés
		private function addDice($n){
			
			$s = "<strong>" .$this->Troll->getVar($n). "</strong>";
			
			switch($n){
				
				case "Attaque" :			
				case "Esquive" :
					return $s." D6";
					break;
				case "Régénération" :
				case "Dégâts" :
					return $s." D3";
					break;					
				default :
					return $s;
					break;
					
			}
			
		}	
		
		// Retourne le temps avec un formatage définie
		private function displayTime($s){
			$m = intval($s%60);
			$m = ( $m < 10 ) ? "0".$m : $m;
			return intval($s/60)."H".$m;
		}
		
		// Ajoute une couleur selon la valeurs de la chaine
		private function addColor( $s, $r=1 ){
			
			$c = "white";
			if ( $s != 0 )
				$c = ($r*$s>0) ? "green" : "red";
			
			return "<span style=\"color:$c;\">$s</span>";
			
		}				
	
   }
   
?>