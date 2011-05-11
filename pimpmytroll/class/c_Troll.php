<?php

	class c_Troll {
		
		private $Id;
		private $Nom;
		private $Attaque;
		private $AttaqueBMP;
		private $AttaqueBMM;
		private $Esquive;		
		private $EsquiveBMP;
		private $EsquiveBMM;
		private $D�g�ts;
		private $D�g�tsBMP;
		private $D�g�tsBMM;		
		private $R�g�n�ration;
		private $R�g�n�rationBMP;
		private $R�g�n�rationBMM;	
		private $PVMax;
		private $PVMaxBMP;	
		private $PVMaxBMM;		
		private $Vue;
		private $VueBMP;
		private $VueBMM;	
		private $RM;
		private $RMBMP;
		private $RMBMM;	
		private $MM;
		private $MMBMP;		
		private $MMBMM;			
		private $Armure;						
		private $ArmureBMP;
		private $ArmureBMM;
		private $Temps;
		private $TempsBMM;
		private $TempsEquipement;	
		private $Equipement;		
		
		// Constructeur
		function c_Troll( $Id, $Nom="" ){
			
			// Initialise tous les attributs � 0
			foreach ( $this as $name => $value )
				$this->$name = 0;
				
			$this->Id  = $Id;	
			$this->Nom = $Nom;
			$this->Equipement = array();
			
		}
		
		// Applique l'objet sur le troll
		function applyItem( $carac ){
			
			// Tableau contenant la correspondance Nom Carac <=> Nom Attribut
			$a = array ( "ATT" => "AttaqueBMP", "ESQ" => "EsquiveBMP", "DEG" => "D�g�tsBMP", "REG" => "R�g�n�rationBMP", "Armure" => "ArmureBMP", "TOUR" => "TempsBMM", "Poids" => "TempsEquipement", "PV" => "PVMaxBMM", "Vue" => "VueBMM" );
			
			// Parcours chaque carac de l'objet
			foreach ( explode( " | ", strtr( $carac, $a ) ) as $key => $carac ){
				
				// S�paration Nom Carac <=> Bonus
				$carac = explode( " : ", $carac );
				
				// Applique le bonus/malus s'il n'augmente pas une comp�tence/sortil�ge
				if ( !preg_match( "#Connaissance#", $carac[0] ) )
					switch ($carac[0]){
						
						// Applique sous forme de % si le type est RM/MM
						case "RM" :
						case "MM" :
							$name = $carac[0]."BMM";
							$name2 = $carac[0]."BMP";							
							$this->$name = $this->addSign(intval($this->$name+intval($carac[1])*$this->$name2/100));
							break;
						default :
							// S�paration BMP/BMM et applique le BMP
							$carac[1] = explode( "\\", $carac[1] );
							$this->$carac[0] = $this->addSign($this->$carac[0]+$carac[1][0]);
							// Applique le BMM s'il existe
							if ( isset($carac[1][1]) ){			
								$n = str_replace( "BMP", "BMM", $carac[0] );
								$this->$n = $this->addSign($this->$n+$carac[1][1]);
								
							}
							break;
							
					}
			
			}
			
			// Mets � jour les attributs du Troll
			$this->updateTrollVar();				
			
		}
		
		// Mets � jour le Troll
		function updateTroll($info){		
			
			// R�cup�ration des caract�ristiques du Troll
			$file = fopen("http://sp.mountyhall.com/SP_Caract.php?Numero=" .$info["AuthTroll"]. "&Motdepasse=".$info["Auth"],"r");
			$carac = trim(stream_get_contents($file));
			fclose($file);	
			
			// R�cup�ration des mouches du Troll
			$file = fopen("http://sp.mountyhall.com/SP_Mouche.php?Numero=" .$info["AuthTroll"]. "&Motdepasse=".$info["Auth"],"r");
			$mouche = trim(stream_get_contents($file));
			fclose($file);		
			
			// R�cup�ration de l'�quipement du Troll
			$file = fopen("http://sp.mountyhall.com/SP_Equipement.php?Numero=" .$info["AuthTroll"]. "&Motdepasse=".$info["Auth"]. "&Split=1", "r");
			$eqs = trim(stream_get_contents($file));			
			fclose($file);	
		
			// Tableau contenant l'�quipement
			foreach ( preg_split( "#\n#", $eqs ) as $eq ){
				
				$eq = explode ( ";", $eq );
				if ( $eq[1] > 0 )
					$this->Equipement[] = $eq;
				
			}									
			
			// Tableau contenant les caracs du Troll
			$caracs = explode( "\n", $carac );
			foreach ( $caracs as $key => $carac )
				$caracs[$key] = explode( ";", $carac );
				
			// Tableau contenant la correspondance Nom Mouch <=> Nom Var	
			$a = array ( "Crobate" => "AttaqueBMM", "Lunettes" => "VueBMM", "Miel" => "R�g�n�rationBMM", "Nabolisants" => "D�g�tsBMM", "Rivatant" => "TempsBMM", "Telaite" => "PVMaxBMM", "Vertie" => "EsquiveBMP", "Xidant" => "ArmureBMM" );
			// Parcours toutes les mouches et applique leurs bonus
			foreach ( explode( "\n", $mouche ) as $key => $mouche ){
				
				$mouche = explode( ";", $mouche );
				if ( $mouche[4] == "LA" ){
					
					$name = strtr( $mouche[2], $a );
					switch ($name){
						
						case "Carnation" :
						case "H�ros":
							break;
						case "PVMaxBMM" :
							$arrayMouches[$name] = (isset($arrayMouches[$name])) ? $arrayMouches[$name]+5 : 5;
							break;
						case "TempsBMM" :
							$arrayMouches[$name] = (isset($arrayMouches[$name])) ? $arrayMouches[$name]-20 : -20;
							break;
						default :
							$arrayMouches[$name] = (isset($arrayMouches[$name])) ? ++$arrayMouches[$name] : 1;
						
					}
					
				}
				
			}
			 
			// Affectation des valeurs
			$this->Attaque = $caracs[2][1];
			$this->Esquive = $caracs[2][2];		
			$this->D�g�ts = $caracs[2][3];
			$this->R�g�n�ration = $caracs[2][4];
			$this->PVMaxBMP = $caracs[2][5];
			$this->VueBMP = $caracs[2][7];
			$this->RMBMP = $caracs[2][8];
			$this->MMBMP = $caracs[2][9];		
			$this->Temps = $caracs[2][11];	
			
			// Application des bonus des mouches			
			foreach ( $arrayMouches as $carac => $value )
				$this->$carac = $this->addSign($value);	
				
			// Mets � jours les attributs du Troll
			$this->updateTrollVar();
									
		}
		
		// Mets � jour les attributs du Troll
		private function updateTrollVar(){
				
			$this->Vue = $this->VueBMP+$this->VueBMM;		
			$this->PVMax = $this->PVMaxBMP+$this->PVMaxBMM;					
			$this->Armure = $this->ArmureBMP+$this->ArmureBMM;	
			$this->RM = $this->RMBMP+$this->RMBMM;
			$this->MM = $this->MMBMP+$this->MMBMM;				
			
		}
		
		// Mets � jour le temps du Troll
		function updateTrollTime(){
			
			if ( $this->TempsEquipement+$this->TempsBMM > 0 )
				$this->Temps += $this->TempsEquipement+$this->TempsBMM;				
			
		}
		
		// Sauvegarde le troll dans un fichier xml
		function saveTroll(){
			
			// Cr�ation du fichier xml
			$dom = new DOMDocument( "1.0", "UTF-8" );	
			
			// Ajout de l'�l�ment root ( Troll )
			$root = $dom->createElement("Troll");
			$dom->appendChild($root);		
			
			// Ajoute les caracs/equipement du troll
			foreach ( $this as $name => $value ){
				
				if ( is_array($value) ){
					
					$equipements = $dom->createElement("Equipements");
					// Ajoute l'equipement
					foreach ( $value as $equipement ){
						
						$item = $dom->createElement( "Equipement", $this->removeHtmlChar($equipement[4]." ".$equipement[5]) );	
						$item->setAttribute( "idTaniere", $this->removeHtmlChar("Objet Equip�") );
						$item->setAttribute( "id", $this->removeHtmlChar($equipement[0]) );
						$item->setAttribute( "type", $this->removeHtmlChar($this->removeInvalidChar($equipement[2])) );
						$item->setAttribute( "temps", $this->removeHtmlChar("Poids : ".$equipement[7]) );
						$item->setAttribute( "carac", $this->removeHtmlChar($equipement[6]) );											
						$equipements->appendChild($item);
						
					}
					$dom->documentElement->appendChild($equipements);						
					
				} else {
					
					// Ajoute les caracs
					$item = $dom->createElement( "Element", $this->removeHtmlChar($name) );
					$item->setAttribute( "value", $this->removeHtmlChar($value) );
					$dom->documentElement->appendChild($item);	
							
				}
				
			}
					
			// Sauvegarde le fichier xml en conservant l'indentation		
			$dom->formatOutput = true;
			$dom->save("trolls/" .$this->Id. ".xml");				
			
		}
		
		// R�cup�re le troll � partir d'un fichier xml
		function getTroll(){
			          
			// Si le fichier xml existe les caracs du troll sont r�cup�r�e		  
            if ( is_file("trolls/" .$this->Id. ".xml") ) {
            		
				// Cr�ation du fichier dom et r�cup�ration du fichier xml du troll	
				$dom = $this->getDom();	
					
				// R�cup�ration des caract�ristiques	
				foreach ( $dom->getElementsByTagName("Element") as $element )	
					$carac[utf8_decode($element->nodeValue)] = $element->getAttribute("value");
					
				// Mets � jour l'objet Troll		
				foreach ( $carac as $name => $value )
					$this->$name = $value;	
					
			} else
				echo "Erreur ! Pas de fichier pour le troll ! Tu dois d'abord le mettre � jour !";
			
		}
		
		// L'�quipement port� par le troll est appliqu�
		function applyEquipement(){
		
			// Cr�ation du fichier dom et r�cup�ration du fichier xml du troll	
			$dom = $this->getDom();		
		
			// Parcours l'�quipements �quip�s et applique les bonus/malus
			foreach ( $dom->getElementsByTagName("Equipements")->item(0)->childNodes as $equipement )
				if ( $equipement->getAttribute("type") != "Arme_2_mains" )
					$this->applyItem($equipement->getAttribute("carac")." | ".$equipement->getAttribute("temps"));
					
			// Mets � jour le temps		
			$this->updateTrollTime();	
				
		}
		
		// Ajouter le signe +
		public function addSign($i){
			
			return ($i>0) ? "+".$i : $i;
			
		}			
		
		// Retourne le DOM du Troll
		private function getDom(){
		
			$dom = new DOMDocument( "1.0", "UTF-8" );	
			$dom->preserveWhiteSpace = false;					
			$dom->load("trolls/" .$this->Id. ".xml");	

			return $dom;
		
		}
		
		// Getter
		function getVar($name){
			return $this->$name;
		}
		
		// Remplace les "_" en " " et supprime les ()
		private function removeInvalidChar($s){
			return str_replace( " ", "_", preg_replace( "#\(|\)#", "", $s ) );
		}
	
		// Supprime les balise BBCode, remplace les charact�res sp�ciaux
		private function removeHtmlChar($s){
			return htmlspecialchars( utf8_encode(preg_replace( "#<.>(.*)</.>#", "$1", trim($s) )), ENT_NOQUOTES, "UTF-8");
		}	
		
	}

?>