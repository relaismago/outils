<?php

	// Vérifie si le nombre d'appel de script n'a pas été dépassé
	function checkScriptCall($id,$db,$name){
		
		$date_less_24 = date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-1, date("Y")));
		
		// Requête SQL récupérant le nombre d'appel du script $name du troll durant les dernières 24 heures
		$sql = "SELECT COUNT(*) FROM refresh_count";
		$sql .= " WHERE date_refresh >= '$date_less_24'";
		$sql .= " AND id_troll_refresh = '$id'";
		$sql .= " AND categorie_refresh = 'classiques'";
		$sql .= " AND script_name_refresh = '$name';";
		
		$nb = mysql_fetch_array(mysql_query($sql,$db),MYSQL_NUM);
		echo mysql_error();
		
		// Retourne false si l'appel du script a été dépassé
		if ( $nb["0"] >= 1 ){
			echo "<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'><h3>Le script public pour le Troll $id a été utilisé plus de 1 fois en moins de 24 heures.</h3></td></tr>";
			return false;
		}		
		
		return true;
		
	}
	
	// Ajoute à la bdd l'appel du script $name
	function updateScriptCall($id,$db,$name){
		
		$by_me_refresh = ( $id == $_SESSION["AuthTroll"] ) ? "oui" : "non";
		$date=date("Y-m-d H-i-s");		
			
		// Requête SQL ajoutant à la bdd l'appel du script $name
		$sql = "INSERT INTO refresh_count";
		$sql .= " (id_troll_refresh, date_refresh, by_me_refresh, categorie_refresh,script_name_refresh)";
		$sql .= " VALUES ('$id', '$date','$by_me_refresh','classiques','$name');"; 
		
		mysql_query($sql,$db);
		echo mysql_error();	
		
	}

	// Retourne le code HTML des listes d'équipements
	function htmlEquipements($idTroll){
		
		// Tableau contenant les noms d'équipements à afficher
		$equipements = array ( "Casque", "Talisman", "Armure", "Arme_1_main", "Arme_2_mains", "Bouclier", "Bottes" );
		$retour = "";
		
		// Parcours chaque type d'équipement et les affiches
		for ( $i=0; $i<count($equipements); ++$i )
			$retour .= htmlEquipement( $idTroll, $equipements[$i], $i );
		
		return "<table cellpadding='10' cellspacing='0'>" .$retour. "</table>";
		
	}
	
	// Retourne le code HTML de la liste d'équipement
	function htmlEquipement( $idTroll, $type, $flag ){
		
		$retour = "";
		$options = "";
		$equipedCarac = "";
		
		// Création de l'objet DOM et charge le fichier xml du troll
		$dom = getDom();
		$dom->preserveWhiteSpace = false;
		$dom->load("trolls/" .$idTroll. ".xml");	
		
		// Ajoute l'option de l'objet équipé
		foreach ( $dom->getElementsByTagName("Equipements")->item(0)->childNodes as $eq )
			if ( $eq->getAttribute("type") == $type ){
				$options .= htmlOptionEquipements( $idTroll, $eq, $type, "selected" );	
				$equipedCarac .= getItemCarac($eq);
			}
		
		// Charge le fichier xml des objets de tanieres
		$dom->load("tanieres/" .$type. ".xml");	

		// Parcours chaques objets et les ajoutent au select
		foreach ( $dom->getElementsByTagName("Element") as $item )	
			$options .= htmlOptionEquipements( $idTroll, $item, $type );
		
		if ( $flag > 0 )
			$retour .= "<tr><td></td></tr>";		
		$retour .= "<tr height='50px;'>
						<td colspan='2' style='border-top: 1px solid #F9BB2F;border-left: 1px solid #F9BB2F;border-right: 1px solid #F9BB2F;'>".htmlGetFilters( $idTroll, $type )."</td>
					</tr>
					<tr  height='75px;'>
						<td style='border-bottom: 1px solid #F9BB2F;border-left: 1px solid #F9BB2F;'>
							<select class='pmtEquipement' id='$type'  onClick=\"updateTroll($idTroll);\" >
								<option value='0' onMouseOver=\"getItemCarac( $idTroll, 0,'$type');\">" .str_replace( "_", " ", $type ). "</option>
								$options
							</select>
						</td>
						<td width='500px;' style='border-bottom: 1px solid #F9BB2F;border-right: 1px solid #F9BB2F;'>
							<span class='pmtSpan' id='span_$type' style='font-size:15;'>$equipedCarac</span>
						</td>
					</tr>";

		return $retour;
		
	}
	
	// Retourne le code HTML des equipements sous forme d'option
	function htmlOptionEquipements( $idTroll, $item, $type, $flag="" ){
		
		$retour = 	"<option $flag value='" .$item->getAttribute("id"). "' onMouseOver=\"getItemCarac( $idTroll, " .$item->getAttribute("id"). ",'$type');\">" 
						.utf8_decode(stripslashes($item->nodeValue)). 
					"</option>";
					
		return $retour;
					
	}
	
	// Retourne le code HTML des filtres
	function htmlGetFilters( $idTroll, $type ){
		
		$retour = "";
		$nomEq = "";
		$nomTemp = "";
		
		// Récupération de la liste des noms d'objets
		$file = fopen("httpMH/Public_Tresors.txt", "r");
		$noms = trim(stream_get_contents($file));			
		fclose($file);	
		
		// Récupération de la liste des templates
		$file = fopen("httpMH/Public_TresorsMagie.txt", "r");
		$temps = trim(stream_get_contents($file));			
		fclose($file);					
		
		// Parcours les noms d'objets
		foreach ( explode( "\n", $noms ) as $nom ){
			
			$nom = explode ( ";", $nom );
			if ( preg_replace( "#\(|\)#", "", $nom[2] ) == str_replace( "_", " ", $type ) )
				$nomEq .= '<option value="' .$nom[1]. '">' .$nom[1]. "</option>";
			
		}
		
		// Parcours les noms de template
		foreach ( explode( "\n", $temps ) as $temp ){
			
			$temp = explode ( ";", $temp );
			$nomTemp .= '<option value="' .$temp[1]. '">' .$temp[1]. "</option>";
			
		}		
		
		$retour .= "<select id='$type"."_nom' onChange=\"updateSelect( $idTroll, '$type' );\" ><option value=''>Nom</option>$nomEq</select> 
					<select id='$type"."_template' onChange=\"updateSelect( $idTroll, '$type' );\" ><option value=''>Template</option>$nomTemp</select> 
					<label>Mithril </label><input id='$type"."_mithril' onChange=\"updateSelect( $idTroll, '$type' );\" type='checkbox' value='Mithril'/>";			
		
		return $retour;
		
	}
	
	// Retourne les caractéristiques formatées de l'objet
	function getItemCarac($item){
		
		// Tableau contenant la correspondance id <=> Nom Taniere
		$tanieres = array ( "38965" => "La Bïblyohtek", "1646554" => "Le Relais des Abysses", "34111" => "La Taverne" );
	
		return spanColor( "gold", strtr( utf8_decode($item->getAttribute("idTaniere")), $tanieres ) ). " " .spanColor( "silver", "[" .$item->getAttribute("id"). "]" ). " " .utf8_decode(addColors($item->getAttribute("carac")." | ".$item->getAttribute("temps"))). spanColor( "orange", "min" );
		
	}
	
	// Retourne l'objet correspondant à l'id, retourne NULL si rien n'est trouvé
	function getItemById( $items, $id ){
		
		foreach ( $items as $item )
			if ( $item->getAttribute("id") == $id )		
				return $item;	
				
		return NULL;		
		
	}
	
	// Ajoute des couleurs aux caracs
	function addColors($s){
		
		$retour = "";
		
		// Parcours les caracs de l'objet et ajoute les couleurs
		foreach ( explode( " | ", $s ) as $e ){
			
			$e = explode( " : ", $e );
			$retour .= spanColor( "orange", $e[0] ). " : " .addColor($e[1]). " ";
			
		}
		
		return $retour;
		
	}
	
	// Ajoute une couleur selon le type de bonus/malus
	function addColor($s){
		
		// Découpe en BMP/BMM
		$s = explode( "\\", $s );
		
		// Réappel la fonction si il y a des BMP/BMM
		if ( count($s) == 2 )
			return addColor($s[0])."\\".addColor($s[1]);
		
		return (preg_match("#-[0-9]+ min|\+#", $s[0]) && !preg_match("#\+[0-9]+ min#", $s[0])) ? spanColor( "green", $s[0] ) : spanColor( "red", $s[0] );
		
	}

	// Retourne une balise span avec la couleur choisie
	function spanColor( $c, $v ){
		return "<span style='color:$c;'>$v</span>";
	}

	// MaJ des tanières
	function updateTanieres($info){
		
		$a = array(chr(140),chr(156));
		$b = array("Oe","oe");
		
		// Récupération du fichier contenant les objets des tanieres
		$file = fopen("http://sp.mountyhall.com/SP_GrandesTanieres.php?Numero=" .$info["AuthTroll"]. "&Motdepasse=".$info["Auth"], "r");
		$data = str_replace($a,$b,trim(stream_get_contents($file)));		
		fclose($file);			
		
		// Extrait les tanières de $data et supprime la dernière case de $tanières (case vide)
		$tanieres = preg_split( "#\s+\#FIN GrandeTaniere [0-9]+\s*#", preg_replace( "#\#DEBUT GrandeTaniere #", "", $data ) );
		unset($tanieres[count($tanieres)-1]);
	
		// Sépare les éléments ainsi que leurs caractéristiques de chaques tanières
		foreach( $tanieres as $key => $taniere ){
			
			// Chaque ligne de la chaine deviens une case du tableau
			$taniere = preg_split( "#\n#", $taniere );
			
			// La case "taniere" du tableau contient les informations de la tanière, supprime ensuite l'ancienne case tanière
			$idTaniere = explode ( ";", $taniere[0] );
			unset($taniere[0]);
			
			// Découpe la chaine de chaque objets en fonction du charactère ";"
			foreach ( $taniere as $key2 => $element ){
				
				$element = explode( ";", $element );
				$element["idTaniere"] = $idTaniere[0];
				$t[$element[2]][] = $element;
				
			}
		
		}
		
		// Ajoute au dossier les fichiers xml d'objet	
		foreach ( $t as $elements )
			createXml( $elements );
		
	}

	// Créé un fichier xml contenant les objets des tanières
	function createXml( $elements ){

		// Trie les objets par nom
		usort( $elements, "sortByName" );
		
		// Création du fichier xml
		$dom = getDom();
		
		// Ajout de l'élément root
		$root = $dom->createElement("Elements");
		$dom->appendChild($root);		
		
		// Ajoute tous les objets
		foreach ( $elements as $element )
			addItem( $element, $dom );		
				
		// Sauvegarde le fichier xml en conservant l'indentation		
		$dom->formatOutput = true;
		$dom->save("tanieres/".removeInvalidChar($elements[0][2]). ".xml");		
		
	}

	// Ajoute un objet à une tanière
	function addItem( $element, $dom ){
		
		// Ajout de l'objet au fichier xml
		$item = $dom->createElement( "Element", removeHtmlChar($element[4]." ".$element[5]) );
		$item->setAttribute( "idTaniere", removeHtmlChar($element["idTaniere"]) );
		$item->setAttribute( "id", removeHtmlChar($element[0]) );
		$item->setAttribute( "type", removeHtmlChar(removeInvalidChar($element[2])) );
		$item->setAttribute( "temps", "Poids : ".removeHtmlChar($element[7]) );
		$item->setAttribute( "carac", removeHtmlChar($element[6]) );
		$dom->documentElement->appendChild($item);
		
	}	

	// Retourne l'objet DOM
	function getDom(){
		
		$dom = new DOMDocument( "1.0", "UTF-8" );	
        $dom->preserveWhiteSpace = false;		
		
		return $dom;		
		
	}

	// Trie le tableau en fonction du nom
	function sortByName($a,$b){
		return strcmp( $a[4].$a[5], $b[4].$b[5] );
	}

	// Remplace les " " en "_" et supprime les ()
	function removeInvalidChar($s){
		return str_replace( " ", "_", preg_replace( "#\(|\)#", "", $s ) );
	}

	// Supprime les balise BBCode, remplace les charactères spéciaux
	function removeHtmlChar($s){
		return htmlspecialchars( preg_replace( "#<.>(.*)</.>#", "$1", utf8_encode(trim($s))), ENT_NOQUOTES );
	}

?>