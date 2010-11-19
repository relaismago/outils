<?php

	// Vérifie si le nombre d'appel de script n'a pas été dépassé
	function checkScriptCall($id,$db){
		
		$date_less_24 = date("Y-m-d H-i-s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")-1, date("Y")));
		
		// Requête SQL récupérant le nombre d'appel du script SP_Vue2 du troll durant les dernières 24 heures
		$sql = "SELECT COUNT(*) FROM refresh_count";
		$sql .= " WHERE date_refresh >= '$date_less_24'";
		$sql .= " AND id_troll_refresh = '$id'";
		$sql .= " AND categorie_refresh = 'classiques'";
		$sql .= " AND script_name_refresh = 'SP_Vue2';";
		
		$nb = mysql_fetch_array(mysql_query($sql,$db),MYSQL_NUM);
		echo mysql_error();
		
		// Retourne false si l'appel du script a été dépassé
		if ( $nb["0"] >= NB_REFRESH_VUE_2D_BY_TROLL ){
			echo "<tr class='mh_tdtitre' align='center'><td class='mh_tdpage'><h3>Le script public pour le Troll " .$id. " a été utilisé plus de ".NB_REFRESH_VUE_2D_BY_TROLL." fois en moins de 24 heures.</h3></td></tr>";
			return false;
		}		
		
		return true;
		
	}
	
	// Ajoute à la bdd l'appel du script SP_Vue2
	function updateScriptCall($id,$db){
		
		$by_me_refresh = ( $id == $_SESSION["AuthTroll"] ) ? "oui" : "non";
		$date=date("Y-m-d H-i-s");		
			
		// Requête SQL ajoutant à la bdd l'appel du script SP_Vue2
		$sql = "INSERT INTO refresh_count";
		$sql .= " (id_troll_refresh, date_refresh, by_me_refresh, categorie_refresh,script_name_refresh)";
		$sql .= " VALUES ('$id', '$date','$by_me_refresh','classiques','SP_Vue2');"; 
		
		mysql_query($sql,$db);
		echo mysql_error();	
		
	}

	// Retourne le code html de la recherche
	function htmlDisplaySpots($data){
		
		$retour = "";

		$retour .= stripslashes(htmlGetSpots($data));
		$retour .= '<form action="save.php" method="post">
				<input name="save" type="hidden" value="' .stripslashes(htmlentities(htmlGetSpots($data),ENT_QUOTES)). '"/>
				<input name="troll" type="hidden" value="' .$data["name"]. '"/>
				<input type="submit" value="Inscrire sur un parcho ce résultat !"/>
			  </form>';				
		
		return $retour;
		
	}

	// Retourne le code html des spots
	function htmlGetSpots($data){
		
		$retour = "";
		
		$spots = getSpots($data);
		$j = 1;
		
		// Parcours les spots
		foreach($spots as $spot){
			
			$td_monstres = "";
			$i = 0;
			$level = 0;
			
			// Parcours le spot
			foreach($spot as $monstre){
				
				if( count($monstre) != 1 ){		
					$a = explode(" [",$monstre["name"]);
					$name = trim($a[0]);
					$age = trim(str_replace("]","",$a[1]));
					$td_monstres .= '<tr><td>' .$monstre["level"]. '</td>';
					$level += $monstre["level"];					
					$td_monstres .= '<td><a href="" onClick="window.open(\'http://games.mountyhall.com/mountyhall/View/MonsterView.php?ai_IDPJ=' .$monstre["id"]. '\',\'_blank\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=1, resizable=1, copyhistory=0, menuBar=0, width=766, height=636\');return(false);">' .$monstre["id"]. '</a></td>';
					$td_monstres .= '<td><a href="http://outilsrm.cat-the-psion.net/bestiaire2/bestiaire.php?Monstre=' .$name. '&Age=' .$age. '&MH=' .$monstre["id"]. '" target="_blank">' .$monstre["name"]. '</a></td>';
					$td_monstres .= '<td><a href="http://outilsrm.cat-the-psion.net/cockpit.php?cX=' .$monstre["X"]. '&cY=' .$monstre["Y"]. '&cZ=' .$monstre["N"]. '" target="_blank">' .$monstre["X"] ." ". $monstre["Y"] ." ". $monstre["N"]. "</a></td></tr>";
					++$i;
					
				}
				
			}

			// Affiche le spot si il correspond aux critères de recherche
			if ( intval($data["number"]) <= $i && intval($data["level"]) <= intval($level/$i) )
				$retour .= '<table class="mh_tdtitre" border="1" align="center" cellpadding="5"><tr bgcolor="' .getColor($i). '"><th>Niv. Moyen : ' .intval($level/$i). '</th><th colspan="3">Spot numéro : ' .$j. '</th></tr>' .$td_monstres. '</table><br/>';							
			
			++$j;
			
		}
		
		return $retour;
		
	}
	
	// Retourne une couleur en fonction du nombre de monstres
	function getColor($i){
		
		switch ($i){
			
			case 2 :
				return "#01E5FE";
			case 3 :
				return "#014DFE";
			case 4 :
				return "#2B01FE";
			case 5 :
				return "#FE9001";
			default :
				return "#FE0101";
			
		}
		
	}
	
	// Retourne un tableau contenant les spots
	function getSpots($data){
		
		$retour = array();
		
		$monsters = getMonsters($data["view"]);	
			
		$range = intval($data["range"]);
		$i = 0;
		$j = 1;
		
		// Effectue le groupement de monstres en spot
		while(count($monsters) > 0){
			while(isset($monsters[$j])){
				if ( $monsters[$j]["X"]-$range <= $monsters["0"]["X"] && $monsters["0"]["X"] <= $monsters[$j]["X"]+$range && $monsters[$j]["Y"]-$range <= $monsters["0"]["Y"] && $monsters["0"]["Y"] <= $monsters[$j]["Y"]+$range && $monsters["0"]["N"] == $monsters[$j]["N"] ){
					$retour[$i]["N"] = $monsters["0"]["N"];
					$retour[$i]["0"] = $monsters["0"];
					$retour[$i][] = $monsters[$j];
					unset($monsters[$j]);
				}
				++$j;
			}
			unset($monsters["0"]);
			$monsters = array_values($monsters);
			++$i;
			$j = 1;
		}

		// trie le tableau du plus petit N au plus grand N
		usort($retour,"sortByLevel");
		
		return $retour;
		
	}	
	
	// Retourne un tableau contenant tous les monstres de la vue ( sans les gowaps )
	function getMonsters($view){
		
		$retour = array();
		
		// extrait les monstres de la vue
		$s = preg_replace("#.*DEBUT MONSTRES#s","$1",$view);
		$s = trim(preg_replace("#\#FIN MONSTRES.*#s","",$s));		
		
		$monsters = explode("\n",$s);
		
		// supprime les gowaps et parse sous forme de tableau les monstres
		foreach( $monsters as $monster )
			if ( !preg_match("#.*Gowap.*#",$monster) )
				$retour[] = parseMonsters(explode(";",$monster));			
				
		return $retour;
		
	}
	
	// Retourne un tableau contenant toutes les informations du monstre
	function parseMonsters( $array ){
		
		$retour = "";
		
		$retour["id"] = trim($array[0]);
		$retour["name"] = trim($array[1]);
		$retour["X"] = trim($array[2]);
		$retour["Y"] = trim($array[3]);
		$retour["N"] = trim($array[4]);	
		$monstre = getInfoFromMonstre($retour["name"]);
		$retour["level"] = estimeNivMonstre($monstre["race"],$monstre["id_template"],$monstre["id_age"]);
		
		return $retour;
		
	}
	
	// Trie le tableau en fonction du niveau ( N )
	function sortByLevel($a,$b){
	
		if ($a["N"] == $b["N"])
			return 0;

		return ($a["N"] > $b["N"]) ? -1 : 1;
		
	}
	
	// Retourne un tableau contenant les archives
	function getArchive($folder){
		
		$retour = array();

		$dossier = opendir($folder);
		
		while ($file = readdir($dossier))
			if ($file != "." && $file != "..")
				$retour[] = $file;
				
		closedir($dossier);				
		
		return $retour;
		
	}

?>