<?php

	function parseCompGGC( $data, $bdd, $db_link ){
		
		$texte = addslashes(trim($data["copiercoller"]));
		
		if ( isEventInDb( $data["idLanceur"], $data, $bdd, $db_link  ) )
			return "La comp�tence ". $data["nom"]. " � ". $data["date"]. " pour la cible " .$data["idCible"]. " a d�ja �t� enregistr� !";
		else 
			mysql_db_query($bdd,"INSERT INTO `ggc_event` (`id_event`, `id_lanceur` , `id_cible` , `type` , `nom` , `texte` , `date` ) VALUES (NULL, '" .intval($data["idLanceur"]). "', '" .intval($data["idCible"]). "', '" .addslashes($data["type"]). "', '" .addslashes($data["nom"]). "', '$texte', '" .addslashes($data["date"]). "' );",$db_link) or die(mysql_error());
	
		return "Comp�tence ajout� pour votre GGC !";			
	
	}
	
	function parseSortGGC( $data, $bdd, $db_link ){
		
		$texte = addslashes(trim($data["copiercoller"]));
		
		if ( isEventInDb( $data["idLanceur"], $data, $bdd, $db_link  ) )
			return "Le Sortil�ge ". $data["nom"]. " � ". $data["date"]. " pour la cible " .$data["idCible"]. " a d�ja �t� enregistr� !";
		else 
			mysql_db_query($bdd,"INSERT INTO `ggc_event` (`id_event`, `id_lanceur` , `id_cible` , `type` , `nom` , `texte` , `date` ) VALUES (NULL, '" .intval($data["idLanceur"]). "', '" .intval($data["idCible"]). "', '" .addslashes($data["type"]). "', '" .addslashes($data["nom"]). "', '$texte', '" .addslashes($data["date"]). "' );",$db_link) or die(mysql_error());
			
		return "Sortil�ge ajout� pour votre GGC !";		
	
	}	
	
	function addTreasure( $data, $bdd, $db_link ){

		$text = trim(preg_replace( "#.+\D(\d+ - .+)Le tr�sor se trouve � vos pieds en.+#", "$1", str_replace( "<|>", "", $data) ));		
		$id = preg_replace( "#(\d+) - .+#", "$1", $text );
		$nom = preg_replace( "#.+ - (.+) \(.*\)#", "$1", $text );
		$desc = preg_replace( "#.+\((.*)\)#", "$1", $text );
		
		mysql_db_query($bdd,"INSERT INTO `ggc_tresor` (`id_tresor`, `nom` , `desc`) VALUES (" .intval($id). ", '" .addslashes($nom). "', '" .addslashes($desc). "');",$db_link) or die(mysql_error());
		
	}
	
	function addTrap( $data, $bdd, $db_link ){

		$text = trim(preg_replace( "#.+(Vous avez pos� un Pi�ge � .+ Ma�trise Magique\s+est de \d+).+#", "$1", str_replace( "<|>", "", $data["copiercoller"])));		
		$type = (preg_match( "#.+Feu.+#", $text )) ? "Feu" : "Glue";
		$texte = "Pi�ge pos� par <a class=\"AllLinks\" onclick=\"EnterPJView(" .intval($data["idLanceur"]). ",750,550)\" href=\"javascript:\">" .intval($data["idLanceur"]). "</a> MM=".preg_replace( "#.+Ma�trise Magique\s+est de (\d+)#", "$1", $text );
		$X = preg_replace( "#.+X = (-?\d+).+#", "$1", $text );
		$Y = preg_replace( "#.+Y = (-?\d+).+#", "$1", $text );
		$N = preg_replace( "#.+N = (-?\d+).+#", "$1", $text );
		
		mysql_db_query($bdd,"INSERT INTO `ggc_piege` (`id_piege`, `id_troll`, `type`, `texte`, `date`, `X`, `Y`, `N`) VALUES (NULL, '".intval($data["idLanceur"])."', '$type', '" .addslashes($texte). "', '" .addslashes($data["date"]). "', '$X', '$Y', '$N');",$db_link) or die(mysql_error());
		
	}	
	
	function removeTrap( $data, $bdd, $db_link ){
		
		$text = trim(preg_replace( "#.+(a d�clench� votre Pi�ge � .+\d\.).+#", "$1", str_replace( "<|>", "", $data["trapInfo"])));	
		$type = (preg_match( "#.+Feu.+#", $text )) ? "Feu" : "Glue";
		$X = preg_replace( "#.+X =\s+(-?\d+).+#", "$1", $text );
		$Y = preg_replace( "#.+Y =\s+(-?\d+).+#", "$1", $text );
		$N = preg_replace( "#.+N =\s+(-?\d+).+#", "$1", $text );		
		
		mysql_db_query($bdd,"DELETE FROM `ggc_piege` WHERE `ggc_piege`.`id_troll` = ".intval($data["idLanceur"])." AND `ggc_piege`.`type` = '$type' AND `ggc_piege`.`X` = $X AND `ggc_piege`.`Y` = $Y AND `ggc_piege`.`N` = $N;",$db_link) or die(mysql_error());
		
	}
	
	function isEventInDb( $id_lanceur, $data, $bdd, $db_link  ){
		
		$date = preg_split( "# #", $data["date"] );
		$dmY = preg_split( "#/#", $date[0] );						
		$hms = preg_split( "#:#", $date[1] );				
		$date = mktime( $hms[0], $hms[1], $hms[2], $dmY[1], $dmY[0], $dmY[2] );				
		
		$sql = "SELECT date FROM ggc_event e WHERE id_lanceur = '" .intval($id_lanceur). "' ";
		$sql .= "AND nom = '" .addslashes($data["nom"]). "' ";
		$sql .= "AND UNIX_TIMESTAMP(STR_TO_DATE( (SELECT date FROM ggc_event WHERE id_event = e.id_event), '%d/%m/%Y %H:%i:%s' )) - '" .$date. "' > -10 AND UNIX_TIMESTAMP(STR_TO_DATE( (SELECT date FROM ggc_event WHERE id_event = e.id_event), '%d/%m/%Y %H:%i:%s' )) - '" .$date. "' < 10 ";
		$sql .= "AND id_cible = '" .intval($data["idCible"]). "';";		
		$result = mysql_db_query($bdd,$sql,$db_link) or die(mysql_error());	
		
		return mysql_num_rows($result);
		
	}

?>