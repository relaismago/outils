<?php

	// Retourne le texte d'un event
	function getEventText( $type, $nom, $texte ){
		
		$retour = "";
		
		switch( $nom ){
		
			case "Accel" :
				$retour = preg_replace( "#.*sacrifié ?(\d+) ?PV.*gagner ?(\d+) ?minutes.*#s", "-$1 PV -$2 min", $texte );	
				break;		
			
			case "Armure Ethérée" :
				$retour = preg_replace( "#.*(Armure : \+\d+).*#s", "$1", $texte );
				break;						
			
			case "AA" :
			case "CdM" :
				$retour = preg_replace( "#.*:(\d+ %).*#s", "$1", $texte );	
				break;
				
			case "Bidouille" :
				$retour = preg_replace( "#.*\[Bidouille\] (.+)#s", "$1", $texte );	
				break;					
				
			case "Camouflage" :	
				$retour = "Réussi";
				break;				
				
			case "Glue" :	
				$retour = (preg_match( "#La Cible subit donc pleinement l'effet du sortilège#",  $texte)) ? "Glué" : "Résisté";
				break;								
	
			case "IdT" :	
				$retour = (preg_match( "#\(Spécial\)#", $texte )) ? "Spécial" : preg_replace( "#.*\d+ - (.+) \(.+\).*#s", "$1", $texte );
				break;		
				
			case "Insulte" :
				$retour = (preg_match( "#Elle vous prendra dorénavant comme adversaire privilégié#", $texte )) ? "Insulté" : "Résisté";
				break;													
				
			case "Parer" :
				$retour = "Succès";
				break;	
	
			case "Piège" :
				$retour = preg_replace( "#.*en X = (-?\d+) \| Y = (-?\d+) \| N = (-?\d+).*#s", "X:$1 Y:$2 N:$3", $texte );	
				break;		
				
			case "Pistage" :
				$retour = preg_replace( "#.*n°(\d+).*#s", "$1", $texte );	
				break;	
				
			case "POUVOIR" :
				$retour = "Pouvoir";
				break;					
				
			case "RA" :	
				$retour = preg_replace( "#.*gagner (\d+).*#s", "+$1 PV", $texte );	
				break;										
					
			case "RP" :	
				$retour = getDamage($texte);	
				if( $ggc_info["type"] != "MORT" )		
					$retour .= preg_replace("#.*un malus de (\d+) points.*#",", -$1 REG",$texte);						
				break;						
				
			case "Sacro" :	
				$retour = preg_replace( "#.*de (\d+) Points de Vie.*perdu (\d+) Points de Vie.*#s", "+$1 PV -$2 PV", $texte );
				break;																
				
			case "TP" :	
				$retour = preg_replace( "#.*Il conduit en : X = (-?\d+) \| Y = (-?\d+) \| N = (-?\d+).*#s", "X:$1 Y:$2 N:$3", $texte );	
				break;									
				
			case "VA" :
				$retour = preg_replace( "#.*suivant : (Vue : \+\d+).*#s", "$1", $texte );	
				break;		
			
			case "VL" :
				$retour = preg_replace( "#.*Zone centrale ciblée : X = (.\d+) \| Y = (.\d+) \| N = (.\d+).*#s", "X:$1 Y:$2 N:$3", $texte );	
				break;
							
			case "Attaque Précise" :				
			case "BS" :						
			case "COMBAT" :								
			case "CdB" :
			case "Charger" :
			case "Frénésie" :
			case "GdS" :					
			case "MORT" :					
			case "Projo" :				
			case "Vampi" :
				$retour = getDamage($texte). ", " .getEsquive($texte);
				if ( $type != "MORT" && $nom == "GdS" )
					$retour .= preg_replace( "#.*de (\d+) PV.*#", ", -$1/TOUR", $texte );
				break;			
				
		}
		
		if ( $type == "MORT" && $nom != "MORT" ){
			if ( preg_match( "#massacré#", $texte ) )
				$retour = "Massacre !";
			else
				$retour = preg_replace( "#.* ((\d+|aucun) PX).*#", "$1", $texte );		
		}
		
		if ( $type == "POUVOIR" )
			$retour = (preg_match("#REDUIT#",$texte)) ? "REDUIT" : "FULL";
		
		return addslashes($retour);
		
	}

	// Retourne les Vtt des trolls dans un tableau ayant comme clée leurs Id
	function getVttTrolls( $arrayIds, $db_vue_rm ){

		$arrayTrolls = array();

		$sql ="SELECT *,";
		$sql .= " DATE_FORMAT(DateMaj, '%d-%m-%Y') as date_maj, race_troll, niveau_troll, HOUR(TIMEDIFF(NOW(),DateMaj)) as Peremption";
		$sql .= " FROM vtt,trolls";
		$sql .= " WHERE id_troll = No";
		$sql .= " AND No IN (".implode(",",$arrayIds).");";

		$trolls = mysql_query($sql,$db_vue_rm);
		if ( mysql_error() )
			echo "alert('".mysql_error()."');";		
    	if ( mysql_num_rows($trolls) > 0 ) 
			while ( $troll = mysql_fetch_assoc($trolls) )
				$arrayTrolls[$troll["id_troll"]] = $troll;
				
		return $arrayTrolls;
		
	}

	// Retourne les Carac des trolls hors de la guilde dans un tableau ayant comme clée leurs Id
	function getAnaTrolls( $arrayIds, $db_vue_rm ){

		$arrayTrolls = array();

		$sql = "SELECT id_troll_anatomique, pv_anatomique, esq_anatomique, att_anatomique, deg_anatomique, reg_anatomique, vue_anatomique, arm_anatomique, DATE_FORMAT(date_anatomique, '%d-%m-%Y') as date_anatomique, source_anatomique FROM anatomiques a, trolls t WHERE a.id_troll_anatomique = t.id_troll AND t.guilde_troll != 450 AND a.id_troll_anatomique IN (".implode(",",$arrayIds).");";

		$trolls = mysql_query($sql,$db_vue_rm);
		if ( mysql_error() )
			echo "alert('".mysql_error()."');";		
    	if ( mysql_num_rows($trolls) > 0 ) 
			while ( $troll = mysql_fetch_assoc($trolls) )
				$arrayTrolls[$troll["id_troll_anatomique"]] = $troll;
				
		return $arrayTrolls;
		
	}

	// Retourne les Gowaps de la guilde dans un tableau ayant comme clée leurs Id
	function getGuildGowap( $arrayIds, $db_vue_rm ){
		
		$arrayGowaps = array();
		
		$sql = " SELECT id_gowap,nom_troll";
		$sql .= " FROM gowaps, trolls";
		$sql .= " WHERE id_troll_gowap = id_troll";
		$sql .= " AND id_gowap IN (".implode(',',$arrayIds).");";
		
		$gowaps = mysql_query($sql,$db_vue_rm);
		if ( mysql_error() )
			echo "alert('".mysql_error()."');";		
    	if ( mysql_num_rows($gowaps) > 0 ) 
			while ( $gowap = mysql_fetch_assoc($gowaps) )
				$arrayGowaps[$gowap["id_gowap"]] = $gowap;
	
		return $arrayGowaps;	
		
	}
	
	// Retourne les trésors identifiés au sol
	function getTreasures( $treasureIds, $db_vue_rm ){
		
		$arrayIdT = array();
		
		$sql = "SELECT * FROM ggc_tresor WHERE id_tresor IN (" .implode(",",$treasureIds). ");";
		$treasures = mysql_query($sql,$db_vue_rm);
    	if ( mysql_error() )
			echo "alert('".mysql_error()."');";		
    	if ( mysql_num_rows($treasures) > 0 ) 			
			while ( $treasure = mysql_fetch_assoc($treasures) )
				$arrayIdT[$treasure["id_tresor"]] = $treasure;
			
		return $arrayIdT; 			
		
	}

	// Retourne les infos VTT du Troll
	function getVttTroll( $id, $db_vue_rm ){
		
		$sql = "SELECT Race, Comps, VUE, VUEB, REG, PV_ACTUELS, Sorts FROM vtt WHERE vtt.No = '$id';";
		$result = mysql_query($sql,$db_vue_rm);
		if ( mysql_error() )
			echo "alert('".mysql_error()."');";
		if ( mysql_num_rows($result) ) 
			return mysql_fetch_assoc($result);		
		
	}

	// Retourne le portee d'une charge ou d'un PM
	function getPortee($value){
		return ceil( ( sqrt( 19 + 8 * ($value + 3) ) - 7) / 2 );
	}
	
	// Ajoute les icones 
	function addIcon( $vtt, $dist, $degm ){
		
		$retour = "";	
		$url = "http://".$_SERVER['SERVER_NAME']."/images/firemago";		
		
		if ( preg_match( "#.*Lancer de Potions.*#", $vtt["Comps"] ) )	
			$porteeLancer = 2 + ( $vtt["VUE"]+$vtt["VUEB"] ) / 5;
		if ( preg_match( "#.*Charger.*#", $vtt["Comps"] ) )	
			$porteeCharge = min( getPortee( $vtt["PV_ACTUELS"]/10+$vtt["REG"] ), $vtt["VUE"]+$vtt["VUEB"] );
		if ( $vtt["Race"] == "Tomawak" )
			$porteePM = getPortee( $vtt["VUE"]+$vtt["VUEB"] );		
		
		if ( isset($porteeLancer) && $porteeLancer >= $dist )
			$retour .= " <img align='ABSMIDDLE' title='Lancer de Potions possible !' src='$url/lancer.png'/>";					
		if ( isset($porteeCharge) && $porteeCharge >= $dist && $dist != 0 )
			$retour .= " <img align='ABSMIDDLE' title='Charge possible !' src='$url/charge.png'/>";					
		if ( isset($porteePM) && $porteePM >= $dist )
			$retour .= " <img align='ABSMIDDLE' title='Dégats -> " .intval($degm+(abs($dist-$porteePM)+floor($vtt["VUE"]/2))*2). "/" .intval($degm+(abs($dist-$porteePM)+floor($vtt["VUE"]/2)+floor($vtt["VUE"]/4))*2). "' src='$url/projo.png'/>";					
		
		return addslashes($retour);
		
	}
	
	// Ajoute les icones d'EM
	function addEMIcon($nom){
		
		GLOBAL $db_vue_rm;
		$url = "http://".$_SERVER['SERVER_NAME']."/images/firemago";			
		$retour = "";	
	
		if ( $sort = getCompoFixe($nom) )
			$retour .= " <img align='ABSMIDDLE' title='Composant fixe " .$sort. "' src='$url/emFixe.png'/>";
		
		if ( $mundidey = getCompoVar($nom) )
			$retour .= " <img align='ABSMIDDLE' title='Composant Variable Mundidey " .$mundidey. "' src='$url/emV.png'/>";		
		
		if ( $compotroll = getCompoTrollByMonstre($nom) )
			$retour .= " <img align='ABSMIDDLE' title=\"Compotroll du Troll " .utf8_decode($compotroll->getAttribute("troll")). "\" src='$url/emCT.png'/>";									
		
		return addslashes($retour);
		
	}	
	
	function addVLC(){
		$url = "http://".$_SERVER['SERVER_NAME']."/images/firemago";			
		$retour = "<img align='ABSMIDDLE' title='Voit le caché' src='$url/vlc.png'/>";
		return addslashes($retour);
	}
	
	// Ajoute le monstre au Cr
	function addMonsterInCr( $name, $id, $carac, $insulte = 0 ){
		
		$retour = "";		
		
		$retour .= "crMonster = '';";
		$retour .= "$('>td',anchorRow).each(function(index) {
				crMonster += $(this).text()+' ';
	  		});";
		$retour .= "crMonster += '" .parseCr( $carac, $insulte ). "';";	
		$retour .= "$('#cr').append(crMonster+'\\n');";		
		
		return $retour;
		
	}
	
	// Parse la chaine en Cr
	function parseCr( $string, $insulte = 0){
		
		$retour = "";
		
		$array = explode( ";", $string );
		
		$retour .= "Niveau : $array[1]\\nPoints de Vie : $array[2]\\nBlessure : $array[3]\\nDés d\'Attaque : $array[4]\\nDés d\'Esquive : $array[5]\\nDés de Dégat : $array[6]\\nDés de Régénération : $array[7]\\nArmure : $array[8]\\nVue : $array[9]\\nMaitrise Magique : $array[10]\\nRésistance Magique : $array[11]\\nNombre d\'attaques : $array[12]\\nVitesse de Déplacement : $array[13]\\nVoir le Caché : $array[14]\\nAttaque à distance : $array[15]\\nDurée DLA : $array[16]";
		
		if ( $array[20] != "" )
			$retour .= "\\nDLA : " . $array[20];
		if ( $array[21] != "" )
			$retour .= "\\nChargement : " . $array[21];
		if ( $array[22] != "" )
			$retour .= "\\nB M : " . $array[22];
		if ( $array[17] != "" ){
			$retour .= "\\nCapacité : " . $array[17] . " affecte " . $array[18];
			if ( $array[19] != 0 )
				$retour .= "\\nPortée : " . $array[19];
		}	
		
		if ( $insulte )
			$array[3] = $array[3]." [color=red]insulté par ".$insulte."[/color]";
		
		return " =>  $array[3]\\n[spoiler=$array[0]]".$retour."[/spoiler]";
		
	}
	
	// Retourne les dégats de l'attaque
	function getDamage($string){
		
		// Dégats reçus/infligés avec armure
		if ( preg_match( "#.+que \d+ points de vie.+#i", $string ) )
			return preg_replace( "#.+que (\d+) points de vie.+#i", "-$1 PV", $string );

		// Dégats reçus/infligés sans armure		
		if ( preg_match( "#.+infligé \d+ points de dégâts.+#i", $string ) )
			return preg_replace( "#.+infligé (\d+) points de dégâts.+#i", "-$1 PV", $string );			
		
		return 0;
		
	}
	
	// Retourne l'esquive de la cible
	function getEsquive($string){
		
		// Esquive de la cible
		if ( preg_match( "#.+adversaire est de\.+: \d+.+#i", $string ) )
			return preg_replace( "#.+adversaire est de\.+: (\d+).+#i", "$1 ESQ", $string );
		
		// Esquive sur le troll
		if ( preg_match( "#.+esquive est de\.+: \d+.+#i", $string ) )
			return preg_replace( "#.+esquive est de\.+: (\d+).+#i", "$1 ESQ", $string );	
			
		return 0;		
		
	}

	// Carac pour l'estimation de carac des monstres
	function getCaracPrimCdM( $stat, $tab_cdm_mh, $caracs_moyennes ){
		
		switch ( $stat ){
			
			case 'att' :
			case 'esq' :
				$de = "D6";
				break;
			case 'deg' :
			case 'reg' :
				$de = "D3";
				break;
			default :
				$de = "";
				
		}
		
		$statmax = $stat."max_cdm";
		$statmin = $stat."min_cdm";	
		
		if ( $tab_cdm_mh[$statmax] != 99 )
			$retour = "entre ". $tab_cdm_mh[$statmin]. " et " . $tab_cdm_mh[$statmax]. " --> <b>" . ($tab_cdm_mh[$statmin]+$tab_cdm_mh[$statmax])/2 . " </b>$de";
		else
			$retour = "> à  ".$tab_cdm_mh[$statmin]." (bestiaire : ".$caracs_moyennes[$stat].")";	
		
		return $retour;
		
	}
	
	// Carac pour l'estimation de carac des monstres
	function getCaracSeconCdM( $stat, $tab_cdm_mh, $caracs_moyennes ){
		
		$statmax = $stat."max_cdm";
		$statmin = $stat."min_cdm";		
		$retour = "";
		if ( $tab_cdm_mh[$statmax] != 99999 )
			$retour = "entre ". $tab_cdm_mh[$statmin]. " et " . $tab_cdm_mh[$statmax]. " --> <b>" .($tab_cdm_mh[$statmin]+$tab_cdm_mh[$statmax])/2 . " </b>";
		else
		{
			if ( $tab_cdm_mh[$statmin] != 0)
				$retour = "> à  ".$tab_cdm_mh[$statmin];
			$retour .= "(moy bestiaire : ".$caracs_moyennes[$stat].")";	
		}	
		
		return $retour;
		
	}
	
	// Récupère la distance entre 2 éléments
	function getDist( $x1, $y1, $n1, $x2, $y2, $n2 ){
		
		$x = abs($x1-$x2);
		$y = abs($y1-$y2);
		$n = abs($n1-$n2);		
		
		if ( $x >= $y && $x >= $n )
			return $x;
			
		if ( $y >= $x && $y >= $n )
			return $y;
			
		if ( $n >= $y && $n >= $x )
			return $n;						
			
	}
	
	// Retourne un timestamp à partir d'une date MH
	function getTimeWithMhDate($date){
		
		$date = preg_split( "# #", $date );
		$dmY = preg_split( "#/#", $date[0] );						
		$hms = preg_split( "#:#", $date[1] );	
					
		return mktime( $hms[0], $hms[1], $hms[2], $dmY[1], $dmY[0], $dmY[2] );			
		
	}

?>