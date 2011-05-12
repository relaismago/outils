<?php

	class c_Item {
		
		public $Nom;
		private $Attaque;
		private $AttaqueM;	
		private $Esquive;
		private $Dégâts;
		private $DégâtsM;		
		private $Régénération;
		private $PV;	
		private $Vue;
		private $RM;
		private $MM;							
		private $Armure;
		private $ArmureM;
		private $Temps;
		private $TempsEquipement;	
		private $Mithril;
		
		// Constructeur
		function c_Item($Nom){
			
			// Initialise tous les attributs à 0
			foreach ( $this as $name => $value )
				$this->$name = 0;	
				
			$this->Nom = $Nom;	
			
			if ( !preg_match( "#\"#", $this->Nom ) ){
				
				$xpath = new DOMXPath($this->getDomItem());
				$item = $xpath->query('/Items/Item[contains("' .utf8_encode($this->Nom). '",child::text())]')->item(0);			
	
				if ( $item == null )
					$item = $xpath->query('/Items/Mithril/Item[contains("' .utf8_encode($this->Nom). '",child::text())]')->item(0);	
				
				if ( $item != null )
					$this->applyItem($item);
				
			}
			
		}
		
		// Construit l'objet à partir d'un tableau
		public function constructWithArray($caracs){
			
			foreach( $caracs as $carac => $value )
				$this->$carac = $value;
			
		}
		
		// Retourne le code html des caracs de l'objet
		public function htmlDisplayItem(){
			
			$caracs = array ( "Attaque", "Esquive", "Dégâts", "Régénération", "PV", "Vue", "RM", "MM", "Armure", "Temps", "TempsEquipement" );
			$retour = "";	
			
			foreach ( $caracs as $i => $carac ){
				
				$temp = "";
				$r = 1;
				if ( preg_match( "#Temps#", $carac ) )
					$r = -1;
				$caracM = $carac;
				$temp .= $carac ." : ";
				
				if ( preg_match( "#RM|MM#", $carac ) )
					$temp .= $this->addColor($this->$carac."% (Moy)",$r);
				else
					$temp .= $this->addColor($this->$carac,$r);
				
				if ( preg_match( "#Attaque|Dégâts|Armure#", $carac ) ){
					
					$caracM = $carac."M";
					$temp .= "\\\\".$this->addColor($this->$caracM,$r);
					
				}
				
				if ( preg_match( "#Temps|TempsEquipement#", $carac ) )
					$temp .= " min";
				
				if ( $i < count($caracs)-1 )
					$temp .= "<br/>";
				
				if ( $this->$carac != 0 || $this->$caracM != 0 )
					$retour .= $temp;
				
			}
			
			if ( empty($retour) )
				$retour = "Aucune information !";
			
			return $retour;
			
		}
		
		// Applique les caracs de l'objet
		private function applyItem($item){
			
			if ( $item->parentNode->nodeName == "Mithril" && preg_match( "#Mithril#", $this->Nom ) )
				$this->Mithril = 1;
			
			$caracs = explode( " | ", $item->getAttribute("carac") );
			
			foreach ( $caracs as $carac )
				$this->applyCarac($carac);
				
			$this->TempsEquipement = $item->getAttribute("temps");				
			
			// Applique les modifications si l'objet est en mithril
			if ( $this->Mithril ){
				
				$this->TempsEquipement *= 0.5;
				
				if ( preg_match( "#arme#", $item->getAttribute("type") ) && $this->Attaque < 0 ){
					if ( $this->Attaque == -1 )
						$this->Attaque = 0;
					else
						$this->Attaque = intval($this->Attaque*0.5);
				} else if ( $this->Esquive < 0 ) {
					if ( $this->Esquive == -1 )
						$this->Esquive = 0;
					else
						$this->Esquive = intval($this->Esquive*0.5);
					
				}
				
			}
			
			$this->applyTemplates(utf8_encode($this->Nom));
			
			
		}
		
		// Applique les templates
		private function applyTemplates($Nom){
			
			$repeat = 0;
			$xpath = new DOMXPath($this->getDomTemplate());
			$templates = $xpath->query('/Templates/Template[contains("' .$Nom. '",child::text())]');	
			
			foreach ( $templates as $template ){
				
				$this->applyTemplate($template);
				$Nom = trim(preg_replace("#(.+)" .$template->nodeValue. "(.*)#","$1 $2",$Nom));
				$repeat = 1;
				//$this->Nom = str_replace( $template->nodeValue, "<b>".$template->nodeValue."</b>", $Nom );
				
			}
			
			if ( $repeat )
				$this->applyTemplates($Nom);
			
		}
		
		// Applique la carac
		private function applyCarac($carac){
			
			$array = array ( "ATT" => "Attaque", "ESQ" => "Esquive", "DEG" => "Dégâts", "REG" => "Régénération", "TOUR" => "Temps" );
			$carac = explode( " : ", $carac );
			$values = explode ( "\\", $carac[1] );
			$name = strtr( $carac[0], $array );
			$value = $values[0];
			
			// Applique la carac
			$this->$name += $value;
			
			// Applique la carac magique
			if ( isset($values[1]) ){ 
				$valueM = $values[1];
				$nameM = $name."M";
				$this->$nameM += $valueM;
			}
					
		}
		
		// Applique le template
		private function applyTemplate($template){
						
			$caracs = explode( " | ", $template->getAttribute("carac") );
			
			foreach ( $caracs as $carac )
				$this->applyCarac($carac);				
								
		}
		
		// Retourne le dom des items
		private function getDomItem(){
			
			$dom = new DOMDocument( "1.0", "UTF-8" );	
			$dom->preserveWhiteSpace = false;			
			$dom->load("./xml/item.xml");
			
			return $dom;				
			
		}
		
		// Retourne le dom des templates
		private function getDomTemplate(){
			
			$dom = new DOMDocument( "1.0", "UTF-8" );	
			$dom->preserveWhiteSpace = false;			
			$dom->load("./xml/template.xml");
			
			return $dom;				
			
		}
		
		// Ajouter le signe +
		private function addSign($i){
			
			return (intval($i)>0) ? "+".$i : $i;
			
		}	
		
		// Ajoute une couleur selon la valeurs de la chaine
		private function addColor( $s, $r=1 ){
			
			$c = "white";
			if ( intval($s) != 0 )
				$c = ($r*intval($s)>0) ? "green" : "red";
			
			return "<span style=\'color:$c;\'>" .$this->addSign($s). "</span>";
			
		}		
		
		public function getVar($nom){
			
			return $this->$nom;
			
		}			
		
	}

?>